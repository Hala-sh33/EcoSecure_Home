@extends('customer.layouts.app')

@push('css')
    <style>
        .status-badge {
            padding: 5px 10px;
            border-radius: 5px;
            font-size: 14px;
        }

        .critical { background-color: #ff4d4d; color: white; }
        .ongoing { background-color: #ffcc00; color: black; }
        .resolved { background-color: #28a745; color: white; }
        .notification-card1 {
            background: #f8d7da;
            border-left: 5px solid #e15260;
            padding: 22px;
            margin-bottom: 10px;
            border-radius: 5px;
        }
        .notification-card2 {
            background: #f8d7da;
            border-left: 5px solid #ec9a49;
            padding: 22px;
            margin-bottom: 10px;
            border-radius: 5px;
        }

        .notification-buttons {
            display: flex;
            gap: 10px;
        }
    </style>
@endpush

@section('content')
    <div class="min-height-200px">
        <div class="page-header">
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="title">
                        <h4>Emergency Incidents</h4>
                    </div>
                    <nav aria-label="breadcrumb" role="navigation">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('customer.dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Emergencies</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <!-- Emergency Alerts (dynamic) -->
        <div class="card-box p-4 mb-4">
            <h5 class="text-danger"><i class="dw dw-warning"></i> Emergency Alerts</h5>

            @forelse($emergencies->where('emergencyStatus', '!=', 'resolved') as $incident)
                @php
                    $isFire = optional($incident->emergencyEntity)->emergencyName === 'Fire Alarm';
                    $alertClass = $isFire ? 'notification-card2' : 'notification-card1';
                @endphp

                <div class="{{ $alertClass }} mb-3 mt-3 notification-card" id="incident-{{ $incident->containsNo }}">
                    <p>
                        <strong>{{ optional($incident->emergencyEntity)->emergencyName }}</strong>
                        - Incident reported on <strong>{{ $incident->date }}</strong> at <strong>{{ $incident->startTime }}</strong>
                    </p>
                    @php
                        $type = optional($incident->emergencyEntity)->emergencyName;
                    @endphp

                    <div class="notification-buttons">
                        @if($type === 'Unauthorized Access')
                            <button class="btn btn-sm btn-outline-secondary ignore-btn" data-id="{{ $incident->containsNo }}">Ignore</button>
                            <button class="btn btn-sm btn-outline-danger take-action-btn" data-id="{{ $incident->containsNo }}">Take Action</button>
                        @else
                            <button class="btn btn-sm btn-outline-danger take-action-btn" data-id="{{ $incident->containsNo }}">Take Action</button>
                        @endif
                    </div>

                </div>
            @empty
                <div class="alert alert-info text-center">No current emergency alerts.</div>
            @endforelse
        </div>


        <!-- Filter Section -->
        <div class="card-box p-4 mb-4">
            <form method="GET" action="{{ route('customer.device.emergencies') }}">
                <div class="row">
                    <div class="col-md-4">
                        <label>Date</label>
                        <input type="date" class="form-control" name="date" value="{{ request('date') }}">
                    </div>
                    <div class="col-md-4">
                        <label>Incident Type</label>
                        <select class="form-control" name="type">
                            <option value="">All Types</option>
                            <option value="unauthorized_access" {{ request('type') == 'unauthorized_access' ? 'selected' : '' }}>Unauthorized Access</option>
                            <option value="fire_alarm" {{ request('type') == 'fire_alarm' ? 'selected' : '' }}>Fire Alarm</option>
                            <option value="water_leak" {{ request('type') == 'water_leak' ? 'selected' : '' }}>Water Leak</option>
                        </select>
                    </div>
                    <div class="col-md-4 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary w-100">Filter</button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Emergency Incidents Table -->
        <div class="card-box p-4">
            <table class="data-table table  hover nowrap">
                <thead>
                <tr>
                    <th>Emergency</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Device</th>
                    <th>Status</th>
                    <th>Action Taken</th>
                </tr>
                </thead>
                <tbody>
                @forelse($emergencies as $emergency)
                    <tr>
                        <td>{{ optional($emergency->emergencyEntity)->emergencyName }}</td>
                        <td>{{ $emergency->date }}</td>
                        <td>{{ $emergency->startTime }} - {{ $emergency->endTime }}</td>
                        <td>{{ $emergency->inventoryDevice->smartDevice->deviceType }}</td>
                        <td>
                                <span class="status-badge {{ $emergency->emergencyStatus }}">
                                    {{ ucfirst($emergency->emergencyStatus) }}
                                </span>
                        </td>
                        <td>{{ $emergency->action ?? 'No action taken' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">No emergency incidents found.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <script>
        // Handle Notification Buttons
        document.querySelectorAll('.ignore-btn').forEach(button => {
            button.addEventListener('click', function () {
                Swal.fire({
                    icon: 'success',
                    title: 'Ignored',
                    text: 'The emergency notification has been ignored.',
                    confirmButtonText: 'OK'
                });
                this.closest('.notification-card').remove();
            });
        });



        document.querySelectorAll('.take-action-btn').forEach(button => {
            button.addEventListener('click', function () {
                const id = this.dataset.id;
                fetch(`/customer/emergency/action/${id}`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    }
                }).then(response => response.json()).then(data => {
                        Swal.fire({
                            icon: 'success',
                            title: 'Action Taken',
                            text: data.message,
                            confirmButtonText: 'OK'
                        });
                        document.getElementById('incident-' + id).remove();
                    });
            });
        });

    </script>
@endsection
