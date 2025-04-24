@foreach($devices as $device)
    <div class="col-lg-6 col-md-6 col-sm-12">
        <div class="product-box">
            <div class="producct-img text-center mt-2">
                <img style="height: 150px; margin-top: 20px;" src="{{ $device->smartDevice->image_path }}" alt="Device Image">
            </div>
            <div class="product-caption">
                <h4>{{ $device->smartDevice->deviceType }}</h4>
                <p><strong>Location:</strong> {{ $device->deviceLocation }}</p>

                <!-- Action Buttons -->
                <div class="d-flex flex-column mt-2">
                    <div class="d-flex justify-content-between">
                        <button style="font-size: 12px;" class="btn btn-outline-danger btn-sm mb-2" onclick="openEmergencyEntityModal({{ $device->inventoryDeviceID }})">
                            <i class="dw dw-warning"></i> Add Emergency Entity
                        </button>
                        <button class="btn btn-danger btn-sm mb-2" onclick="viewEmergencyEntityLogs({{ $device->inventoryDeviceID }})">
                            <i class="dw dw-list"></i> View Logs
                        </button>
                    </div>

                    <div class="d-flex justify-content-between">
                        <button style="font-size: 11.5px;" class="btn btn-outline-warning btn-sm mb-2" onclick="openEmergencyIncidentModal({{ $device->inventoryDeviceID }})">
                            <i class="dw dw-alarm"></i> Add Emergency Incident
                        </button>
                        <button class="btn btn-warning btn-sm mb-2" onclick="viewEmergencyIncidentLogs({{ $device->inventoryDeviceID }})">
                            <i class="dw dw-list"></i> View Logs
                        </button>
                    </div>

                    <div class="d-flex justify-content-between">
                        <button style="font-size: 12px;" class="btn btn-outline-success btn-sm" onclick="openConsumptionLogModal({{ $device->inventoryDeviceID }})">
                            <i class="dw dw-analytics"></i> Add Consumption Log
                        </button>
                        <button class="btn btn-success btn-sm" onclick="viewConsumptionLog({{ $device->inventoryDeviceID }})">
                            <i class="dw dw-list"></i> View Logs
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach
