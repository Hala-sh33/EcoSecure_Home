<form class="p-4" method="POST" action="{{ $home ? route('admin.homes.update', $home->homeID) : route('admin.homes.store') }}">
    @csrf
    @if ($home)
        @method('PUT')
    @endif

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label>Home Owner <strong class="text-danger">*</strong></label>
                <select class="form-control select2" name="accountID" required>
                    <option value="">Select Home Owner</option>
                    @foreach($owners as $owner)
                        <option value="{{ $owner->accountID }}" {{ old('accountID', $home->accountID ?? '') == $owner->accountID ? 'selected' : '' }}>
                            {{ $owner->accountName }}
                        </option>
                    @endforeach
                </select>
                @error('accountID') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label>Country <strong class="text-danger">*</strong></label>
                <select class="form-control select2" name="Country" required>
                    <option value="">Select Country</option>
                    @php
                        $arabic_countries = [
                            'المملكة العربية السعودية', 'الإمارات العربية المتحدة', 'الكويت', 'قطر', 'البحرين', 'عمان',
                            'مصر', 'الأردن', 'العراق', 'لبنان', 'سوريا', 'فلسطين', 'اليمن', 'الجزائر', 'المغرب', 'تونس', 'ليبيا', 'السودان', 'موريتانيا', 'جيبوتي', 'الصومال', 'جزر القمر'
                        ];
                    @endphp
                    @foreach($arabic_countries as $country)
                        <option value="{{ $country }}" {{ old('Country', $home->Country ?? '') == $country ? 'selected' : '' }}>
                            {{ $country }}
                        </option>
                    @endforeach
                </select>
                @error('Country') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
        </div>


        <div class="col-md-6">
            <div class="form-group">
                <label>Street Name <strong class="text-danger">*</strong></label>
                <input class="form-control" type="text" name="streetName" value="{{ old('streetName', $home->streetName ?? '') }}" required>
                @error('streetName') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label>Home Number <strong class="text-danger">*</strong></label>
                <input class="form-control" type="text" name="homeNumber" value="{{ old('homeNumber', $home->homeNumber ?? '') }}" required>
                @error('homeNumber') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label>Home Type <strong class="text-danger">*</strong></label>
                <input class="form-control" type="text" name="homeType" value="{{ old('homeType', $home->homeType ?? '') }}" required>
                @error('homeType') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
        </div>


        <div class="col-md-6">
            <div class="form-group">
                <label>City <strong class="text-danger">*</strong></label>
                <input class="form-control" type="text" name="City" value="{{ old('City', $home->City ?? '') }}" required>
                @error('City') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label>Number of Rooms <strong class="text-danger">*</strong></label>
                <input class="form-control" type="number" name="numberOfRooms" value="{{ old('numberOfRooms', $home->numberOfRooms ?? '') }}" required min="1">
                @error('numberOfRooms') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
        </div>
    </div>

    <button type="submit" class="btn btn-primary">{{ $home ? 'Update' : 'Create' }}</button>
</form>
