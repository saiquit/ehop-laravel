<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Google Font -->
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/vendors/styles/core.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/vendors/styles/icon-font.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/src/plugins/bootstrap/bootstrap.min.css') }}">
	{{-- <link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/src/plugins/datatables/css/dataTables.bootstrap4.min.css') }}"> --}}
	{{-- <link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/src/plugins/datatables/css/responsive.bootstrap4.min.css') }}"> --}}
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/backend/vendors/styles/style.css') }}">

	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-119386393-1"></script>
	<script>
		window.dataLayer = window.dataLayer || [];
		function gtag(){dataLayer.push(arguments);}
		gtag('js', new Date());

		gtag('config', 'UA-119386393-1');
	</script>
    @stack('css')
</head>

<body>
    <div class="pre-loader">
		<div class="pre-loader-box">
			<div class="loader-logo"><img src="{{ asset('assets/backend/vendors/images/deskapp-logo.svg') }}" alt=""></div>
			<div class='loader-progress' id="progress_div">
				<div class='bar' id='bar1'></div>
			</div>
			<div class='percent' id='percent1'>0%</div>
			<div class="loading-text">
				Loading...
			</div>
		</div>
	</div>
    @include('layouts.backend.partials.header')
    @include('layouts.backend.partials.sidebar')
        <div class="mobile-menu-overlay"></div>
        <main >
        <div class="main-container">
        {{-- //message --}}
                    @if (session()->has('success'))
                    <div class="p-3 m-3 ">
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Congratulation </strong> {{session()->get("success")}}.
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                    @endif
            @yield('content')
        </div>
        </main>

    <script src="{{ asset('assets/backend/src/scripts/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/backend/vendors/scripts/core.js') }}"></script>
	<script src="{{ asset('assets/backend/vendors/scripts/script.min.js') }}"></script>
	<script src="{{ asset('assets/backend/vendors/scripts/process.js') }}"></script>
	<script src="{{ asset('assets/backend/vendors/scripts/layout-settings.js') }}"></script>
	<script src="{{ asset('assets/backend/src/plugins/apexcharts/apexcharts.min.js') }}"></script>
	<script src="{{ asset('assets/backend/src/plugins/datatables/js/jquery.dataTables.min.js') }}"></script>
	<script src="{{ asset('assets/backend/src/plugins/datatables/js/dataTables.bootstrap4.min.js') }}"></script>
	<script src="{{ asset('assets/backend/src/plugins/datatables/js/dataTables.responsive.min.js') }}"></script>
	<script src="{{ asset('assets/backend/src/plugins/datatables/js/responsive.bootstrap4.min.js') }}"></script>
	<script src="{{ asset('assets/backend/vendors/scripts/dashboard.js') }}"></script>

    @stack('js')
</body>
</html>
