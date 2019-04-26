<!DOCTYPE html>
<html lang="en">
<head>
	<title>@yield('title') - {{ config('app.name') }}</title>
	<meta charset="utf-8">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="author" content="{{ config('app.name') }}">
	<link rel="icon" href="{{ asset('images/favicon.ico') }}" type="image/x-icon">

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.datepicker.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/feather.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/waves.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/icofont.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/custom_styles.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/alertify.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/styles.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/widget.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('css/pages.css') }}">
	{{-- You can put page wise internal css style in styles section --}}
	@stack('styles')
	<style>
		#loader{
			background: #fff;
			width: 100%;
			height: 100%;
			opacity: 0.8;
			position: fixed;
			z-index: 9999;
		}
		#loader > .preloader6 {
			position: fixed;
			top: 50%;
    		left: 50%;
		}
	</style>
</head>
<body>
	<div id="loader">
		<div class="preloader6">
			<hr>
		</div>
	</div>
    <div id="pcoded" class="pcoded">
		<div class="pcoded-overlay-box"></div>

        <div class="pcoded-container navbar-wrapper">
			@include('super_admin.layouts.includes.header')


			<div class="pcoded-main-container">
				<div class="pcoded-wrapper">
					@include('super_admin.layouts.includes.sidebar')

                    <div class="pcoded-content">
						<div class="page-header">
							<div class="page-block">
								<div class="row align-items-center">
									<div class="col-md-8">
										<div class="page-header-title">
										</div>
                                        <ul class="breadcrumb">
											<li class="breadcrumb-item">
												<a href="{{ route('super_admin.dashboard') }}">
													<i class="feather icon-home"></i>
												</a>
											</li>

                                            <li class="breadcrumb-item">
												<a href="{{ url()->full() }}">
													@yield('title')
												</a>
											</li>
										</ul>
									</div>
								</div>
							</div>
						</div>

						<div class="pcoded-inner-content">
							<div class="main-body">
								<div class="page-wrapper">
									<div class="page-body">
										<div class="row" id='draggablePanelList'>
											@yield('dashboard')
											<div class="col-sm-12">
												@if ($errors->all())
													<ul class="alert alert-danger">
														@foreach ($errors->all() as $message)
															<li>{{ $message }}</li>
														@endforeach
													</ul>
												@endif

												@yield('contents')
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
    </div>
	@include('super_admin.layouts.includes.common_pop')
	{{-- Change Password Modal --}}
	{{-- @include('super_admin.layouts.includes.change_password') --}}
	<script src="{{ asset('js/jquery-3.3.1.min.js') }}" type="text/javascript"></script>
	<script src="{{ asset('js/jquery-ui.min.js') }}" type="text/javascript"></script>
	<script src="{{ asset('js/popper.min.js') }}" type="text/javascript"></script>
	<script src="{{ asset('js/bootstrap.min.js') }}" type="text/javascript"></script>
	<script src="{{ asset('js/bootstrap-datepicker.min.js') }}" type="text/javascript"></script>
	<script src="{{ asset('js/jquery.slimscroll.js') }}" type="text/javascript"></script>
	<script src="{{ asset('js/pcoded.min.js') }}" type="text/javascript"></script>
	<script src="{{ asset('js/waves.min.js') }}" type="text/javascript"></script>
	<script src="{{ asset('js/vertical-layout.min.js') }}" type="text/javascript"></script>
	<script src="{{ asset('js/custom_scripts.js') }}" type="text/javascript"></script>
	<script src="{{ asset('js/pages.js') }}" type="text/javascript"></script>
	<script src="{{ asset('js/jquery.passtrength.min.js') }}" type="text/javascript"></script>
	<script src="{{ asset('js/alertify.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/axios.min.js') }}"></script>
	<script src="{{ asset('js/scripts.js') }}" type="text/javascript"></script>

	@if (session('message'))
        <script>
            showNotice("{{ session('type') }}", "{{ session('message') }}");
        </script>
    @endif
	<script>
	$(document).ready(function() {
		setTimeout(function() {
			setTimeout(function() {
				hideLoader();
			},100)
			showLoader();
		},1000);
	});

	function showLoader() {
		document.getElementById("loader").style.display = "block";
		document.getElementById("pcoded").style.display = "none";
	}
	function hideLoader(){
		document.getElementById("loader").style.display = "none";
		document.getElementById("pcoded").style.display = "block";
	}
	</script>
	@include('super_admin.layouts.includes.common_form_script')
    {{-- You can put page wise javascript in scripts section --}}
    @stack('scripts')
</body>
</html>
