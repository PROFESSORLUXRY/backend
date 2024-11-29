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
                                <?php endif; ?> User</h5>
                        </div>
                        <div class="card-body">
                            <form action="<?php echo e(route('users.create.action')); ?>" method="POST">
                                <?php if(isset($item)): ?>
                                    <input type="text" class="form-control" name="id" value="<?php echo e($item->id); ?>" hidden/>
                                <?php endif; ?>

                                <div class="mb-3">
                                    <label class="form-label" for="name">Name</label>
                                    <input type="text" class="form-control" name="name" id="name" placeholder=""
                                           <?php if(isset($item)): ?> value="<?php echo e($item->name); ?>" <?php endif; ?> />
                                </div>

                                <div class="mb-3">
                                    <label class="form-label" for="password">Password</label>
                                    <input type="password" class="form-control" name="password" id="password"/>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label" for="referral_code">Referral Code</label>
                                    <input type="text" class="form-control" name="referral_code" id="referral_code"
                                           <?php if(isset($item)): ?> value="<?php echo e($item->referral_code); ?>" <?php endif; ?>/>
                                </div>

                                <?php if(auth()->user()->role->slug === 'admin'): ?>
                                    <div class="mb-3">
                                        <label class="form-label" for="role_id">Role</label>
                                        <select class="select2 form-select" name="role_id">
                                            <?php $__currentLoopData = \App\Models\Role::query()->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option <?php if(isset($item) && $item->role_id === $role->id): ?> selected
                                                        <?php endif; ?> value="<?php echo e($role->id); ?>">
                                                    <?php echo e($role->name); ?>

                                                </option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                <?php endif; ?>

                                <?php if(auth()->user()->role->slug === 'admin'): ?>
                                    <div class="mb-3">
                                        <label class="form-label" for="manager_id">Manager</label>
                                        <select class="select2 form-select" name="manager_id">
                                            <?php $__currentLoopData = \App\Models\User::query()->where('role_id', \App\Models\Role::query()->where('slug', 'manager')->value('id'))->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $manager): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option <?php if(isset($item) && $item->manager_id === $manager->id): ?> selected
                                                        <?php endif; ?> value="<?php echo e($manager->id); ?>">
                                                    <?php echo e($manager->name); ?>

                                                </option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
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

<?php echo $__env->make('pages.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\OSPanel\domains\friezer-backend\resources\views/pages/users/item.blade.php ENDPATH**/ ?>