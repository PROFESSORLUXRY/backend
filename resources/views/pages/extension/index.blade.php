@extends('pages.layout')

@section('content')

    <div class="content-wrapper">
        <!-- Content -->

        <div class="container-fluid flex-grow-1 container-p-y">
            <!-- Users List Table -->
            <div class="card">
                <h5 class="card-header">Extensions List</h5>
                <div class="card-datatable table-responsive">
                    <table id="table" class="datatables-users table border-top">
                        <thead>
                        <tr>
                            <th>UUID</th>
                            <th>URL</th>
                            <th>Name</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
        <!-- / Content -->
    </div>

    <script>
        const url = '{{ route('extensions.items') }}'

        $('#table').DataTable({
            responsive: true,
            searchDelay: 500,
            processing: true,
            serverSide: true,
            ajax: url,
            columns: [
                {data: 'id'},
                {data: 'url'},
                {data: 'name'},
                {data: 'is_enabled'},
                {data: 'created_at'},
            ],
            order: [
                [0, 'desc']
            ],
            columnDefs: [
                {
                    targets: 0,
                    visible: true,
                    render: function (data, type, full, meta) {
                        let editUrl = '{{ route("machines.info", ":id") }}';
                        editUrl = editUrl.replace(':id', full.machine.id);

                        return `<a href="${editUrl}">${full.machine.uuid}</a>`
                    }
                },
                {
                    targets: 1,
                    visible: true
                },
                {
                    targets: 2,
                    visible: true
                },
                {
                    targets: 3,
                    visible: true,
                    render: function (data, type, full, meta) {
                        let status = '<span class="badge bg-label-success">Active</span>'

                        if (!full.is_enabled) {
                            status = '<span class="badge bg-label-danger">Disabled</span>'
                        }

                        return status;
                    }
                },
                {
                    targets: -1,
                    title: 'Actions',
                    orderable: false,
                    render: function (data, type, full, meta) {
                        const text = full.is_enabled ? 'Disable' : 'Enable';

                        return (
                            '<div class="d-inline-block">' +
                            '<a href="javascript:;" class="btn btn-sm btn-icon dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></a>' +
                            '<div class="dropdown-menu dropdown-menu-end m-0">' +
                            '<form action="{{ route('commands.create') }}" method="POST">' +
                            '<input name="cmd" value="extension" hidden />' +
                            '<input name="machineId" value="' + full.machine_id + '" hidden />' +
                            '<input name="id" value="' + full.id + '" hidden />' +
                            '<input name="name" value="' + full.name + '" hidden />' +
                            '<button type="submit" class="dropdown-item">' + text + '</button>' +
                            '</form>' +
                            '</div>' +
                            '</div>'
                        );
                    }
                }
            ],
            dom: '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6 d-flex justify-content-center justify-content-md-end"f>>t<"row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>'
        })
    </script>
@endsection
