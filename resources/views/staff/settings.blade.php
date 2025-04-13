@extends('staff.base')
@section('title', 'Setting - Management Information System')
@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-sm-8">
            <h2>Settings</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="/staff/dashboard">Staff</a>
                </li>
                <li class="breadcrumb-item active">
                    <strong>Settings</strong>
                </li>
            </ol>
        </div>
    </div>

    <div class="wrapper wrapper-content animated fadeInDown">
        <div class="row">
            <div class="col-sm-12">
                @include('components.message')
            </div>
            <div class="col-lg-6">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>Personal Information</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>

                            <a class="close-link">
                                <i class="fa fa-times"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <form action="{{ route('staff.user-update') }}" method="POST">

                            @csrf()
                            <div class="form-group d-none">
                                <label>ID</label>
                                <input type="number" name="id" value="{{ Auth::user()->id }}" class="form-control"
                                    readonly>
                            </div>
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" name="name" value="{{ Auth::user()->name }}" class="form-control"
                                    required>
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="text" name="email" value="{{ Auth::user()->email }}" class="form-control"
                                    readonly>
                            </div>
                            <div class="form-group">
                                <label>Role</label>
                                <input type="text" name="role" value="{{ Auth::user()->role }}" class="form-control"
                                    readonly>
                            </div>


                            <div class="form-group text-center">
                                <button class="btn btn-sm btn-primary m-t-n-xs w-100" type="submit"><strong>Submit</strong>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>Change Password</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>

                            <a class="close-link">
                                <i class="fa fa-times"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <form action="{{ route('staff.user-update-password') }}" method="POST" autocomplete="off">
                            @csrf()
                            <div class="form-group d-none">
                                <label>Email</label>
                                <input type="email" name="email" value="{{ Auth::user()->email }}" class="form-control"
                                    readonly>
                            </div>
                            <div class="form-group">
                                <label>Old Password</label>
                                <input type="password" name="old_password" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>New Password</label>
                                <input type="password" name="new_password" id="new_password" class="form-control"
                                    autocomplete="new-password" minlength="6" required>
                            </div>
                            <div class="form-group">
                                <label>Confirm Password</label>
                                <input type="password" name="confirm_password" id="confirm_password"
                                    autocomplete="new-password" minlength="6" class="form-control" required>
                            </div>
                            <div class="form-group d-none">
                                <label>ID</label>
                                <input type="number" name="id" value="{{ Auth::user()->id ?? '' }}"
                                    class="form-control" readonly>
                            </div>
                            <div class="form-group text-center">
                                <button class="btn btn-sm btn-success m-t-n-xs w-100" type="submit"><strong>Update
                                        Password</strong>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        document.querySelector('#confirm_password').addEventListener('input', function() {
            const password = document.getElementById('new_password').value;
            const repeatPassword = document.getElementById('confirm_password').value;

            if (password !== repeatPassword) {
                document.getElementById('confirm_password').setCustomValidity("Passwords do not match!");
            } else {
                document.getElementById('confirm_password').setCustomValidity("");
            }
        });
    </script>
@endsection
