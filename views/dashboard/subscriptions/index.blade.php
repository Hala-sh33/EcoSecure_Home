@extends('dashboard.layouts.app')

@section('content')
    <div class="min-height-200px">
        <div class="page-header">
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="title">
                        <h4>Subscriptions for {{ $customer->accountName }}</h4>
                    </div>
                    <nav aria-label="breadcrumb" role="navigation">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.customers.index') }}">Customers</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Subscriptions</li>
                        </ol>
                    </nav>
                </div>
                <div class="col-md-6 col-sm-12 text-right">
                    <a class="btn btn-primary" href="{{ route('admin.subscriptions.create', $customer->accountID) }}">
                        Add New <i class="dw dw-add"></i>
                    </a>
                </div>
            </div>
        </div>


        <div class="card-box mb-30 pt-4">
            <div class="pb-20">
            <table class="data-table table  hover nowrap">
                <thead>
                <tr>
                    <th>Payment Method</th>
                    <th>Amount</th>
                    <th>Start</th>
                    <th>End</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($subscriptions as $subscription)
                    <tr>
                        <td>{{ ucfirst($subscription->PaymentMethod) }}</td>
                        <td>{{ $subscription->paymentAmount }} SAR</td>
                        <td>{{ $subscription->startDate }}</td>
                        <td>{{ $subscription->endDate }}</td>
                        <td><span class="badge badge-{{ $subscription->subscriptionStatus == 'active' ? 'success' : ($subscription->subscriptionStatus == 'expired' ? 'warning' : 'danger') }}">
                            {{ ucfirst($subscription->subscriptionStatus) }}</span>
                        </td>
                        <td>
                            <div class="dropdown">
                                <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button"
                                   data-toggle="dropdown">
                                    <i class="dw dw-more"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                    <a class="dropdown-item" href="{{ route('admin.subscriptions.edit', $subscription->subscriptionID) }}">
                                        <i class="dw dw-edit2"></i> Edit
                                    </a>
                                    <form action="{{ route('admin.subscriptions.destroy', $subscription->subscriptionID) }}" method="POST" class="d-inline delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="dropdown-item delete-btn" data-item-name="Subscription">
                                            <i class="dw dw-delete-3"></i> Delete
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </td>

                    </tr>
                @endforeach
                @if($subscriptions->isEmpty())
                    <tr><td colspan="5" class="text-center">No subscriptions found</td></tr>
                @endif
                </tbody>
            </table>
        </div>
        </div>
    </div>
@endsection
