<div id="responsibilityCenterModal" class="modal fade" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">

                    <div class="col-sm-12">
                        <h3 class="m-t-none m-b">Responsibility Center Details</h3>

                        <form role="form" action="{{ route('admin.rescen-edit') }}" method="POST">
                            @csrf()
                            <div class="form-group">
                                <label>Code</label>
                                <input type="text" name="code" id="modalCode" class="form-control" readonly
                                    required>
                            </div>
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" name="name" id="modalName" class="form-control" required>
                            </div>

                            <div class="form-group text-center">
                                <button class="btn btn-sm btn-primary m-t-n-xs w-100"
                                    type="submit"><strong>Update</strong>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="mooeModal" class="modal fade" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">

                    <div class="col-sm-12">
                        <h3 class="m-t-none m-b">MOOE Details</h3>

                        <form role="form" action="{{ route('admin.mooe-edit') }}" method="POST">
                            @csrf()
                            <div class="form-group">
                                <label>Code</label>
                                <input type="text" name="code" id="modalCode" class="form-control" readonly
                                    required>
                            </div>
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" name="name" id="modalName" class="form-control" required>
                            </div>

                            <div class="form-group text-center">
                                <button class="btn btn-sm btn-primary m-t-n-xs w-100"
                                    type="submit"><strong>Update</strong>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="coModal" class="modal fade" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">

                    <div class="col-sm-12">
                        <h3 class="m-t-none m-b">Capital Outlay Details</h3>

                        <form role="form" action="{{ route('admin.co-edit') }}" method="POST">
                            @csrf()
                            <div class="form-group">
                                <label>Code</label>
                                <input type="text" name="code" id="modalCode" class="form-control" readonly
                                    required>
                            </div>
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" name="name" id="modalName" class="form-control" required>
                            </div>

                            <div class="form-group text-center">
                                <button class="btn btn-sm btn-primary m-t-n-xs w-100"
                                    type="submit"><strong>Update</strong>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div id="officeModal" class="modal fade" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12">
                        <h3 class="m-t-none m-b">Office Details</h3>

                        <form role="form" action="{{ route('admin.office_edit') }}" method="POST">
                            @csrf()
                            <div class="form-group d-none">
                                <label>Office ID</label>
                                <input type="text" name="office_id" id="office_id" class="form-control" readonly
                                    required>
                            </div>
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" name="office_name" id="office_name" class="form-control" required>
                            </div>

                            <div class="form-group text-center">
                                <button class="btn btn-sm btn-primary m-t-n-xs w-100"
                                    type="submit"><strong>Update</strong>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="unitModal" class="modal fade" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12">
                        <h3 class="m-t-none m-b">Unit Details</h3>

                        <form role="form" action="{{ route('admin.units-edit') }}" method="POST">
                            @csrf()
                            <div class="form-group d-none">
                                <label>Unit ID</label>
                                <input type="text" name="unit_id" id="unit_id" class="form-control" readonly
                                    required>
                            </div>
                            <div class="form-group">
                                <label>Unit Name</label>
                                <input type="text" name="unit_name" id="unit_name" class="form-control" required>
                            </div>

                            <div class="form-group text-center">
                                <button class="btn btn-sm btn-primary m-t-n-xs w-100"
                                    type="submit"><strong>Update</strong>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
