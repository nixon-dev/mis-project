<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <link rel="icon" type="image/ico" href="{{ asset('img/favicon.ico') }}">

    <title> @yield('title', 'Management Information System')</title>

    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('font-awesome/css/font-awesome.css ') }}" rel="stylesheet">

    <link href="{{ asset('css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/personal.css') }}" rel="stylesheet">


</head>

<body class="dark-skin-2">

    <div class="loginColumns animated fadeInDown" style="margin-top: -80px;">

        <div class="row">
            <div class="col-sm-12 text-center mb-4">
                <img class="text-center" src="{{ asset('img/logo/diffun_quirino.png') }}"
                    style="width: 10vw; height: auto; object-fit: cover;" />
                <img class="text-center" src="{{ asset('img/logo/mis.png') }}"
                    style="width: 10vw; height: auto; object-fit: cover;" />
            </div>

            <div class="col-md-12">
                @include('components.alert')
            </div>
            <div class="col-md-6 d-md-block d-none text-white">

                <h2 class="font-bold">Management Information System</h2>

                <p>
                    Document Tracking System
                </p>
                <p>
                    In development
                </p>

            </div>
            @yield('form')
        </div>
        <hr />
        <div class="row">
            <div class="col-md-12 text-white">
                <small class="pull-right">© 2025</small>
                Copyright LGU DIFFUN
            </div>
        </div>
    </div>

    <!-- Mainly scripts -->
    <script src="{{ asset('js/jquery-3.1.1.min.js') }}"></script>
    <script src="{{ asset('js/popper.min.js ') }}"></script>
    <script src="{{ asset('js/bootstrap.js') }}"></script>
    <script src="{{ asset('js/plugins/metisMenu/jquery.metisMenu.js') }}"></script>
    <script src="{{ asset('js/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>

    <!-- Custom and plugin javascript -->
    <script src="{{ asset('js/inspinia.js') }}"></script>


</body>

</html>
