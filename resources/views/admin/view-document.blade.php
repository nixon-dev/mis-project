@extends('admin.base')
@section('title', 'View Document - Management Information System')


@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-sm-8">
            <h2>Document Tracking</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="/admin/dashboard">Admin</a>
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
                <a href="" class="btn btn-primary">Add Action</a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="wrapper wrapper-content animated fadeInUp">
                <div class="ibox">
                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="m-b-md">
                                    {{-- <a href="#" class="btn btn-white btn-xs pull-right">Edit project</a> --}}
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
                                    <dd>{{ $data[0]->document_origin }}</dd>
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
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Date</th>
                                            <th>Action Taken</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>

                                            <td>
                                                Create project in webapp
                                            </td>
                                            <td>
                                                03/14/2025 - 11:46 AM
                                            </td>
                                            <td>
                                                <p class="small">
                                                    Lorem Ipsum is that it has a more-or-less normal
                                                    distribution of letters, as opposed to using 'Content
                                                    here, content here', making it look like readable.
                                                </p>
                                            </td>

                                        </tr>


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
