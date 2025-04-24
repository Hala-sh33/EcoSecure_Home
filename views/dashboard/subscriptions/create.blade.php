@extends('dashboard.layouts.app')

@section('content')
    <div class="min-height-200px">

        <div class="page-header">
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="title">
                        <h4>Add Subscription for {{ $customer->accountName }}</h4>
                    </div>
                    <nav aria-label="breadcrumb" role="navigation">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.customers.index') }}">Customers</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.subscriptions.index', $customer->accountID) }}">Subscriptions</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Add</li>
                        </ol>
                    </nav>
                </div>

            </div>
        </div>

        <div class="card-box p-4">
            <form method="POST" action="{{ route('admin.subscriptions.store', $customer->accountID) }}">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <label>Payment Method</label>
                        <select name="PaymentMethod" class="form-control" required>
                            <option value="">Select</option>
                            <option value="cash">Cash</option>
                            <option value="credit">Credit Card</option>
                            <option value="paypal">PayPal</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label>Amount</label>
                        <input type="number" step="0.01" class="form-control" name="paymentAmount" required>
                    </div>

                    <div class="col-md-6 mt-3">
                        <label>Start Date</label>
                        <input type="date" class="form-control" name="startDate" required>
                    </div>

                    <div class="col-md-6 mt-3">
                        <label>End Date</label>
                        <input type="date" class="form-control" name="endDate" required>
                    </div>

                    <div class="col-md-6 mt-3">
                        <label>Status</label>
                        <select name="subscriptionStatus" class="form-control" required>
                            <option value="">Select</option>
                            <option value="active">Active</option>
                            <option value="expired">Expired</option>
                            <option value="cancelled">Cancelled</option>
                        </select>
                    </div>
                </div>

                <button class="btn btn-success mt-4" type="submit">Save Subscription</button>
            </form>
        </div>
    </div>
@endsection
