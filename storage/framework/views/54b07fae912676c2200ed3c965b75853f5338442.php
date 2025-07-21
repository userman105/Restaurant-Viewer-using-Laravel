<?php $__env->startSection('content'); ?>
    <style>
        .bg-orange {
            background-color: #fd7e14 !important;
        }

        .text-orange {
            color: #fd7e14 !important;
        }

        .btn-orange {
            background-color: #fd7e14;
            color: white;
            border: none;
        }

        .btn-orange:hover {
            background-color: #e96b0b;
        }

        .btn-outline-orange {
            border-color: #fd7e14;
            color: #fd7e14;
        }

        .btn-outline-orange:hover {
            background-color: #fd7e14;
            color: white;
        }

        .badge-orange {
            background-color: #fd7e14;
            color: white;
        }
    </style>


    <div class="container py-4">

        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card shadow-sm">
                    <div class="card-header bg-orange text-white">
                        <h4 class="mb-0">Place an Order</h4>
                    </div>
                    <div class="card-body">

                        <h5 class="text-orange">Menu for Restaurant #<?php echo e($restaurant_id); ?></h5>

                        <?php if(session('success')): ?>
                            <div class="alert alert-success"><?php echo e(session('success')); ?></div>
                        <?php endif; ?>

                        <div class="menu-items mb-4">
                            <div class="list-group">
                                <?php $__empty_1 = true; $__currentLoopData = $menuItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <div class="list-group-item d-flex justify-content-between align-items-center">
                                        <div>
                                            <h6 class="mb-1"><?php echo e($item->name); ?></h6>
                                            <small class="text-muted"><?php echo e($item->description); ?></small>
                                        </div>
                                        <div class="d-flex align-items-center">
                                        <span class="badge badge-orange rounded-pill me-2">
                                            $<?php echo e(number_format($item->price, 2)); ?>

                                        </span>
                                            <form method="POST" action="<?php echo e(route('cart.add')); ?>">
                                                <?php echo csrf_field(); ?>
                                                <input type="hidden" name="item_id" value="<?php echo e($item->id); ?>">
                                                <input type="hidden" name="restaurant_id" value="<?php echo e($restaurant_id); ?>">
                                                <input type="number" name="quantity" value="1" min="1" class="form-control form-control-sm me-2" style="width: 60px;">
                                                <button type="submit" class="btn btn-sm btn-outline-orange">Add</button>
                                            </form>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <p class="text-muted">No menu items available for this restaurant.</p>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="order-summary mb-4">
                            <h5>Your Order</h5>
                            <div class="card">
                                <div class="card-body">
                                    <?php if(session('cart') && count(session('cart')) > 0): ?>
                                        <ul class="list-group mb-3">
                                            <?php $__currentLoopData = session('cart'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $itemId => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                                    <div>
                                                        Item #<?php echo e($itemId); ?> — Quantity: <?php echo e($item['quantity'] ?? 'N/A'); ?>

                                                    </div>
                                                </li>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </ul>
                                    <?php else: ?>
                                        <p class="text-center text-muted">Your cart is empty</p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>

                        <div class="d-grid gap-2">
                            <?php if(session('cart') && count(session('cart')) > 0): ?>
                                <form method="POST" action="<?php echo e(route('order.checkout')); ?>">
                                    <?php echo csrf_field(); ?>
                                 }
                                    <button type="submit" class="btn btn-orange">Proceed to Checkout</button>
                                </form>
                            <?php else: ?>
                                <button type="button" class="btn btn-orange" disabled>Proceed to Checkout</button>
                            <?php endif; ?>
                                <a href="<?php echo e(route('customer.main')); ?>" class="btn btn-outline-orange mt-2">Back to Home</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\wamp64\www\web_project\restaurantExample\resources\views/restaurants/order.blade.php ENDPATH**/ ?>