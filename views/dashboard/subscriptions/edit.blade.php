@extends('dashboard.layouts.app')

@section('content')
    <div class="min-height-200px">
        <div class="page-header">
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="title">
                        <h4>Edit Subscription for {{ $customer->accountName }}</h4>
                    </div>
                    <nav aria-label="breadcrumb" role="navigation">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.customers.index') }}">Customers</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.subscriptions.index', $customer->accountID) }}">Subscriptions</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Edit</li>
                        </ol>
                    </nav>
                </div>

            </div>
        </div>

        <div class="card-box p-4">
            <form method="POST" action="{{ route('admin.subscriptions.update', $subscription->subscriptionID) }}">
                @csrf
                @method('PUT')

                <input type="hidden" name="accountID" value="{{ $subscription->accountID }}">

                <div class="row">
                    <div class="col-md-6">
                        <label>Payment Method</label>
                        <select class="form-control" name="PaymentMethod">
                            <option value="visa" {{ $subscription->PaymentMethod == 'visa' ? 'selected' : '' }}>Visa</option>
                            <option value="cash" {{ $subscription->PaymentMethod == 'cash' ? 'selected' : '' }}>Cash</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label>Amount</label>
                        <input type="number" class="form-control" name="paymentAmount" value="{{ $subscription->paymentAmount }}">
                    </div>

                    <div class="col-md-6">
                        <label>Start Date</label>
                        <input type="date" class="form-control" name="startDate" value="{{ $subscription->startDate }}">
                    </div>

                    <div class="col-md-6">
                        <label>End Date</label>
                        <input type="date" class="form-control" name="endDate" value="{{ $subscription->endDate }}">
                    </div>

                    <div class="col-md-6">
                        <label>Status</label>
                        <select class="form-control" name="subscriptionStatus">
                            <option value="active" {{ $subscription->subscriptionStatus == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="expired" {{ $subscription->subscriptionStatus == 'expired' ? 'selected' : '' }}>Expired</option>
                            <option value="canceled" {{ $subscription->subscriptionStatus == 'canceled' ? 'selected' : '' }}>Canceled</option>
                        </select>
                    </div>
                </div>

                <button class="btn btn-primary mt-3">Update</button>
            </form>
        </div>
    </div>
@endsection
