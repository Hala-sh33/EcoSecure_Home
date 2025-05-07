<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\InventoryDevice;
use App\Models\Home;
use App\Models\Account;
use App\Models\ConsumptionLog;
use App\Models\EmergencyIncident;
use App\Models\EmergencyEntity;

class DeviceDetailsController extends Controller
{
    public function index()
    {
        $customers = Account::where('accountType', 'homeowner')->get();
        return view('dashboard.devices.details', compact('customers'));
    }

    public function getHomes($accountID)
    {
        $homes = Home::where('accountID', $accountID)->get();
        return response()->json($homes);
    }

    public function getDevices($homeID)
    {
        $devices = InventoryDevice::where('homeID', $homeID)->with(['smartDevice'])->get();
        $html = view('dashboard.devices.device_cards', compact('devices'))->render();
        return response()->json(['html' => $html]);
    }

    public function getDeviceDetails($deviceID)
    {
        $device = InventoryDevice::with(['smartDevice'])->findOrFail($deviceID);
        $consumptionLogs = ConsumptionLog::where('inventoryDeviceID', $deviceID)->get();
        $emergencyIncidents = EmergencyIncident::where('inventoryDeviceID', $deviceID)->get();
        $emergencyEntities = EmergencyEntity::where('inventoryDeviceID', $deviceID)->get();

        $html = view('dashboard.devices.device_modal', compact('device', 'consumptionLogs', 'emergencyIncidents', 'emergencyEntities'))->render();
        return response()->json(['html' => $html]);
    }


    public function getEmergencyEntityLogs($deviceID)
    {
        $logs = EmergencyEntity::where('inventoryDeviceID', $deviceID)->get();
        $html = view('dashboard.devices.logs.emergency_entity_logs', compact('logs'))->render();
        return response()->json(['html' => $html]);
    }

    public function getEmergencyIncidentLogs($deviceID)
    {
        $logs = EmergencyIncident::where('inventoryDeviceID', $deviceID)->get();
        $html = view('dashboard.devices.logs.emergency_incident_logs', compact('logs'))->render();
        return response()->json(['html' => $html]);
    }

    public function getConsumptionLogs($deviceID)
    {
        $logs = ConsumptionLog::where('inventoryDeviceID', $deviceID)->get();
        $html = view('dashboard.devices.logs.consumption_logs', compact('logs'))->render();
        return response()->json(['html' => $html]);
    }


    public function storeEmergencyEntity(Request $request)
    {
        $request->validate([
            'inventoryDeviceID' => 'required|exists:InventoryDevice,inventoryDeviceID',
            'emergencyName' => 'required|string|max:255',
            'emergencyDescription' => 'required|string',
            'emergencyContact' => 'required|string|max:50',
        ]);

        $entity = EmergencyEntity::create($request->all());

        $html = view('dashboard.devices.logs.emergency_entity_logs', ['logs' => [$entity]])->render();

        return response()->json(['success' => 'Emergency Entity added successfully!', 'html' => $html]);
    }

    public function storeEmergencyIncident(Request $request)
    {
        $request->validate([
            'inventoryDeviceID' => 'required|exists:InventoryDevice,inventoryDeviceID',
            'date' => 'required|date',
            'startTime' => 'required',
            'endTime' => 'required',
            'emergencyStatus' => 'required|in:resolved,ongoing,critical',
            'action' => 'required|string',
        ]);

        $incident = EmergencyIncident::create($request->all());

        $html = view('dashboard.devices.logs.emergency_incident_logs', ['logs' => [$incident]])->render();

        return response()->json(['success' => 'Emergency Incident added successfully!', 'html' => $html]);
    }

    // Store Consumption Log
    public function storeConsumptionLog(Request $request)
    {
        $request->validate([
            'inventoryDeviceID' => 'required|exists:InventoryDevice,inventoryDeviceID',
            'startStamp' => 'required|date',
            'endStamp' => 'required|date|after_or_equal:startStamp',
            'consumption' => 'required|numeric|min:0',
        ]);

        $log = ConsumptionLog::create($request->all());

        $html = view('dashboard.devices.logs.consumption_logs', ['logs' => [$log]])->render();

        return response()->json(['success' => 'Consumption Log added successfully!', 'html' => $html]);
    }

    public function deleteEmergencyEntity($id)
    {
        EmergencyEntity::where('emergencyID', $id)->delete();
        return response()->json(['success' => 'Deleted']);
    }

    public function getEmergencyEntity($id)
    {
        $entity = EmergencyEntity::findOrFail($id);
        return response()->json($entity);
    }


}
