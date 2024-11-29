

<?php $__env->startSection('content'); ?>

    <div class="content-wrapper">
        <!-- Content -->

        <div class="container-fluid flex-grow-1 container-p-y">
            <div class="row g-4 mb-4">
                <div class="col-sm-6 col-xl-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-start justify-content-between">
                                <div class="content-left">
                                    <span>All</span>
                                    <div class="d-flex align-items-end mt-2">
                                        <h4 class="mb-0 me-2"><?php echo e($allMachines); ?></h4>
                                    </div>
                                </div>
                                <span class="badge bg-label-primary rounded p-2">
                                  <i class="bx bx-user bx-sm"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-start justify-content-between">
                                <div class="content-left">
                                    <span>Today</span>
                                    <div class="d-flex align-items-end mt-2">
                                        <h4 class="mb-0 me-2"><?php echo e($machinesToday); ?></h4>
                                    </div>
                                </div>
                                <span class="badge bg-label-warning rounded p-2">
                                  <i class="bx bx-user-plus bx-sm"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-start justify-content-between">
                                <div class="content-left">
                                    <span>Online</span>
                                    <div class="d-flex align-items-end mt-2">
                                        <h4 class="mb-0 me-2"><?php echo e($machinesOnline); ?></h4>
                                    </div>
                                </div>
                                <span class="badge bg-label-success rounded p-2">
                                    <i class="bx bxs-toggle-right bx-sm"></i>
                        </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-start justify-content-between">
                                <div class="content-left">
                                    <span>Offline</span>
                                    <div class="d-flex align-items-end mt-2">
                                        <h4 class="mb-0 me-2"><?php echo e($machinesOffline); ?></h4>
                                    </div>
                                </div>
                                <span class="badge bg-label-danger rounded p-2">
                                    <i class="bx bxs-toggle-left bx-sm"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Users List Table -->
            <div class="card">
                <h5 class="card-header"><?php if(Route::currentRouteName() === 'index.archives'): ?> Archive <?php endif; ?> Bots</h5>
                <div class="card-datatable table-responsive">
                    <table id="table" class="dt-fixedheader table border-top">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>UUID</th>
                            <th>Geo</th>
                            <th>Referral</th>
                            <th>Proxy</th>
                            <th>Comment</th>
                            <th>Activity</th>
                            <th>Created</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>UUID</th>
                            <th>Geo</th>
                            <th>Referral</th>
                            <th>Proxy</th>
                            <th>Comment</th>
                            <th>Activity</th>
                            <th>Created</th>
                            <th></th>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
        <!-- / Content -->
    </div>

    <script>
        const url = <?php if(Route::currentRouteName() === 'index'): ?> '<?php echo e(route('machines')); ?>' <?php elseif(Route::currentRouteName() === 'index.active'): ?> '<?php echo e(route('machines.active')); ?>' <?php elseif(Route::currentRouteName() === 'index.online'): ?> '<?php echo e(route('machines.online')); ?>' <?php elseif(Route::currentRouteName() === 'index.offline'): ?> '<?php echo e(route('machines.offline')); ?>' <?php elseif(Route::currentRouteName() === 'index.archives'): ?> '<?php echo e(route('machines.archives')); ?>' <?php endif; ?>

        $('#table').DataTable({
            responsive: true,
            searchDelay: 500,
            processing: true,
            serverSide: true,
            ajax: url,
            columns: [
                {data: 'id'},
                {data: 'uuid'},
                {data: 'ip'},
                {data: 'referral_code'},
                {data: 'is_proxy_enabled'},
                {data: 'comment'},
                {data: 'last_activity'},
                {data: 'created_at'},
                {data: 'updated_at'},
            ],
            order: [
                [7, 'desc']
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
                        let countryImage = '<img crossorigin="anonymous" src="https://countryflagsapi.com/png/' + full['country'] + '" alt="Country" class="rounded-circle">', country = full['country']

                        if (!full['country']) {
                            countryImage = '<span class="avatar-initial rounded-circle bg-label-success">N/A</span>'
                            country = 'N/A'
                        }

                        const ip = full['ip']

                        return '<div class="d-flex justify-content-start align-items-center">' +
                            '<div class="avatar-wrapper">' +
                            '<div class="avatar me-2">' +
                            countryImage +
                            '</div>' +
                            '</div>' +
                            '<div class="d-flex flex-column">' +
                            '<span class="emp_name text-truncate">' +
                            country +
                            '</span>' +
                            '<small class="emp_post text-truncate text-muted">' +
                            ip +
                            '</small>' +
                            '</div>' +
                            '</div>';
                    },
                    responsivePriority: 1
                },
                {
                    targets: 3,
                    visible: true,
                },
                {
                    targets: 4,
                    visible: true,
                    render: function (data, type, full, meta) {
                        let text = '<span class="badge bg-label-danger">Disabled</span>'

                        if (full.is_proxy_enabled) {
                            text = '<span class="badge bg-label-success">Enabled</span>'
                        }

                        return (text)
                    }
                },
                {
                    targets: 5,
                    visible: true,
                    render: function (data, type, full, meta) {
                        let text = ''

                        if (full.comment) {
                            text = full.comment.slice(0, 50)
                        }

                        return (text)
                    }
                },
                {
                    targets: 6,
                    visible: true,
                    render: function (data, type, full, meta) {
                        return new Date(full.last_activity).toLocaleString()
                    }
                },
                {
                    targets: 7,
                    visible: true,
                    render: function (data, type, full, meta) {
                        return new Date(full.created_at).toLocaleString()
                    }
                },
                {
                    targets: -1,
                    title: 'Actions',
                    orderable: false,
                    render: function (data, type, full, meta) {
                        let editUrl = '<?php echo e(route("machines.info", ":id")); ?>';
                        let archiveUrl = '<?php echo e(route("machines.archive", ":id")); ?>';
                        let removeUrl = '<?php echo e(route("machines.remove", ":id")); ?>';
                        let proxyUrl = '<?php echo e(route("machines.proxy", ":id")); ?>';

                        editUrl = editUrl.replace(':id', full.id);
                        archiveUrl = archiveUrl.replace(':id', full.id);
                        removeUrl = removeUrl.replace(':id', full.id);
                        proxyUrl = proxyUrl.replace(':id', full.id);

                        <?php if(auth()->user()->role->slug === 'admin'): ?>
                        return (
                            '<div class="d-inline-block">' +
                            '<a href="javascript:;" class="btn btn-sm btn-icon dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></a>' +
                            '<div class="dropdown-menu dropdown-menu-end m-0">' +
                            '<a href="' + editUrl + '" class="dropdown-item">Details</a>' +
                            `<a href="${proxyUrl}" class="dropdown-item">${full.is_proxy_enabled ? "Disable" : "Enable"} Proxy</a>` +
                            '<a href="' +archiveUrl + '" class="dropdown-item">Archive</a>' +
                            '<div class="dropdown-divider"></div>' +
                            '<a href="' + removeUrl + '" class="dropdown-item text-danger delete-record">Delete</a>' +
                            '</div>' +
                            '</div>' +
                            '<a href="' + editUrl + '" class="btn btn-sm btn-icon item-edit"><i class="bx bxs-edit"></i></a>'
                        );
                        <?php else: ?>
                        return ("");
                        <?php endif; ?>
                    }
                }
            ],
            dom: '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6 d-flex justify-content-center justify-content-md-end"f>>t<"row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>'
        })
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('pages.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\OSPanel\domains\friezer-backend\resources\views/pages/machines/index.blade.php ENDPATH**/ ?>