@extends('staff.base')
@section('title', 'Denied Documents - Management Information System')
@section('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
    <link href="{{ asset('css/plugins/dataTables/datatables.min.css') }}" rel="stylesheet">
    <link href="https://cdn.datatables.net/responsive/3.0.4/css/responsive.bootstrap4.css" rel="stylesheet">
@endsection
@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-sm-8">
            <h2>Denied Documents</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="/staff/dashboard">Staff</a>
                </li>
                <li class="breadcrumb-item">
                    Document Tracking
                </li>
                <li class="breadcrumb-item active">
                    <strong>Denied</strong>
                </li>
            </ol>
        </div>
       
    </div>

    <div class="wrapper wrapper-content animated fadeInDown">


        @if (Session::has('success'))
            <p class="alert alert-success">{{ Session::get('success') }}</p>
        @elseif (Session::has('error'))
            <p class="alert alert-danger">{{ Session::get('error') }}</p>
        @endif


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
                            <table id="documentTable" class="table table-bordered table-responsive table-hover">
                                <thead>
                                    <tr>
                                        <th class="wp-10 text-center">Status</th>
                                        <th class="wp-30">Title</th>
                                        <th class="wp-30">Origin</th>
                                        <th class="wp-10">Nature</th>
                                        <th class="wp-20">No.</th>
                                        <th class="wp-10 text-center">View</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($data as $d)
                                        <tr>
                                            <td class="wp-10 text-center">
                                                @if ($d->document_status == 'Approved')
                                                    <span class="label label-success">{{ $d->document_status }}</span>
                                                @elseif ($d->document_status == 'Denied')
                                                    <span class="label label-danger">{{ $d->document_status }}</span>
                                                @else
                                                    <span class="label label-primary">{{ $d->document_status }}</span>
                                                @endif
                                            </td>
                                            <td class="wp-30"> {{ $d->document_title }} </td>
                                            <td class="wp-30"> {{ $d->office_name }} </td>
                                            <td class="wp-10"> {{ $d->document_nature }} </td>
                                            <td class="wp-20"> {{ $d->document_number }} </td>
                                            <td class="wp-10 text-center">
                                                <a href="{{ route('staff.view-document', ['id' => $d->document_number]) }}"
                                                    class="btn btn-primary btn-sm">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center">No Denied Document Found</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th class="wp-10 text-center">Status</th>
                                        <th>Title</th>
                                        <th>Origin</th>
                                        <th>Nature</th>
                                        <th>No.</th>
                                        <th class="text-center">View</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>



    </div>
@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
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
                    'targets': [0, 5]
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
                        .columns([3])
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
@endsection
