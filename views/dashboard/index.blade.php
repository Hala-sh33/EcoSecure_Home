@extends('dashboard.layouts.app')

@push('css')
    <style>
        .card-box {
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        }

        .icon-box {
            background: rgba(255, 255, 255, 0.2);
            padding: 15px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .card-box h2 {
            font-weight: bold;
        }

        .activity-item {
            border-left: 3px solid #00E396;
            padding: 10px;
            margin-bottom: 10px;
            background: #f9f9f9;
            border-radius: 5px;
        }
    </style>
@endpush

@section('content')
    <div class="min-height-200px">
        <!-- Summary Cards -->
        <div class="row">
            <!-- الاشتراكات النشطة -->
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 mb-4">
                <div class="card-box bg-success text-white">
                    <div class="d-flex align-items-center">
                        <div class="icon-box"><i class="dw dw-money fa-3x"></i></div>
                        <div class="ml-3">
                            <h2 class="mb-1 text-white">{{ $activeSubscriptions }}</h2>
                            <p class="mb-0 text-white">Active Subscriptions</p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- عدد العملاء -->
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 mb-4">
                <div class="card-box bg-primary text-white">
                    <div class="d-flex align-items-center">
                        <div class="icon-box"><i class="dw dw-user1 fa-3x"></i></div>
                        <div class="ml-3">
                            <h2 class="mb-1 text-white">{{ $totalCustomers }}</h2>
                            <p class="mb-0 text-white">Total Customers</p>
                        </div>
                    </div>
                </div>
            </div>



            <!-- عدد الأجهزة الذكية -->
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 mb-4">
                <div class="card-box bg-info text-white">
                    <div class="d-flex align-items-center">
                        <div class="icon-box"><i class="dw dw-chip fa-3x"></i></div>
                        <div class="ml-3">
                            <h2 class="mb-1 text-white">{{ $totalDevices }}</h2>
                            <p class="mb-0 text-white">Smart Devices</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- المبيعات (عدد عمليات الدفع) -->
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 mb-4">
                <div class="card-box bg-warning text-white">
                    <div class="d-flex align-items-center">
                        <div class="icon-box"><i class="dw dw-shopping-cart fa-3x"></i></div>
                        <div class="ml-3">
                            <h2 class="mb-1 text-white">{{ $totalSales }}</h2>
                            <p style="font-size: 14px;" class="mb-0 text-white">Total Sales (This Month)</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!-- Charts Section -->
        <div class="row">
            <!-- استهلاك الطاقة -->
{{--            <div class="col-md-6">--}}
{{--                <div class="card-box p-4">--}}
{{--                    <h5 class="text-blue h4">Energy Consumption</h5>--}}
{{--                    <div id="energyChart"></div>--}}
{{--                </div>--}}
{{--            </div>--}}
            <div class="col-md-6">
                <div class="card-box p-4">
                    <h5 class="text-blue h4">Subscriptions Per Month</h5>
                    <div id="subscriptionsChart"></div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card-box p-4">
                    <h5 class="text-blue h4">Subscription Status</h5>
                    <div id="salesChart"></div>
                </div>
            </div>


            <!-- توزيع العملاء على المنازل -->

        </div>

        <!-- Last Activities Section -->
        <div class="row mt-4">

            <div class="col-md-6">
                <div class="card-box p-4">
                    <h5 class="text-blue h4">Customer Distribution / Subscriptions In Cities</h5>
                    <div id="cityChart"></div>
                </div>
            </div>

            <div class="col-md-6 mt-4">
                <div class="card-box p-4">
                    <h5 class="text-blue h4">Top Customers by Number of Homes</h5>
                    <div id="customerHomeChart"></div>
                </div>
            </div>


        </div>
    </div>

    <!-- ApexCharts.js -->
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
        const subsData = @json($subscriptionsPerMonth);
        const salesData = @json($salesPerCategory);

        new ApexCharts(document.querySelector("#subscriptionsChart"), {
            chart: { type: 'area', height: 300 },
            series: [{ name: "Subscriptions", data: Object.values(subsData) }],
            xaxis: { categories: Object.keys(subsData) },
            colors: ['#5c658b']
        }).render();

        new ApexCharts(document.querySelector("#salesChart"), {
            chart: { type: 'pie', height: 300 },
            series: Object.values(salesData),
            labels: Object.keys(salesData),
            colors: ['#FF4560', '#00E396', '#008FFB']
        }).render();

        const cityData = @json($topCities);
        new ApexCharts(document.querySelector("#cityChart"), {
            chart: { type: 'bar', height: 300 },
            series: [{
                name: "Subscriptions",
                data: Object.values(cityData)
            }],
            xaxis: {
                categories: Object.keys(cityData)
            },
            colors: ['#546E7A']
        }).render();

        const customerHomes = @json($customerHomeCount);

        new ApexCharts(document.querySelector("#customerHomeChart"), {
            chart: { type: 'line', height: 300 },
            series: [{
                name: "Number of Homes",
                data: Object.values(customerHomes)
            }],
            xaxis: {
                categories: Object.keys(customerHomes),
                labels: { rotate: -45 }
            },
            colors: ['#00BFFF']
        }).render();

    </script>
@endsection
