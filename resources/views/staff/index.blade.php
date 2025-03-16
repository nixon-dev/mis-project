@extends('staff.base')
@section('title', 'Dashboard - Management Information System')
@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-sm-8">
            <h2>Dashboard</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="/staff/dashboard">Staff</a>
                </li>
                <li class="breadcrumb-item active">
                    <strong>Dashboard</strong>
                </li>
            </ol>
        </div>
        {{-- <div class="col-sm-4">
            <div class="title-action">
                <a href="" class="btn btn-primary">This is action area</a>
            </div>
        </div> --}}
    </div>

    <div class="wrapper wrapper-content">
        <div class="row">
            <div class="col-lg-3">
                <div class="ibox ">
                    <div class="ibox-title">
                        <div class="ibox-tools">
                            <span class="label label-success float-right">Count</span>
                        </div>
                        <h5>Document</h5>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins">{{ $lastMonthDocumentCount }}</h1>
                        {{-- <div class="stat-percent font-bold text-success">98% <i class="fa fa-bolt"></i></div> --}}
                        <small>Last Month</small>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="ibox ">
                    <div class="ibox-title">
                        <div class="ibox-tools">
                            <span class="label label-success float-right">Count</span>
                        </div>
                        <h5>Document</h5>
                    </div>
                    <div class="ibox-content">
                        <h1 class="no-margins">{{ $thisMonthDocumentCount }}</h1>
                        {{-- <div class="stat-percent font-bold text-success">98% <i class="fa fa-bolt"></i></div> --}}
                        <small>This Month</small>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
