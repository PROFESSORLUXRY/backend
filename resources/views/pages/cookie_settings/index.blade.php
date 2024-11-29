@extends('pages.layout')

@section('content')

    <div class="content-wrapper">
        <!-- Content -->

        <div class="container-fluid flex-grow-1 container-p-y">
            <div class="card mb-4">
                <h5 class="card-header">Cookie Settings</h5>
                <div class="card-datatable table-responsive">
                    <table id="table" class="datatables-users table border-top">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Icon</th>
                            <th>Url</th>
                            <th></th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">Cookie Download</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('cookie_settings.download') }}" method="POST">
                        <div class="mb-3">
                            <label class="form-label" for="url">Url</label>
                            <input type="text" name="url" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="date">Date</label>
                            <input type="date" name="date" class="form-control" id="date">
                        </div>

                        <button type="submit" class="btn btn-primary">Download</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        const url = '{{ route('cookie_settings.items') }}'

        $('#table').DataTable({
            responsive: true,
            searchDelay: 500,
            processing: true,
            serverSide: true,
            ajax: url,
            columns: [
                {data: 'name'},
                {data: 'icon_url'},
                {data: 'url'},
                {data: 'id'},
            ],
            order: [
                [3, 'desc']
            ],
            columnDefs: [
                {
                    targets: 0,
                    visible: true
                },
                {
                    targets: 1,
                    render: function (data, type, full, meta) {
                        return (`<img src="${full.icon_url}" width="32" height="32" />`)
                    },
                    responsivePriority: 1
                },
                {
                    targets: 2,
                    visible: true
                },
                {
                    targets: -1,
                    title: 'Actions',
                    orderable: false,
                    render: function (data, type, full, meta) {
                        return (
                            '<div class="d-inline-block">' +
                            '<a href="javascript:;" class="btn btn-sm btn-icon dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></a>' +
                            '<div class="dropdown-menu dropdown-menu-end m-0">' +
                            '<a href="' + full.edit_url + '" class="dropdown-item">Details</a>' +
                            '<div class="dropdown-divider"></div>' +
                            '<a href="' + full.remove_url + '" class="dropdown-item text-danger delete-record">Delete</a>' +
                            '</div>' +
                            '</div>' +
                            '<a href="' + full.edit_url + '" class="btn btn-sm btn-icon item-edit"><i class="bx bxs-edit"></i></a>'
                        );
                    }
                }
            ],
            dom:
                '<"row mx-2"' +
                '<"col-md-2"<"me-3"l>>' +
                '<"col-md-10"<"dt-action-buttons text-xl-end text-lg-start text-md-end text-start d-flex align-items-center justify-content-end flex-md-row flex-column mb-3 mb-md-0"fB>>' +
                '>t' +
                '<"row mx-2"' +
                '<"col-sm-16 col-md-6"i>' +
                '<"col-sm-12 col-md-6"p>' +
                '>',
            language: {
                sLengthMenu: '_MENU_',
                search: '',
                searchPlaceholder: 'Search..'
            },
            buttons: [
                {
                    text: '<i class="bx bx-plus me-0 me-sm-1"></i><span class="d-none d-sm-inline-block">Add New Cookie</span>',
                    className: 'btn btn-primary mx-3',
                    action: function () {
                        window.location = '{{ route('cookie_settings.create') }}'
                    }
                }
            ],
        })
    </script>
@endsection
