<?php $__env->startSection('content'); ?>
    <div class="container py-4">
        <h2 class="text-orange mb-4">Attach Menu Item to Restaurant</h2>

        <?php if(session('success')): ?>
            <div class="alert alert-success"><?php echo e(session('success')); ?></div>
        <?php endif; ?>

        <form action="<?php echo e(route('employee.menu_items.attach')); ?>" method="POST">
            <?php echo csrf_field(); ?>

            <div class="mb-3">
                <label for="restaurant_id" class="form-label fw-bold text-orange">Select Restaurant</label>
                <select name="restaurant_id" class="form-select border-orange" required>
                    <?php $__currentLoopData = $restaurants; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $restaurant): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($restaurant->id); ?>"><?php echo e($restaurant->name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="menu_item_id" class="form-label fw-bold text-orange">Select Menu Item</label>
                <select name="menu_item_id" class="form-select border-orange" required>
                    <?php $__currentLoopData = $menuItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menuItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($menuItem->id); ?>"><?php echo e($menuItem->name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>

            <button type="submit" class="btn btn-orange">Attach Menu Item</button>
        </form>
        <a href="<?php echo e(route('employee.dashboard')); ?>" class="text-orange">Back to Dashboard</a>
    </div>

    <style>
        .text-orange { color: #FF7B25; }
        .border-orange { border: 1px solid #FF7B25; }
        .btn-orange { background-color: #FF7B25; color: white; }
        .btn-orange:hover { background-color: #e96b0b; }
    </style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\wamp64\www\web_project\restaurantExample\resources\views/employee/menu_items.blade.php ENDPATH**/ ?>