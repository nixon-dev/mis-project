@extends('staff.base')
@section('title', 'Pending External Document - Management Information System')
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
                        <iframe src="https://docs.google.com/gview?url={{ $fileUrl }}&embedded=true"
                             style="width:100%; height:700px;" frameborder="0">
                         </iframe
                             <script>$(document).ready(function() {
  // Wait for the iframe to load (though even then, access might be blocked)
  $('iframe').on('load', function() {
    // Attempt to find the element within the iframe and add the class
    $(this).contents().find('.ndfHFb-c4YZDc-Wrql6b').addClass('d-none');
  });
});</script>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
