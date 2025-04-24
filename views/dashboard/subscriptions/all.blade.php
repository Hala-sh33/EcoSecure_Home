@extends('dashboard.layouts.app')

@section('content')
    <div class="min-height-200px">
        <div class="page-header mb-3">
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="title">
                        <h4>All Subscriptions</h4>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-box p-3">
            <div class="table-responsive">
                <table class="data-table table  hover nowrap">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Customer</th>
                        <th>Phone</th>
                        <th>Payment Method</th>
                        <th>Amount</th>
                        <th>Start</th>
                        <th>End</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($subscriptions as $index => $subscription)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $subscription->account->accountName }}</td>
                            <td>{{ $subscription->account->phoneNumber }}</td>
                            <td>{{ ucfirst($subscription->PaymentMethod) }}</td>
                            <td>{{ $subscription->paymentAmount }} SAR</td>
                            <td>{{ $subscription->startDate }}</td>
                            <td>{{ $subscription->endDate }}</td>
                            <td>
                                <span class="badge badge-{{ $subscription->subscriptionStatus == 'active' ? 'success' : ($subscription->subscriptionStatus == 'expired' ? 'warning' : 'danger') }}">
                                    {{ ucfirst($subscription->subscriptionStatus) }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('admin.subscriptions.index', $subscription->account->accountID) }}" class="btn btn-sm btn-outline-primary">
                                    <i class="dw dw-settings2"></i> Manage
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    @if($subscriptions->isEmpty())
                        <tr><td colspan="8" class="text-center">No subscriptions found</td></tr>
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
