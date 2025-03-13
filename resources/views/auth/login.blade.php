<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login - Management Information System</title>

    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset ('font-awesome/css/font-awesome.css ') }}" rel="stylesheet">

    <link href="{{ asset ('css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset ('css/style.css') }}" rel="stylesheet">


</head>

<body class="gray-bg">

    <div class="loginColumns animated fadeInDown">
        <div class="row">

            <div class="col-md-6">
                <h1 class="font-bold">Login</h1>

                <h3 class="font-bold">Management Information System</h3>

                <p>
                    Document Tracking System
                </p>
                <p>
                    Prototype
                </p>
                <p>
                    @include(_message)
                </p>

            </div>
            <div class="col-md-6">
                <div class="ibox-content">
                    <form class="m-t" role="form" action="" method="POST">
                        {{  csrf_field() }}
                        <div class="form-group">
                            <input type="email" name="inputEmail" class="form-control" placeholder="Email" required="">
                        </div>
                        <div class="form-group">
                            <input type="password" name="inputPassword" class="form-control" placeholder="Password" required="">
                        </div>
                        <label> <input type="checkbox" class="i-checks" name="inputRememberMe"> Remember me </label>
                        <button type="submit" class="btn btn-primary block full-width m-b">Login</button>

                        <a href="#">
                            <small>Forgot password?</small>
                        </a>

                        <p class="text-muted text-center">
                            <small>Do not have an account?</small>
                        </p>
                        <a class="btn btn-sm btn-white btn-block" href="{{ url('/register')}}">Create an account</a>
                    </form>
                    <p class="m-t">
                        <small>Pakaenam si Rhovin &copy; 2025</small>
                    </p>
                </div>
            </div>
        </div>
        <hr />
        <div class="row">
            <div class="col-md-6">
                Copyright LGU DIFFUN
            </div>
            <div class="col-md-6 text-right">
                <small>© 2025</small>
            </div>
        </div>
    </div>

    <!-- Mainly scripts -->
    <script src="{{ asset ('js/jquery-3.1.1.min.js') }}"></script>
    <script src="{{ asset ('js/popper.min.js ') }}"></script>
    <script src="{{ asset ('js/bootstrap.js') }}"></script>
    <script src="{{ asset ('js/plugins/metisMenu/jquery.metisMenu.js') }}"></script>
    <script src="{{ asset ('js/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>

    <!-- Custom and plugin javascript -->
    <script src="{{ asset ('js/inspinia.js') }}"></script>
    <script src="{{ asset ('js/plugins/pace/pace.min.js') }}"></script>


</body>

</html>