<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>
    <!-- Styles -->
    <link
        href="https://fonts.googleapis.com/css?family=Archivo+Narrow:300,400,700%7CMontserrat:300,400,500,600,700,800,900"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/frontend/plugins/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/plugins/ps-icon/style.css')}}">
    <!-- CSS Library-->
    <link rel="stylesheet" href="{{ asset('assets/frontend/plugins/bootstrap/dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/plugins/owl-carousel/assets/owl.carousel.css') }}">
    <link rel="stylesheet"
        href="{{ asset('assets/frontend/plugins/jquery-bar-rating/dist/themes/fontawesome-stars.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/plugins/slick/slick/slick.css') }}">
    <link rel="stylesheet"
        href="{{ asset('assets/frontend/plugins/bootstrap-select/dist/css/bootstrap-select.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/plugins/Magnific-Popup/dist/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/frontend/plugins/jquery-ui/jquery-ui.min.css') }}">

    <!-- Custom-->
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/style.css') }}">
    <!--HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries-->
    <!--WARNING: Respond.js doesn't work if you view the page via file://-->
    <!--[if lt IE 9]><script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script><script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script><![endif]-->
    @stack('css')
</head>
<!--[if IE 7]><body class="ie7 lt-ie8 lt-ie9 lt-ie10"><![endif]-->
<!--[if IE 8]><body class="ie8 lt-ie9 lt-ie10"><![endif]-->
<!--[if IE 9]><body class="ie9 lt-ie10"><![endif]-->

<body class="ps-loading">
    <div class="header--sidebar"></div>
    @include('layouts.frontend.partials.header')
    <main class="ps-main">
        @yield('content')
    </main>
    @include('layouts.frontend.partials.footer')
    <script type="text/javascript" src="{{ asset('assets/frontend/plugins/jquery/dist/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/frontend/plugins/bootstrap/dist/js/bootstrap.min.js') }}">
    </script>
    <script type="text/javascript"
        src="{{ asset('assets/frontend/plugins/jquery-bar-rating/dist/jquery.barrating.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/frontend/plugins/owl-carousel/owl.carousel.min.js') }}">
    </script>
    <script type="text/javascript" src="{{ asset('assets/frontend/plugins/gmap3.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/frontend/plugins/imagesloaded.pkgd.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/frontend/plugins/isotope.pkgd.min.js') }}"></script>
    <script type="text/javascript"
        src="{{ asset('assets/frontend/plugins/bootstrap-select/dist/js/bootstrap-select.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/frontend/plugins/jquery.matchHeight-min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/frontend/plugins/slick/slick/slick.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/frontend/plugins/elevatezoom/jquery.elevatezoom.js') }}">
    </script>
    <script type="text/javascript"
        src="{{ asset('assets/frontend/plugins/Magnific-Popup/dist/jquery.magnific-popup.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/frontend/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    {{-- <script type="text/javascript"
        src="https://maps.googleapis.com/mapss/api/js?key=AIzaSyAx39JFH5nhxze1ZydH-Kl8xXM3OK4fvcg&amp;region=GB">
    </script> --}}

    <!-- Custom scripts-->
    <script type="text/javascript" src="{{ asset('assets/frontend/js/main.js') }}"></script>
    @stack('js')
</body>

</html>
