@extends('customer.layouts.app')

@section('content')
    <div class="min-height-200px">

        <div class="page-header mb-4 d-flex justify-content-between">
            <div class="title">
                <h4 class="text-primary fw-bold"><i class="dw dw-chart11 me-2"></i> Family Members</h4>
            </div>
            <a href="{{ route('customer.members.create') }}" class="btn btn-primary">Add Member</a>
        </div>

        <div class="card-box p-4">
            <table class="data-table table hover nowrap">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @forelse ($members as $index => $member)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $member->userName }}</td>
                        <td>
                            <a href="{{ route('customer.members.edit', $member->memberID) }}" class="btn btn-sm btn-info">Edit</a>
                            <form action="{{ route('customer.members.destroy', $member->memberID) }}" method="POST" class="d-inline delete-form">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn btn-sm btn-danger delete-btn" data-item-name="{{ $member->userName }}">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="3" class="text-center">No members added yet.</td></tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
