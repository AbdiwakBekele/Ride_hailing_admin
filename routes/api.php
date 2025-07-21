<?php

use App\Http\Controllers\UserAuthController;
use App\Http\Controllers\Api\ApiCarController;
use App\Http\Controllers\Api\ApiDriverController;
use App\Http\Controllers\Api\ApiRouteController;
use App\Http\Controllers\Api\ApiClientController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
Route::get('/login',[UserAuthController::class, 'login_get']);
Route::post('/login',[UserAuthController::class, 'login_post']);
Route::post('/register',[UserAuthController::class, 'register']);
Route::post('/logout',[UserAuthController::class, 'logout'])->middleware('auth:sanctum');
Route::apiResource('cars', ApiCarController::class);
Route::apiResource('drivers', ApiDriverController::class);
Route::apiResource('routes', ApiRouteController::class);
Route::apiResource('clients', ApiClientController::class);

Route::middleware(['driver'])->group(function () {}
  Route::apiResource('drivers', ApiDriverController::class);
);
//Test
