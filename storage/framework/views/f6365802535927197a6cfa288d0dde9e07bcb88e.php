

<?php $__env->startSection('content'); ?>
    <div class="content-wrapper">
        <div class="container-fluid flex-grow-1 container-p-y">
            <div class="row">
                <div class="col-xl">
                    <div class="card mb-4">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0"><?php if(isset($item)): ?>
                                    Edit
                                <?php else: ?>
                                    New
                                <?php endif; ?> Address</h5>
                        </div>
                        <div class="card-body">
                            <form action="<?php echo e(route('addresses.create.action')); ?>" method="POST">
                                <?php if(isset($item)): ?>
                                    <input type="text" class="form-control" name="id" value="<?php echo e($item->id); ?>" hidden/>
                                <?php endif; ?>

                                <?php if(isset($item)): ?>
                                    <div class="mb-3">
                                        <label class="form-label" for="address">Address</label>
                                        <input type="text" class="form-control" name="address"
                                               value="<?php echo e($item->address); ?>"/>
                                    </div>
                                <?php else: ?>
                                    <div class="mb-3">
                                        <label class="form-label" for="address">Address</label>
                                        <textarea class="form-control" name="address" id="address"></textarea>
                                        <div class="form-text">Enter BTC address (You can use several via SHIFT +
                                            ENTER)
                                        </div>
                                    </div>
                                <?php endif; ?>

                                <button type="submit" class="btn btn-primary">
                                    <?php if(isset($item)): ?>
                                        Edit
                                    <?php else: ?>
                                        Create
                                    <?php endif; ?>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('pages.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\OSPanel\domains\friezer-backend\resources\views/pages/addresses/item.blade.php ENDPATH**/ ?>