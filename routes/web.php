<?php

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
