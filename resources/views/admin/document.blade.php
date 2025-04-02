@extends('admin.base')
@section('title', 'Document Tracking - Management Information System')
@section('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
    <link href="{{ asset('css/plugins/dataTables/datatables.min.css') }}" rel="stylesheet">
    <link href="https://cdn.datatables.net/responsive/3.0.4/css/responsive.bootstrap4.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">

@endsection
@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-sm-8">
            <h2>Document Tracking</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="/admin/dashboard">Admin</a>
                </li>
                <li class="breadcrumb-item active">
                    <strong>Document Tracking</strong>
                </li>
            </ol>
        </div>
        <div class="col-sm-4">
            <div class="title-action">
                {{-- <a data-toggle="modal" href="#modal-form" class="btn btn-primary">Add Document</a> --}}
            </div>
            <div id="modal-form" class="modal fade" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="row">

                                <div class="col-sm-12">
                                    <h3 class="m-t-none m-b">Add Document</h3>

                                    <form role="form" action="{{ url('/admin/insert-document') }}" method="POST">
                                        @csrf()
                                        <div class="form-group">
                                            <label>Title</label>
                                            <input type="text" name="document_title" placeholder="" class="form-control"
                                                required minlength="5">
                                        </div>
                                        <div class="form-group row ">
                                            <div class="col-sm-12">
                                                <label class="">Origin Office</label>
                                            </div>
                                            <div class="col-sm-12">
                                                <select id="mySelect" class="form-control p-w-sm select2"
                                                    style="width: 100%;" name="document_origin" required>
                                                    <option value=""></option>
                                                    @foreach ($office as $o)
                                                        <option value="{{ $o->office_id }}">{{ $o->office_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Nature of Document</label>
                                            <input type="text" name="document_nature" placeholder=""
                                                class="form-control">
                                        </div>

                                        <div class="form-group">
                                            <label>Deadline</label>
                                            <input type="datetime-local" name="document_deadline" class="form-control"
                                                onfocus="this.showPicker()">
                                        </div>

                                        <div class="form-group text-center">
                                            <button class="btn btn-sm btn-primary m-t-n-xs w-100"
                                                type="submit"><strong>Submit</strong>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
                        <table id="documentTable" class="table table-bordered table-responsive table-hover"
                            style="width: 100%">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Origin</th>
                                    <th>Nature</th>
                                    <th>No.</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">View</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($data as $d)
                                    <tr>
                                        <td class="wp-30"> {{ $d->document_title }} </td>
                                        <td class="wp-20"> {{ $d->office_name }} </td>
                                        <td class="wp-10"> {{ $d->document_nature }} </td>
                                        <td class="wp-10"> {{ $d->document_number }} </td>
                                        @php
                                            $statusClass = match ($d->document_status) {
                                                'Approved' => 'success',
                                                'Denied' => 'danger',
                                                'Pending' => 'primary',
                                                default => 'info',
                                            };
                                        @endphp
                                        <td class="wp-10 text-center">
                                            <span class="label label-{{ $statusClass }}">{{ $d->document_status }}</span>
                                        </td>
                                        <td class="wp-10 text-center">
                                            <a href="{{ url('/admin/document-tracking/' . $d->document_number) }}"
                                                class="btn btn-success btn-sm">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="#000" class="bi bi-eye" viewBox="0 0 16 16">
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
                                        <td colspan="6">No Document Found</td>
                                    </tr>
                                @endforelse
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Title</th>
                                    <th>Origin</th>
                                    <th>Nature</th>
                                    <th>No.</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">View</th>
                                </tr>
                            </tfoot>
                        </table>




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
                placeholder: "Select Office",
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
                columnDefs: [{
                    'orderable': false,
                    'targets': [4, 5]
                }],
                // dom: '<"html5buttons"B>lTfgitp',
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
                        .columns([1, 2])
                        .every(function() {
                            var column = this;
                            var select = $('<select><option value=""></option></select>')
                                .appendTo($(column.footer()).empty())
                                .on('change', function() {
                                    column
                                        .search($(this).val())
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
