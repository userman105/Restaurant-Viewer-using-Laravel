<?php $__env->startSection('content'); ?>
    <div class="container py-4">
        <h2 class="mb-4 text-orange">My Restaurants</h2>

        <?php if($restaurants->isEmpty()): ?>
            <p>You are not associated with any restaurants yet.</p>
        <?php else: ?>
            <div class="row">
                <?php $__currentLoopData = $restaurants; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $restaurant): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-md-4 mb-4">
                        <div class="card h-100 border-orange">
                            <div class="card-body">
                                <h5 class="card-title text-orange"><?php echo e($restaurant->name); ?></h5>
                                <p class="card-text"><?php echo e($restaurant->description); ?></p>
                                <p class="card-text"><strong>City:</strong> <?php echo e($restaurant->city); ?></p>
                                <p class="card-text"><strong>Cuisine:</strong> <?php echo e($restaurant->cuisine_type); ?></p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        <?php endif; ?>
        <a href="<?php echo e(route('employee.dashboard')); ?>" class="text-orange">Back to Dashboard</a>
    </div>

    <style>
        .text-orange {
            color: #FF7B25;
        }
        .border-orange {
            border: 1px solid #FF7B25;
        }
    </style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\wamp64\www\web_project\restaurantExample\resources\views/employee/my_restaurants.blade.php ENDPATH**/ ?>