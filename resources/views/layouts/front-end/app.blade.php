<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link rel="icon" href="{{asset('storage/company')}}/{{$web_config['fav_icon']->value}}" />
    <link rel="preconnect" href="https://fonts.googleapis.com/" />
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&amp;display=swap"
        rel="stylesheet" />
    <!-- ========== bootstrap css ========== -->
    <link rel="stylesheet" href="{{ asset('assets/front-end/assets/css/vendors/bootstrap.css') }}" id="rtl-link" />
    <!-- ========== swiper css ========== -->
    <link rel="stylesheet" href="{{ asset('assets/front-end/assets/css/vendors/swiper-bundle.css') }}" />
    <!-- ========== remix icon css ========== -->
    <link rel="stylesheet" href="{{ asset('assets/front-end/assets/fonts/remix-icon/remixicon.css') }}" />
    <!-- ========== animation css ========== -->
    <link rel="stylesheet" href="cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <!-- ========== style css ========== -->
    <link rel="stylesheet" href="{{ asset('assets/front-end/assets/css/style.css') }}" />
    
    @yield('page-style')
</head>

<body class="montserrat-font color-2">
    <div class="loader-wrapper">
        <div class="text-center">
            <img src="{{ asset('assets/front-end/assets/images/loader/loader.gif') }}" alt="car-loader"
                class="img-fluid" />
            <h4>Welcome To, Fashion Clickz. Just wait.....</h4>
        </div>
    </div>
    @include('layouts.front-end.partials._header')
    @yield('content')
    @include('layouts.front-end.partials._footer')
    <div class="tap-top">
        <div>
            <i class="ri-arrow-up-line"></i>
        </div>
    </div>
    <!-- ========== Mood Button js ========== -->
    <script src="{{ asset('assets/front-end/assets/js/theme-setting.js') }}"></script>
    <!-- ========== bootstrap js ========== -->
    <script src="{{ asset('assets/front-end/assets/js/vendors/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/front-end/assets/js/vendors/popper.min.js') }}"></script>
    <!-- ========== swiper js ========== -->
    <script src="{{ asset('assets/front-end/assets/js/vendors/swiper-bundle.min.js') }}"></script>
    <!-- ========== custom js ========== -->
    <script src="{{ asset('assets/front-end/assets/js/custom-slider.js') }}"></script>
     <!-- ========== dropdown js ========== -->
    <script src="{{ asset('assets/front-end/assets/js/dropdown.js') }}"></script>
    <!-- ========== menu js ========== -->
    <script src="{{ asset('assets/front-end/assets/js/menu.js') }}"></script>
    <!-- ========== filter js ========== -->
    <script src="{{ asset('assets/front-end/assets/js/filter.js') }}"></script>
    <!-- ========== like js ========== -->
    <script src="{{ asset('assets/front-end/assets/js/like.js') }}"></script>
    <!-- =========== isotop filter js =========== -->
    <script src="{{ asset('assets/front-end/assets/js/isotop-filter.js') }}"></script>
    <!-- ========= img selector js ========== -->
    <script src="{{ asset('assets/front-end/assets/js/img-selector.js') }}"></script>
    <!-- ========== newsletter js ========== -->
    <script src="{{ asset('assets/front-end/assets/js/newsletter.js') }}"></script>
     <!-- ========== stickycart js ========== -->
    <script src="{{ asset('assets/front-end/assets/js/stickycart.js') }}"></script>
    <!-- ========== Loader js ========== -->
    <script src="{{ asset('assets/front-end/assets/js/loader.js') }}"></script>
    <!-- ========== script js ========== -->
    <script src="{{ asset('assets/front-end/assets/js/script.js') }}"></script>

    @yield('page-script')
</body>

</html>
