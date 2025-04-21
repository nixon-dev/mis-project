@extends('staff.base')
@section('title', 'View Document - Management Information System')

@section('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="{{ asset('css/plugins/iCheck/custom.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/plugins/jQueryUI/jquery-ui.css') }}" type="text/css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.2/dropzone.min.css" rel="stylesheet">
    <style>
        .dropzone {
            background: #e3e6ff;
            border-radius: 13px;
            max-width: 550px;
            margin-left: auto;
            margin-right: auto;
            border: 2px dotted #1833FF;
            margin-top: 50px;
        }
    </style>
@endsection


@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-sm-8">
            <h2>View Document</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('staff.index') }}">Staff</a>
                </li>
                <li class="breadcrumb-item">
                    Document Tracking
                </li>
                <li class="breadcrumb-item">
                    @if ($data->document_status == 'Approved')
                        <a href="{{ route('document.approved') }}">Approved</a>
                    @elseif ($data->document_status == 'Denied')
                        <a href="{{ route('document.denied') }}">Denied</a>
                    @elseif ($data->document_status == 'Pending')
                        <a href="{{ route('document.pending') }}">Pending</a>
                    @else
                        <a href="{{ route('document.draft') }}">Draft</a>
                    @endif
                </li>

                <li class="breadcrumb-item active">
                    <strong>{{ $data->document_number }}</strong>
                </li>
            </ol>
        </div>
        <div class="col-sm-4">
            <div class="title-action">
                @if ($checkIfSent == '0')
                    <a href="#submit-form" data-toggle="modal" class="btn btn-primary">Submit</a>
                @else
                    <button href="#" class="btn btn-primary" disabled>Submit</button>
                @endif
            </div>


        </div>
    </div>

    @include('components.message')


    <div class="row">
        <div class="col-lg-9">
            <div class="wrapper wrapper-content animated fadeInDown">
                <div class="ibox">
                    <div class="ibox-content">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="m-b-md">
                                    <a data-toggle="modal" href="#items-form"
                                        class="btn btn-primary btn-xs pull-right m-l-10 {{ $data->document_status == 'Draft' ? '' : 'disabled' }}">Add
                                        Items</a>
                                    <a data-toggle="modal" href="#update-form"
                                        class="btn btn-primary btn-xs pull-right m-l-10 {{ $data->document_status == 'Draft' ? '' : 'disabled' }}">Edit
                                        Document</a>

                                    <h2 class="font-bold">{{ $data->document_title }}</h2>
                                </div>
                                <div class="row">
                                    <div class="col-lg-5">
                                        <dl class="dl-horizontal">
                                            <dt class="fs-18">Status:</dt>
                                            <dd class="fs-16">
                                                @php
                                                    $status = match ($data->document_status) {
                                                        'Approved' => 'success',
                                                        'Denied' => 'danger',
                                                        'Pending' => 'primary',
                                                        default => 'info',
                                                    };
                                                @endphp
                                                <span
                                                    class="label label-{{ $status }}">{{ $data->document_status }}</span>
                                            </dd>
                                        </dl>
                                    </div>
                                </div>
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


                                    <dt class="fs-18">Responsibility Code</dt>
                                    <dd class="fs-16">{{ $data->office_code ?? 'None' }}</dd>
                                    <dt class="fs-18">Document Number:</dt>
                                    <dd class="fs-16">{{ $data->document_number }}</dd>
                                    <dt class="fs-18">Deadline:</dt>
                                    <dd class="fs-16">{{ $data->document_deadline }}</dd>

                                </dl>
                            </div>
                            <div class="col-sm-12 row">
                                <div class="checkbox i-checks pl-3">
                                    <label class="fs-16"><input type="checkbox" onchange="updateStatus('pr', this.checked)"
                                            {{ $data->pr == 'true' ? 'checked' : '' }} disabled> PR</label>
                                </div>
                                <div class="checkbox i-checks pl-3">
                                    <label class="fs-16"><input type="checkbox"
                                            onchange="updateStatus('canvass', this.checked)"
                                            {{ $data->canvass == 'true' ? 'checked' : '' }} disabled> Canvass</label>
                                </div>
                                <div class="checkbox i-checks pl-3">
                                    <label class="fs-16"><input type="checkbox"
                                            onchange="updateStatus('abstract', this.checked)"
                                            {{ $data->abstract == 'true' ? 'checked' : '' }} disabled> Abstract</label>
                                </div>
                                <div class="checkbox i-checks pl-3">
                                    <label class="fs-16"><input type="checkbox"
                                            onchange="updateStatus('obr', this.checked)"
                                            {{ $data->obr == 'true' ? 'checked' : '' }} disabled> OBR</label>
                                </div>
                                <div class="checkbox i-checks pl-3">
                                    <label class="fs-16"><input type="checkbox" onchange="updateStatus('po', this.checked)"
                                            {{ $data->po == 'true' ? 'checked' : '' }} disabled> PO</label>
                                </div>
                                <div class="checkbox i-checks pl-3">
                                    <label class="fs-16"><input type="checkbox"
                                            onchange="updateStatus('par', this.checked)"
                                            {{ $data->par == 'true' ? 'checked' : '' }} disabled> PAR</label>
                                </div>
                                <div class="checkbox i-checks pl-3">
                                    <label class="fs-16"><input type="checkbox"
                                            onchange="updateStatus('air', this.checked)"
                                            {{ $data->air == 'true' ? 'checked' : '' }} disabled> AIR</label>
                                </div>
                                <div class="checkbox i-checks pl-3">
                                    <label class="fs-16">
                                        <input type="checkbox" onchange="updateStatus('dv', this.checked)"
                                            {{ $data->dv == 'true' ? 'checked' : '' }} disabled> DV</label>
                                </div>
                            </div>
                        </div>

                        <div class="row m-t-sm">
                            <div class="col-lg-12">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th class="wp-5">No.</th>
                                            <th class="wp-5">Type</th>
                                            <th class="wp-20">Description</th>
                                            <th class="wp-10">MOOE</th>
                                            <th class="wp-10">Capital Outlay</th>
                                            <th class="wp-10 text-center">Quantity</th>
                                            <th class="wp-15">Unit Price</th>
                                            <th class="wp-15">Total Amount</th>
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
                                                    {{ $i->di_mooe }}
                                                </td>
                                                <td>
                                                    {{ $i->di_co }}
                                                </td>
                                                <td class="text-center">
                                                    {{ $i->di_quantity }}
                                                </td>
                                                <td>
                                                    <span class="pull-left">₱</span> <span
                                                        class="pull-right">{{ number_format($i->di_unit_price, 2) }}</span>
                                                </td>
                                                <td>
                                                    <span class="pull-left">₱</span> <span
                                                        class="pull-right">{{ number_format($i->di_total_amount, 2) }}</span>
                                                </td>


                                            </tr>

                                        @empty
                                            <tr class="text-center">
                                                <td colspan="8">No Items Found</td>
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
                            class="btn btn-primary btn-xs pull-right m-l-10 {{ $data->document_status == 'Draft' ? '' : 'disabled' }}">Add
                            Actions</a>

                    </div>
                    <div class="ibox-content">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th class="wp-20">Name</th>
                                    <th class="wp-20">Date</th>
                                    <th class="wp-30">Action Taken</th>
                                    <th class="wp-30">Remarks</th>
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
                                        <td>
                                            {{ $a->dh_remarks }}
                                        </td>

                                    </tr>

                                @empty
                                    <tr class="text-center">
                                        <td colspan="4">No Action Taken</td>
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
                <ul class="list-group mb-3">
                    @forelse ($attachments as $attachment)
                        @php
                            $icons = [
                                'pdf' => 'fa-file-pdf-o',
                                'doc' => 'fa-file-word-o',
                                'docx' => 'fa-file-word-o',
                                'xls' => 'fa-file-excel-o',
                                'xlsx' => 'fa-file-excel-o',
                                'ppt' => 'fa-file-powerpoint-o',
                                'pptx' => 'fa-file-powerpoint-o',
                            ];
                            $iconClass = $icons[$attachment->da_file_type] ?? 'fa-file';

                            $filename = $attachment->da_name;
                            $extension = pathinfo($filename, PATHINFO_EXTENSION);
                            $nameWithoutExtension = pathinfo($filename, PATHINFO_FILENAME);
                            $truncatedName = Str::limit($nameWithoutExtension, 10, '..');

                        @endphp
                        <li class="list-group-item">

                            <a href="{{ route('download_file', ['filename' => $attachment->da_name]) }}"
                                class="pull-left"><i class="fa {{ $iconClass }}"></i>
                                {{ $truncatedName }}.{{ $extension }}</a>

                            <a href="{{ route('delete_file', ['filename' => $attachment->da_name]) }}"
                                onclick="return confirm('Delete attachment?')" class="pull-right text-danger"><i
                                    class="fa fa-trash"></i></a>
                        </li>
                    @empty
                        <li class="list-group-item">No Attached File</li>
                    @endforelse
                </ul>
                <a href="#upload-form" data-toggle="modal"
                    class="btn btn-primary btn-sm w-100 {{ $data->document_status == 'Draft' ? '' : 'disabled' }}">Attach
                    File</a>
            </div>
        </div>
    </div>


    {{-- MODALS --}}
    <div id="items-form" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <h3 class="m-t-none m-b">Add Item</h3>
                            <form role="form" action="{{ route('document.add-item') }}" method="POST"
                                onsubmit="this.querySelector('button[type=submit]').disabled = true; return true;">
                                @csrf()

                                <div class="form-group d-none">
                                    <label>Document ID</label>
                                    <input value="{{ $data->document_id }}" name="document_id" class="form-control"
                                        type="number" readonly>
                                </div>

                                <div class="form-group">
                                    <label>Type</label>
                                    <select class="form-control" name="item_unit" required>
                                        @forelse ($units as $unit)
                                            <option value="{{ $unit->unit_name }}">{{ $unit->unit_name }}</option>
                                        @empty
                                            <option disabled>No Unit Found, Please Ask Administrator</option>
                                        @endforelse
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea name="item_description" class="form-control" required></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Expense Type</label>
                                    <select id="expense_type" class="form-control">
                                        <option value="MOOE" selected>MOOE</option>
                                        <option value="CO">Capital Outlay</option>
                                    </select>
                                </div>
                                <div class="form-group row" id="mooe-div">
                                    <div class="col-sm-12">
                                        <label>MOOE</label>
                                    </div>
                                    <div class="col-sm-12">
                                        <select id="mooeSelect" class="form-control p-w-sm select2" style="width: 100%;"
                                            name="item_mooe" required>
                                            <option selected></option>
                                            @forelse ($mooes as $m)
                                                <option value="{{ $m->code }}">
                                                    {{ $m->name }}</option>
                                            @empty
                                                <option disabled>No MOOE Found, Please ask Administrator</option>
                                            @endforelse
                                        </select>

                                    </div>
                                </div>

                                <div class="form-group row d-none" id="co-div">
                                    <div class="col-sm-12">
                                        <label>Capital Outlay</label>
                                    </div>
                                    <div class="col-sm-12">
                                        <select id="coSelect" class="form-control p-w-sm select2" style="width: 100%;"
                                            name="item_co">
                                            <option selected></option>
                                            @forelse ($co as $c)
                                                <option value="{{ $c->code }}">
                                                    {{ $c->name }}</option>
                                            @empty
                                                <option disabled>No Capital Outlay Found, Please ask Administrator</option>
                                            @endforelse
                                        </select>

                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Quantity</label>
                                    <input type="number" name="item_quantity" id="item_quantity" class="form-control"
                                        required>
                                </div>

                                <div class="form-group">
                                    <label>Unit Price</label>
                                    <input type="number" name="item_unit_price" step="0.01" id="item_unit_price"
                                        class="form-control" required>
                                </div>

                                <div class="form-group">
                                    <label>Total Amount</label>
                                    <input type="text" name="item_total_amount" id="item_total_amount"
                                        class="form-control" required readonly>
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

    <div id="upload-form" class="modal fade" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <h3 class="m-t-none m-b">Upload File</h3>

                    <div id="dropzone">
                        <form action="{{ route('upload_file') }}" class="dropzone" id="fileupload"
                            enctype="multipart/form-data">
                            @csrf
                            <input name="document_id" class="d-none" value="{{ $data->document_id }}">
                            <div class="dz-message">
                                Drag and Drop your files here<br>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="submit-form" class="modal fade" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <h3 class="m-t-none m-b">Submit Form To</h3>

                    <form role="form" action="{{ route('document.submit') }}" method="POST">
                        @csrf()

                        <div class="form-group d-none">
                            <label>Document ID</label>
                            <input value="{{ $data->document_id }}" name="document_id" class="form-control"
                                type="number" readonly>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-12">
                                <label>Office</label>
                            </div>
                            <div class="col-sm-12">
                                <select id="officeSelect" class="form-control p-w-sm select2" style="width: 100%;"
                                    name="office_id" required>
                                    <option selected></option>
                                    @forelse ($office as $o)
                                        <option value="{{ $o->office_id }}">
                                            {{ $o->office_name }}
                                        </option>
                                    @empty
                                        <option disabled>No Office Found, Please ask Administrator</option>
                                    @endforelse
                                </select>

                            </div>
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

    <div id="action-form" class="modal fade" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="row">

                        <div class="col-sm-12">
                            <h3 class="m-t-none m-b">Add Action</h3>

                            <form role="form" action="{{ route('document.add-action') }}" method="POST"
                                onsubmit="this.querySelector('button[type=submit]').disabled = true; return true;">
                                @csrf()

                                <div class="form-group d-none">
                                    <label>Document ID</label>
                                    <input value="{{ $data->document_id }}" name="document_id" class="form-control"
                                        type="number" readonly>
                                </div>

                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" name="history_name" value="{{ Auth::user()->name }}"
                                        class="form-control" required minlength="2">
                                </div>

                                <div class="form-group">
                                    <label>Date and Time</label>
                                    <input type="datetime-local" onfocus="this.showPicker()" name="history_date"
                                        class="form-control" required>
                                </div>

                                <div class="form-group">
                                    <label>Action</label>
                                    <input type="text" name="history_action" class="form-control" required>
                                </div>

                                <div class="form-group">
                                    <label>Remarks (Optional)</label>
                                    <textarea class="form-control" name="history_remarks"></textarea>
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


    <div id="update-form" class="modal fade" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="row">

                        <div class="col-sm-12">
                            <h3 class="m-t-none m-b">Edit Document</h3>
                            <form role="form" action="{{ route('document.update') }}" method="POST"
                                onsubmit="this.querySelector('button[type=submit]').disabled = true; return true;">
                                @csrf()
                                <div class="form-group d-none">
                                    <label>Document ID</label>
                                    <input value="{{ $data->document_id }}" name="document_id" class="form-control"
                                        type="number" readonly>
                                </div>
                                <div class="form-group">
                                    <label>Title</label>
                                    <input type="text" name="document_title" value="{{ $data->document_title }}"
                                        class="form-control" required minlength="5">
                                </div>
                                <div class="form-group">
                                    <label>Nature of Document</label>
                                    <input type="text" name="document_nature" value="{{ $data->document_nature }}"
                                        class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label>Deadline</label>
                                    <input type="datetime-local" name="document_deadline" class="form-control"
                                        onfocus="this.showPicker()"
                                        @if ($data->document_deadline != 'No Deadline') value="{{ $data->unformatted_document_deadline }}" @endif>
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
    <script>
        const expTypeSelect = document.getElementById('expense_type');
        const mooeDiv = document.getElementById('mooe-div');
        const mooeSelect = document.getElementById('mooeSelect');
        const coDiv = document.getElementById('co-div');
        const coSelect = document.getElementById('coSelect');



        expTypeSelect.addEventListener('change', function() {
            const expType = this.value;
            if (expType === 'MOOE') {
                mooeDiv.classList.remove('d-none');
                mooeSelect.required = true;
                coDiv.classList.add('d-none');
                coSelect.required = false;
            } else {
                mooeDiv.classList.add('d-none');
                mooeSelect.required = false;
                coDiv.classList.remove('d-none');
                coSelect.required = true;
            }
        });
    </script>
    <script>
        $.fn.modal.Constructor.prototype._enforceFocus = function() {};
    </script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#mooeSelect').select2({
                placeholder: "Select a MOOE",
                allowClear: true
            });

            $('#coSelect').select2({
                placeholder: "Select a Capital Outlay",
                allowClear: true
            });

            $('#officeSelect').select2({
                placeholder: "Select an Office",
                allowClear: true
            });
        });
    </script>
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
                let itemId = checkbox.attr('onchange').match(/'([^']+)'/)[1];
                let isChecked = checkbox.prop('checked');

                updateStatus(itemId, isChecked);
            });
        });

        function updateStatus(itemId, isChecked) {
            var document_id = {
                {
                    $data - > document_id
                }
            };
            var token = "{{ csrf_token() }}";

            $.ajax({
                method: 'POST',
                url: '{{ route('staff.document-update-status') }}',
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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.2/min/dropzone.min.js"></script>
    <script>
        Dropzone.options.fileupload = {
            acceptedFiles: ".pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx",
            parallelUploads: 3,

        };
    </script>
    <script>
        const itemQuantity = document.getElementById('item_quantity');
        const itemUnitPrice = document.getElementById('item_unit_price');
        const itemTotalAmount = document.getElementById('item_total_amount');

        itemQuantity.addEventListener('input', updateTotalPrice);
        itemUnitPrice.addEventListener('input', updateTotalPrice);

        function updateTotalPrice() {
            const quantity = parseFloat(itemQuantity.value) || 0;
            const price = parseFloat(itemUnitPrice.value) || 0;
            const total = quantity * price;

            itemTotalAmount.value = total.toFixed(2);
        }
    </script>

@endsection
