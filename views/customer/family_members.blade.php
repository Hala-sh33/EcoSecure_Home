@extends('customer.layouts.app')

@section('content')
    <div class="min-height-200px">
        <div class="page-header">
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="title">
                        <h4>Family Members</h4>
                    </div>
                    <nav aria-label="breadcrumb" role="navigation">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('customer.dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Family Members</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>

        <!-- Family Members Table -->
        <div class="card-box p-4">
            <table class="data-table table  hover nowrap">
                <thead>
                <tr>
                    <th>Member Name</th>
                    <th>Account ID</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>John Doe</td>
                    <td>101</td>
                </tr>
                <tr>
                    <td>Jane Doe</td>
                    <td>102</td>
                </tr>
                <tr>
                    <td>Michael Smith</td>
                    <td>103</td>
                </tr>
                <tr>
                    <td>Emily Johnson</td>
                    <td>104</td>
                </tr>
                <tr>
                    <td>David Brown</td>
                    <td>105</td>
                </tr>
                <tr>
                    <td>Sarah Wilson</td>
                    <td>106</td>
                </tr>
                </tbody>
            </table>
        </div>

    </div>

@endsection
