@extends('staff.base')
@section('title', 'Denied External Document - Management Information System')
@section('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
    <link href="{{ asset('css/plugins/dataTables/datatables.min.css') }}" rel="stylesheet">
    <link href="https://cdn.datatables.net/responsive/3.0.4/css/responsive.bootstrap4.css" rel="stylesheet">
@endsection
@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-sm-8">
            <h2>Denied External Document</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="/staff/dashboard">Staff</a>
                </li>
                <li class="breadcrumb-item">External</li>
                <li class="breadcrumb-item active">
                    <strong>Denied Document</strong>
                </li>
            </ol>
        </div>
    </div>
    <div class="wrapper wrapper-content animated fadeInDown">
        @include('components.alert')
        <div class="row">
            @include('staff.budget.components.table')

        </div>
    </div>
@endsection
