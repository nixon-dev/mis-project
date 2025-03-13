<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Register - Management Information System</title>

    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset ('font-awesome/css/font-awesome.css ') }}" rel="stylesheet">

    <link href="{{ asset ('css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset ('css/style.css') }}" rel="stylesheet">


</head>

<body class="gray-bg">

    <div class="loginColumns animated fadeInDown">
        <div class="row">

            <div class="col-md-6">
                <h1 class="font-bold">Register</h1>

                <h3 class="font-bold">Management Information System</h3>

                <p>
                    Document Tracking System
                </p>
                <p>
                    Prototype
                </p>

            </div>
            <div class="col-md-6">
                <div class="ibox-content">
                    <form class="m-t" role="form" action="index.html">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Name" required>
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control" placeholder="Username" required>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" placeholder="Password" required>
                        </div>
                        <button type="submit" class="btn btn-primary block full-width m-b">Register</button>

                        <p class="text-muted text-center">
                            <small>Already have an account?</small>
                        </p>
                        <a class="btn btn-sm btn-white btn-block" href="{{ url ('/login') }}">Login</a>
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