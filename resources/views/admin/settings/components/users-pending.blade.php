<table class="table table-bordered table-hover users-pending-table" style="width: 100%;">
    <thead>
        <tr>
            <th scope="col">Name</th>
            <th scope="col">Office</th>
            <th>Email</th>
            <th>Role</th>
            <th>Manage</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($usersPending as $up)
            <tr>
                <td> {{ $up->name }} </td>
                @if ( $up->role == 'Administrator')
                <td>Every Office</td>
                @elseif ($up->office_id == Null)
                <td>No Assigned Office</td>
                @else
                    <td>{{ $up->office_name }}</td>
                @endif
                <td> {{ $up->email }} </td>
                <td> {{ $up->role }} </td>
                <td class="text-center">
                    <a href="{{ route('admin.users', ['id' => $up->id]) }}" class="btn btn-danger btn-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                            fill="#fff" class="bi bi-eye" viewBox="0 0 16 16">
                            <path
                                d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z" />
                            <path
                                d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0" />
                        </svg>
                    </a>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5" class="text-center">No Pending User Found</td>
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

@section('script')
    <script src="{{ asset('js/plugins/dataTables/datatables.min.js') }}"></script>
    <script>
        $.fn.dataTable.Buttons.defaults.dom.button.className = 'btn btn-white btn-sm';

        $(document).ready(function() {
            $('.users-pending-table').DataTable({
                pageLength: 10,
                order: [],
                responsive: true,
                initComplete: function() {
                    this.api()
                        .columns([3])
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

            });

        });
    </script>
@endsection