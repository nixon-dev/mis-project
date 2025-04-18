@extends('admin.base')
@section('title', 'Users - Management Information System')
@section('css')
    <link href="{{ asset('css/plugins/dataTables/datatables.min.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />

@endsection
@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-sm-8">
            <h2>Users List</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="/admin/dashboard">Admin</a>
                </li>
                <li class="breadcrumb-item active">
                    Settings
                </li>
                <li class="breadcrumb-item active">
                    <strong>Users</strong>
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
                        <h5>Users</h5>


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
                        <table class="table table-bordered table-striped table-hover" id="users-table">
                            <thead>
                                <tr>
                                    <th scope="col">Name</th>
                                    <th scope="col">Office</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Manage</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($users as $u)
                                    <tr>
                                        <td> {{ $u->name }} </td>
                                        @if ($u->role == 'Administrator')
                                            <td>Every Office</td>
                                        @elseif ($u->office_id == null)
                                            <td>No Assigned Office</td>
                                        @else
                                            <td>{{ $u->office_name }}</td>
                                        @endif
                                        <td> {{ $u->email }} </td>
                                        <td> {{ $u->role }} </td>
                                        <td class="text-center">
                                            <a href="{{ route('admin.users-view', ['id' => $u->id]) }}"
                                                class="btn btn-primary btn-sm">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">No User Found</td>
                                    </tr>
                                @endforelse
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Name</th>
                                    <th>Office</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Manage</th>
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
            $('#users-table').DataTable({
                pageLength: 10,
                order: [],
                responsive: true,
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
