@extends('staff.base')
@section('title', 'Budget Management - Management Information System')
@section('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
    <link href="{{ asset('css/plugins/dataTables/datatables.min.css') }}" rel="stylesheet">
    <link href="https://cdn.datatables.net/responsive/3.0.4/css/responsive.bootstrap4.css" rel="stylesheet">
@endsection
@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-sm-8">
            <h2>Budget Management</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="/staff/dashboard">Staff</a>
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
                        <h5>Document Data</h5>
            
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
                        <div class="">
                            <table id="documentTable" class="table table-bordered table-responsive table-hover" style="width: 100%">
                                <thead>
                                    <tr>
                                        <th style="width: 100%">Office</th>
                                        <th>Budget</th>
                                    </tr>
                                </thead>
                                <tbody>
                                   
                                        <tr>
                                            <td class="text-center" colspan="2">Temp</td>
                                        </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Office</th>
                                        <th>Budget</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <script src="{{ asset('js/plugins/dataTables/datatables.min.js') }}"></script>
            <script src="https://cdn.datatables.net/responsive/3.0.4/js/responsive.bootstrap4.js"></script>
            <script>
                $(document).ready(function() {
                    $('#mySelect').select2({
                        placeholder: "Select an option...",
                        allowClear: true
                    });
                });
            </script>
            <script>
                $.fn.dataTable.Buttons.defaults.dom.button.className = 'btn btn-white btn-sm';
                $(document).ready(function() {
                    $('#documentTable').DataTable({
                        pageLength: 10,
                        order: [],
                        responsive: true,
                        // dom: '<"html5buttons"B>lTfgitp',
                        columnDefs: [{
                            'orderable': false,
                            'targets': [4, 5]
                        }],
                        buttons: [{
                                extend: 'copy'
                            },
                            {
                                extend: 'csv'
                            },
                            {
                                extend: 'excel',
                                title: 'ExampleFile'
                            },
                            {
                                extend: 'pdf',
                                title: 'ExampleFile'
                            },
            
                            {
                                extend: 'print',
                                customize: function(win) {
                                    $(win.document.body).addClass('white-bg');
                                    $(win.document.body).css('font-size', '10px');
            
                                    $(win.document.body).find('table')
                                        .addClass('compact')
                                        .css('font-size', 'inherit');
                                }
                            }
                        ],
                        initComplete: function() {
                            this.api()
                                .columns([2, 3])
                                .every(function() {
                                    var column = this;
            
                                    var select = $('<select><option value=""></option></select>')
                                        .appendTo($(column.footer()).empty())
                                        .on('change', function() {
                                            column
                                                .search($(this).val(), {
                                                    exact: true
                                                })
                                                .draw();
                                        });
                                    column
                                        .data()
                                        .unique()
                                        .sort()
                                        .each(function(d, j) {
                                            select.append(
                                                '<option value="' + d + '">' + d + '</option>'
                                            );
                                        });
                                });
                        }
                    });
                });
            </script>
            
        </div>
    </div>
@endsection
