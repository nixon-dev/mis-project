@extends('staff.base')
@section('title', 'Document Tracking - Management Information System')
@section('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
    <link href="{{ asset('css/plugins/dataTables/datatables.min.css') }}" rel="stylesheet">
    <link href="https://cdn.datatables.net/responsive/3.0.4/css/responsive.bootstrap4.css" rel="stylesheet">
@endsection
@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-sm-8">
            <h2>Pending Document</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="/staff/dashboard">Staff</a>
                </li>
                <li class="breadcrumb-item active">
                    <strong>Pending Document</strong>
                </li>
            </ol>
        </div>
        <div class="col-sm-4">
            <div class="title-action">
                {{-- <a data-toggle="modal" href="#modal-form" class="btn btn-primary">Document Action</a> --}}
            </div>

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
                        <h5>Pending Document</h5>
                        {{-- <a href="{{ url('/add-student-form') }}">Add New Record</a> --}}

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
                                            <td class="wp-10"> {{ $d->document_number }} </td>
                                            <td class="wp-10 text-center">
                                                <a href="{{ route('budget.view', ['id' => $d->document_number]) }}"
                                                    class="btn btn-primary btn-sm">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                        fill="#fff" class="bi bi-eye" viewBox="0 0 16 16">
                                                        <path
                                                            d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z" />
                                                        <path
                                                            d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0" />
                                                    </svg>
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td class="text-center" colspan="6">No Pending Document Found</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                                <tfoot>
                                    <tr>

                                        <th class="text-center">Status</th>
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
@endsection
