<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Home;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MyHomeController extends Controller
{
    public function index()
    {
        $homes = Auth::user()->homes()->withCount('inventoryDevices')->get();
        return view('customer.my_homes.index', compact('homes'));
    }

    public function edit($id)
    {
        $home = auth()->user()->homes()->findOrFail($id);
        return view('customer.my_homes.edit', compact('home'));
    }

    public function update(Request $request, $id)
    {
        $home = auth()->user()->homes()->findOrFail($id);

        $validated = $request->validate([
            'streetName' => 'required|string|max:255',
            'homeNumber' => 'required|string|max:50',
            'homeType' => 'required|string|max:50',
            'City' => 'required|string|max:100',
        ]);

        $home->update($validated);

        return redirect()->route('customer.my_homes.index')->with('success', 'Home updated successfully.');
    }

    public function destroy($id)
    {
        $home = auth()->user()->homes()->withCount('inventoryDevices')->findOrFail($id);

        if ($home->inventory_devices_count > 0) {
            return redirect()->route('customer.my_homes.index')->with('error', 'You cannot delete a home that has devices.');
        }

        $home->delete();

        return redirect()->route('customer.my_homes.index')->with('success', 'Home deleted successfully.');
    }

}
