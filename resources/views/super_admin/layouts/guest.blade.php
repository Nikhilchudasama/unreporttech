<!DOCTYPE html>
<html lang="en">
<head>
    <title>{{ config('app.name') }}</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="author" content="{{ config('app.name') }}">
    <link rel="icon" href="images/favicon.ico" type="image/x-icon">

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/feather.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/waves.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/icofont.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/custom_styles.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/pages.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/passtrength.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/alertify.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/styles.css') }}">
</head>
<body themebg-pattern="theme1">
    <div class="theme-loader">
        <div class="loader-track">
            <div class="preloader-wrapper">
                <div class="spinner-layer spinner-blue">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="gap-patch">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>

                <div class="spinner-layer spinner-red">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="gap-patch">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>

                <div class="spinner-layer spinner-yellow">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="gap-patch">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>

                <div class="spinner-layer spinner-green">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="gap-patch">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="login-block">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    @yield('contents')
                </div>
            </div>
        </div>
    </section>

    <script src="{{ asset('js/jquery-3.3.1.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/jquery-ui.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/popper.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/jquery.slimscroll.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/waves.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/custom_scripts.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/jquery.passtrength.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/alertify.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/scripts.js') }}" type="text/javascript"></script>

    @if (session('message'))
        <script>
            showNotice("{{ session('type') }}", "{{ session('message') }}");
        </script>
    @endif

    @stack('scripts')
</body>
</html>
