@extends('admin.base')
@section('title', 'Users - Management Information System')
@section('css')
    <link href="{{ asset('css/plugins/dataTables/datatables.min.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />

@endsection
@php
    use Carbon\Carbon;
@endphp
@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-sm-8">
            <h2>Active Users List</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.index') }}">Admin</a>
                </li>
                <li class="breadcrumb-item active">
                    Settings
                </li>
                <li class="breadcrumb-item active">
                    <strong>Active Users</strong>
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
                        <table class="table table-bordered table-hover active-users" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th scope="col">Name</th>
                                    <th>IP Adress</th>
                                    <th>User Agent</th>
                                    <th>Last Activity</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($activeUsers as $au)
                                    <tr>
                                        <td>
                                            {{ $au->name ? $au->name : 'Guest' }}
                                        </td>
                                        <td>
                                            {{ $au->ip_address }}
                                        </td>
                                        <td>
                                            {{ $au->user_agent }}
                                        </td>
                                        <td>

                                            {{ Carbon::parse($au->last_activity)->diffForHumans() }}
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
                                    <th scope="col">Name</th>
                                    <th>IP Adress</th>
                                    <th>User Agent</th>
                                    <th>Last Activity</th>
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
            $('.active-users').DataTable({
                pageLength: 10,
                order: [],
                responsive: true,
                initComplete: function() {
                    this.api()
                        .columns([])
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
