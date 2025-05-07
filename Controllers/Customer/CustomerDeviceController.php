<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\EmergencyEntity;
use App\Models\EmergencyIncident;
use App\Models\Home;
use App\Models\OperationSchedule;
use App\Models\SmartAcSetting;
use App\Models\SmartDevice;
use App\Models\SmartLightSetting;
use Illuminate\Http\Request;
use App\Models\InventoryDevice;

class CustomerDeviceController extends Controller
{
    public function listDevices(Request $request)
    {
        $user = auth()->user();
        if (session()->has('member_id')) {
            $member = \App\Models\Member::with('home')->find(session('member_id'));
            $homes = $member->home ? collect([$member->home]) : collect();
            $homeIDs = $member->home ? [$member->home->homeID] : [];
        } else {
            $homes = \App\Models\Home::where('accountID', $user->accountID)->get();
            $homeIDs = $homes->pluck('homeID')->toArray();
        }
        $selectedHome = $request->get('home_id');
        $selectedRoom = $request->get('room');
        $devicesQuery = \App\Models\InventoryDevice::with('smartDevice');
        if ($selectedHome) {
            $devicesQuery->where('homeID', $selectedHome);
        } else {
            $devicesQuery->whereIn('homeID', $homeIDs);
        }

        // Get room list if a home is selected
        $rooms = [];
        if ($selectedHome) {
            $rooms = InventoryDevice::where('homeID', $selectedHome)
                ->select('deviceLocation')
                ->distinct()
                ->pluck('deviceLocation');
        }
        if ($selectedRoom) {
            $devicesQuery->where('deviceLocation', $selectedRoom);
        }
        $devices = $devicesQuery->get();
        return view('customer.list_devices', compact(
            'devices', 'homes', 'selectedHome', 'rooms', 'selectedRoom'
        ));
    }


    public function deviceSettings($id)
    {
        $device = InventoryDevice::with(['operationSchedule', 'lightSetting', 'acSetting'])->findOrFail($id);
        return view('customer.device_settings', compact('device'));
    }

    public function toggleDevice($id, $status)
    {
        $device = InventoryDevice::findOrFail($id);
        $device->update(['is_on' => $status]);

        return response()->json(['status' => $status]);
    }

    public function updateSchedule(Request $request, $id)
    {
//        dd($request->all());
//        $request->validate([
//            'scheduleName' => 'nullable|string|max:100',
//            'days' => 'nullable|array',
//            'days.*' => 'in:Monday,Tuesday,Wednesday,Thursday,Friday,Saturday,Sunday',
//            'startDate' => 'nullable|date',
//            'endDate' => 'nullable|date|after_or_equal:startDate',
//            'onTime' => 'required|date_format:H:i',
//            'offTime' => 'required|date_format:H:i',
//        ]);


        $schedule = OperationSchedule::updateOrCreate(
            ['inventoryDeviceID' => $id],
            [
                'scheduleName' => $request->scheduleName,
                'days' => $request->days ?? [],
                'startDate' => $request->startDate,
                'endDate' => $request->endDate,
                'onTime' => $request->onTime,
                'offTime' => $request->offTime,
            ]
        );

        return response()->json(['message' => 'Schedule updated successfully!']);
    }


    // تحديث إعدادات الإضاءة الذكية
    public function updateLight(Request $request, $id)
    {
        $request->validate([
            'lightBrightness' => 'required|integer|min:0|max:100',
            'lightColor' => 'nullable|string|max:50',
        ]);

        $lightSetting = SmartLightSetting::updateOrCreate(
            ['inventoryDeviceID' => $id],
            [
                'lightBrightness' => $request->lightBrightness,
                'lightColor' => $request->lightColor,
            ]
        );

        return response()->json(['message' => 'Light settings updated successfully!']);
    }

    // تحديث إعدادات التكييف الذكي
    public function updateAc(Request $request, $id)
    {
        $request->validate([
            'acTemperature' => 'required|integer|min:16|max:30',
            'acFan' => 'required|in:low,medium,high,auto',
            'acMode' => 'required|in:cool,heat,fan,dry,auto',
        ]);

        $acSetting = SmartAcSetting::updateOrCreate(
            ['inventoryDeviceID' => $id],
            [
                'acTemperature' => $request->acTemperature,
                'acFan' => $request->acFan,
                'acMode' => $request->acMode,
            ]
        );

        return response()->json(['message' => 'AC settings updated successfully!']);
    }

    public function listEmergencies(Request $request)
    {
        $query = EmergencyIncident::with(['emergencyEntity', 'inventoryDevice.smartDevice'])
            ->whereHas('inventoryDevice', function ($q) {
                $q->whereHas('home', function ($q) {
                    $q->where('accountID', auth()->id());
                });
            });

        $deviceTypes = SmartDevice::select('deviceType')->distinct()->pluck('deviceType');

        if ($request->has('date') && $request->date) {
            $query->whereDate('date', $request->date);
        }

        if ($request->has('status') && $request->status) {
            $query->where('emergencyStatus', $request->status);
        }

        if ($request->has('device_type') && $request->device_type) {
            $query->whereHas('inventoryDevice.smartDevice', function ($q) use ($request) {
                $q->where('deviceType', $request->device_type);
            });
        }

        $emergencies = $query->orderBy('date', 'desc')->get();

        return view('customer.emergency_incidents', compact('emergencies', 'deviceTypes'));
    }


    public function listEmergencyContacts()
    {
        $contacts = EmergencyEntity::whereHas('inventoryDevice', function ($q) {
            $q->whereHas('home', function ($q) {
                $q->where('accountID', auth()->id());
            });
        })->get();

        return view('customer.emergency_contacts', compact('contacts'));
    }
}
