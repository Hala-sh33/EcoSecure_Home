<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Home;
use App\Models\SmartDevice;
use Illuminate\Http\Request;
use App\Models\Account;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\InventoryDevice;
use App\Models\Subscription;
use App\Models\Payment;
use Carbon\Carbon;
class AdminController extends Controller
{


    public function dashboard()
    {
        $totalCustomers = Account::where('accountType', 'homeowner')->count();
        $activeSubscriptions = Subscription::where('subscriptionStatus', 'active')->count();
        $totalDevices = SmartDevice::count();
        $totalSales = Subscription::whereMonth('startDate', now()->month)->count();

        $subscriptionsPerMonth = Subscription::selectRaw('MONTHNAME(startDate) as month, COUNT(*) as count')
//            ->whereYear('startDate', now()->year)
            ->groupBy('month')
            ->orderByRaw('MIN(startDate)')
            ->take(6)
            ->pluck('count', 'month');
//        dd($subscriptionsPerMonth);

        $salesPerCategory = Subscription::select('subscriptionStatus', DB::raw('COUNT(*) as count'))
            ->groupBy('subscriptionStatus')
            ->pluck('count', 'subscriptionStatus');
        $topCities = DB::table('Home')
            ->join('Account', 'Home.accountID', '=', 'Account.accountID')
            ->join('Subscription', 'Subscription.accountID', '=', 'Account.accountID')
            ->select('Home.City', DB::raw('COUNT(*) as count'))
            ->groupBy('Home.City')
            ->orderByDesc('count')
            ->limit(5)
            ->pluck('count', 'City');

        $customerHomeCount = Account::where('accountType', 'homeowner')
            ->leftJoin('Home', 'Account.accountID', '=', 'Home.accountID')
            ->select('Account.accountName', DB::raw('COUNT(Home.homeID) as home_count'))
            ->groupBy('Account.accountID', 'Account.accountName')
            ->orderByDesc('home_count')
            ->limit(10)
            ->pluck('home_count', 'accountName');
        return view('dashboard.index', compact(
            'totalCustomers',
            'activeSubscriptions',
            'totalDevices',
            'totalSales',
            'subscriptionsPerMonth',
            'salesPerCategory',
            'topCities',
            'customerHomeCount',
        ));
    }

    public function index()
    {
        $admins = Account::whereIn('accountType', ['admin', 'staff'])->get();
        return view('dashboard.admins.index', compact('admins'));
    }

    public function create()
    {
        return view('dashboard.admins.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'accountName' => 'required|string|max:255',
            'email' => 'required|email|unique:Account,email',
            'phoneNumber' => 'required|regex:/^05\d{8}$/|unique:Account,phoneNumber',
            'accountType' => 'required|in:admin,staff',
            'password' => 'required|min:8|confirmed',
        ]);
        Account::create([
            'accountName' => $request->accountName,
            'email' => $request->email,
            'phoneNumber' => $request->phoneNumber,
            'accountType' => $request->accountType,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('admin.admins.index')->with('success', 'User added successfully!');
    }

    public function edit($id)
    {
        $admin = Account::whereIn('accountType', ['admin', 'staff'])->findOrFail($id);
        return view('dashboard.admins.edit', compact('admin'));
    }

    public function update(Request $request, $id)
    {
        $admin = Account::whereIn('accountType', ['admin', 'staff'])->findOrFail($id);
        $request->validate([
            'accountName' => 'required|string|max:255',
            'email' => 'required|email|unique:Account,email,' . $admin->accountID . ',accountID',
            'phoneNumber' => 'required|regex:/^05\d{8}$/|unique:Account,phoneNumber,' . $admin->accountID . ',accountID',
            'accountType' => 'required|in:admin,staff',
            'password' => 'nullable|min:8|confirmed',
        ]);
        $admin->update([
            'accountName' => $request->accountName,
            'email' => $request->email,
            'phoneNumber' => $request->phoneNumber,
            'accountType' => $request->accountType,
            'password' => $request->password ? Hash::make($request->password) : $admin->password,
        ]);

        return redirect()->route('admin.admins.index')->with('success', 'User updated successfully!');
    }

    public function destroy($id)
    {
        $admin = Account::whereIn('accountType', ['admin', 'staff'])->findOrFail($id);
        $admin->delete();

        return redirect()->route('admin.admins.index')->with('success', 'User deleted successfully!');
    }

    public function profile()
    {
        $admin = auth()->user();
        return view('dashboard.profile', compact('admin'));
    }

    public function updateProfile(Request $request)
    {
        $admin = auth()->user();

        $request->validate([
            'accountName' => 'required|string|max:255',
            'email'       => 'required|email|unique:Account,email,' . $admin->accountID . ',accountID',
            'phoneNumber' => ['required', 'regex:/^05\d{8}$/'],
            'password'    => ['nullable', 'min:8', 'regex:/[a-z]/', 'regex:/[0-9]/'],
        ]);

        $admin->accountName = $request->accountName;
        $admin->email = $request->email;
        $admin->phoneNumber = $request->phoneNumber;

        if ($request->password) {
            $admin->password = Hash::make($request->password);
        }

        $admin->save();

        return redirect()->back()->with('success', 'Profile updated successfully');
    }
}
