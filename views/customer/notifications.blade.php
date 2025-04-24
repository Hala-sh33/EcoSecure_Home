@extends('customer.layouts.app')

@push('css')
    <style>
        .notification-card1 {
            background: #0b132b0f;
            border-left: 5px solid #e15260 !important;
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
        <div class="card-box p-4">
            <h5 class="text-danger mb-4"><i class="dw dw-warning"></i> Emergency Notifications</h5>

            @forelse($incidents as $incident)
                <div class="border notification-card1 p-3 mb-3">
                    <p>
                        <strong>{{ ucfirst($incident->emergencyStatus) }}</strong> incident on
                        <strong>{{ $incident->date }}</strong> from
                        <strong>{{ $incident->startTime }}</strong> to
                        <strong>{{ $incident->endTime }}</strong>
                    </p>
                    <p>Action Taken: {{ $incident->action }}</p>
                    <div class="notification-buttons">
                        <button class="btn btn-sm btn-outline-secondary">Ignore</button>
                        <button class="btn btn-sm btn-outline-danger">Take Action</button>
                    </div>
                </div>
            @empty
                <p class="text-muted">No emergency notifications found for the current or last month.</p>
            @endforelse
        </div>
    </div>
@endsection
