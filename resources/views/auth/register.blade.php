@extends('base.auth')
@section('title', 'Register - Management Information System')
@section('form')
    <div class="col-md-6 ">
        <div class="ibox-content dark-skin border-radius-3">
            <h2 class="font-bold text-center">Register</h2>
            <form class="m-t" role="form" action="{{ route('register') }}" method="POST">
                @csrf
                <div class="form-group">
                    <input type="text" name="name" class="form-control dark-skin-2 text-white border-secondary"
                        placeholder="Name" value="{{ old('name') }}" required>
                    @error('name')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror

                </div>
                <div class="form-group">
                    <input type="email" name="email" class="form-control dark-skin-2 text-white border-secondary"
                        placeholder="Email" value="{{ old('email') }}" pattern="[a-z0-9._%+\-]+@[a-z0-9.\-]+\.[a-z]{2,}$"
                        title="Must be valid email" required>
                    @error('email')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <input type="password" name="password" class="form-control dark-skin-2 text-white border-secondary"
                        placeholder="Password" required minlength="6">
                    @error('password')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <input type="password" name="password_confirmation"
                        class="form-control dark-skin-2 text-white border-secondary" placeholder="Confirm Password" required
                        minlength="6">
                </div>
                <button type="submit" class="btn btn-primary block full-width m-b">Register</button>

                <p class="text-muted text-center">
                    <small>Already have an account?</small>
                </p>
                <a class="btn btn-sm btn-success block full-width m-b" href="{{ url('/login') }}">Login</a>
            </form>
        </div>
    </div>
@endsection