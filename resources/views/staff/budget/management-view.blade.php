@extends('staff.base')
@section('title', 'Budget Management - Management Information System')
@section('css')
    <link href="{{ asset('css/plugins/dataTables/datatables.min.css') }}" rel="stylesheet">
    <link href="https://cdn.datatables.net/responsive/3.0.4/css/responsive.bootstrap4.css" rel="stylesheet">
@endsection
@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-sm-8">
            <h2>{{ $data->office_name }}</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('staff.index') }}">Staff</a>
                </li>
                <li class="breadcrumb-item">Budget</li>
                <li class="breadcrumb-item">
                    <a href="{{ route('management.list') }}">Management</a>
                </li>
                <li class="breadcrumb-item active">
                    <strong> {{ $data->office_code }}</strong>
                </li>
            </ol>
        </div>
    </div>
    <div class="wrapper wrapper-content animated fadeInDown">
        @include('components.message')
        <div class="row">
            <div class="col-lg-4">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>Budget Data</h5>

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

                        <h1>Test</h1>
                    </div>
                </div>
            </div>

            <div class="col-lg-8">
                <div class="ibox ">
                    <div class="ibox-title">
                        <a href="#" class="btn btn-xs btn-white pull-right">Add Budget</a>
                        <h5>Budget Allocation History</h5>
                    </div>
                    <div class="ibox-content">
                        <table id="budgetHistoryTable" class="display table table-bordered table-hover  wp-100">
                            <thead>
                                <tr>
                                    <th class="wp-10">Date</th>
                                    <th class="wp-70">Allocated By</th>
                                    <th class="wp-25">Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($history as $h)
                                    <tr>
                                        <td>{{ $h->ob_allocation_date }}</td>
                                        <td>{{ $h->name }}</td>
                                        <td>
                                            <span class="pull-left">₱</span> <span
                                                class="pull-right">{{ number_format($h->ob_allocated_amount, 2) }}</span>
                                        </td>
                                    </tr>
                                @empty
                                @endforelse
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th class="wp-10">Date</th>
                                    <th class="wp-70">Allocated By</th>
                                    <th class="wp-25">Amount</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/plugins/dataTables/datatables.min.js') }}"></script>
    <script>
        $.fn.dataTable.Buttons.defaults.dom.button.className = 'btn btn-white btn-sm';
        $(document).ready(function() {
            $('#budgetHistoryTable').DataTable({
                language: {
                    zeroRecords: "No Allocation History Found"
                },
                pageLength: 10,
                order: [],
                responsive: true,

            });
        });
    </script>
@endsection
