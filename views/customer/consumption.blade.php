@extends('customer.layouts.app')

@section('content')
    <div class="min-height-200px">
        <div class="page-header mb-4">
            <div class="title">
                <h4 class="text-primary fw-bold"><i class="dw dw-chart11 me-2"></i> Energy Consumption Log</h4>
            </div>
        </div>

        <div class="row">
            @forelse($devices as $device)
                <div class="col-md-6 mb-4">
                    <div class="card shadow-sm h-100">
                        <div class="card-header bg-gradient-primary text-white d-flex align-items-center">
                            <i class="dw dw-chip me-2"></i>
                            <h5 class="mb-0">
                                {{ $device->smartDevice->deviceType }} - {{ $device->deviceLocation }}
                            </h5>
                        </div>
                        <div class="card-body">
                            <!-- Device Image -->
                            <div class="d-flex justify-content-around mb-3">
                                <img src="{{ $device->smartDevice->image_path }}"
                                     alt="{{ $device->smartDevice->deviceType }}"
                                     class="img-fluid rounded"
                                     style="max-height: 100px; object-fit: cover;">
                                @php
                                    $total = $device->consumptionLogs ? $device->consumptionLogs->sum('consumption') : 0;
                                @endphp
                                <p class="text-muted mb-3">
                                    <strong>Total Consumption:</strong>
                                    <span class="text-success fw-bold">{{ $total }} kWh</span>
                                </p>
                            </div>



                            <!-- Consumption Logs Table -->
                            <div class="table-responsive">
                                <table class="data-table table  hover nowrap">

                                <thead class="bg-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Start Time</th>
                                        <th>End Time</th>
                                        <th>Consumption (kWh)</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if($device->consumptionLogs && $device->consumptionLogs->isNotEmpty())
                                        @foreach($device->consumptionLogs as $log)
                                            <tr>
                                                <td>{{ $log->readingNo }}</td>
                                                <td>{{ $log->startStamp }}</td>
                                                <td>{{ $log->endStamp }}</td>
                                                <td>{{ $log->consumption }}</td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="4" class="text-center text-muted py-3">
                                                No logs available
                                            </td>
                                        </tr>
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-info text-center" role="alert">
                        <i class="dw dw-info1 me-2"></i> No devices found.
                    </div>
                </div>
            @endforelse
        </div>
    </div>
@endsection
