<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Traits\UploadFile;
use Illuminate\Http\Request;
use App\Models\SmartDevice;

class SmartDeviceController extends Controller
{
    use UploadFile;

    public function index()
    {
        $smartDevices = SmartDevice::all();
        return view('dashboard.smart-devices.index', compact('smartDevices'));
    }

    public function create()
    {
        return view('dashboard.smart-devices.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'deviceType' => 'required|string|max:100|unique:SmartDevice,deviceType',
            'deviceStatus' => 'required|in:active,inactive,faulty',
            'deviceWarranty' => 'required|date',
            'quantityOnHand' => 'required|integer|min:1',
            'Description' => 'nullable|string',
            'year' => 'required|integer|min:2000|max:' . date('Y'),
            'modelNo' => 'required|string|max:100',
            'modelin' => 'required|string|max:100',
            'specification' => 'nullable|string',
            'pic' => 'nullable|image',
        ]);
        $data = $request->all();
        if ($request->hasFile('pic')) {
            $data['pic'] = $this->upload($request->file('pic'));
        }
        SmartDevice::create($data);

        return redirect()->route('admin.smart-devices.index')->with('success', 'Smart Device added successfully!');
    }

    public function edit($id)
    {
        $smartDevice = SmartDevice::findOrFail($id);
        return view('dashboard.smart-devices.edit', compact('smartDevice'));
    }

    public function update(Request $request, $id)
    {
        $smartDevice = SmartDevice::findOrFail($id);

        $request->validate([
            'deviceType' => 'required|string|max:100|unique:SmartDevice,deviceType,' . $smartDevice->deviceID . ',deviceID',
            'deviceStatus' => 'required|in:active,inactive,faulty',
            'deviceWarranty' => 'required|date',
            'quantityOnHand' => 'required|integer|min:1',
            'Description' => 'nullable|string',
            'year' => 'required|integer|min:2000|max:' . date('Y'),
            'modelNo' => 'required|string|max:100',
            'modelin' => 'required|string|max:100',
            'specification' => 'nullable|string',
            'pic' => 'nullable|image',
        ]);
        $data = $request->all();
        if ($request->hasFile('pic')) {
            $data['pic'] = $this->upload($request->file('pic'));
        }
        $smartDevice->update($data);

        return redirect()->route('admin.smart-devices.index')->with('success', 'Smart Device updated successfully!');
    }

    public function destroy($id)
    {
        $smartDevice = SmartDevice::findOrFail($id);
        $smartDevice->delete();

        return redirect()->route('admin.smart-devices.index')->with('success', 'Smart Device deleted successfully!');
    }
}
