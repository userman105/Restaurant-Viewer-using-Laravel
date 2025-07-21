<?php

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\CustomerSetupController;
use App\Http\Controllers\ReservationController;
use App\Models\Restaurant;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\EmployeeDashboardController;
use App\Http\Controllers\EmployeeController;


Route::get('/register/customer', [RegisterController::class, 'showCustomerRegistrationForm'])
    ->name('register.customer');
Route::post('/register/customer', [RegisterController::class, 'registerCustomer']);


Route::get('/register/employee', [RegisterController::class, 'showEmployeeRegistrationForm'])
    ->name('register.employee');
Route::post('/register/employee', [RegisterController::class, 'registerEmployee']);

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/', function () {
    return view('welcome');
});



Route::get('/employee/dashboard', [EmployeeDashboardController::class, 'index'])->name('employee.dashboard');
Route::post('/employee/dashboard/store', [EmployeeDashboardController::class, 'store'])->name('employee.dashboard.store');

Route::get('/customer/main', [App\Http\Controllers\HomeController::class, 'index'])->name('customer.main');

Route::get('/customer/setup', [CustomerSetupController::class, 'showForm'])->name('customer.setup');
Route::post('/customer/setup', [CustomerSetupController::class, 'store'])->name('customer.store');

Route::get('/customer/restaurants/{id}/reserve', [App\Http\Controllers\RestaurantController::class, 'reserve'])->name('restaurants.reserve');
Route::get('/customer/restaurants/{id}/order', [App\Http\Controllers\RestaurantController::class, 'order'])->name('restaurants.order');
Route::get('/reservations', [ReservationController::class, 'index'])->name('reservations.index');


Route::post('/reservations/{restaurant}', [ReservationController::class, 'store'])->name('reservations.store');



Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::post('/checkout', [CartController::class, 'checkout'])->name('order.checkout');

Route::get('/my-orders', [\App\Http\Controllers\CartController::class, 'index'])->name('orders.index');

Route::get('/employee/my-restaurants', [EmployeeDashboardController::class, 'myRestaurants'])->name('employee.myRestaurants');

Route::get('/employee/orders', [EmployeeDashboardController::class, 'orders'])->name('employee.orders');
Route::post('/employee/orders/{order}/update-status', [EmployeeDashboardController::class, 'updateOrderStatus'])->name('employee.orders.updateStatus');

Route::get('/employee/menu-items', [EmployeeController::class, 'showMenuItems'])->name('employee.menu_items');
Route::post('/employee/menu-items', [EmployeeController::class, 'attachMenuItem'])->name('employee.menu_items.attach');

Route::get('/employee/reservations', [EmployeeController::class, 'myReservations'])->name('employee.reservations');
Route::put('/employee/reservations/{reservation}', [EmployeeController::class, 'updateReservation'])->name('employee.reservations.update');

Route::get('/employee/join-restaurant', [EmployeeController::class, 'joinRestaurantForm'])->name('employee.joinRestaurantForm');

Route::post('/employee/join-restaurant', [EmployeeController::class, 'joinRestaurant'])->name('employee.joinRestaurant');

require __DIR__.'/auth.php';
