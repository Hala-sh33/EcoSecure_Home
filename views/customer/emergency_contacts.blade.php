@extends('customer.layouts.app')

@section('content')
    <div class="min-height-200px">
        <div class="page-header">
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="title">
                        <h4>Emergency Contacts</h4>
                    </div>
                    <nav aria-label="breadcrumb" role="navigation">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('customer.dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Emergency Contacts</li>
                        </ol>
                    </nav>
                </div>
                <div class="col-md-6 col-sm-12 text-right">
                    <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#addContactModal">
                        Add New Contact <i class="fa fa-plus"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- Emergency Contacts Table -->
        <div class="card-box p-4">
            <table class="data-table table  hover nowrap">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Contact Number</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>John Doe</td>
                    <td>Home Security</td>
                    <td>+966 051234567</td>
                </tr>
                <tr>
                    <td>Jane Smith</td>
                    <td>Fire Department</td>
                    <td>+966 059876543</td>
                </tr>
                <tr>
                    <td>Michael Brown</td>
                    <td>Family Member</td>
                    <td>+966 056789012</td>
                </tr>
                <tr>
                    <td>Sarah Johnson</td>
                    <td>Neighborhood Watch</td>
                    <td>+966 053456789</td>
                </tr>
                <tr>
                    <td>David Wilson</td>
                    <td>Local Police Station</td>
                    <td>+966 052345678</td>
                </tr>
                <tr>
                    <td>Emily White</td>
                    <td>Personal Doctor</td>
                    <td>+966 057890123</td>
                </tr>
                </tbody>
            </table>


        </div>
    </div>

    <!-- Add Contact Modal -->
    <div class="modal fade" id="addContactModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Emergency Contact</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                </div>
                <div class="modal-body">
                    <form id="addContactForm">
                        @csrf
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control" name="emergencyName" required>
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <input type="text" class="form-control" name="emergencyDescription" required>
                        </div>
                        <div class="form-group">
                            <label>Contact Number</label>
                            <input type="text" class="form-control" name="emergencyContact" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById("addContactForm").addEventListener("submit", function(event) {
            event.preventDefault();
            let formData = new FormData(this);

            fetch("{{ route('customer.device.emergencyContacts') }}", {
                method: "POST",
                body: formData,
                headers: {
                    "X-CSRF-TOKEN": '{{ csrf_token() }}',
                }
            })
                .then(response => response.json())
                .then(data => {
                    Swal.fire({
                        icon: 'success',
                        title: 'Contact Added!',
                        text: data.message,
                        confirmButtonText: 'OK'
                    });
                    location.reload();
                })
                .catch(error => console.error("Error:", error));
        });
    </script>
@endsection
