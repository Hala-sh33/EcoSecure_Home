<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\EmergencyIncident;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{

    public function dashboard(Request $request)
    {

        $range = $request->get('range', 'year');
        $startDate = match ($range) {
            'day' => Carbon::today(),
            'week' => Carbon::now()->startOfWeek(),
            'month' => Carbon::now()->startOfMonth(),
            'year' => Carbon::now()->startOfYear(),
            default => Carbon::now()->startOfMonth()
        };

        $user = auth()->user();

        if (session()->has('member_id')) {
            $member = \App\Models\Member::with('home')->find(session('member_id'));
            $homes = $member->home ? collect([$member->home]) : collect();
            $homeIds = $member->home ? [$member->home->homeID] : [];
        } else {
            $homes = $user->homes()->get();
            $homeIds = $homes->pluck('homeID')->toArray();
        }


        $selectedHomeId = $request->get('home_id');
        $homeId = $selectedHomeId;
        $filteredHomeIds = $selectedHomeId ? [$selectedHomeId] : $homeIds;

        $emergencyIncidents = \App\Models\EmergencyIncident::whereHas('inventoryDevice', function ($query) use ($filteredHomeIds) {
            $query->whereIn('homeID', $filteredHomeIds);
        })->count();

        $topDevices = DB::table('ConsumptionLog')
            ->join('InventoryDevice', 'ConsumptionLog.inventoryDeviceID', '=', 'InventoryDevice.inventoryDeviceID')
            ->join('SmartDevice', 'InventoryDevice.deviceID', '=', 'SmartDevice.deviceID')
            ->whereIn('InventoryDevice.homeID', $filteredHomeIds)
            ->whereBetween('ConsumptionLog.startStamp', [$startDate, now()])

            ->select('SmartDevice.deviceType as device_name', DB::raw('SUM(ConsumptionLog.consumption) as total'))
            ->groupBy('SmartDevice.deviceType')
            ->orderByDesc('total')
            ->limit(5)
            ->pluck('total', 'device_name');

        $electricityCategories = DB::table('ConsumptionLog')
            ->join('InventoryDevice', 'ConsumptionLog.inventoryDeviceID', '=', 'InventoryDevice.inventoryDeviceID')
            ->join('SmartDevice', 'InventoryDevice.deviceID', '=', 'SmartDevice.deviceID')
            ->whereIn('InventoryDevice.homeID', $filteredHomeIds)
            ->whereBetween('ConsumptionLog.startStamp', [$startDate, now()])

            ->select('SmartDevice.deviceType', DB::raw('SUM(ConsumptionLog.consumption) as total'))
            ->groupBy('SmartDevice.deviceType')
            ->pluck('total', 'deviceType');
//        dd($electricityCategories);

        $waterByRoom = DB::table('ConsumptionLog')
            ->join('InventoryDevice', 'ConsumptionLog.inventoryDeviceID', '=', 'InventoryDevice.inventoryDeviceID')
            ->whereIn('InventoryDevice.homeID', $filteredHomeIds)
            ->whereBetween('ConsumptionLog.startStamp', [$startDate, now()])

            ->select('InventoryDevice.deviceLocation as room_name', DB::raw('SUM(ConsumptionLog.consumption) as total'))
            ->groupBy('room_name')
            ->pluck('total', 'room_name');

        $solarGenerated = rand(600, 900);
        $savings = rand(439, 7877);

        return view('customer.dashboard', compact(
            'homes', 'selectedHomeId', 'electricityCategories',
            'topDevices', 'waterByRoom', 'solarGenerated', 'savings', 'emergencyIncidents', 'homeId'
        ));
    }



    public function editProfile()
    {
        $customer = auth()->user();
        return view('customer.profile', compact('customer'));
    }

    public function updateProfile(Request $request)
    {
        $customer = auth()->user();

        $request->validate([
            'accountName' => 'required|string|max:100',
            'email' => 'required|email|unique:Account,email,' . $customer->accountID . ',accountID',
            'phoneNumber' => ['required', 'regex:/^05[0-9]{8}$/'],
            'password' => 'nullable|min:8|regex:/[A-Za-z]/|regex:/[0-9]/|confirmed',
        ]);

        $customer->update([
            'accountName' => $request->accountName,
            'email' => $request->email,
            'phoneNumber' => $request->phoneNumber,
            'password' => $request->password ? bcrypt($request->password) : $customer->password,
        ]);

        return redirect()->back()->with('success', 'Profile updated successfully!');
    }

    public function subscriptions()
    {
        $subscriptions = auth()->user()->subscriptions()->get();
        return view('customer.subscriptions', compact('subscriptions'));
    }

    public function printSubscription($id)
    {
        $sub = auth()->user()->subscriptions()->findOrFail($id);
        return view('customer.subscription_print', compact('sub'));
    }

    public function destroySubscription($id)
    {
        $subscription = auth()->user()->subscriptions()->findOrFail($id);
        $subscription->delete();
        return redirect()->route('customer.subscriptions')->with('success', 'Subscription deleted.');
    }

    public function renewSubscription($id)
    {
        $old = auth()->user()->subscriptions()->findOrFail($id);
        $new = $old->replicate();
        $new->startDate = now();
        $new->endDate = now()->addMonth();
        $new->subscriptionStatus = 'active';
        $new->save();
        return redirect()->route('customer.subscriptions')->with('success', 'Subscription renewed.');
    }


    public function consumptionLog()
    {
        $devices = auth()->user()
            ->homes()
            ->with(['inventoryDevices.consumptionLogs', 'inventoryDevices.smartDevice'])
            ->get()
            ->pluck('inventoryDevices')
            ->flatten();
        return view('customer.consumption', compact('devices'));
    }


    public function getNotifications()
    {
        $user = auth()->user();
        $homes = $user->homes()->pluck('homeID');
        $devices = \App\Models\InventoryDevice::whereIn('homeID', $homes)->pluck('inventoryDeviceID');
        $now = Carbon::now();
        $startOfLastMonth = $now->copy()->subMonth()->startOfMonth();
        $endOfThisMonth = $now->copy()->endOfMonth();

        $incidents = EmergencyIncident::whereIn('inventoryDeviceID', $devices)
//            ->whereBetween('date', [$startOfLastMonth, $endOfThisMonth])
            ->get();

        return view('customer.notifications', compact('incidents'));
    }
    public static function getEmergencyNotifications()
    {
        $user = auth()->user();
        $homeIDs = $user->homes()->pluck('homeID');
        $deviceIDs = \App\Models\InventoryDevice::whereIn('homeID', $homeIDs)->pluck('inventoryDeviceID');

        $now = \Carbon\Carbon::now();
        $startOfLastMonth = $now->copy()->subMonth()->startOfMonth();
        $endOfThisMonth = $now->copy()->endOfMonth();

        $latestIncidents = \App\Models\EmergencyIncident::whereIn('inventoryDeviceID', $deviceIDs)
            ->whereBetween('date', [$startOfLastMonth, $endOfThisMonth])
            ->orderBy('date', 'desc')
            ->limit(5)
            ->get();

        $count = \App\Models\EmergencyIncident::whereIn('inventoryDeviceID', $deviceIDs)
            ->whereBetween('date', [$startOfLastMonth, $endOfThisMonth])
            ->count();

        $data =  [
            'count' => $count,
            'notifications' => $latestIncidents->map(function ($incident) {
                return [
                    'id' => $incident->containsNo,
                    'message' => $incident->action ?? 'Unknown emergency action',
                    'time' => $incident->startTime,
                    'status' => $incident->emergencyStatus,
                ];
            })
        ];
        return $data;
    }


}
