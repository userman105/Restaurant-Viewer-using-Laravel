<?php $__env->startSection('content'); ?>
    <div class="container py-4">
        <h2 class="mb-4 text-orange">Manage Reservations</h2>

        <?php if(session('success')): ?>
            <div class="alert alert-success"><?php echo e(session('success')); ?></div>
        <?php endif; ?>

        <?php if($reservations->isEmpty()): ?>
            <p>No reservations found for your restaurants.</p>
        <?php else: ?>
            <?php $__currentLoopData = $reservations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $reservation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>  
            <div class="card mb-3">
                <div class="card-body">
                    <h5>Reservation ID: <?php echo e($reservation->id); ?></h5>
                    <p>Total Amount: $<?php echo e($reservation->total_amount); ?></p>
                    <p>Status: <?php echo e($reservation->status); ?></p>

                    <?php if($reservation->customer): ?>
                    <p><strong>Customer Email:</strong> <?php echo e($reservation->customer->Email); ?></p>
                    <p><strong>Customer Phone:</strong> <?php echo e($reservation->customer->PhoneNo); ?></p>
                    <p><strong>Customer Address:</strong> <?php echo e($reservation->customer->Address ?? 'No address available'); ?></p>
                    <?php else: ?>
                        <p>No customer info available.</p>
                    <?php endif; ?>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>Restaurant ID</th>
                    <th>User ID</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Guests</th>
                    <th>Special Requests</th>
                    <th>Status</th>
                    <th>Update Status</th>
                </tr>
                </thead>
                <tbody>
                <?php $__currentLoopData = $reservations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $reservation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>  <!-- Changed from $orders to $reservations -->
                <tr>
                    <td><?php echo e($reservation->restaurant_id); ?></td>
                    <td><?php echo e($reservation->user_id); ?></td>
                    <td><?php echo e($reservation->date); ?></td>
                    <td><?php echo e($reservation->time); ?></td>
                    <td><?php echo e($reservation->guests); ?></td>
                    <td><?php echo e($reservation->special_requests); ?></td>
                    <td><?php echo e($reservation->status); ?></td>
                    <td>
                        <form method="POST" action="<?php echo e(route('employee.reservations.update', $reservation->id)); ?>">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('PUT'); ?>

                            <select name="status" class="form-select mb-2">
                                <option value="pending" <?php echo e($reservation->status == 'pending' ? 'selected' : ''); ?>>Pending</option>
                                <option value="confirmed" <?php echo e($reservation->status == 'confirmed' ? 'selected' : ''); ?>>Confirmed</option>
                                <option value="cancelled" <?php echo e($reservation->status == 'cancelled' ? 'selected' : ''); ?>>Cancelled</option>
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
        .text-orange { color: #FF7B25; }
        .btn-orange { background-color: #FF7B25; color: white; }
        .btn-orange:hover { background-color: #e96b0b; }
    </style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\wamp64\www\web_project\restaurantExample\resources\views/employee/reservations.blade.php ENDPATH**/ ?>