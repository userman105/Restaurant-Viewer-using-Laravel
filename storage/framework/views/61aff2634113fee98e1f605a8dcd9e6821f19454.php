<?php $__env->startSection('content'); ?>
    <div class="container py-4">
        <h2 class="mb-4 text-orange">Manage Orders</h2>

        <?php if(session('success')): ?>
            <div class="alert alert-success"><?php echo e(session('success')); ?></div>
        <?php endif; ?>

        <?php if($orders->isEmpty()): ?>
            <p>No orders available for your restaurants.</p>
        <?php else: ?>

            <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="card mb-3">
                    <div class="card-body">
                        <h5>Order ID: <?php echo e($order->id); ?></h5>
                        <p>Total Amount: $<?php echo e($order->total_amount); ?></p>
                        <p>Status: <?php echo e($order->status); ?></p>

                        <?php if($order->customer): ?>
                            <p><strong>Customer Email:</strong> <?php echo e($order->customer->Email); ?></p>
                            <p><strong>Customer Phone:</strong> <?php echo e($order->customer->PhoneNo); ?></p>
                            <p><strong>Customer Address:</strong> <?php echo e($order->customer->Address ?? 'No address available'); ?></p>
                        <?php else: ?>
                            <p>No customer info available.</p>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Restaurant</th>
                    <th>Customer</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Change Status</th>
                </tr>
                </thead>
                <tbody>
                <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($order->id); ?></td>
                        <td><?php echo e($order->restaurant->name); ?></td>
                        <td><?php echo e($order->user->name); ?></td>
                        <td>$<?php echo e($order->total_amount); ?></td>
                        <td><?php echo e($order->status); ?></td>
                        <td>
                            <form action="<?php echo e(route('employee.orders.updateStatus', $order)); ?>" method="POST">
                                <?php echo csrf_field(); ?>
                                <select name="status" class="form-select form-select-sm d-inline w-auto">
                                    <option value="pending" <?php echo e($order->status == 'pending' ? 'selected' : ''); ?>>Pending</option>
                                    <option value="preparing" <?php echo e($order->status == 'preparing' ? 'selected' : ''); ?>>Preparing</option>
                                    <option value="ready" <?php echo e($order->status == 'ready' ? 'selected' : ''); ?>>Ready</option>
                                    <option value="delivered" <?php echo e($order->status == 'delivered' ? 'selected' : ''); ?>>Delivered</option>
                                    <option value="cancelled" <?php echo e($order->status == 'cancelled' ? 'selected' : ''); ?>>Cancelled</option>
                                </select>
                                <button type="submit" class="btn btn-sm btn-orange">Update</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        <?php endif; ?>
        <a href="<?php echo e(route('employee.dashboard')); ?>" class="text-orange">Back to Dashboard</a>
    </div>

    <style>
        .text-orange {
            color: #FF7B25;
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

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\wamp64\www\web_project\restaurantExample\resources\views/employee/orders.blade.php ENDPATH**/ ?>