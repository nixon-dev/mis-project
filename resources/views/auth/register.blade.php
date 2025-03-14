<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Register - Management Information System</title>

    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('font-awesome/css/font-awesome.css ') }}" rel="stylesheet">

    <link href="{{ asset('css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/personal.css') }}" rel="stylesheet">


</head>

<body class="dark-skin-2">



    <div class="loginColumns animated fadeInDown" style="margin-top: -80px;">

        <div class="row">
            <div class="col-md-6 text-center mb-4">
                <img class="text-center pull-right" src="{{ asset('img/logo/diffun_quirino.png') }}"
                    style="width: 120px; height: 120px; object-fit: cover;" />

            </div>
            <div class="col-md-6 text-center mb-4">
                <img class="text-center pull-left" src="{{ asset('img/logo/mis.png') }}"
                    style="width: 120px; height: 120px; object-fit: cover;" />

            </div>
            <div class="col-md-6 text-white">
                <h1 class="font-bold">Register</h1>

                <h3 class="font-bold">Management Information System</h3>

                <p>
                    Document Tracking System
                </p>
                <p>
                    Prototype
                </p>
                <!-- Display validation errors -->
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

            </div>
            <div class="col-md-6 ">
                <div class="ibox-content dark-skin border-radius-35">
                    <form class="m-t" role="form" action="{{ route('register') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <input type="text" name="name"
                                class="form-control bg-dark text-white border-secondary" placeholder="Name"
                                value="{{ old('name') }}" required>
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror

                        </div>
                        <div class="form-group">
                            <input type="email" name="email"
                                class="form-control bg-dark text-white border-secondary" placeholder="Email"
                                value="{{ old('email') }}" required>
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input type="password" name="password"
                                class="form-control bg-dark text-white border-secondary" placeholder="Password" required
                                minlength="6">
                            @error('password')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input type="password" name="password_confirmation"
                                class="form-control bg-dark text-white border-secondary" placeholder="Confirm Password"
                                required minlength="6">
                        </div>
                        <button type="submit" class="btn btn-primary block full-width m-b">Register</button>

                        <p class="text-muted text-center">
                            <small>Already have an account?</small>
                        </p>
                        <a class="btn btn-sm red-bg btn-block" href="{{ url('/login') }}">Login</a>
                    </form>
                    <p class="m-t">
                        <small>Pakaenam si Rhovin &copy; 2025</small>
                    </p>
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
    <script src="{{ asset('js/plugins/pace/pace.min.js') }}"></script>


</body>

</html>
