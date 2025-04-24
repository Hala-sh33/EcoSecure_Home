@extends('website.layouts.app')

@section('title', 'Contact Us - EcoSecure Home')

@section('content')

    <!-- About Us Hero Section -->
    <section style="margin-top: 45px;" class="hero_section text-center bg-light">
        <div class="container">
            <div class="col-md-12">
                <div class="hero_section_title text-center mb_50">
                    <h4>Contact EcoSecure Home</h4>
                    <h3>We’re here to assist you. Reach out to us anytime!</h3>
                </div><!--end .hero_section_title-->
            </div>
        </div>
    </section>
    <section style="padding-top: 50px;" class="contact_info">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-4">
                    <div class="contact_box shadow-lg p-5 rounded text-center">
                        <i class="fa fa-phone-alt font-icon"></i>
                        <h3 class="mt-3">Call Us</h3>
                        <p class="text-muted">+966 555 123 456</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="contact_box shadow-lg p-5 rounded text-center">
                        <i class="fa fa-envelope font-icon"></i>
                        <h3 class="mt-3">Email Us</h3>
                        <p class="text-muted">support@ecosecurehome.com</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="contact_box shadow-lg p-5 rounded text-center">
                        <i class="fa fa-map-marker-alt font-icon"></i>
                        <h3 class="mt-3">Visit Us</h3>
                        <p class="text-muted">Jubail, Saudi Arabia</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section style="padding-top: 50px;" class="map_section">
        <div class="container">
            <div class="map_container shadow-lg rounded overflow-hidden">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3633.7845239051847!2d49.65754211500276!3d27.00313948312019!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3e35a206b8b1b6f9%3A0xa7c2a3c8e07e1a90!2sJubail%2C%20Saudi%20Arabia!5e0!3m2!1sen!2ssa!4v1644239868765!5m2!1sen!2ssa"
                    width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy">
                </iframe>
            </div>
        </div>
    </section>

@endsection
