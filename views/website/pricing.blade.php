@extends('website.layouts.app')

@section('title', 'Pricing - EcoSecure Home')

@section('content')

    <!-- Hero Section -->
    <section style="margin-top: 45px;" class="hero_section text-center bg-light">
        <div class="container">
            <div class="col-md-12">
                <div class="hero_section_title text-center mb_50">
                    <h4>EcoSecure Home Pricing</h4>
                    <h3>Choose the perfect plan for your home security & automation needs.</h3>
                </div><!--end .hero_section_title-->
            </div>
        </div>
    </section>

    <!-- Pricing Plans -->
    <section style="margin-top: 45px;" class="pricing_section text-center">
        <div class="container">
            <div class="row">
                <!-- Basic Plan -->
                <div class="col-md-4">
                </div>

                <!-- Standard Plan -->
                <div class="col-md-4">
                    <div class="pricing_box shadow-lg p-5 rounded featured">
                        <img class="img-pricing" src="{{asset('website/images/pr.png')}}">

                        <h3 class="plan_title">Standard</h3>
                        <p class="price"><strong>SAR 100</strong> / Year</p>
                        <ul class="pricing_features">
                            <li><i class="fa fa-check"></i> Smart Lock Control</li>
                            <li><i class="fa fa-check"></i> Mobile App Access</li>
                            <li><i class="fa fa-check"></i> 24/7 Monitoring</li>
                            <li><i class="fa fa-check"></i> AI Video Surveillance</li>
                            <li><i class="fa fa-check"></i> Energy Efficiency Reports</li>
                        </ul>
                        <a href="{{route('login')}}" class="btn btn-success">Get Started</a>
                    </div>
                </div>

                <!-- Premium Plan -->
                <div class="col-md-4">
                </div>
            </div>
        </div>
    </section>

@endsection
