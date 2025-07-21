<?php $__env->startSection('content'); ?>
    <div class="container py-4">
        <h2 class="mb-4">Join a Restaurant</h2>

        <?php if(session('success')): ?>
            <div class="alert alert-success"><?php echo e(session('success')); ?></div>
        <?php endif; ?>

        <form method="POST" action="<?php echo e(route('employee.joinRestaurant')); ?>">
            <?php echo csrf_field(); ?>
            <div class="mb-3">
                <label for="restaurant_id" class="form-label">Restaurant ID</label>
                <input type="number" name="restaurant_id" class="form-control" required>
            </div>
            <button type="submit" class="btn-orange">Join</button>
        </form>

        <a href="<?php echo e(route('employee.dashboard')); ?>" class="btn btn-orange mt-3">Back to Dashboard</a>
    </div>


    <style>
        .text-orange {
            color: #FF7B25;
        }
        .border-orange {
            border: 1px solid #FF7B25;
        }
        .btn-orange {
            background-color: #FF7B25;
            color: #FFF3E0;
            border: none;
        }
        .btn-orange:hover {
            background-color: #e96b0b;
        }
    </style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\wamp64\www\web_project\restaurantExample\resources\views/employee/joinRestaurant.blade.php ENDPATH**/ ?>