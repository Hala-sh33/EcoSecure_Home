<footer class="footer_area bg-dark text-white py-4">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <a style="display: flex;    justify-content: space-around;" href="{{ route('home') }}" class="footer_logo">
                    <img style="height: 100px;width: 100px;" src="{{ asset('logo3.png') }}" alt="EcoSecure Home Logo"
                         class="mb-2">
                </a>
                <p class="text-center">Smart Home Security & Automation for a safer, smarter life.</p>
            </div>

            <div style="display: flex;align-items: flex-start;flex-direction: column;" class="col-md-3">
                <h3 style="margin-bottom: 10px;">Contact Us</h3>
                <p><i class="fa fa-phone"></i> +966 555 123 456</p>
                <p><i class="fa fa-envelope"></i> support@ecosecurehome.com</p>
            </div>
            <div class="col-md-3">
                <div style="    display: flex
;
    justify-content: space-evenly;" class="social_links mt-2">
                    <a href="#" class="text-white mx-2"><i style="font-size: 35px; margin-top: 29px;" class="fab fa-twitter"></i></a>
                    <a href="#" class="text-white mx-2"><i style="font-size: 35px; margin-top: 29px;" class="fab fa-facebook"></i></a>
                    <a href="#" class="text-white mx-2"><i style="font-size: 35px; margin-top: 29px;" class="fab fa-linkedin"></i></a>
                </div>
            </div>
        </div>
        <p style="    border-top: 1px solid #68bf16;
    text-align: center;
    padding: 16px 0;
    margin-top: 19px;" class="mb-0">&copy; {{ date('Y') }} EcoSecure Home. All rights reserved.</p>
    </div>
</footer>
<script src="{{ asset('website/js/jquery.min.js') }}"></script>
<script src="{{ asset('website/js/bootstrap.min.js') }}"></script>
<script src="{{asset('website/js/owl.carousel.min.js')}}"></script>
<script src="{{ asset('website/js/custom.js') }}"></script>
@stack('js')
