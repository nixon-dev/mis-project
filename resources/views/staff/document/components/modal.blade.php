<div id="modal-form" class="modal fade" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">

                    <div class="col-sm-12">
                        <h3 class="m-t-none m-b">Add Document</h3>

                        <form role="form" action="{{ route('document.add') }}" method="POST"
                            onsubmit="this.querySelector('button[type=submit]').disabled = true; return true;">
                            @csrf()
                            <div class="form-group">
                                <label>Title</label>
                                <input type="text" name="document_title" placeholder="" class="form-control"
                                    required>
                            </div>
                            <div class="form-group">
                                <label>Origin Office</label>
                                <input type="text" name="document_origin" value="{{ $officeName }}"
                                    class="form-control" readonly required>
                            </div>
                            <div class="form-group">
                                <label>Office Code</label>
                                <input type="text" name="document_origin" value="{{ $officeCode }}"
                                    class="form-control" readonly required>
                            </div>
                            <div class="form-group">
                                <label>Nature of Document</label>
                                <input type="text" name="document_nature" placeholder="" class="form-control"
                                    required>
                            </div>

                            <div class="form-group">
                                <label>Deadline</label>
                                <input type="datetime-local" name="document_deadline" class="form-control"
                                    onfocus="this.showPicker()">
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

<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('#mySelect').select2({
            placeholder: "Select an office",
            allowClear: true
        });
    });
</script>
