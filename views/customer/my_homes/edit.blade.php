@extends('customer.layouts.app')

@section('content')
    <div class="min-height-200px">
        <div class="page-header">
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="title">
                        <h4>Edit Home</h4>
                    </div>
                    <nav aria-label="breadcrumb" role="navigation">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('customer.dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('customer.my_homes.index') }}">My Homes</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Edit</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>


        <div class="card-box p-4">
            <form action="{{ route('customer.my_homes.update', $home->homeID) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label>Street Name</label>
                    <input type="text" name="streetName" value="{{ old('streetName', $home->streetName) }}" class="form-control">
                    @error('streetName') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="form-group">
                    <label>Home Number</label>
                    <input type="text" name="homeNumber" value="{{ old('homeNumber', $home->homeNumber) }}" class="form-control">
                    @error('homeNumber') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="form-group">
                    <label>Home Type</label>
                    <input type="text" name="homeType" value="{{ old('homeType', $home->homeType) }}" class="form-control">
                    @error('homeType') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="form-group">
                    <label>City</label>
                    <input type="text" name="City" value="{{ old('City', $home->City) }}" class="form-control">
                    @error('City') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <button type="submit" class="btn btn-primary mt-3">
                    <i class="icon-copy dw dw-save me-1"></i> Save Changes
                </button>
            </form>
        </div>
    </div>
@endsection
