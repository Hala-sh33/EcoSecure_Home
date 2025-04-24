@extends('customer.layouts.app')

@push('css')
    <style>

        .card-box2 {
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .icon-box {
            background-color: rgba(255, 255, 255, 0.15);
            padding: 15px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .summary-label {
            font-size: 14px;
            margin: 0;
            opacity: 0.9;
        }

        .summary-value {
            font-size: 20px;
            font-weight: bold;
            margin: 0;
        }
        .activity-item {
            border-left: 3px solid #00E396;
            padding: 10px;
            margin-bottom: 10px;
            background: #f9f9f9;
            border-radius: 5px;
            font-size: 13px;
        }
    </style>
@endpush
@section('content')
    <div class="min-height-200px">

        <!-- Select Home -->
        <form method="GET" class="mb-4">
            <label for="home_id">Select Home Number:</label>
            <select name="home_id" id="home_id" class="form-control select2" onchange="this.form.submit()">
{{--                <option value="">Select Home</option>--}}
                <option value="" selected>All Home</option>
                @foreach($homes as $home)
                    <option value="{{ $home->homeID }}" {{ $home->homeID == $homeId ? 'selected' : '' }}>
                        {{ $home->homeNumber }}/ {{ $home->streetName }}/ ({{ $home->City }})
                    </option>
                @endforeach
            </select>
        </form>

        <div class="row mb-4">
            <div class="col-md-3">
                <div class="card-box card-box2 bg-primary text-white">
                    <div class="d-flex justify-content-between align-items-center w-100">
                        <div>
                            <p class="summary-value">{{ $homes->count() }}</p>
                            <p class="summary-label">My Homes</p>
                        </div>
                        <div class="icon-box">
                            <i class="dw dw-home fa-2x text-white"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card-box card-box2 bg-info text-white">
                    <div class="d-flex justify-content-between align-items-center w-100">
                        <div>
                            <p class="summary-value">{{ $topDevices->count() }}</p>
                            <p class="summary-label">Smart Devices</p>
                        </div>
                        <div class="icon-box">
                            <i class="dw dw-chip fa-2x text-white"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card-box card-box2 bg-warning text-white">
                    <div class="d-flex justify-content-between align-items-center w-100">
                        <div>
                            <p class="summary-value">{{ number_format(array_sum($electricityCategories->toArray()), 2) }} kWh</p>
                            <p class="summary-label">Monthly Consumption</p>
                        </div>
                        <div class="icon-box">
                            <i class="dw dw-analytics fa-2x text-white"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card-box card-box2 bg-danger text-white">
                    <div class="d-flex justify-content-between align-items-center w-100">
                        <div>
                            <p class="summary-value">{{$emergencyIncidents}}</p>
                            <p class="summary-label">Emergency Incidents</p>
                        </div>
                        <div class="icon-box">
                            <i class="dw dw-warning fa-2x text-white"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- Charts Section -->
        <div class="row">
            <div class="col-md-12 bf-w">
                <form method="GET" class="mb-4 d-flex justify-content-start">
                    <label for="range" class="me-2">Filter by:</label>
                    <select name="range" id="range" class="form-control w-auto" onchange="this.form.submit()">
                        <option value="day" {{ request('range') == 'day' ? 'selected' : '' }}>Today</option>
                        <option value="week" {{ request('range') == 'week' ? 'selected' : '' }}>This Week</option>
                        <option value="month" {{ request('range') == 'month' ? 'selected' : '' }}>This Month</option>
                        <option value="year" {{ request('range') == 'year' ? 'selected' : '' }}>This Year</option>
                    </select>
                </form>
            </div>
            <div class="col-md-6 mb-3">

                <div class="card-box p-4">
                    <h5 class="text-blue h4">Top 5 Electricity-Consuming Devices (kWh)</h5>
                    <div id="topDevicesChart"></div>
                </div>
            </div>

            <div class="col-md-6 mb-3">
                <div class="card-box p-4">
{{--                    @dump($electricityCategories)--}}
                    <h5 class="text-blue h4">Electricity by Device Type</h5>
                    <div id="electricityCategoryChart"></div>
                </div>
            </div>



            <div class="col-md-6 mb-3">
                <div class="card-box p-4">
                    <h5 class="text-blue h4">Water Consumption by Room</h5>
                    <div id="waterByRoomChart"></div>
                </div>
            </div>

            <div class="col-md-6 mb-3">
                <div class="card-box p-4">
                    <h5 class="text-blue h4">Emergency Incidents</h5>
                    <div id="solarChart"></div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
        const electricityData = @json($electricityCategories);
        const topDevicesData = @json($topDevices);
        const waterByRoomData = @json($waterByRoom);
        const solarData = [{{ $solarGenerated }}, {{ $savings }}];

        new ApexCharts(document.querySelector("#electricityCategoryChart"), {
            chart: { type: 'line', height: 300 },
            series: [{ name: "kWh", data: Object.values(electricityData) }],
            xaxis: { categories: Object.keys(electricityData) }
        }).render();

        new ApexCharts(document.querySelector("#topDevicesChart"), {
            chart: { type: 'area', height: 300 },
            series: [{ name: "kWh", data: Object.values(topDevicesData) }],
            xaxis: { categories: Object.keys(topDevicesData) }
        }).render();

        new ApexCharts(document.querySelector("#waterByRoomChart"), {
            chart: { type: 'bar', height: 300 },
            series: [{ name: "Liters", data: Object.values(waterByRoomData) }],
            xaxis: { categories: Object.keys(waterByRoomData) }
        }).render();

        new ApexCharts(document.querySelector("#solarChart"), {
            chart: { type: 'donut', height: 300 },
            series: solarData,
            labels: ['Fire Alarm', 'Calling'],
        }).render();
    </script>
@endpush
