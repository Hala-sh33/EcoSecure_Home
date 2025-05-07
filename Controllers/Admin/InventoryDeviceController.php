<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\InventoryDevice;
use App\Models\Home;
use App\Models\SmartDevice;

class InventoryDeviceController extends Controller
{
    // Show all devices
    public function index()
    {
        $devices = InventoryDevice::with(['home', 'smartDevice'])->get();
        return view('dashboard.devices.index', compact('devices'));
    }

    // Show create device form
    public function create()
    {
        $homes = Home::all();
        $smartDevices = SmartDevice::all();
        return view('dashboard.devices.create', compact('homes', 'smartDevices'));
    }

    // Store new device
    public function store(Request $request)
    {
        $request->validate([
            'homeID' => 'required|exists:Home,homeID',
            'deviceID' => 'required|exists:SmartDevice,deviceID',
            'deviceLocation' => 'required|string|max:255',
            'color' => 'required|string|max:50',
            'size' => 'required|string|max:50',
        ]);

        InventoryDevice::create([
            'homeID' => $request->homeID,
            'deviceID' => $request->deviceID,
            'deviceLocation' => $request->deviceLocation,
            'color' => $request->color,
            'size' => $request->size,
        ]);

        return redirect()->route('admin.devices.index')->with('success', 'Smart device added successfully!');
    }

    // Show edit form
    public function edit($id)
    {
        $device = InventoryDevice::findOrFail($id);
        $homes = Home::all();
        $smartDevices = SmartDevice::all();
        return view('dashboard.devices.edit', compact('device', 'homes', 'smartDevices'));
    }

    // Update device details
    public function update(Request $request, $id)
    {
        $device = InventoryDevice::findOrFail($id);

        $request->validate([
            'homeID' => 'required|exists:Home,homeID',
            'deviceID' => 'required|exists:SmartDevice,deviceID',
            'deviceLocation' => 'required|string|max:255',
            'color' => 'required|string|max:50',
            'size' => 'required|string|max:50',
        ]);

        $device->update([
            'homeID' => $request->homeID,
            'deviceID' => $request->deviceID,
            'deviceLocation' => $request->deviceLocation,
            'color' => $request->color,
            'size' => $request->size,
        ]);

        return redirect()->route('admin.devices.index')->with('success', 'Smart device updated successfully!');
    }

    // Delete device
    public function destroy($id)
    {
        $device = InventoryDevice::findOrFail($id);
        $device->delete();

        return redirect()->route('admin.devices.index')->with('success', 'Smart device deleted successfully!');
    }
}
