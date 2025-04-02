@extends('admin.base')
@section('title', 'User Setting - Management Information System')
@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-sm-8">
            <h2>Personal Setting</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="/admin/dashboard">Admin</a>
                </li>
                <li class="breadcrumb-item active">
                    Settings
                </li>
                <li class="breadcrumb-item active">
                    <strong>Personal</strong>
                </li>
            </ol>
        </div>
        {{-- <div class="col-sm-4">
            <div class="title-action">
                <a href="" class="btn btn-primary">This is action area</a>
            </div>
        </div> --}}
    </div>


    <div class="wrapper wrapper-content animated fadeInDown">
        <div class="row">

            <div class="col-sm-12">
                @if (Session::has('success'))
                    <p class="alert alert-success">{{ Session::get('success') }}</p>
                @elseif (Session::has('error'))
                    <p class="alert alert-danger">{{ Session::get('error') }}</p>
                @endif
            </div>

            @if ($errors->any())
                <div class="col-sm-12">
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>ASD</h5>
                    </div>
                    <div class="ibox-content">

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
