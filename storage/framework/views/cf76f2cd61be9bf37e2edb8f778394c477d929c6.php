<?php $__env->startSection('content'); ?>
    <div class="container py-4">
        <h3 class="mb-4">My Orders</h3>

        <?php $__empty_1 = true; $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="card mb-3">
                <div class="card-body">
                    <h5>Order #<?php echo e($order->id); ?></h5>
                    <p>Status: <strong><?php echo e(ucfirst($order->status)); ?></strong></p>
                    <p>Total: $<?php echo e(number_format($order->total_amount, 2)); ?></p>
                    <p>Delivery Address: <?php echo e($order->delivery_address); ?></p>
                    <small class="text-muted">Ordered on <?php echo e($order->created_at->format('M d, Y h:i A')); ?></small>
                </div>
            </div>

            <a href="<?php echo e(route('customer.main')); ?>" class="btn btn-orange">
                Main Page
            </a>

        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <p>You have no orders yet.</p>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\wamp64\www\web_project\restaurantExample\resources\views/orders/index.blade.php ENDPATH**/ ?>