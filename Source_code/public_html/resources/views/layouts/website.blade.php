<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!--<meta content="width=device-width, initial-scale=1" name="viewport">-->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1" name="viewport">

    <title>@yield('title')</title>

    <link href="{{ asset('assets/images/favicon-icon.png')}}" rel="icon" sizes="32x32" type="image/png">

    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons&display=swap">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="{{ asset('root/css/style.css')}}">
    <link rel="stylesheet" href="{{ asset('root/css/responsive.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/css/jp-style.css')}}">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    @yield('pageStyle')
</head>
<body>
<!-- Navbar Start-->
@include('layouts.nav')

<section class="content">
    <!--Start Main Content Area-->
    @yield('content')
    <!--End Main Content Area-->
</section>
<!-- End of content-wrapper -->

<!--Start Footer Area-->

@include('layouts.donatebook')
@include('layouts.footer')

@section('footer_js_scrip_area')
    <!-- Bootstrap core JavaScript
    ================================================== -->

    <!-- All JS -->
    <script src="{{ asset('/assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/jquery.js')}}"></script>
    <script src="{{ asset('js/menu.js')}}"></script>
    <script src="{{ asset('js/jquery.magnific-popup.min.js')}}"></script>
    <script src="{{ asset('js/SmoothScroll.js')}}"></script>
    <script src="{{ asset('js/bootstrap.min.js')}}"></script>
    <script src="{{ asset('js/owl.carousel.min.js')}}"></script>

    <script src="{{ asset('root/js/rev-slider/jquery.themepunch.tools.min.js') }}"></script>
    <script src="{{ asset('root/js/rev-slider/jquery.themepunch.revolution.min.js') }}"></script>

    <script src="{{ asset('root/js/rev-slider/revolution.extension.actions.min.js') }}"></script>
    <script src="{{ asset('root/js/rev-slider/revolution.extension.carousel.min.js') }}"></script>
    <script src="{{ asset('root/js/rev-slider/revolution.extension.kenburn.min.js') }}"></script>
    <script src="{{ asset('root/js/rev-slider/revolution.extension.layeranimation.min.js') }}"></script>
    <script src="{{ asset('root/js/rev-slider/revolution.extension.migration.min.js') }}"></script>
    <script src="{{ asset('root/js/rev-slider/revolution.extension.navigation.min.js') }}"></script>
    <script src="{{ asset('root/js/rev-slider/revolution.extension.parallax.min.js') }}"></script>
    <script src="{{ asset('root/js/rev-slider/revolution.extension.slideanims.min.js') }}"></script>
    <script src="{{ asset('root/js/rev-slider/revolution.extension.video.min.js') }}"></script>
    <script src="{{ asset('root/js/custom.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@show
@yield('script')
</body>
</html>
