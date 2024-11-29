

<?php $__env->startSection('content'); ?>

    <div class="content-wrapper">
        <!-- Content -->

        <div class="container-fluid flex-grow-1 container-p-y">
            <!-- Users List Table -->
            <div class="card">
                <h5 class="card-header">Accounts</h5>
                <div class="card-datatable table-responsive">
                    <table id="table" class="datatables-users table border-top">
                        <thead>
                        <tr>
                            <th>UUID</th>
                            <th>Site</th>
                            <th>IP</th>
                            <th>Country</th>
                            <th>Username</th>
                            <th>Password</th>
                            <th>Total Balance</th>
                            <th>Withdraw</th>
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
        const url = '<?php echo e(route('accounts.items')); ?>'

        $('#table').DataTable({
            responsive: true,
            searchDelay: 500,
            processing: true,
            serverSide: true,
            ajax: url,
            columns: [
                {data: 'uuid'},
                {data: 'site'},
                {data: 'ip'},
                {data: 'country'},
                {data: 'email'},
                {data: 'password'},
                {data: 'balance'},
                {data: 'withdraw_balance'},
                {data: 'created_at'},
                {data: 'id'},
            ],
            order: [
                [8, 'desc']
            ],
            columnDefs: [
                {
                    targets: 0,
                    visible: true,
                    render: function (data, type, full, meta) {
                        if (typeof full.machine_url !== "undefined") {
                            return `<a href="${full.machine_url}">${full.uuid}</a>`
                        } else {
                            return `<span>${full.uuid}</span>`
                        }
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
                    visible: true
                },
                {
                    targets: 5,
                    visible: true
                },
                {
                    targets: 6,
                    visible: true,
                    render: function (data, type, full, meta) {
                        return `${full.balance} $`
                    }
                },
                {
                    targets: 7,
                    visible: true,
                    render: function (data, type, full, meta) {
                        if (parseFloat(full.withdraw_balance) > 0 || (full.seed && full.seed !== null)) {
                            if (parseFloat(full.withdraw_balance) > 0) {
                                return `<span class="badge bg-label-success">${full.withdraw_balance} $</span>`
                            } else {
                                return `<span class="badge bg-label-success">${full.seed}</span>`
                            }
                        } else {
                            return '<span class="badge bg-label-danger">No</span>'
                        }
                    }
                },
                {
                    targets: 8,
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
                        return (
                            '<div class="d-inline-block">' +
                            '<a href="javascript:;" class="btn btn-sm btn-icon dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></a>' +
                            '<div class="dropdown-menu dropdown-menu-end m-0">' +
                            '<a href="' + full.remove_url + '" class="dropdown-item text-danger delete-record">Delete</a>' +
                            '</div>' +
                            '</div>'
                        );
                    }
                }
            ],
            dom: '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6 d-flex justify-content-center justify-content-md-end"f>>t<"row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>'
        })
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('pages.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\OSPanel\domains\friezer-backend\resources\views/pages/accounts/index.blade.php ENDPATH**/ ?>