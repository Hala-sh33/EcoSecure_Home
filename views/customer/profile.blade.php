@extends('customer.layouts.app')

@section('content')
    <div class="min-height-200px">
        <div class="card-box p-4">
            <h4 class="text-blue h4 mb-4">Edit Profile</h4>

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <form method="POST" action="{{ route('customer.profile.update') }}">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Name <strong class="text-danger">*</strong></label>
                            <input class="form-control" name="accountName" value="{{ old('accountName', $customer->accountName) }}" required>
                            @error('accountName') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Email <strong class="text-danger">*</strong></label>
                            <input class="form-control" type="email" name="email" value="{{ old('email', $customer->email) }}" required>
                            @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Phone Number <strong class="text-danger">*</strong></label>
                            <input class="form-control" name="phoneNumber" value="{{ old('phoneNumber', $customer->phoneNumber) }}" required>
                            <small class="form-text text-muted">Must start with 05 and contain 10 digits.</small>
                            @error('phoneNumber') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>New Password</label>
                            <input class="form-control" type="password" name="password">
                            <small class="form-text text-muted">Leave blank if you don't want to change it.</small>
                            @error('password') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Confirm Password</label>
                            <input class="form-control" type="password" name="password_confirmation">
                            @error('password_confirmation') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary mt-3">Save Changes</button>
            </form>
        </div>
    </div>
@endsection
