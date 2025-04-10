@extends('admin.base')
@section('title', 'Users - Management Information System')
@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-sm-8">
            <h2>Users</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.index') }}">Admin</a>
                </li>
                <li class="breadcrumb-item active">
                    <strong>Users</strong>
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
                        <li class="nav-item" ><a class="nav-link active" data-toggle="tab" href="#users-pending"
                                aria-expanded="true">Users</a></li>
                        <li class="nav-item" ><a class="nav-link" data-toggle="tab" href="#users-list"
                                aria-expanded="false">Pending Users</a></li>
                    </ul>
                    <div class="tab-content">
                        <div id="users-pending" class="tab-pane fade show active">
                            <div class="panel-body">
                                @include('admin.settings.components.users-list')
                            </div>
                        </div>
                        <div id="users-list" class="tab-pane fade">
                            <div class="panel-body">
                                @include('admin.settings.components.users-pending')
                            </div>
                        </div>
                    </div>

         
                    
                </div>
            </div>
        </div>
    </div>
@endsection
