@extends('dashboard.layouts.app')

@section('content')
    <div class="min-height-200px mb-5">
        <div class="page-header">
            <h4>My Profile</h4>
        </div>

        <div class="card-box p-4">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <form method="POST" action="{{ route('admin.profile.update') }}">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <label>Name <strong class="text-danger">*</strong></label>
                        <input class="form-control" type="text" name="accountName" value="{{ old('accountName', $admin->accountName) }}" required>
                        @error('accountName') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="col-md-6">
                        <label>Email <strong class="text-danger">*</strong></label>
                        <input class="form-control" type="email" name="email" value="{{ old('email', $admin->email) }}" required>
                        @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="col-md-6 mt-3">
                        <label>Phone Number <strong class="text-danger">*</strong></label>
                        <input class="form-control" type="text" name="phoneNumber" value="{{ old('phoneNumber', $admin->phoneNumber) }}" required>
                        <small class="form-text text-muted">Format: 05XXXXXXXX</small>
                        @error('phoneNumber') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="col-md-6 mt-3">
                        <label>New Password (optional)</label>
                        <input class="form-control" type="password" name="password">
                        <small class="form-text text-muted">Min 8 chars, letters and numbers</small>
                        @error('password') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                </div>

                <button class="btn btn-primary mt-4" type="submit">Update Profile</button>
            </form>
        </div>
    </div>
@endsection
