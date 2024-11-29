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
                                <?php endif; ?> Cookie</h5>
                        </div>
                        <div class="card-body">
                            <form action="<?php echo e(route('cookie_settings.create.action')); ?>" method="POST">
                                <?php if(isset($item)): ?>
                                    <input type="text" class="form-control" name="id" value="<?php echo e($item->id); ?>" hidden/>
                                <?php endif; ?>

                                <div class="mb-3">
                                    <label class="form-label" for="name">Name</label>
                                    <input type="text" class="form-control" name="name" id="name"
                                           placeholder="Facebook"
                                           <?php if(isset($item)): ?> value="<?php echo e($item->name); ?>" <?php endif; ?> />
                                </div>

                                <div class="mb-3">
                                    <label class="form-label" for="icon_url">Icon Url</label>
                                    <input type="text" class="form-control" name="icon_url" id="icon_url"
                                           placeholder="https://upload.wikimedia.org/wikipedia/commons/thumb/1/1b/Facebook_icon.svg/800px-Facebook_icon.svg.png"
                                           <?php if(isset($item)): ?> value="<?php echo e($item->icon_url); ?>" <?php endif; ?> />
                                </div>

                                <div class="mb-3">
                                    <label class="form-label" for="url">Name</label>
                                    <input type="text" class="form-control" name="url" id="url"
                                           placeholder="facebook.com"
                                           <?php if(isset($item)): ?> value="<?php echo e($item->url); ?>" <?php endif; ?> />
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

<?php echo $__env->make('pages.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\OSPanel\domains\friezer-backend\resources\views/pages/cookie_settings/item.blade.php ENDPATH**/ ?>