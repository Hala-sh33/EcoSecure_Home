<form class="p-4" method="POST" action="{{ $admin ? route('admin.admins.update', $admin->accountID) : route('admin.admins.store') }}">
    @csrf
    @if ($admin)
        @method('PUT')
    @endif

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label>Name <strong class="text-danger">*</strong></label>
                <input class="form-control" type="text" name="accountName" value="{{ old('accountName', $admin->accountName ?? '') }}" required>
                @error('accountName') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label>Email <strong class="text-danger">*</strong></label>
                <input class="form-control" type="email" name="email" value="{{ old('email', $admin->email ?? '') }}" required>
                @error('email') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label>Phone Number <strong class="text-danger">*</strong></label>
                <input class="form-control" type="text" name="phoneNumber" value="{{ old('phoneNumber', $admin->phoneNumber ?? '') }}" required>
                <small class="form-text text-muted">Phone number must start with <strong>05</strong> and be followed by 8 digits.</small>
                @error('phoneNumber') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label>Role <strong class="text-danger">*</strong></label>
                <select class="form-control select2" name="accountType" required>
                    <option value="admin" {{ old('accountType', $admin->accountType ?? '') == 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="staff" {{ old('accountType', $admin->accountType ?? '') == 'staff' ? 'selected' : '' }}>Staff</option>
                </select>
                @error('accountType') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
        </div>

        <!-- Password Field with Confirmation -->
        <div class="col-md-6">
            <div class="form-group">
                <label>Password {{ $admin ? '(Leave empty to keep current password)' : '' }} <strong class="text-danger">*</strong></label>
                <input class="form-control" type="password" name="password" {{ $admin ? '' : 'required' }}>
                <small class="form-text text-muted">
                    Password must be at least <strong>8 characters</strong> and include letters and numbers.
                </small>
                @error('password') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
        </div>

        <!-- Password Confirmation Field -->
        <div class="col-md-6">
            <div class="form-group">
                <label>Confirm Password <strong class="text-danger">*</strong></label>
                <input class="form-control" type="password" name="password_confirmation">
                @error('password_confirmation') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
        </div>
    </div>

    <button type="submit" class="btn btn-primary">{{ $admin ? 'Update' : 'Create' }}</button>
</form>
