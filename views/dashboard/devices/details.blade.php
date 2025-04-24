@extends('dashboard.layouts.app')

@section('content')
    <div class="min-height-200px">
        <div class="card-box mb-30 p-4">
            <h4 class="text-blue h4">Device Details Management</h4>

            <div class="card p-4">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Select Customer:</label>
                            <select class="form-control" id="customerSelect">
                                <option value="">-- Select Customer --</option>
                                @foreach($customers as $customer)
                                    <option value="{{ $customer->accountID }}">{{ $customer->accountName }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Select Home:</label>
                            <select class="form-control" id="homeSelect" disabled>
                                <option value="">-- Select Home --</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <!-- عرض الأجهزة -->
            <div id="deviceList" class="mt-4 card">
              <div class="card-header">
                  <h5>Devices in Home</h5>
              </div>
                <div class="row card-body" id="deviceContainer">
                    <!-- يتم تحميل الأجهزة هنا عبر AJAX -->
                </div>
            </div>
        </div>
    </div>
    @include('dashboard.devices.modals')
    @include('dashboard.devices.logs_modals')

    <script>
        // تحميل المنازل الخاصة بالعميل
        document.getElementById('customerSelect').addEventListener('change', function () {
            let customerID = this.value;
            let homeSelect = document.getElementById('homeSelect');
            homeSelect.innerHTML = '<option value="">-- Select Home --</option>';
            homeSelect.disabled = true;

            if (customerID) {
                fetch(`/admin/device-details/homes/${customerID}`)
                    .then(response => response.json())
                    .then(homes => {
                        homes.forEach(home => {
                            homeSelect.innerHTML += `<option value="${home.homeID}">${home.streetName}</option>`;
                        });
                        homeSelect.disabled = false;
                    });
            }
        });

        // تحميل الأجهزة في المنزل المحدد وعرضها كـ HTML
        document.getElementById('homeSelect').addEventListener('change', function () {
            let homeID = this.value;
            let deviceContainer = document.getElementById('deviceContainer');
            deviceContainer.innerHTML = '';

            if (homeID) {
                fetch(`/admin/device-details/devices/${homeID}`)
                    .then(response => response.json())
                    .then(data => {
                        deviceContainer.innerHTML = data.html;
                    });
            }
        });

        // فتح المودال لتحميل تفاصيل الجهاز
        function loadDeviceDetails(deviceID) {
            fetch(`/admin/device-details/${deviceID}`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('deviceModalContent').innerHTML = data.html;
                    $('#deviceModal').modal('show');
                });
        }

        function openEmergencyEntityModal(deviceID) {
            document.getElementById('emergencyEntityDeviceID').value = deviceID;
            $('#emergencyEntityModal').modal('show');
        }

        function openEmergencyIncidentModal(deviceID) {
            document.getElementById('emergencyIncidentDeviceID').value = deviceID;
            $('#emergencyIncidentModal').modal('show');
        }

        function openConsumptionLogModal(deviceID) {
            document.getElementById('consumptionLogDeviceID').value = deviceID;
            $('#consumptionLogModal').modal('show');
        }


        function viewEmergencyEntityLogs(deviceID) {
            fetch(`/admin/device-details/emergency-entity-logs/${deviceID}`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('emergencyEntityLogsContent').innerHTML = data.html;
                    $('#emergencyEntityLogsModal').modal('show');
                });
        }

        function viewEmergencyIncidentLogs(deviceID) {
            fetch(`/admin/device-details/emergency-incident-logs/${deviceID}`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('emergencyIncidentLogsContent').innerHTML = data.html;
                    $('#emergencyIncidentLogsModal').modal('show');
                });
        }

        function viewConsumptionLog(deviceID) {
            fetch(`/admin/device-details/consumption-logs/${deviceID}`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('consumptionLogContent').innerHTML = data.html;
                    $('#consumptionLogListModal').modal('show');
                });
        }


        function submitForm(formID, route, logModalID, logContainerID, openLogsModalID) {
            let form = document.getElementById(formID);
            let formData = new FormData(form);
            if (formData.get("emergencyContactType") === "user_choice") {
                let memberName = formData.get("emergencyContactUser");
                formData.set("emergencyContact", memberName || "Custom Member");
            } else {
                formData.set("emergencyContact", formData.get("emergencyContactType"));
            }
            fetch(route, {method: "POST", body: formData, headers: {"X-CSRF-TOKEN": '{{csrf_token()}}',}})
                .then(response => response.json()).then(data => {
                    if (data.success) {
                        alert(data.success);
                        document.getElementById(logContainerID).innerHTML += data.html;
                        form.reset();
                        $(`#${logModalID}`).modal('hide');
                        setTimeout(() => {
                            $(`#${openLogsModalID}`).modal('show');
                        }, 500);
                    }
                }).catch(error => console.error("Error:", error));
        }

        // Submit Emergency Entity Form and Open Logs
        document.getElementById("emergencyEntityForm").addEventListener("submit", function(event) {
            event.preventDefault();
            submitForm("emergencyEntityForm", "{{ route('admin.device-details.store-emergency-entity') }}", "emergencyEntityModal", "emergencyEntityLogsContent", "emergencyEntityLogsModal");
        });

        // Submit Emergency Incident Form and Open Logs
        document.getElementById("emergencyIncidentForm").addEventListener("submit", function(event) {
            event.preventDefault();
            submitForm("emergencyIncidentForm", "{{ route('admin.device-details.store-emergency-incident') }}", "emergencyIncidentModal", "emergencyIncidentLogsContent", "emergencyIncidentLogsModal");
        });

        // Submit Consumption Log Form and Open Logs
        document.getElementById("consumptionLogForm").addEventListener("submit", function(event) {
            event.preventDefault();
            submitForm("consumptionLogForm", "{{ route('admin.device-details.store-consumption-log') }}", "consumptionLogModal", "consumptionLogContent", "consumptionLogModal");
        });


        function toggleUserChoice() {
            const type = document.getElementById("emergencyContactType").value;
            const userChoiceBox = document.getElementById("userChoiceContainer");

            if (type === "user_choice") {
                userChoiceBox.style.display = "block";
            } else {
                userChoiceBox.style.display = "none";
            }
        }


        function deleteEmergencyEntity(id) {
            if (confirm("Are you sure you want to delete this contact?")) {
                fetch(`/admin/device-details/delete-emergency-entity/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    }
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            const row = document.getElementById(`entityRow-${id}`);
                            if (row) row.remove();

                            Swal.fire({
                                icon: 'success',
                                title: 'Deleted',
                                text: 'Emergency contact deleted successfully!',
                                timer: 1500,
                                showConfirmButton: false
                            });
                        }
                    });
            }
        }

        function editEmergencyEntity(id) {
            fetch(`/admin/device-details/edit-emergency-entity/${id}`)
                .then(res => res.json())
                .then(data => {
                    $('#emergencyEntityLogsModal').modal('hide');

                    document.querySelector('[name="emergencyName"]').value = data.emergencyName;
                    document.querySelector('[name="emergencyDescription"]').value = data.emergencyDescription;
                    document.querySelector('[name="emergencyContactType"]').value = "user_choice";
                    document.querySelector('[name="emergencyContact"]').value = data.emergencyContact;

                    let memberSelect = document.querySelector('[name="userMemberContact"]');
                    if (memberSelect) {
                        [...memberSelect.options].forEach(option => {
                            option.selected = option.value === data.emergencyContact;
                        });
                    }

                    document.getElementById('emergencyEntityDeviceID').value = data.inventoryDeviceID;

                    setTimeout(() => {
                        $('#emergencyEntityModal').modal('show');
                    }, 300);
                });
        }


    </script>
@endsection
