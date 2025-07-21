<?php $__env->startSection('content'); ?>
    <div class="container py-4">

        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-header" style="background-color: #FF7B25; color: #FFF3E0;">
                        <h4 class="mb-0 text-center">Make a Reservation</h4>
                    </div>
                    <div class="card-body" style="background-color: #FFF8F0;">
                        <p class="text-center mb-4 text-muted">Fill in the details below for restaurant ID: <strong><?php echo e($restaurant_id); ?></strong></p>

                        <!-- Reservation Form -->
                        <form method="POST" action="<?php echo e(route('reservations.store', $restaurant_id)); ?>">
                            <?php echo csrf_field(); ?>

                            <div class="mb-3">
                                <label for="date" class="form-label fw-bold text-orange">Date</label>
                                <input type="date" class="form-control border-orange" id="date" name="date" required>
                            </div>
                            <div class="mb-3">
                                <label for="time" class="form-label fw-bold text-orange">Time</label>
                                <input type="time" class="form-control border-orange" id="time" name="time" required>
                            </div>
                            <div class="mb-3">
                                <label for="guests" class="form-label fw-bold text-orange">Number of Guests</label>
                                <input type="number" class="form-control border-orange" id="guests" name="guests" min="1" max="10" required>
                            </div>
                            <div class="mb-3">
                                <label for="notes" class="form-label fw-bold text-orange">Special Requests</label>
                                <textarea class="form-control border-orange" id="notes" name="notes" rows="3"></textarea>
                            </div>
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn" style="background-color: #FF7B25; color: #FFF3E0;">Confirm Reservation</button>
                                <a href="<?php echo e(route('customer.main')); ?>" class="btn btn-outline-orange mt-2">Back to Home</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .text-orange {
            color: #FF7B25;
        }
        .border-orange {
            border: 1px solid #FF7B25;
        }
        .btn-outline-orange {
            border: 1px solid #FF7B25;
            color: #FF7B25;
        }
        .btn-outline-orange:hover {
            background-color: #FF7B25;
            color: #FFF3E0;
        }
    </style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\wamp64\www\web_project\restaurantExample\resources\views/restaurants/reserve.blade.php ENDPATH**/ ?>