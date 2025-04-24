<form method="POST" action="{{ $device ? route('admin.devices.update', $device->inventoryDeviceID) : route('admin.devices.store') }}">
    @csrf
    @if ($device)
        @method('PUT')
    @endif

    <div class="row">
        <!-- Home Selection -->
        <div class="col-md-6">
            <div class="form-group">
                <label>Home <strong class="text-danger">*</strong></label>
                <select class="form-control" name="homeID" required>
                    <option value="">Select Home</option>
                    @foreach($homes as $home)
                        <option value="{{ $home->homeID }}" {{ old('homeID', $device->homeID ?? '') == $home->homeID ? 'selected' : '' }}>
                            {{ $home->streetName }} ({{ $home->account->accountName }})
                        </option>
                    @endforeach
                </select>
                @error('homeID') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
        </div>

        <!-- Device Type Selection -->
        <div class="col-md-6">
            <div class="form-group">
                <label>Device Type <strong class="text-danger">*</strong></label>
                <select class="form-control" name="deviceID" required>
                    <option value="">Select Device Type</option>
                    @foreach($smartDevices as $smartDevice)
                        <option value="{{ $smartDevice->deviceID }}" {{ old('deviceID', $device->deviceID ?? '') == $smartDevice->deviceID ? 'selected' : '' }}>
                            {{ $smartDevice->deviceType }}
                        </option>
                    @endforeach
                </select>
                @error('deviceID') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
        </div>

        <!-- Device Location -->
        <div class="col-md-6">
            <div class="form-group">
                <label>Device Location <strong class="text-danger">*</strong></label>
                <input class="form-control" type="text" name="deviceLocation" value="{{ old('deviceLocation', $device->deviceLocation ?? '') }}" required>
                @error('deviceLocation') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
        </div>

        <!-- Device Color -->
        <div class="col-md-6">
            <div class="form-group">
                <label>Device Color <strong class="text-danger">*</strong></label>
                <input class="form-control" type="text" name="color" value="{{ old('color', $device->color ?? '') }}" required>
                @error('color') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
        </div>

        <!-- Device Size -->
        <div class="col-md-6">
            <div class="form-group">
                <label>Device Size <strong class="text-danger">*</strong></label>
                <input class="form-control" type="text" name="size" value="{{ old('size', $device->size ?? '') }}" required>
                @error('size') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
        </div>
    </div>

    <button type="submit" class="btn btn-primary">{{ $device ? 'Update' : 'Create' }}</button>
</form>
