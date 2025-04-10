@extends('admin.base')
@section('title', 'Office - Management Information System')
@section('css')
    <link href="{{ asset('css/plugins/dataTables/datatables.min.css') }}" rel="stylesheet">
@endsection
@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-sm-8">
            <h2>Office</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="/admin/dashboard">Admin</a>
                </li>
                <li class="breadcrumb-item active">
                    Settings
                </li>

                <li class="breadcrumb-item active">
                    <strong>Office</strong>
                </li>
            </ol>
        </div>
        <div class="col-sm-4">
            <div class="title-action">
                <a data-toggle="modal" href="#modal-form" class="btn btn-primary">Add Office</a>
            </div>
            <div id="modal-form" class="modal fade" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="row">

                                <div class="col-sm-12">
                                    <h3 class="m-t-none m-b">Add Office</h3>

                                    <form role="form" action="{{ url('/admin/office/add') }}" method="POST">
                                        @csrf()
                                        <div class="form-group">
                                            <label>Name</label>
                                            <input type="text" name="office_name" placeholder="" class="form-control"
                                                required>
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

        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>Office List</h5>
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
                        <table class="table table-bordered table-hover dataTables-example" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th>Office Name</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($office as $o)
                                    <tr>
                                        <td> {{ $o->office_name }} </td>
                                        <td class="text-center">
                                            <a href="#officeModal" data-toggle="modal" class="btn blue-1 btn-sm"
                                                data-id="{{ $o->office_id }}" data-name="{{ $o->office_name }}">
                                                <i class="fa fa-pencil text-white"></i>
                                            </a>
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ url('/admin/office/' . $o->office_id) }}"
                                                class="btn btn-danger btn-sm"
                                                onclick="return confirm('Delete {{ $o->office_name }}?')">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="2">No Office Found</td>
                                    </tr>
                                @endforelse
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Office Name</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('admin.settings.components.modal')
@endsection
@section('script')
    <script src="{{ asset('js/plugins/dataTables/datatables.min.js') }}"></script>


    <script>
        $.fn.dataTable.Buttons.defaults.dom.button.className = 'btn btn-white btn-sm';

        $(document).ready(function() {
            $('.dataTables-example').DataTable({
                pageLength: 10,
                order: [],
                responsive: true,
                autoWidth: false,
                columnDefs: [{
                    "width": "100%",
                    "targets": "_all"
                }]

            });

        });

        $(document).ready(function() {
            $('#officeModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                var code = button.data('id');
                var name = button.data('name');

                var modal = $(this);
                modal.find('#office_id').val(code);
                modal.find('#office_name').val(name);
            });
        });
    </script>
    </script>

@endsection
