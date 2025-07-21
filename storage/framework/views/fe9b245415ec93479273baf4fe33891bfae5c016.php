<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Restaurants</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        body {
            background-color: #fff7f0;
            color: #4a4a4a;
        }

        .restaurant-item {
            border-left: 6px solid #fd7e14;
            border-radius: 12px;
            background-color: #fff;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
            transition: transform 0.2s ease-in-out;
        }

        .restaurant-item:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }

        .restaurant-name {
            color: #e65100;
        }

        .btn-outline-primary {
            border-color: #fd7e14;
            color: #fd7e14;
        }

        .btn-outline-primary:hover {
            background-color: #fd7e14;
            color: #fff;
        }

        .btn-primary {
            background-color: #fd7e14;
            border: none;
        }

        .btn-primary:hover {
            background-color: #e65100;
        }

        .restaurant-list {
            margin-top: 40px;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand text-orange fw-bold" href="#">Welcome to the home screen!</a>
        <a href="<?php echo e(route('customer.main')); ?>" class="text-orange">Main Page</a>
        <div class="ms-auto d-flex align-items-center">
            <a href="<?php echo e(route('orders.index')); ?>" class="btn btn-orange me-3">My Orders</a>

            <!-- 🆕 New Button -->
            <a href="<?php echo e(route('reservations.index')); ?>" class="btn btn-orange me-3">My Reservations</a>

            <div class="dropdown">
                <button class="btn btn-outline-orange dropdown-toggle" type="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    <?php echo e(Auth::user()->name); ?>

                </button>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                    <li>
                        <form method="POST" action="<?php echo e(route('logout')); ?>">
                            <?php echo csrf_field(); ?>
                            <button type="submit" class="dropdown-item">Logout</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>

<div class="container py-4">
    <form method="GET" action="<?php echo e(route('customer.main')); ?>" class="mb-4">
        <div class="input-group">
            <input type="text" name="search" class="form-control border-orange" placeholder="Search for a restaurant..." value="<?php echo e(request('search')); ?>">
            <button class="btn btn-orange" type="submit">Search</button>
        </div>
    </form>


<div class="offcanvas offcanvas-start" tabindex="-1" id="filterDrawer" aria-labelledby="filterDrawerLabel">
    <div class="offcanvas-header">
        <h5 id="filterDrawerLabel">Filter by Cuisine</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"></button>
    </div>
    <div class="offcanvas-body">
        <form method="GET" action="<?php echo e(route('customer.main')); ?>">
            <div class="list-group">

                <?php $__currentLoopData = ['Sandwich', 'Pizza', 'Sea Food', 'Asian', 'Dessert']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <label class="list-group-item">
                        <input class="form-check-input me-1" type="radio" name="cuisine_type" value="<?php echo e($type); ?>" <?php echo e(request('cuisine_type') == $type ? 'checked' : ''); ?>>
                        <?php echo e($type); ?>

                    </label>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            </div>

            <div class="mt-3 d-grid gap-2">
                <button type="submit" class="btn btn-orange">Apply Filter</button>
                <a href="<?php echo e(route('customer.main')); ?>" class="btn btn-outline-secondary">Clear Filter</a>
            </div>
        </form>
    </div>
</div>

<!-- Button to open Filter -->
<div class="container mt-4">
    <div class="d-flex justify-content-end mb-3">
        <button class="btn btn-outline-orange" type="button" data-bs-toggle="offcanvas" data-bs-target="#filterDrawer">
            Filter Restaurants
        </button>
    </div>

    <!-- Optional: Show active filter -->
    <?php if(request('cuisine_type')): ?>
        <div class="alert alert-info">
            Showing restaurants for: <strong><?php echo e(request('cuisine_type')); ?></strong>
        </div>
    <?php endif; ?>
</div>

<!-- Restaurant List -->
<div class="container restaurant-list">
    <?php $__currentLoopData = $restaurants; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $restaurant): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="restaurant-item p-4 mb-4">
            <div class="row align-items-center">
                <div class="col-md-2 mb-3 mb-md-0">
                    <img src="<?php echo e(asset('storage/' . $restaurant->image)); ?>" alt="<?php echo e($restaurant->name); ?>" class="img-fluid rounded">
                </div>
                <div class="col-md-7 mb-3 mb-md-0">
                    <h5 class="restaurant-name"><?php echo e($restaurant->name); ?></h5>
                    <div class="restaurant-cuisine text-muted mb-2">
                        <?php echo e($restaurant->cuisine_type); ?> • <?php echo e($restaurant->rating); ?> ★ •
                        <span class="text-warning fw-semibold"><?php echo e($restaurant->price_range_formatted); ?></span>
                    </div>
                    <p class="restaurant-description mb-2"><?php echo e($restaurant->description); ?></p>
                    <div class="restaurant-details small text-muted">
                        <div><i class="bi bi-geo-alt-fill"></i> <?php echo e($restaurant->address); ?>, <?php echo e($restaurant->city); ?></div>
                        <div><i class="bi bi-clock-fill"></i> <?php echo e($restaurant->opening_hours); ?></div>
                        <div><i class="bi bi-phone-fill"></i> <?php echo e($restaurant->phone); ?></div>
                    </div>
                </div>
                <div class="col-md-3 d-flex flex-column justify-content-center">
                    <?php if($restaurant->reservation_available): ?>
                        <a href="<?php echo e(route('restaurants.reserve', $restaurant->id)); ?>" class="btn btn-outline-primary mb-2">
                            <i class="bi bi-calendar-check"></i> Reserve
                        </a>
                    <?php else: ?>
                        <button class="btn btn-outline-secondary mb-2" disabled>
                            <i class="bi bi-calendar-x"></i> No Reservations
                        </button>
                    <?php endif; ?>

                    <?php if($restaurant->delivery_available || $restaurant->takeout_available): ?>
                        <a href="<?php echo e(route('restaurants.order', $restaurant->id)); ?>" class="btn btn-primary">
                            <i class="bi bi-bag"></i> Order Now
                        </a>
                    <?php else: ?>
                        <button class="btn btn-secondary" disabled>
                            <i class="bi bi-bag-x"></i> No Ordering
                        </button>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.js"></script>
<?php if(session('success')): ?>
    <div class="alert alert-success">
        <?php echo e(session('success')); ?>

    </div>
<?php endif; ?>
</body>
</html>
<?php /**PATH D:\wamp64\www\web_project\restaurantExample\resources\views/customer/main.blade.php ENDPATH**/ ?>