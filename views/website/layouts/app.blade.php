<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'EcoSecure Home')</title>
    <link rel="icon" href="{{asset('logo.png')}}">
    <link rel="stylesheet" href="{{asset('website/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('website/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{asset('website/css/fontello.css')}}">
    <link rel="stylesheet" href="{{asset('website/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('website/css/animate.css')}}">
    <link rel="stylesheet" href="{{asset('website/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('website/css/custom.css')}}">
</head>
<body>
<div class="spinner">
    <div class="rect1"></div>
    <div class="rect2"></div>
    <div class="rect3"></div>
    <div class="rect4"></div>
    <div class="rect5"></div>
</div><!--end .spinner-->
@include('website.layouts.header')
<main>
    @yield('content')
</main>
@include('website.layouts.footer')
<script>
    function redirectToFeatures() {
        localStorage.setItem("scrollToFeatures", "yes");
        window.location.href = "{{ route('home') }}";
    }

    document.addEventListener("DOMContentLoaded", function () {
        if (localStorage.getItem("scrollToFeatures") === "yes") {
            localStorage.removeItem("scrollToFeatures");
            const el = document.querySelector("#features");
            if (el) {
                el.scrollIntoView({ behavior: "smooth" });
            }
        }
    });
</script>

</body>
</html>
