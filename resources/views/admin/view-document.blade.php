@extends('admin.base')
@section('title', 'View Document - Management Information System')

@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="{{ asset('css/plugins/iCheck/custom.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/plugins/jQueryUI/jquery-ui.css') }}" type="text/css" />

@endsection


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
                <a data-toggle="modal" href="#modal-form" class="btn btn-primary">Add Action</a>
            </div>
            <div id="modal-form" class="modal fade" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="row">

                                <div class="col-sm-12">
                                    <h3 class="m-t-none m-b">Add Action</h3>

                                    <form role="form" action="{{ url('/admin/insert-document-action') }}" method="POST">
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
            <div class="wrapper wrapper-content animated fadeInDown">

                @if (Session::has('success'))
                    <p class="alert alert-success">{{ Session::get('success') }}</p>
                @elseif (Session::has('error'))
                    <p class="alert alert-danger">{{ Session::get('error') }}</p>
                @endif

                <div class="ibox">
                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="m-b-md">
                                    <a href="{{ url('/admin/delete-document/' . $data[0]->document_id) }}"
                                        class="btn btn-white btn-xs pull-right"
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
                            <div class="col-sm-12 row">
                                <div class="checkbox i-checks pl-3">
                                    <label><input type="checkbox" onchange="updateStatus('pr', this.checked)"
                                            {{ $data[0]->pr == 'true' ? 'checked' : '' }}> PR</label>
                                </div>
                                <div class="checkbox i-checks pl-3">
                                    <label><input type="checkbox" onchange="updateStatus('canvass', this.checked)"
                                            {{ $data[0]->canvass == 'true' ? 'checked' : '' }}> Canvass</label>
                                </div>
                                <div class="checkbox i-checks pl-3">
                                    <label><input type="checkbox" onchange="updateStatus('abstract', this.checked)"
                                            {{ $data[0]->abstract == 'true' ? 'checked' : '' }}> Abstract</label>
                                </div>
                                <div class="checkbox i-checks pl-3">
                                    <label><input type="checkbox" onchange="updateStatus('obr', this.checked)"
                                            {{ $data[0]->obr == 'true' ? 'checked' : '' }}> OBR</label>
                                </div>
                                <div class="checkbox i-checks pl-3">
                                    <label><input type="checkbox" onchange="updateStatus('po', this.checked)"
                                            {{ $data[0]->po == 'true' ? 'checked' : '' }}> PO</label>
                                </div>
                                <div class="checkbox i-checks pl-3">
                                    <label><input type="checkbox" onchange="updateStatus('par', this.checked)"
                                            {{ $data[0]->par == 'true' ? 'checked' : '' }}> PAR</label>
                                </div>
                                <div class="checkbox i-checks pl-3">
                                    <label><input type="checkbox" onchange="updateStatus('air', this.checked)"
                                            {{ $data[0]->air == 'true' ? 'checked' : '' }}> AIR</label>
                                </div>
                                <div class="checkbox i-checks pl-3">
                                    <input type="checkbox" onchange="updateStatus('dv', this.checked)"
                                        {{ $data[0]->dv == 'true' ? 'checked' : '' }}> DV
                                </div>
                            </div>
                        </div>

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

    <script>
        $(document).ready(function() {
            $('.i-checks').on('ifChanged', function(event) {
                let checkbox = $(this).find('input[type="checkbox"]');
                let itemId = checkbox.attr('onchange').match(/'([^']+)'/)[1]; // Extract 'air' or 'dv'
                let isChecked = checkbox.prop('checked');

                updateStatus(itemId, isChecked);
            });
        });

        function updateStatus(itemId, isChecked) {
            var document_id = {{ $data[0]->document_id }};
            var token = "{{ csrf_token() }}";

            $.ajax({
                method: 'POST',
                url: '/admin/document/update-status',
                data: {
                    'document_id': document_id,
                    'item_column': itemId,
                    'item_status': isChecked ? true : false,
                    _token: token, 
                },
                success: function(response) {
                    console.log("Success:", response);
                },
                error: function(xhr) {
                    console.error("Error:", xhr.responseText);
                }
            });
        }
    </script>
@endsection
