<div class="col-lg-12">
    <div class="ibox ">
        <div class="ibox-title">
            <h5>Document Data</h5>

            <div class="ibox-tools">
                <a class="collapse-link">
                    <i class="fa fa-chevron-up"></i>
                </a>

                <a class="close-link">
                    <i class="fa fa-times"></i>
                </a>
            </div>
        </div>
        <div class="ibox-content">
            <div class="">
                <table id="documentTable" class="table table-bordered table-responsive table-hover">
                    <thead>
                        <tr>
                            <th class="wp-10 text-center">Status</th>
                            <th class="wp-30">Title</th>
                            <th class="wp-30">Origin</th>
                            <th class="wp-10">Nature</th>
                            <th class="wp-20">No.</th>
                            <th class="wp-10 text-center">View</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($data as $d)
                            <tr>
                                <td class="wp-10 text-center">
                                    @if ($d->de_status == 'Approved')
                                        <span class="label label-success">{{ $d->de_status }}</span>
                                    @elseif ($d->de_status == 'Denied')
                                        <span class="label label-danger">{{ $d->de_status }}</span>
                                    @else
                                        <span class="label label-primary">{{ $d->de_status }}</span>
                                    @endif
                                </td>
                                <td class="wp-30"> {{ $d->document_title }} </td>
                                <td class="wp-30"> {{ $d->office_name }} </td>
                                <td class="wp-10"> {{ $d->document_nature }} </td>
                                <td class="wp-10"> {{ $d->document_number }} </td>
                                <td class="wp-10 text-center">
                                    <a href="{{ route('budget.view', ['id' => $d->document_number]) }}"
                                        class="btn btn-primary btn-sm">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                        @endforelse
                    </tbody>
                    <tfoot>
                        <tr>
                            <th class="text-center">Status</th>
                            <th>Title</th>
                            <th>Origin</th>
                            <th>Nature</th>
                            <th>No.</th>
                            <th class="text-center">View</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('js/plugins/dataTables/datatables.min.js') }}"></script>
<script>
    $.fn.dataTable.Buttons.defaults.dom.button.className = 'btn btn-white btn-sm';
    $(document).ready(function() {
        $('#documentTable').DataTable({
            language: {
                zeroRecords: "No Allocation History Found"
            },
            pageLength: 25,
            order: [],
            responsive: true,
            columnDefs: [{
                'orderable': false,
                'targets': [4, 5]
            }],
            initComplete: function() {
                const api = this.api();
                if (api.data().count() > 0) {
                    api.columns([2, 3])
                        .every(function() {
                            var column = this;

                            var select = $('<select><option value=""></option></select>')
                                .appendTo($(column.footer()).empty())
                                .on('change', function() {
                                    column
                                        .search($(this).val(), {
                                            exact: true
                                        })
                                        .draw();
                                });

                            column
                                .data()
                                .unique()
                                .sort()
                                .each(function(d, j) {
                                    select.append(
                                        '<option value="' + d + '">' + d + '</option>'
                                    );
                                });
                        });
                }
            }
        });
    });
</script>
