@extends('customer.layouts.app')

@push('css')
    <style>
        .settings-box {
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            background: #fff;
        }

        .settings-box h6 {
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 15px;
        }
    </style>
@endpush

@section('content')
    <div class="min-height-200px">
        <div class="page-header">
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="title">
                        <h4>Device Settings</h4>
                    </div>
                    <nav aria-label="breadcrumb" role="navigation">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('customer.dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('customer.device.list') }}">Devices</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Settings</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- Operation Schedule Settings -->
            <div class="col-md-6">
                <div class="settings-box">
                    <h6><i class="dw dw-calendar1"></i> Operation Schedule</h6>
                    <form id="operationScheduleForm">
                        @csrf
                        <input type="hidden" name="inventoryDeviceID" value="{{ $device->inventoryDeviceID }}">

                        <!-- اختيار جدول جاهز -->
                        <div class="form-group">
                            <label>Select Predefined Schedule</label>
                            <select class="form-control" name="scheduleName">
                                <option value="">-- Select --</option>
                                @foreach(['Summer', 'Winter', 'Away', 'Weekend'] as $schedule)
                                    <option value="{{ $schedule }}" {{ $device->operationSchedule->scheduleName == $schedule ? 'selected' : '' }}>
                                        {{ $schedule }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- اسم الجدول المخصص -->
                        <div class="form-group mt-3">
                            <label>Or Create New Schedule</label>
                            <input type="text" class="form-control" name="scheduleName" placeholder="e.g. Family Trip"
                                   value="{{ $device->operationSchedule->scheduleName }}">
                        </div>
                        @php
                            $daysArray = json_decode($device->operationSchedule->days, true) ?? [];
                        @endphp
                        <div class="form-group">
                            <label>Days</label>
                            <div class="row">
                                @foreach(['Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday'] as $day)
                                    <div class="col-4">
                                        <label>
                                            <input type="checkbox" name="days[]" value="{{ $day }}"
                                                {{ in_array($day, $daysArray) ? 'checked' : '' }}>
                                            {{ $day }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>


                        <div class="form-group">
                            <label>Start Date</label>
                            <input type="date" class="form-control" name="startDate" value="{{ $device->operationSchedule->startDate }}">
                        </div>

                        <div class="form-group">
                            <label>End Date</label>
                            <input type="date" class="form-control" name="endDate" value="{{ $device->operationSchedule->endDate }}">
                        </div>

                        <div class="form-group">
                            <label>On Time</label>
                            <input type="time" class="form-control" name="onTime" value="{{ $device->operationSchedule->onTime }}">
                        </div>

                        <div class="form-group">
                            <label>Off Time</label>
                            <input type="time" class="form-control" name="offTime" value="{{ $device->operationSchedule->offTime }}">
                        </div>

                        <button type="submit" class="btn btn-primary mt-3">Save</button>
                    </form>
                </div>
            </div>

        @if($device->smartDevice->deviceType === 'Smart AC')
            <!-- AC Settings -->
            <div class="col-md-4">
                <div class="settings-box">
                    <h6><i class="dw dw-air-conditioning"></i> AC Settings</h6>
                    <form id="acSettingForm">
                        @csrf
                        <input type="hidden" name="inventoryDeviceID" value="{{ $device->inventoryDeviceID }}">

                        <div class="form-group">
                            <label>Temperature (°C)</label>
                            <input type="number" class="form-control" name="acTemperature" value="{{ $device->acSetting->acTemperature ?? '' }}" min="16" max="30">
                        </div>
                        <div class="form-group">
                            <label>Fan Speed</label>
                            <select class="form-control" name="acFan">
                                @foreach(['low', 'medium', 'high', 'auto'] as $fan)
                                    <option value="{{ $fan }}" {{ isset($device->acSetting) && $device->acSetting->acFan == $fan ? 'selected' : '' }}>
                                        {{ ucfirst($fan) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Mode</label>
                            <select class="form-control" name="acMode">
                                @foreach(['cool', 'heat', 'fan', 'dry', 'auto'] as $mode)
                                    <option value="{{ $mode }}" {{ isset($device->acSetting) && $device->acSetting->acMode == $mode ? 'selected' : '' }}>
                                        {{ ucfirst($mode) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary mt-3">Save</button>
                    </form>
                </div>
            </div>
            @endif

            @if($device->smartDevice->deviceType === 'Smart Light')
            <!-- Light Settings -->
            <div class="col-md-4">
                <div class="settings-box">
                    <h6><i class="dw dw-lightbulb"></i> Light Settings</h6>
                    <form id="lightSettingForm">
                        @csrf
                        <input type="hidden" name="inventoryDeviceID" value="{{ $device->inventoryDeviceID }}">

                        <div class="form-group">
                            <label>Brightness (%)</label>
                            <input type="number" class="form-control" name="lightBrightness" value="{{ $device->lightSetting->lightBrightness ?? '' }}" min="0" max="100">
                        </div>
                        <div class="form-group">
                            <label>Color</label>
                            <input type="text" class="form-control" name="lightColor" value="{{ $device->lightSetting->lightColor ?? '' }}">
                        </div>

                        <button type="submit" class="btn btn-primary mt-3">Save</button>
                    </form>
                </div>
            </div>
            @endif

        </div>
    </div>


@endsection
@push('js')
    <script>
        function updateSetting(formId, route) {
            const form = document.getElementById(formId);

            if (form) {
                form.addEventListener('submit', function (event) {
                    event.preventDefault();
                    let formData = new FormData(this);
                    const days = [];
                    this.querySelectorAll('input[name="days[]"]:checked').forEach(checkbox => {
                        days.push(checkbox.value);
                    });
                    formData.set('days', JSON.stringify(days));
                    fetch(route, {
                        method: "POST",
                        body: formData,
                        headers: {
                            "X-CSRF-TOKEN": '{{ csrf_token() }}',
                        }
                    })
                        .then(response => response.json())
                        .then(data => {
                            Swal.fire({
                                icon: 'success',
                                title: 'Updated!',
                                text: data.message,
                                confirmButtonText: 'OK'
                            });
                        })
                        .catch(error => {
                            console.error("Error:", error);
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Something went wrong!'
                            });
                        });
                });
            }
        }


        updateSetting("operationScheduleForm", "{{ route('customer.device.updateSchedule', $device->inventoryDeviceID) }}");
        updateSetting("lightSettingForm", "{{ route('customer.device.updateLight', $device->inventoryDeviceID) }}");
        updateSetting("acSettingForm", "{{ route('customer.device.updateAc', $device->inventoryDeviceID) }}");
    </script>
@endpush
