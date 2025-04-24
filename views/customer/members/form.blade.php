<form class="p-4" method="POST" action="{{ $member ? route('customer.members.update', $member->memberID) : route('customer.members.store') }}">
    @csrf
    @if($member)
        @method('PUT')
    @endif

    <div class="form-group">
        <label>Name <strong class="text-danger">*</strong></label>
        <input class="form-control" type="text" name="userName" value="{{ old('userName', $member->userName ?? '') }}" required>
        @error('userName') <small class="text-danger">{{ $message }}</small> @enderror
    </div>

    <button type="submit" class="btn btn-primary">{{ $member ? 'Update' : 'Create' }}</button>
</form>
