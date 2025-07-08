<?php

use App\Http\Controllers\UserAuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
Route::get('/login',[UserAuthController::class, 'login_get']);
Route::post('/login',[UserAuthController::class, 'login_post']);
Route::post('/register',[UserAuthController::class, 'register']);
Route::post('/logout',[UserAuthController::class, 'logout'])->middleware('auth:sanctum');

