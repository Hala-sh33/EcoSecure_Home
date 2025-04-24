@extends('customer.layouts.app')

@section('content')
    <div class="min-height-200px">
        <div class="page-header">
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="title">
                        <h4>My Smart Devices</h4>
                    </div>
                    <nav aria-label="breadcrumb" role="navigation">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('customer.dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Devices</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <!-- Select Home -->
        <div class="card-box p-3 mb-4">
            <div class="row">
                <div class="col-md-6">
                    <form method="GET" action="{{ route('customer.device.list') }}">
                        <label for="homeSelect"><strong>Select Home:</strong></label>
                        <select class="form-control select2" id="homeSelect" name="home_id" onchange="this.form.submit()">
                            <option value="">All Homes</option>
                            @foreach($homes as $home)
                                <option value="{{ $home->homeID }}" {{ $selectedHome == $home->homeID ? 'selected' : '' }}>
                                    {{ $home->streetName }} ({{ $home->City }})
                                </option>
                            @endforeach
                        </select>
                    </form>

                </div>
                <div class="col-md-6">
                    <!-- Select Room (only if a home is selected) -->
                    @if($selectedHome)
                        <form method="GET" action="{{ route('customer.device.list') }}" class="mb-4">
                            <input type="hidden" name="home_id" value="{{ $selectedHome }}">
                            <label for="roomSelect"><strong>Select Room:</strong></label>
                            <select class="form-control select2" id="roomSelect" name="room" onchange="this.form.submit()">
                                <option value="">All Rooms</option>
                                @foreach($rooms as $room)
                                    <option value="{{ $room }}" {{ $selectedRoom == $room ? 'selected' : '' }}>
                                        {{ $room }}
                                    </option>
                                @endforeach
                            </select>
                        </form>
                    @endif
                </div>
            </div>
        </div>

        <!-- Device List -->
        <div class="row">
            @forelse($devices as $device)
                <div class="col-md-4 mb-3">
                    <div class="card-box text-center p-4 ">
                        <div class="device-img">
                            <img src="{{ $device->smartDevice->image_path }}" alt="Device Image" class="img-fluid" style="height: 150px;">
                        </div>
                        <h5 class="mt-3">{{ $device->smartDevice->deviceType }}</h5>
                        <p class="text-muted">Location: {{ $device->deviceLocation }}</p>

                        <!-- Toggle Switch for ON/OFF -->
                        <div class="custom-control custom-switch mb-3">
                            <input type="checkbox" class="custom-control-input device-toggle" id="deviceSwitch{{ $device->inventoryDeviceID }}" {{ $device->is_on ? 'checked' : '' }}>
                            <label class="custom-control-label" for="deviceSwitch{{ $device->inventoryDeviceID }}">
                                {{ $device->is_on ? 'Turn Off' : 'Turn On' }}
                            </label>
                        </div>

                        <!-- Settings Button -->
                        <a href="{{ route('customer.device.settings', $device->inventoryDeviceID) }}" class="btn btn-outline-primary btn-sm">
                            <i class="dw dw-settings2"></i> Settings
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-warning text-center">No devices found for the selected home.</div>
                </div>
            @endforelse
        </div>
    </div>
@endsection


@push('js')
    <script>
        // Toggle Device State (ON/OFF)
        document.querySelectorAll('.device-toggle').forEach(toggle => {
            toggle.addEventListener('change', function () {
                let deviceID = this.id.replace('deviceSwitch', '');
                let isOn = this.checked ? 1 : 0;
                let label = this.nextElementSibling;

                fetch(`/customer/device/toggle/${deviceID}/${isOn}`, {
                    method: "POST",
                    headers: { "X-CSRF-TOKEN": '{{csrf_token()}}' }
                })
                    .then(response => response.json())
                    .then(data => {
                        label.textContent = data.status ? 'Turn Off' : 'Turn On';
                        Swal.fire({
                            icon: 'success',
                            title: 'Updated!',
                            text: 'Device Status Updated',
                            confirmButtonText: 'OK'
                        });
                    })
                    .catch(error => console.error("Error:", error));
            });
        });
    </script>
@endpush
