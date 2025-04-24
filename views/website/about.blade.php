@extends('website.layouts.app')

@section('title', 'About Us - EcoSecure Home')

@section('content')

    <!-- About Us Hero Section -->
    <section style="margin-top: 45px;" class="hero_section text-center bg-light">
        <div class="container">
            <div class="col-md-12">
                <div class="hero_section_title text-center mb_50">
                    <h4>About EcoSecure Home</h4>
                    <h3>Smart, Secure, and Sustainable Living Solutions</h3>
                </div><!--end .hero_section_title-->
            </div>
        </div>
    </section>

    <!-- About Details Section -->
    <section class="about_section aboutttt">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-5">
                    <img style="border-radius: 20px;" src="{{ asset('website/images/about.png') }}" alt="About EcoSecure Home" class="img-fluid rounded shadow">
                </div>
                <div class="col-md-7">
                    <h2 class="mb-4">Who We Are</h2>
                    <p>
                        At <strong>EcoSecure Home</strong>, we are pioneers in <strong>smart home security and automation</strong>, empowering homeowners with seamless control, real-time monitoring, and intelligent automation. Our mission is to redefine home security by integrating <strong>cutting-edge AI technology</strong> with intuitive, user-friendly solutions.
                    </p>
                    <p>
                        We provide a <strong>comprehensive ecosystem</strong> of AI-driven surveillance, automated alerts, energy optimization, and smart device control—all designed to ensure your home is <strong>secure, efficient, and effortlessly manageable</strong>. With seamless IoT integration, we bring the future of smart living to your fingertips, making homes safer, smarter, and more sustainable.
                    </p>
                </div>

            </div>
        </div>
    </section>


    <!-- Professional Installation Section -->
    <section style="margin-top: 50px;" class="installation_area section_padding section_dark_bg">
        <img src="{{ asset('website/images/testimonial-shape.png') }}" class="triangle_shape installation_shape" alt="Shape">
        <div class="container">
            <div class="row">
                <div class="col-md-6 pr_0">
                    <div class="installation_left">
                        <div class="hero_section_title mb_50">
                            <h4>Get Started</h4>
                            <h1>Professional Installation</h1>
                        </div><!--end .hero_section_title-->
                        <p>
                            Our smart home professionals will work with you to customize and install your package with precision. We ensure a hassle-free experience, and best of all—installation is completely free from our side.
                        </p>
                        <a href="{{ route('contact') }}" class="btn btn-default default_btn">Request a Free Quote</a>
                    </div><!--end .installation_left-->
                </div><!--end .col-md-6-->
            </div><!--end .row-->
        </div><!--end .container-->
    </section>

@endsection
