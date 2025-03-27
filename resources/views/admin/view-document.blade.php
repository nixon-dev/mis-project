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
            <h2>View Document</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="/admin/dashboard">Admin</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="/admin/document-tracking">Document Tracking</a>
                </li>
                <li class="breadcrumb-item active">
                    <strong>{{ $data->document_number }}</strong>
                </li>
            </ol>
        </div>
        <div class="col-sm-4">
            <div class="title-action">
                {{-- <a data-toggle="modal" href="#action-form" class="btn btn-primary">Add Items</a> --}}
            </div>
            

        </div>
    </div>

    <div class="col-sm-12 mb-3 m-t-10">
        @if (Session::has('success'))
        <p class="alert alert-success">{{ Session::get('success') }}</p>
    @elseif (Session::has('error'))
        <p class="alert alert-danger">{{ Session::get('error') }}</p>
    @endif
    </div>
    

    <div class="row">
        <div class="col-lg-9">
            <div class="wrapper wrapper-content animated fadeInDown">
                <div class="ibox">
                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="m-b-md">
                                    <a data-toggle="modal" href="#items-form" class="btn btn-primary btn-xs pull-right m-l-10">Add Items</a>
                                    
                                    <a data-toggle="modal" href="#amount-form"
                                        class="btn btn-primary btn-xs pull-right m-l-10">Edit Document</a>
                                    
                                    <a href="{{ url('/admin/delete-document/' . $data->document_id) }}"
                                        class="btn btn-danger btn-xs pull-right"
                                        onclick="return confirm('Delete document?')">Delete Document</a>
                                    <h2 class="font-bold">{{ $data->document_title }}</h2>
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

                                    <dt class="fs-18">Origin:</dt>
                                    <dd class="fs-16">{{ $data->office_name }}</dd>
                                    <dt class="fs-18">Nature of Document:</dt>
                                    <dd class="fs-16">{{ $data->document_nature }}</dd>
                                    <dt class="fs-18">Amount:</dt>
                                    <dd class="fs-16">₱ {{ number_format($data->amount, 2) }}</dd>
                                </dl>
                            </div>
                            <div class="col-lg-7" id="cluster_info">
                                <dl class="dl-horizontal">

                                    <dt class="fs-18">Document Number:</dt>
                                    <dd class="fs-16">{{ $data->document_number }}</dd>
                                    <dt class="fs-18">Deadline:</dt>
                                    <dd class="fs-16">{{ $data->document_deadline }}</dd>

                                </dl>
                            </div>
                            <div class="col-sm-12 row">
                                <div class="checkbox i-checks pl-3">
                                    <label class="fs-16"><input type="checkbox" onchange="updateStatus('pr', this.checked)"
                                            {{ $data->pr == 'true' ? 'checked' : '' }}> PR</label>
                                </div>
                                <div class="checkbox i-checks pl-3">
                                    <label class="fs-16"><input type="checkbox" onchange="updateStatus('canvass', this.checked)"
                                            {{ $data->canvass == 'true' ? 'checked' : '' }}> Canvass</label>
                                </div>
                                <div class="checkbox i-checks pl-3">
                                    <label class="fs-16"><input type="checkbox" onchange="updateStatus('abstract', this.checked)"
                                            {{ $data->abstract == 'true' ? 'checked' : '' }}> Abstract</label>
                                </div>
                                <div class="checkbox i-checks pl-3">
                                    <label class="fs-16"><input type="checkbox" onchange="updateStatus('obr', this.checked)"
                                            {{ $data->obr == 'true' ? 'checked' : '' }}> OBR</label>
                                </div>
                                <div class="checkbox i-checks pl-3">
                                    <label class="fs-16"><input type="checkbox" onchange="updateStatus('po', this.checked)"
                                            {{ $data->po == 'true' ? 'checked' : '' }}> PO</label>
                                </div>
                                <div class="checkbox i-checks pl-3">
                                    <label class="fs-16"><input type="checkbox" onchange="updateStatus('par', this.checked)"
                                            {{ $data->par == 'true' ? 'checked' : '' }}> PAR</label>
                                </div>
                                <div class="checkbox i-checks pl-3">
                                    <label class="fs-16"><input type="checkbox" onchange="updateStatus('air', this.checked)"
                                            {{ $data->air == 'true' ? 'checked' : '' }}> AIR</label>
                                </div>
                                <div class="checkbox i-checks pl-3">
                                    <label class="fs-16">
                                        <input type="checkbox" onchange="updateStatus('dv', this.checked)"
                                        {{ $data->dv == 'true' ? 'checked' : '' }}> DV</label>
                                </div>
                            </div>
                        </div>

                        <div class="row m-t-sm">
                            <div class="col-lg-12">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Item No.</th>
                                            <th>Unit</th>
                                            <th>Description</th>
                                            <th>Quantity</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($items as $i)
                                            <tr>

                                                <td>
                                                    {{ $loop->iteration }}
                                                </td>
                                                <td>
                                                    {{ $i->di_unit }}
                                                </td>
                                                <td>
                                                    {{ $i->di_description }}
                                                </td>
                                                <td>
                                                    {{ $i->di_quantity }}
                                                </td>

                                            </tr>

                                        @empty
                                            <tr class="text-center">
                                                <td colspan="4">No Items Found</td>
                                            </tr>
                                        @endforelse


                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>Actions</h5>
                        <a data-toggle="modal" href="#action-form"
                        class="btn btn-primary btn-xs pull-right m-l-10">Add Actions</a>
                        
                    </div>
                    <div class="ibox-content">
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
                                            {{ $a->dh_name }}
                                        </td>
                                        <td>
                                            {{ $a->dh_date }}
                                        </td>
                                        <td>
                                            {{ $a->dh_action }}
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
        <div class="col-lg-3">
            <div class="wrapper wrapper-content">
                <h4>Attached Documents</h4>
            </div>
        </div>
    </div>


{{-- MODALS --}}
<div id="items-form" class="modal fade" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">

                    <div class="col-sm-12">
                        <h3 class="m-t-none m-b">Add Item</h3>

                        <form role="form" action="{{ url('/admin/document/add-item') }}" method="POST">
                            @csrf()

                            <div class="form-group d-none">
                                <label>Document ID</label>
                                <input value="{{ $data->document_id }}" name="document_id" class="form-control"
                                    type="number" readonly>
                            </div>

                            <div class="form-group">
                                <label>Unit</label>
                                <select class="form-control" name="item_unit" required>
                                    <option value="Unit">Unit</option>
                                    <option value="Set">Set</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Description</label>
                                <textarea name="item_description" class="form-control" required></textarea>

                            </div>

                            <div class="form-group">
                                <label>Quantity</label>
                                <input type="number" name="item_quantity" class="form-control" required>
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


<div id="action-form" class="modal fade" aria-hidden="true">
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
                                <input value="{{ $data->document_id }}" name="document_id" class="form-control"
                                    type="number" readonly>
                            </div>

                            <div class="form-group">
                                <label>Name/Position</label>
                                <input type="text" name="history_name" placeholder="" class="form-control"
                                    required minlength="2">
                            </div>

                            <div class="form-group">
                                <label>Date and Time</label>
                                <input type="datetime-local" onfocus="this.showPicker()" name="history_date" class="form-control" required>
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


<div id="amount-form" class="modal fade" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">

                    <div class="col-sm-12">
                        <h3 class="m-t-none m-b">Edit Document</h3>

                        <form role="form"
                            action="{{ url('/admin/update-document-amount') }}"
                            method="POST">
                            @csrf()

                            <div class="form-group d-none">
                                <label>Document ID</label>
                                <input value="{{ $data->document_id }}"
                                    name="document_id" class="form-control"
                                    type="number" readonly>
                            </div>

                            <div class="form-group">
                                <label>Title</label>
                                <input type="text" name="document_title"
                                    value="{{ $data->document_title }}"
                                    class="form-control" required minlength="5">
                            </div>

                            <div class="form-group">
                                <label>Nature of Document</label>
                                <input type="text" name="document_nature"
                                    value="{{ $data->document_nature }}"
                                    class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label>Amount</label>
                                <input type="number" name="amount" min="0"
                                    value="{{ $data->amount }}" step=".01"
                                    class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label>Deadline</label>
                                <input type="datetime-local" name="document_deadline"
                                    class="form-control" onfocus="this.showPicker()"
                                    @if ($data->document_deadline != 'No Deadline')
                                     value="{{ $data->unformatted_document_deadline }}"
                                    @endif>
                            </div>

                            <div class="form-group text-center">
                                <button class="btn btn-sm btn-primary m-t-n-xs w-100"
                                    type="submit"><strong>Edit</strong>
                                </button>
                            </div>
                        </form>
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
            var document_id = {{ $data->document_id }};
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
