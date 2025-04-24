<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>@yield('title', 'EcoSecure Home')</title>
    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('logo3.png')}}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{asset('logo3.png')}}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('logo3.png')}}">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/vendors/styles/core.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/vendors/styles/icon-font.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/vendors/styles/style.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/src/custom.css') }}">

    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-119386393-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-119386393-1');
    </script>
</head>
<body class="login-page">
<div class="login-header box-shadow">
    <div class="container-fluid d-flex justify-content-between align-items-center">
        <div style="height: 81px;background: white;" class="brand-logo">
            <a href="{{route('home')}}">
                <img style="height: 66px;width: 66px;" src="{{asset('logo3.png')}}" alt="">
            </a>
        </div>
        <div class="login-menu">
            <ul>
                <li><a href="#">Welcome Back!</a></li>
            </ul>
        </div>
    </div>
</div>
<div class="login-wrap d-flex align-items-center flex-wrap justify-content-center">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6 col-lg-7">
                <img src="{{asset('assets/vendors/images/login-page-img.png')}}" alt="">
            </div>
            <div class="col-md-6 col-lg-5">
               @yield('content')
            </div>
        </div>
    </div>
</div>
<!-- js -->
<script src="{{asset('assets/vendors/scripts/core.js')}}"></script>
<script src="{{asset('assets/vendors/scripts/script.min.js')}}"></script>
<script src="{{asset('assets/vendors/scripts/process.js')}}"></script>
<script src="{{asset('assets/vendors/scripts/layout-settings.js')}}"></script>
<!-- Include SweetAlert from CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>

    @if(session('success'))
    Swal.fire({
        icon: 'success',
        title: 'Success',
        text: '{{ session('success') }}',
        confirmButtonColor: '#3085d6'
    });
    @endif

    @if(session('error'))
    Swal.fire({
        icon: 'error',
        title: 'Error',
        text: '{{ session('error') }}',
        confirmButtonColor: '#d33'
    });
    @endif
</script>

</body>
</html>
