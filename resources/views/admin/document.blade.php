@extends('admin.base')
@section('title', 'Document Tracking - Management Information System')
@section('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
    <link href="{{ asset('css/plugins/dataTables/datatables.min.css') }}" rel="stylesheet">

@endsection
@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-sm-8">
            <h2>Document Tracking</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.index') }}">Admin</a>
                </li>
                <li class="breadcrumb-item active">
                    <strong>Document Tracking</strong>
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
                    </div>
                    <div class="ibox-content">
                        <table id="documentTable" class="table table-bordered table-responsive table-hover">
                            <thead>
                                <tr>
                                    <th class="wp-30">Title</th>
                                    <th class="wp-20">Origin</th>
                                    <th class="wp-15">Nature</th>
                                    <th class="wp-15">No.</th>
                                    <th class="wp-20 text-center">Status</th>
                                    <th class="wp-20 text-center">View</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($data as $d)
                                    <tr>
                                        <td> @shorten($d->document_title, 50) </td>
                                        <td> {{ $d->office_name }} </td>
                                        <td> {{ $d->document_nature }} </td>
                                        <td> {{ $d->document_number }} </td>
                                        @php
                                            $statusClass = match ($d->document_status) {
                                                'Approved' => 'success',
                                                'Denied' => 'danger',
                                                'Pending' => 'primary',
                                                default => 'info',
                                            };
                                        @endphp
                                        <td class="text-center">
                                            <span class="label label-{{ $statusClass }}">{{ $d->document_status }}</span>
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ url('/admin/document-tracking/' . $d->document_number) }}"
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

    <script src="{{ asset('js/plugins/dataTables/datatables.min.js') }}"></script>
    <script>
        $.fn.dataTable.Buttons.defaults.dom.button.className = 'btn btn-white btn-sm';

        $(document).ready(function() {
            $('#documentTable').DataTable({
                language: {
                    zeroRecords: "No Document Found"
                },
                pageLength: 25,
                order: [],
                responsive: true,
                columnDefs: [{
                    'orderable': false,
                    'targets': [5]
                }],
                initComplete: function() {
                    const api = this.api();
                    if (api.data().count() > 0) {
                        api.columns([1])
                            .every(function() {
                                var column = this;

                                var select = $('<select style="width: 100%;"><option value=""></option></select>')
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
                }
            });
        });
    </script>
@endsection
