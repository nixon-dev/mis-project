<div id="modal-form" class="modal fade" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">

                    <div class="col-sm-12">
                        <h3 class="m-t-none m-b">Add Document</h3>

                        <form role="form" action="{{ url('/staff/insert-document') }}" method="POST">
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
                            <div class="form-group row ">
                                <div class="col-sm-12">
                                    <label class="">Responsibility Center</label>
                                </div>

                                <div class="col-sm-12">
                                    <select id="mySelect" class="form-control p-w-sm select2" style="width: 100%;"
                                        name="rc_code" required>
                                        @foreach ($rescen as $rc)
                                            <option value="{{ $rc->code }}">
                                                {{ $rc->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
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

@section('script')
<script>
    $.fn.modal.Constructor.prototype._enforceFocus = function() {};
</script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#mySelect').select2({
                placeholder: "Select an option...",
                allowClear: true
            });
        });
    </script>
@endsection
