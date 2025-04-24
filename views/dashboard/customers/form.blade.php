<form class="p-4" method="POST" action="{{ $customer ? route('admin.customers.update', $customer->accountID) : route('admin.customers.store') }}">
    @csrf
    @if ($customer)
        @method('PUT')
    @endif

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label>Name <strong class="text-danger">*</strong></label>
                <input class="form-control" type="text" name="accountName" value="{{ old('accountName', $customer->accountName ?? '') }}" required>
                @error('accountName') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label>Email <strong class="text-danger">*</strong></label>
                <input class="form-control" type="email" name="email" value="{{ old('email', $customer->email ?? '') }}" required>
                @error('email') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label>Phone Number <strong class="text-danger">*</strong></label>
                <input class="form-control" type="text" name="phoneNumber" value="{{ old('phoneNumber', $customer->phoneNumber ?? '') }}" required>
                <small class="form-text text-muted">Phone number must start with **05** and be followed by 8 digits.</small>
                @error('phoneNumber') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label>Password <strong class="text-danger">*</strong></label>
                <input class="form-control" type="password" name="password" {{ $customer ? '' : 'required' }}>
                <small class="form-text text-muted">Password must be at least **8 characters**, contain **letters and numbers**.</small>
                @error('password') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label>Confirm Password <strong class="text-danger">*</strong></label>
                <input class="form-control" type="password" name="password_confirmation" {{ $customer ? '' : 'required' }}>
                @error('password_confirmation') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
        </div>
    </div>

    <button type="submit" class="btn btn-primary">{{ $customer ? 'Update' : 'Create' }}</button>
</form>
