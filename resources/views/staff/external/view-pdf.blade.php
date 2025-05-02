@extends('staff.base')
@section('title', $filename . ' - Management Information System')
@section('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
    <link href="{{ asset('css/plugins/dataTables/datatables.min.css') }}" rel="stylesheet">
    <link href="https://cdn.datatables.net/responsive/3.0.4/css/responsive.bootstrap4.css" rel="stylesheet">
@endsection
@section('content')

    <div class="wrapper wrapper-content animated fadeIn">
        @include('components.alert')
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox">
                    <div class="ibox-title">
                        <a onclick="window.close()" class="text-secondary pull-right">
                            <i class="fa fa-arrow-left"></i> Back
                        </a>

                        {{ $filename }}

                    </div>
                    <div class="ibox-content">
                     <div style="position: relative; width: 100%; height: 700px;">
    <iframe id="docxViewer"
        src="https://docs.google.com/gview?url={{ $fileUrl }}&embedded=true"
        style="width: 100%; height: 700px;" frameborder="0"></iframe>

    <!-- Overlay only top-right corner -->
    <div style="
        position: absolute;
        top: 0;
        right: 0;
        width: 80px;
        height: 40px;
        background: transparent;
        z-index: 999;
        pointer-events: auto;
    "></div>
</div>


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
