@extends('admin.base')
@section('title', $info[0]->name . ' - Management Information System')
@section('css')
    <link href="{{ asset('css/plugins/iCheck/custom.css') }}" rel="stylesheet">
    <link href="{{ asset('css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-sm-8">
            <h2>{{ $info[0]->name }}</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="/admin/dashboard">Admin</a>
                </li>
                <li class="breadcrumb-item active">
                    <a href="/admin/users">Users</a>
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

    <div class="wrapper wrapper-content">
        <div class="row">

            @if (Session::has('success'))
                <div class="col-sm-12">
                    <p class="alert alert-success">{{ Session::get('success') }}</p>
                </div>
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

            <div class="col-lg-6">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>Personal Details</h5>

                    </div>
                    <div class="ibox-content">
                        <h3 class="font-bold text-dark">Name: {{ $info[0]->name }}</h3>
                        <h4 class="text-dark">Email: {{ $info[0]->email }}</h4>
                        <h4 class="text-dark">Created:
                            {{ \Carbon\Carbon::parse($info[0]->created_at)->format('M d, Y - h:i A') }}</h4>
                        <h4 class="text-dark">Role: {{ $info[0]->role }}</h4>

                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>Roles</h5>
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
                                <select name="role" class="form-control">
                                    <option value="Guest" {{ $info[0]->role == 'Guest' ? 'selected' : '' }}>Guest</option>
                                    <option value="Staff" {{ $info[0]->role == 'Staff' ? 'selected' : '' }}>Staff</option>
                                    <option value="Administrator"
                                        {{ $info[0]->role == 'Administrator' ? 'selected' : '' }}>Administrator</option>
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
    <script src="{{ asset('js/plugins/iCheck/icheck.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('.i-checks').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green',
            });
        });
    </script>
@endsection
