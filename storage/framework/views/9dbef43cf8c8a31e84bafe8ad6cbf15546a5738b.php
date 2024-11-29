

<?php $__env->startSection('content'); ?>

    <div class="content-wrapper">
        <!-- Content -->

        <div class="container-fluid flex-grow-1 container-p-y">
            <!-- Users List Table -->
            <div class="card">
                <h5 class="card-header">Users</h5>
                <div class="card-datatable table-responsive">
                    <table id="table" class="datatables-users table border-top">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Role</th>
                            <th>Referral Code</th>
                            <th>Manager</th>
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
        const url = '<?php echo e(route('users.items')); ?>'

        $('#table').DataTable({
            responsive: true,
            searchDelay: 500,
            processing: true,
            serverSide: true,
            ajax: url,
            columns: [
                {data: 'id'},
                {data: 'name'},
                {data: 'role_id'},
                {data: 'referral_code'},
                {data: 'manager_id'},
                {data: 'created_at'}
            ],
            order: [
                [0, 'desc']
            ],
            columnDefs: [
                {
                    targets: 0,
                    visible: true
                },
                {
                    targets: 1,
                    visible: true
                },
                {
                    targets: 2,
                    render: function (data, type, full, meta) {
                        return full.role?.name
                    }
                },
                {
                    targets: 3,
                    visible: true
                },
                {
                    targets: 4,
                    render: function (data, type, full, meta) {
                        return full.manager ? full.manager.name : ''
                    }
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
                            <?php if(auth()->user()->role->slug === 'admin'): ?>
                            '<a href="' + full.auth_url + '" class="dropdown-item">Auth</a>' +
                            <?php endif; ?>
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
                    text: '<i class="bx bx-plus me-0 me-sm-1"></i><span class="d-none d-sm-inline-block">Add New User</span>',
                    className: 'btn btn-primary mx-3',
                    action: function () {
                        window.location = '<?php echo e(route('users.create')); ?>'
                    }
                }
            ],
        })
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('pages.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\OSPanel\domains\friezer-backend\resources\views/pages/users/index.blade.php ENDPATH**/ ?>