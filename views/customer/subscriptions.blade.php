@extends('customer.layouts.app')

@section('content')
    <div class="min-height-200px">
        <div class="page-header mb-3">
            <h4>My Subscriptions</h4>
        </div>

        <div class="card-box p-4">
            @if($subscriptions->count())
                <table class="data-table table  hover nowrap">
                    <thead>
                    <tr>
                        <th>Payment Method</th>
                        <th>Amount</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($subscriptions as $sub)
                        <tr>
                            <td>{{ ucfirst($sub->PaymentMethod) }}</td>
                            <td>{{ $sub->paymentAmount }} SAR</td>
                            <td>{{ $sub->startDate }}</td>
                            <td>{{ $sub->endDate }}</td>
                            <td>
                                <span class="badge badge-{{ $sub->subscriptionStatus == 'active' ? 'success' : ($sub->subscriptionStatus == 'expired' ? 'warning' : 'danger') }}">
                                    {{ ucfirst($sub->subscriptionStatus) }}
                                </span>
                            </td>
                            <td>
                                <button class="btn btn-sm btn-info" data-toggle="modal" data-target="#subModal{{ $sub->subscriptionID }}">
                                    View
                                </button>
                                <a href="{{ route('customer.subscriptions.print', $sub->subscriptionID) }}" target="_blank"
                                   class="btn btn-sm btn-secondary">
                                    Print
                                </a>
                            </td>
                        </tr>
                        <!-- Modal -->
                        <div class="modal fade" id="subModal{{ $sub->subscriptionID }}" tabindex="-1" role="dialog">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Subscription Details</h5>
                                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                                    </div>
                                    <div class="modal-body">
                                        <p><strong>Payment Method:</strong> {{ $sub->PaymentMethod }}</p>
                                        <p><strong>Amount:</strong> {{ $sub->paymentAmount }} SAR</p>
                                        <p><strong>Start Date:</strong> {{ $sub->startDate }}</p>
                                        <p><strong>End Date:</strong> {{ $sub->endDate }}</p>
                                        <p><strong>Status:</strong> {{ ucfirst($sub->subscriptionStatus) }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    </tbody>
                </table>
            @else
                <p class="text-center">You don't have any subscriptions yet.</p>
            @endif
        </div>
    </div>
@endsection
