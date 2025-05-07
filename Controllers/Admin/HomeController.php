<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Home;
use App\Models\Account;

class HomeController extends Controller
{
    // Show all homes
    public function index()
    {
        $homes = Home::with('account')->get();
        return view('dashboard.homes.index', compact('homes'));
    }

    // Show create home form
    public function create()
    {
        $owners = Account::where('accountType', 'homeowner')->get();
        return view('dashboard.homes.create', compact('owners'));
    }

    // Store new home
    public function store(Request $request)
    {
        $request->validate([
            'accountID' => 'required|exists:Account,accountID',
            'streetName' => 'required|string|max:255',
            'homeNumber' => 'required|string|max:50|unique:Home,homeNumber',
            'homeType' => 'required|string|max:100',
            'Country' => 'required|string|max:100',
            'City' => 'required|string|max:100',
            'numberOfRooms' => 'required|integer|min:1',
        ]);

        Home::create([
            'accountID' => $request->accountID,
            'streetName' => $request->streetName,
            'homeNumber' => $request->homeNumber,
            'homeType' => $request->homeType,
            'Country' => $request->Country,
            'City' => $request->City,
            'numberOfRooms' => $request->numberOfRooms,
        ]);

        return redirect()->route('admin.homes.index')->with('success', 'Home added successfully!');
    }

    // Show edit form
    public function edit($id)
    {
        $home = Home::findOrFail($id);
        $owners = Account::where('accountType', 'homeowner')->get();
        return view('dashboard.homes.edit', compact('home', 'owners'));
    }

    // Update home details
    public function update(Request $request, $id)
    {
        $home = Home::findOrFail($id);

        $request->validate([
            'accountID' => 'required|exists:Account,accountID',
            'streetName' => 'required|string|max:255',
            'homeNumber' => 'required|string|max:50|unique:Home,homeNumber,' . $home->homeID . ',homeID',
            'homeType' => 'required|string|max:100',
            'Country' => 'required|string|max:100',
            'City' => 'required|string|max:100',
            'numberOfRooms' => 'required|integer|min:1',
        ]);

        $home->update([
            'accountID' => $request->accountID,
            'streetName' => $request->streetName,
            'homeNumber' => $request->homeNumber,
            'homeType' => $request->homeType,
            'Country' => $request->Country,
            'City' => $request->City,
            'numberOfRooms' => $request->numberOfRooms,
        ]);

        return redirect()->route('admin.homes.index')->with('success', 'Home updated successfully!');
    }

    // Delete home
    public function destroy($id)
    {
        $home = Home::findOrFail($id);
        $home->delete();

        return redirect()->route('admin.homes.index')->with('success', 'Home deleted successfully!');
    }
}
