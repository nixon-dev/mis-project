@extends('admin.base')
@section('title', 'Account Settings - Management Information System')
@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-sm-8">
            <h2>Account Setting</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.index') }}">Admin</a>
                </li>
                <li class="breadcrumb-item active">
                    <strong>Settings</strong>
                </li>
            </ol>
        </div>
    </div>
    <div class="wrapper wrapper-content animated fadeInDown">
        <div class="row">
            <div class="col-lg-12" id="message-container">
                @include('components.message')
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
                <div class="tabs-container">
                    <ul class="nav nav-tabs">
                        <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#profile" aria-expanded="true">Profile</a></li>
                        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#password" aria-expanded="false">Password</a></li>
                    </ul>
                    <div class="tab-content">
                        <div id="profile" class="tab-pane fade show active">
                            <div class="panel-body">
                                @include('admin.settings.components.profile')
                            </div>
                        </div>
                        <div id="password" class="tab-pane fade">
                            <div class="panel-body">
                                @include('admin.settings.components.password')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            $('#user-update').on('submit', function(event) {
                event.preventDefault();
                $.ajax({
                    method: 'POST',
                    url: '{{ route('admin.user-update') }}',
                    data: jQuery('#user-update').serialize(),
                    dataType: 'json',
                    success: function(response) {
                        if (response.success) {
                            $('#message-container').html('<div class="alert alert-success">' +
                                response.message + '</div>');
                            $('#display-name').text(response.message.split('updated to ')[1] ||
                                $('#name').val());
                        } else {
                            $('#message-container').html('<div class="alert alert-danger">' +
                                response.message + '</div>');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error("AJAX Error:", error);
                        $('#message-container').html(
                            '<div class="alert alert-danger">An unexpected error occurred. Please try again.</div>'
                        );
                    },
                });
            });
        });
    </script>
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
    <script>
        $(document).ready(function() {
            $('#user-update-password').on('submit', function(event) {
                event.preventDefault();
                $.ajax({
                    method: 'POST',
                    url: '{{ route('admin.user-update-password') }}',
                    data: jQuery('#user-update-password').serialize(),
                    dataType: 'json',
                    success: function(response) {
                        if (response.success) {
                            $('#message-container').html('<div class="alert alert-success">' +
                                response.message + '</div>');
                            $('#display-name').text(response.message.split('updated to ')[1] ||
                                $('#name').val());
                        } else {
                            $('#message-container').html('<div class="alert alert-danger">' +
                                response.message + '</div>');
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error("AJAX Error:", error);
                        $('#message-container').html(
                            '<div class="alert alert-danger">An unexpected error occurred. Please try again.</div>'
                        );
                    },
                });
            });
        });
    </script>
@endsection
