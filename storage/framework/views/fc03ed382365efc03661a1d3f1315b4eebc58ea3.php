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
                                <?php endif; ?> Clipper</h5>
                        </div>
                        <div class="card-body">
                            <form action="<?php echo e(route('clipper.create.action')); ?>" method="POST">
                                <?php if(isset($item)): ?>
                                    <input type="text" class="form-control" name="id" value="<?php echo e($item->id); ?>" hidden/>
                                <?php endif; ?>

                                <div class="mb-3">
                                    <label class="form-label" for="url">Rule</label>
                                    <input type="text" class="form-control" name="reg" id="reg"
                                           placeholder="(3[a-zA-HJ-NP-Z0-9]{25,59})"
                                           <?php if(isset($item)): ?> value="<?php echo e($item->reg); ?>" <?php endif; ?> />
                                </div>

                                <div class="mb-3">
                                    <label class="form-label" for="url">Rule</label>
                                    <input type="text" class="form-control" name="value" id="value"
                                           placeholder="3NA22JyuX4iW63PgGxS6wGygPUHE69npbd"
                                           <?php if(isset($item)): ?> value="<?php echo e($item->value); ?>" <?php endif; ?> />
                                </div>

                                <button type="submit" class="btn btn-primary"><?php if(isset($item)): ?>
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

<?php echo $__env->make('pages.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\OSPanel\domains\friezer-backend\resources\views/pages/clipper/item.blade.php ENDPATH**/ ?>