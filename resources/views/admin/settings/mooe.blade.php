@extends('admin.base')
@section('title', 'MOOE - Management Information System')
@section('css')
    <link href="{{ asset('css/plugins/dataTables/datatables.min.css') }}" rel="stylesheet">
@endsection
@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-sm-8">
            <h2>Maintenance & Other Operating Expenses</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.index') }}">Admin</a>
                </li>
                <li class="breadcrumb-item active">
                    Settings
                </li>

                <li class="breadcrumb-item active">
                    <strong>MOOE</strong>
                </li>
            </ol>
        </div>
        <div class="col-sm-4">
            <div class="title-action">
                <a data-toggle="modal" href="#modal-form" class="btn btn-primary">Add MOOE</a>
            </div>
            <div id="modal-form" class="modal fade" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="row">

                                <div class="col-sm-12">
                                    <h3 class="m-t-none m-b">Add MOOE</h3>

                                    <form role="form" action="{{ route('admin.mooe-add') }}" method="POST">
                                        @csrf()
                                        <div class="form-group">
                                            <label>Code</label>
                                            <input type="text" name="code" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Name</label>
                                            <input type="text" name="name" class="form-control" required>
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

        @include('components.message')


        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>MOOE List</h5>
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
                                    <th class="wp-80">Type</th>
                                    <th class="wp-10">Code</th>
                                    <th class="wp-5">Edit</th>
                                    <th class="wp-5">Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($mooes as $c)
                                    <tr>
                                        <td> {{ $c->name }} </td>
                                        <td>{{ $c->code }}</td>
                                        <td class="text-center">
                                            <a href="#mooeModal" data-toggle="modal" class="btn blue-1 btn-sm"
                                                data-code="{{ $c->code }}" data-name="{{ $c->name }}">
                                                <i class="fa fa-pencil text-white"></i>
                                            </a>
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('admin.mooe-delete', ['code' => $c->code]) }}"
                                                class="btn btn-danger btn-sm"
                                                onclick="return confirm('Delete {{ $c->name }}?')">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4">No MOOE Found</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('admin.settings.components.modal');
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
    </script>
    <script>
        $(document).ready(function() {
            $('#mooeModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                var code = button.data('code');
                var name = button.data('name');

                var modal = $(this);
                modal.find('#modalCode').val(code);
                modal.find('#modalName').val(name);
            });
        });
    </script>


@endsection
