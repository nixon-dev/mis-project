@extends('admin.base')
@section('title', $info[0]->name . ' - Management Information System')
@section('css')
    <link href="{{ asset('css/plugins/iCheck/custom.css') }}" rel="stylesheet">
    <link href="{{ asset('css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
@endsection

@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-sm-8">
            <h2>{{ $info[0]->name }}</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.index') }}">Admin</a>
                </li>
                <li class="breadcrumb-item active">
                    <a href="{{ route('admin.users-list') }}">Users</a>
                </li>
                <li class="breadcrumb-item active">
                    <strong>{{ $info[0]->id }}</strong>
                </li>
            </ol>
        </div>
        {{-- <div class="col-sm-4">
            <div class="title-action">
                <a href="" class="btn btn-primary">This is action area</a>
            </div>
        </div> --}}
    </div>

    <div class="wrapper wrapper-content animated fadeInDown">
        <div class="row">

            <div class="col-sm-12">
                @if (Session::has('success'))
                    <p class="alert alert-success">{{ Session::get('success') }}</p>
                @elseif (Session::has('error'))
                    <p class="alert alert-danger">{{ Session::get('error') }}</p>
                @endif
            </div>

            <div class="col-lg-6">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>Personal Details</h5>
                        <a href="{{ url('/admin/users/delete/' . $info[0]->id) }}" class="btn btn-danger btn-xs pull-right"
                            onclick="return confirm('Delete User?')">Delete
                            User</a>
                    </div>
                    <div class="ibox-content">
                        <h3 class="font-bold text-dark">Name: {{ $info[0]->name }}</h3>
                        <h4 class="text-dark">Email: {{ $info[0]->email }}</h4>
                        <h4 class="text-dark">Created:
                            {{ \Carbon\Carbon::parse($info[0]->created_at)->format('M d, Y - h:i A') }}</h4>
                        <h4 class="text-dark">Role: {{ $info[0]->role }}</h4>
                        @if ($info[0]->role == 'Administrator')
                        @elseif ($info[0]->office_id == null)
                            <h4 class="text-dark">Office: No Assigned Office</h4>
                        @else
                            <h4 class="text-dark">Office: {{ $info[0]->office_name }}</h4>
                        @endif

                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>Assign Roles and Office</h5>
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
                        <form action="{{ url('/admin/users/update') }}" method="POST">

                            @csrf()
                            <div class="form-group d-none">
                                <label>ID</label>
                                <input type="number" name="id" value="{{ $info[0]->id }}" class="form-control"
                                    readonly>
                            </div>
                            <div class="form-group">
                                <label>Role</label>
                                <select name="role" class="form-control">
                                    <option value="Guest" {{ $info[0]->role == 'Guest' ? 'selected' : '' }}>Guest</option>
                                    <option value="Staff" {{ $info[0]->role == 'Staff' ? 'selected' : '' }}>Staff</option>
                                    <option value="Administrator"
                                        {{ $info[0]->role == 'Administrator' ? 'selected' : '' }}>Administrator</option>
                                </select>
                            </div>

                            <div class="form-group {{ $info[0]->role == 'Administrator' ? 'd-none' : '' }}">
                                <label>Office</label>
                                <select id="mySelect" class="form-control p-w-sm select2" style="width: 100%;"
                                    name="office_id">
                                    <option value=""></option>
                                    @foreach ($office as $o)
                                        <option value="{{ $o->office_id }}"
                                            {{ $info[0]->office_id == $o->office_id ? 'selected' : '' }}>
                                            {{ $o->office_name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group text-center">
                                <button class="btn btn-sm btn-primary m-t-n-xs w-100" type="submit"><strong>Submit</strong>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
    <script src="{{ asset('js/plugins/iCheck/icheck.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('.i-checks').iCheck({
                checkboxClass: 'icheckbox_square-green',
            });
        });
        $(document).ready(function() {
            $('#mySelect').select2({
                placeholder: "Select an option...",
                allowClear: true
            });
        });
    </script>
@endsection
