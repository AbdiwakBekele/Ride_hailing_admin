<?php
use App\Http\Controllers\DriverController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\RouteController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminAuthController;

// Route::get('/', function () {
//     return view('welcome');
// });
Route::group(['middleware' => 'web'], function () {
   Route::get('admin-dashboard',[AdminController::class, 'index'])->name('admin.dashboard');
   Route::get('logout', [AdminAuthController::class, 'logout'])->name('admin.logout');
});

Route::get('admin-login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('admin-login', [AdminAuthController::class, 'login'])->name('admin.login.submit');
Route::get('/', [AdminAuthController::class, 'showRegisterForm'])->name('admin.register');
Route::post('admin-register', [AdminAuthController::class, 'register'])->name('admin.register.submit');
// Drivers Routes
Route::resource('drivers', DriverController::class)->names([
    'index' => 'drivers.index',
    'create' => 'drivers.create',
    'store' => 'drivers.store',
    'show' => 'drivers.show',
    'edit' => 'drivers.edit',
    'update' => 'drivers.update',
    'destroy' => 'drivers.destroy',
]);

// Clients Routes
Route::resource('clients', ClientController::class)->names([
    'index' => 'clients.index',
    'create' => 'clients.create',
    'store' => 'clients.store',
    'show' => 'clients.show',
    'edit' => 'clients.edit',
    'update' => 'clients.update',
    'destroy' => 'clients.destroy',
]);

// Cars Routes
Route::resource('cars', CarController::class)->names([
    'index' => 'cars.index',
    'create' => 'cars.create',
    'store' => 'cars.store',
    'show' => 'cars.show',
    'edit' => 'cars.edit',
    'update' => 'cars.update',
    'destroy' => 'cars.destroy',
]);

// Routes Routes
Route::resource('routes', RouteController::class)->names([
    'index' => 'routes.index',
    'create' => 'routes.create',
    'store' => 'routes.store',
    'show' => 'routes.show',
    'edit' => 'routes.edit',
    'update' => 'routes.update',
    'destroy' => 'routes.destroy',
]);
