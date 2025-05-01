<table class="table table-bordered table-hover users-table" style="width: 100%;">
    <thead>
        <tr>
            <th class="wp-30" scope="col">Name</th>
            <th class="wp-30" scope="col">Office</th>
            <th class="wp-20">Email</th>
            <th class="wp-10">Role</th>
            <th class="wp-10">Manage</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($usersList as $ul)
            <tr>
                <td> {{ $ul->name }} </td>
                @if ($ul->role == 'Administrator')
                    <td>Every Office</td>
                @elseif ($ul->office_id == null)
                    <td>No Assigned Office</td>
                @else
                    <td>{{ $ul->office_name }}</td>
                @endif
                <td> {{ $ul->email }} </td>
                <td> {{ $ul->role }} </td>
                <td class="text-center">
                    <a href="{{ route('admin.users-view', ['id' => $ul->id]) }}" class="btn btn-primary btn-sm">
                        <i class="fa fa-eye"></i>
                    </a>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5" class="text-center">No User Found</td>
            </tr>
        @endforelse
    </tbody>
    <tfoot>
        <tr>
            <th>Name</th>
            <th>Office</th>
            <th>Email</th>
            <th>Role</th>
            <th>Manage</th>
        </tr>
    </tfoot>
</table>
<script src="{{ asset('js/plugins/dataTables/datatables.min.js') }}"></script>
<script>
    $.fn.dataTable.Buttons.defaults.dom.button.className = 'btn btn-white btn-sm';

    $(document).ready(function() {
        $('.users-table').DataTable({
            pageLength: 10,
            order: [],
            responsive: true,
            initComplete: function() {
                this.api()
                    .columns([3])
                    .every(function() {
                        var column = this;

                        var select = $('<select style="width: 100%;"><option value=""></option></select>')
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

        });

    });
</script>
