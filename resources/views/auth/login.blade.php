<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <link rel="icon" type="image/ico" href="{{ asset('img/favicon.ico') }}">

    <title>Login - Management Information System</title>

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
                @include('_message')
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
            <div class="col-md-6 d-md-block">
                <div class="ibox-content border-radius-35 dark-skin">
                    <h2 class="font-bold text-center">Login</h2>
                    <form class="m-t" role="form" action="" method="POST">
                        @csrf
                        <div class="form-group">
                            <input type="email" name="inputEmail"
                                class="form-control dark-skin-2 text-white border-secondary" placeholder="Email"
                                required="">
                        </div>
                        <div class="form-group">
                            <input type="password" name="inputPassword"
                                class="form-control dark-skin-2 text-white border-secondary" placeholder="Password"
                                required="">
                        </div>
                        <label> <input type="checkbox" class="i-checks" name="inputRememberMe"> Remember me </label>
                        <button type="submit" class="btn btn-primary block full-width m-b">Login</button>

                        <a href="#">
                            <small>Forgot password?</small>
                        </a>

                        <p class="text-muted text-center">
                            <small>Do not have an account?</small>
                        </p>
                        <a class="btn btn-sm btn-success block full-width m-b" href="{{ url('/register') }}">Create
                            an
                            account</a>
                    </form>
                    {{-- <p class="m-t">
                        <small>Nickson &copy; 2025</small>
                    </p> --}}
                </div>
            </div>
        </div>
        <hr />
        <div class="row">
            <div class="col-md-12 text-white">
                Copyright LGU DIFFUN
                <small class="pull-right">© 2025</small>
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
