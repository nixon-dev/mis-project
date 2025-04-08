@extends('base.auth')
@section('title', 'Login - Management Information System')
@section('form')
    <div class="col-md-6 d-md-block">
        <div class="ibox-content border-radius-35 dark-skin">
            <h2 class="font-bold text-center">Login</h2>
            <form class="m-t" role="form" action="" method="POST">
                @csrf
                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="inputEmail" class="form-control dark-skin-2 text-white border-secondary"
                        required>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="inputPassword" class="form-control dark-skin-2 text-white border-secondary"
                        required>
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
        </div>
    </div>
@endsection
