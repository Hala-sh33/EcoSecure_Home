@extends('dashboard.layouts.app')

@section('content')
    <div class="min-height-200px">
        <div class="page-header">
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="title">
                        <h4>Inventory Devices</h4>
                    </div>
                    <nav aria-label="breadcrumb" role="navigation">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Inventory Devices</li>
                        </ol>
                    </nav>
                </div>
                <div class="col-md-6 col-sm-12 text-right">
                    <a class="btn btn-primary" href="{{ route('admin.devices.create') }}">
                        Add New <i class="dw dw-add"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="card-box mb-30 pt-4">
            <div class="pb-20">
                <table class="data-table table  hover nowrap">
                    <thead>
                    <tr>
                        <th>Home</th>
                        <th>Device Type</th>
                        <th>Location</th>
                        <th>Color</th>
                        <th>Size</th>
                        <th class="datatable-nosort">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($devices as $device)
                        <tr>
                            <td>{{ $device->home->streetName }}</td>
                            <td>{{ $device->smartDevice->deviceType }}</td>
                            <td>{{ $device->deviceLocation }}</td>
                            <td>{{ $device->color }}</td>
                            <td>{{ $device->size }}</td>
                            <td>
                                <div class="dropdown">
                                    <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                                        <i class="dw dw-more"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                        <a class="dropdown-item" href="{{ route('admin.devices.edit', $device->inventoryDeviceID) }}">
                                            <i class="dw dw-edit2"></i> Edit
                                        </a>
                                        <form action="{{ route('admin.devices.destroy', $device->inventoryDeviceID) }}" method="POST" class="d-inline delete-form">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="dropdown-item delete-btn" data-item-name="Device {{ $device->smartDevice->deviceType }}">
                                                <i class="dw dw-delete-3"></i> Delete
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
