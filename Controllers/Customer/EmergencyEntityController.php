<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EmergencyEntity;
use App\Models\InventoryDevice;

class EmergencyEntityController extends Controller
{
    public function index()
    {
        $entities = EmergencyEntity::with('inventoryDevice')
            ->whereHas('inventoryDevice', function ($q) {
                $q->whereIn('homeID', auth()->user()->homes()->pluck('homeID'));
            })->get();

        return view('customer.emergency_entities.index', compact('entities'));
    }

    public function create()
    {
        $devices = InventoryDevice::whereIn('homeID', auth()->user()->homes()->pluck('homeID'))->get();
        return view('customer.emergency_entities.create', compact('devices'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'inventoryDeviceID' => 'required|exists:InventoryDevice,inventoryDeviceID',
            'emergencyName' => 'required|string|max:100',
            'emergencyDescription' => 'nullable|string',
            'emergencyContact' => 'required|string|max:100',
            'emergencyNameMember' => 'nullable|string|max:100',
        ]);

        $emergencyName = $request->emergencyName === 'Custom Member'
            ? $request->emergencyNameMember
            : $request->emergencyName;

        EmergencyEntity::create([
            'inventoryDeviceID' => $request->inventoryDeviceID,
            'emergencyName' => $emergencyName,
            'emergencyDescription' => $request->emergencyDescription,
            'emergencyContact' => $request->emergencyContact,
        ]);

        return redirect()->route('customer.emergency_entities.index')->with('success', 'Emergency Entity added successfully.');
    }


    public function edit(EmergencyEntity $emergencyEntity)
    {
        $devices = InventoryDevice::whereIn('homeID', auth()->user()->homes()->pluck('homeID'))->get();
        return view('customer.emergency_entities.edit', compact('emergencyEntity', 'devices'));
    }

    public function update(Request $request, EmergencyEntity $emergencyEntity)
    {
        $request->validate([
            'inventoryDeviceID' => 'required|exists:InventoryDevice,inventoryDeviceID',
            'emergencyName' => 'required|string|max:100',
            'emergencyDescription' => 'nullable|string',
            'emergencyContact' => 'required|string|max:100',
            'emergencyNameMember' => 'nullable|string|max:100',
        ]);

        $emergencyName = $request->emergencyName === 'Custom Member'
            ? $request->emergencyNameMember
            : $request->emergencyName;

        $emergencyEntity->update([
            'inventoryDeviceID' => $request->inventoryDeviceID,
            'emergencyName' => $emergencyName,
            'emergencyDescription' => $request->emergencyDescription,
            'emergencyContact' => $request->emergencyContact,
        ]);

        return redirect()->route('customer.emergency_entities.index')->with('success', 'Emergency Entity updated successfully.');
    }


    public function destroy(EmergencyEntity $emergencyEntity)
    {
        $emergencyEntity->delete();
        return redirect()->route('customer.emergency_entities.index')->with('success', 'Emergency Entity deleted.');
    }
}
