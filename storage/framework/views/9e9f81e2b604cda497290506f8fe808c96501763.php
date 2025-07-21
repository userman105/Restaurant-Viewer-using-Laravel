<?php $__env->startSection('content'); ?>
    <div class="container py-4">
        <h2 class="mb-4">My Reservations</h2>

        <?php if($reservations->count()): ?>
            <div class="list-group">
                <?php $__currentLoopData = $reservations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $reservation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="list-group-item">
                        <strong>Restaurant #<?php echo e($reservation->restaurant_id); ?></strong><br>
                        Date: <?php echo e($reservation->date); ?><br>
                        Time: <?php echo e($reservation->time); ?><br>
                        Guests: <?php echo e($reservation->guests); ?><br>
                        Status: <?php echo e(ucfirst($reservation->status)); ?>

                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

            <a href="<?php echo e(route('customer.main')); ?>" class="btn btn-orange">
                Main Page
            </a>

        <?php else: ?>
            <p class="text-muted">You have no reservations yet.</p>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\wamp64\www\web_project\restaurantExample\resources\views/reservations/index.blade.php ENDPATH**/ ?>