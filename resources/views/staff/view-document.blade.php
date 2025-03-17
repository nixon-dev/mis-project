@extends('staff.base')
@section('title', 'View Document - Management Information System')

@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endsection


@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-sm-8">
            <h2>Document Tracking</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="/staff/dashboard">Staff</a>
                </li>
                <li class="breadcrumb-item">
                    <strong>Document Tracking</strong>
                </li>
                <li class="breadcrumb-item active">
                    <strong>@truncate($data[0]->document_title)</strong>
                </li>
            </ol>
        </div>
        <div class="col-sm-4">
            <div class="title-action">
                <a data-toggle="modal" href="#modal-form" class="btn btn-primary">Add Action</a>
            </div>
            <div id="modal-form" class="modal fade" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="row">

                                <div class="col-sm-12">
                                    <h3 class="m-t-none m-b">Add Action</h3>

                                    <form role="form" action="{{ url('/staff/insert-document-action') }}" method="POST">
                                        @csrf()

                                        <div class="form-group d-none">
                                            <label>Document ID</label>
                                            <input value="{{ $data[0]->document_id }}" name="document_id"
                                                class="form-control" type="number" readonly>
                                        </div>

                                        <div class="form-group">
                                            <label>Name/Position</label>
                                            <input type="text" name="history_name" placeholder="" class="form-control"
                                                required minlength="5">
                                        </div>

                                        <div class="form-group">
                                            <label>Date and Time</label>
                                            <input type="datetime-local" name="history_date" class="form-control" required>
                                        </div>

                                        <div class="form-group">
                                            <label>Action Taken/Comments</label>
                                            <input type="text" name="history_action" class="form-control" required>
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

    <div class="row">
        <div class="col-lg-12">
            <div class="wrapper wrapper-content animated fadeInUp">

                @if (Session::has('success'))
                    <p class="alert alert-success">{{ Session::get('success') }}</p>
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
                <div class="ibox">
                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="m-b-md">
                                    <a href="{{ url('/staff/delete-document/' . $data[0]->document_id) }}"
                                        class="btn btn-white btn-xs pull-right d-none"
                                        onclick="return confirm('Delete document?')">Delete Document</a>
                                    <h2>{{ $data[0]->document_title }}</h2>
                                </div>
                                {{-- <dl class="dl-horizontal">
                                    <dt>Status:</dt>
                                    <dd><span class="label label-primary">Active</span></dd>
                                </dl> --}}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-5">
                                <dl class="dl-horizontal">

                                    <dt>Origin:</dt>
                                    <dd>{{ $data[0]->office_name }}</dd>
                                    <dt>Nature of Document:</dt>
                                    <dd>{{ $data[0]->document_nature }}</dd>
                                </dl>
                            </div>
                            <div class="col-lg-7" id="cluster_info">
                                <dl class="dl-horizontal">

                                    <dt>Document Number:</dt>
                                    <dd>{{ $data[0]->document_number }}</dd>
                                    <dt>Deadline:</dt>
                                    <dd>{{ $data[0]->document_deadline }}</dd>

                                </dl>
                            </div>
                        </div>
                        {{-- <div class="row">
                            <div class="col-lg-12">
                                <dl class="dl-horizontal">
                                    <dt>Completed:</dt>
                                    <dd>
                                        <div class="progress progress-striped active m-b-sm">
                                            <div style="width: 60%;" class="progress-bar"></div>
                                        </div>
                                        <small>Project completed in <strong>60%</strong>. Remaining close the project, sign
                                            a contract and invoice.</small>
                                    </dd>
                                </dl>
                            </div>
                        </div> --}}
                        <div class="row m-t-sm">
                            <div class="col-lg-12">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Date</th>
                                            <th>Action Taken</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($action as $a)
                                            <tr>

                                                <td>
                                                    {{ $a->history_name }}
                                                </td>
                                                <td>
                                                    {{ $a->history_date }}
                                                </td>
                                                <td>
                                                    {{ $a->history_action }}
                                                </td>

                                            </tr>

                                        @empty
                                            <tr class="text-center">
                                                <td colspan="3 ">No Action Taken</td>
                                            </tr>
                                        @endforelse


                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- <div class="col-lg-3">
            <div class="wrapper wrapper-content project-manager">
                <h4>Project description</h4>
                <img src="/Images/zender_logo.png" class="img-responsive">
                <p class="small">
                    There are many variations of passages of Lorem Ipsum available, but the majority have suffered
                    alteration in some form, by injected humour, or randomised words which don't look
                    even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there
                    isn't anything embarrassing
                </p>
                <p class="small font-bold">
                    <span><i class="fa fa-circle text-warning"></i> High priority</span>
                </p>
                <h5>Project tag</h5>
                <ul class="tag-list" style="padding: 0">
                    <li><a href=""><i class="fa fa-tag"></i> Zender</a></li>
                    <li><a href=""><i class="fa fa-tag"></i> Lorem ipsum</a></li>
                    <li><a href=""><i class="fa fa-tag"></i> Passages</a></li>
                    <li><a href=""><i class="fa fa-tag"></i> Variations</a></li>
                </ul>
                <h5>Project files</h5>
                <ul class="list-unstyled project-files">
                    <li><a href=""><i class="fa fa-file"></i> Project_document.docx</a></li>
                    <li><a href=""><i class="fa fa-file-picture-o"></i> Logo_zender_company.jpg</a></li>
                    <li><a href=""><i class="fa fa-stack-exchange"></i> Email_from_Alex.mln</a></li>
                    <li><a href=""><i class="fa fa-file"></i> Contract_20_11_2014.docx</a></li>
                </ul>
                <div class="text-center m-t-md">
                    <a href="#" class="btn btn-xs btn-primary">Add files</a>
                    <a href="#" class="btn btn-xs btn-primary">Report contact</a>

                </div>
            </div>
        </div> --}}
    </div>
@endsection
