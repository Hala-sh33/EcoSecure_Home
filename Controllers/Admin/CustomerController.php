<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Account;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Account::where('accountType', 'homeowner')->get();
        return view('dashboard.customers.index', compact('customers'));
    }

    public function create()
    {
        return view('dashboard.customers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'accountName' => 'required|string|max:255',
            'email' => 'required|email|unique:Account,email',
            'phoneNumber' => ['required', 'regex:/^05\d{8}$/', 'unique:Account,phoneNumber'],
            'password' => ['required', 'min:8', 'regex:/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/'],
        ]);

        Account::create([
            'accountName' => $request->accountName,
            'email' => $request->email,
            'phoneNumber' => $request->phoneNumber,
            'password' => Hash::make($request->password),
            'accountType' => 'homeowner',
        ]);

        return redirect()->route('admin.customers.index')->with('success', 'Customer added successfully!');
    }

    public function edit($id)
    {
        $customer = Account::where('accountType', 'homeowner')->findOrFail($id);
        return view('dashboard.customers.edit', compact('customer'));
    }

    public function update(Request $request, $id)
    {
        $customer = Account::where('accountType', 'homeowner')->findOrFail($id);
        $request->validate([
            'accountName' => 'required|string|max:255',
            'email' => 'required|email|unique:Account,email,' . $customer->accountID . ',accountID',
            'phoneNumber' => ['required', 'regex:/^05\d{8}$/', 'unique:Account,phoneNumber,' . $customer->accountID . ',accountID'],
            'password' => ['nullable', 'min:8', 'regex:/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/'],
        ]);
        $customer->update([
            'accountName' => $request->accountName,
            'email' => $request->email,
            'phoneNumber' => $request->phoneNumber,
            'password' => $request->password ? Hash::make($request->password) : $customer->password,
        ]);

        return redirect()->route('admin.customers.index')->with('success', 'Customer updated successfully!');
    }

    public function destroy($id)
    {
        $customer = Account::where('accountType', 'homeowner')->findOrFail($id);
        $customer->delete();
        return redirect()->route('admin.customers.index')->with('success', 'Customer deleted successfully!');
    }

    public function takeEmergencyAction($id)
    {
        $incident = \App\Models\EmergencyIncident::findOrFail($id);
        $incident->action = 'Owner took action manually';
        $incident->emergencyStatus = 'resolved';
        $incident->save();

        return response()->json(['message' => 'Emergency marked as resolved and action recorded.']);
    }

}
