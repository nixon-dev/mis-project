@extends('admin.base')
@section('title', 'User Setting - Management Information System')
@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-sm-8">
            <h2>Personal Setting</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="/admin/dashboard">Admin</a>
                </li>
                <li class="breadcrumb-item active">
                    Settings
                </li>
                <li class="breadcrumb-item active">
                    <strong>Personal</strong>
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

            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>Personal Information</h5>
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
                        <form action="{{ url('/admin/user/update') }}" method="POST">

                            @csrf()
                            <div class="form-group d-none">
                                <label>ID</label>
                                <input type="number" name="id" value="{{ Auth::user()->id ?? '' }}"
                                    class="form-control" readonly>
                            </div>
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" name="name" value="{{ Auth::user()->name ?? '' }}"
                                    class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="text" name="email" value="{{ Auth::user()->email ?? '' }}"
                                    class="form-control" readonly>
                            </div>
                            <div class="form-group">
                                <label>Role</label>
                                <input type="text" name="role" value="{{ Auth::user()->role ?? 'Guest' }}"
                                    class="form-control" readonly>
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
