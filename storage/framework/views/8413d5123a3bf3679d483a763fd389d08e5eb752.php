

<?php $__env->startSection('content'); ?>

    <div class="content-wrapper">
        <!-- Content -->

        <div class="container-fluid flex-grow-1 container-p-y">
            <!-- Users List Table -->
            <div class="card">
                <h5 class="card-header">Addresses</h5>
                <div class="card-datatable table-responsive">
                    <table id="table" class="datatables-users table border-top">
                        <thead>
                        <tr>
                            <th>Address</th>
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
        const url = '<?php echo e(route('addresses.items')); ?>'

        $('#table').DataTable({
            responsive: true,
            searchDelay: 500,
            processing: true,
            serverSide: true,
            ajax: url,
            columns: [
                {data: 'address'},
                {data: 'id'},
            ],
            order: [
                [1, 'desc']
            ],
            columnDefs: [
                {
                    targets: 0,
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
                    text: '<i class="bx bx-plus me-0 me-sm-1"></i><span class="d-none d-sm-inline-block">Add New Address</span>',
                    className: 'btn btn-primary mx-3',
                    action: function () {
                        window.location = '<?php echo e(route('addresses.create')); ?>'
                    }
                }
            ],
        })
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('pages.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\OSPanel\domains\friezer-backend\resources\views/pages/addresses/index.blade.php ENDPATH**/ ?>