@extends('customer.layouts.app')

@section('content')
    <div class="min-height-200px">

        <div class="page-header">
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="title">
                        <h4>My Homes</h4>
                    </div>
                    <nav aria-label="breadcrumb" role="navigation">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('customer.dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">My Homes</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>


        <div class="row">
            @forelse($homes as $home)
                <div class="col-md-4 mb-4">
                    <div class="card-box p-4 shadow border rounded-3 bg-light position-relative h-100">
                        <div class="text-center mb-3">
                            <i class="dw dw-house text-primary" style="font-size: 60px;"></i>
                        </div>
                        <h5 class="text-center fw-bold mb-2">
                            {{ $home->streetName }} - {{ $home->homeNumber }}
                        </h5>
{{--                        <div class="text-center text-muted mb-3">--}}
{{--                            <small>#{{ $home->homeID }}</small>--}}
{{--                        </div>--}}
                        <hr>
                        <p><strong>Devices Count:</strong> {{ $home->inventory_devices_count }}</p>
                        <p><strong>Home Type:</strong> {{ $home->homeType }}</p>
                        <p><strong>City:</strong> {{ $home->City }}</p>
                        <div class="d-flex justify-content-center gap-2 mt-3">
                            <a href="{{ route('customer.my_homes.edit', $home->homeID) }}" class="btn btn-info mr-3 btn-sm">
                                <i class="icon-copy dw dw-edit-2 me-1"></i> Edit
                            </a>
                            <form action="{{ route('customer.my_homes.destroy', $home->homeID) }}" method="POST" class="d-inline delete-form">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm delete-btn"
                                        data-item-name="this home"
                                        @if($home->inventory_devices_count > 0) disabled title="Cannot delete a home with devices" @endif>
                                    <i class="icon-copy dw dw-delete-3 me-1"></i> Delete
                                </button>
                            </form>


                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-warning text-center">No homes available yet.</div>
                </div>
            @endforelse
        </div>

    </div>
@endsection
