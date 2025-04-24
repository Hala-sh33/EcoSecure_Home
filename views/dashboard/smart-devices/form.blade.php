<form method="POST"
      action="{{ $device ?
route('admin.smart-devices.update', $device->deviceID) : route('admin.smart-devices.store') }}" enctype="multipart/form-data">
    @csrf
    @if ($device)
        @method('PUT')
    @endif

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label>Device Type <strong class="text-danger">*</strong></label>
                <input class="form-control" type="text" name="deviceType" value="{{ old('deviceType', $device->deviceType ?? '') }}" required>
                @error('deviceType') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label>Device Status <strong class="text-danger">*</strong></label>
                <select class="form-control" name="deviceStatus" required>
                    <option value="active" {{ old('deviceStatus', $device->deviceStatus ?? '') == 'active' ? 'selected' : '' }}>Active</option>
                    <option value="inactive" {{ old('deviceStatus', $device->deviceStatus ?? '') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                    <option value="faulty" {{ old('deviceStatus', $device->deviceStatus ?? '') == 'faulty' ? 'selected' : '' }}>Faulty</option>
                </select>
                @error('deviceStatus') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label>Device Warranty <strong class="text-danger">*</strong></label>
                <input class="form-control" type="date" name="deviceWarranty" value="{{ old('deviceWarranty', $device->deviceWarranty ?? '') }}" required>
                @error('deviceWarranty') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label>Quantity on Hand <strong class="text-danger">*</strong></label>
                <input class="form-control" type="number" name="quantityOnHand" value="{{ old('quantityOnHand', $device->quantityOnHand ?? '') }}" required min="1">
                @error('quantityOnHand') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
        </div>


        <div class="col-md-6">
            <div class="form-group">
                <label>Year <strong class="text-danger">*</strong></label>
                <input class="form-control" type="number" name="year" value="{{ old('year', $device->year ?? '') }}" required min="2000" max="{{ date('Y') }}">
                @error('year') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label>Model Number <strong class="text-danger">*</strong></label>
                <input class="form-control" type="text" name="modelNo" value="{{ old('modelNo', $device->modelNo ?? '') }}" required>
                @error('modelNo') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label>Model In <strong class="text-danger">*</strong></label>
                <input class="form-control" type="text" name="modelin" value="{{ old('modelin', $device->modelin ?? '') }}" required>
                @error('modelin') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label>Specification</label>
                <input class="form-control" type="text" name="specification" value="{{ old('specification', $device->specification ?? '') }}">
                @error('specification') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label>Picture</label>
                <input class="form-control-file" type="file" name="pic">
                @error('pic') <small class="text-danger">{{ $message }}</small> @enderror

                @if(isset($device->pic) && $device->pic)
                    <div class="mt-2">
                        <img src="{{ $device->image_path }}" alt="Device Image" width="100">
                    </div>
                @endif
            </div>

            <div class="col-md-12">
                <div class="form-group">
                    <label>Description</label>
                    <textarea class="form-control" name="Description">{{ old('Description', $device->Description ?? '') }}</textarea>
                    @error('Description') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
            </div>

        </div>

    </div>

    <button type="submit" class="btn btn-primary">{{ $device ? 'Update' : 'Create' }}</button>
</form>
