@extends('staff.base')
@section('title', 'Budget Management - Management Information System')
@section('css')
    <link href="{{ asset('css/plugins/dataTables/datatables.min.css') }}" rel="stylesheet">
    <link href="https://cdn.datatables.net/responsive/3.0.4/css/responsive.bootstrap4.css" rel="stylesheet">
@endsection
@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-sm-8">
            <h2>Budget Management</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('staff.index') }}">Staff</a>
                </li>
                <li class="breadcrumb-item">Budget</li>
                <li class="breadcrumb-item active">
                    <strong>Management</strong>
                </li>
            </ol>
        </div>
    </div>
    <div class="wrapper wrapper-content animated fadeInDown">
        @include('components.message')
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>Budget Data</h5>

                    </div>
                    <div class="ibox-content">
                        <table id="budgetTables" class="display table table-bordered  table-hover">
                            <thead>
                                <tr>
                                    <th class="wp-70">Office</th>
                                    <th class="wp-25">Budget</th>
                                    <th class="wp-10">Manage</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($data as $d)
                                    <tr>
                                        <td>{{ $d->office_name }}</td>
                                        <td>
                                            <span class="pull-left">₱</span> <span
                                                class="pull-right">{{ number_format($d->office_budget, 2) }}</span>
                                        </td>
                                        <td class="wp-10 text-center">
                                            <a href="{{ route('management.view', ['id' => $d->office_id]) }}"
                                                class="btn btn-primary btn-sm">
                                                <i class="fa fa-eye text-white"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                @endforelse
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Office</th>
                                    <th>Budget</th>
                                    <th>Manage</th>
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
            $('#budgetTables').DataTable({

                language: {
                    zeroRecords: "No Office Found"
                },
                pageLength: 10,
                order: [],
                responsive: true,

            });
        });
    </script>
@endsection
