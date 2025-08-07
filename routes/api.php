<?php

use App\Http\Controllers\UserAuthController;
use App\Http\Controllers\Api\ApiCarController;
use App\Http\Controllers\Api\ApiDriverController;
use App\Http\Controllers\Api\ApiRouteController;
use App\Http\Controllers\Api\ApiClientController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');
// Route::get('/login',[UserAuthController::class, 'login_get']);
// Route::post('/login',[UserAuthController::class, 'login_post']);
// Route::post('/register',[UserAuthController::class, 'register']);
// Route::post('/logout',[UserAuthController::class, 'logout'])->middleware('auth:sanctum');
Route::apiResource('cars', ApiCarController::class);
Route::post('/drivers/register', [ApiDriverController::class, 'register']);
Route::post('/drivers/login', [ApiDriverController::class, 'login']);
Route::post('/drivers/logout', [ApiDriverController::class, 'logout']);
Route::apiResource('drivers', ApiDriverController::class)->except(['store']);
Route::apiResource('routes', ApiRouteController::class);
Route::apiResource('clients', ApiClientController::class);
Route::post('/clients/register', [ApiClientController::class, 'register']) ->withoutMiddleware(['web']);;
Route::post('/clients/login', [ApiClientController::class, 'login']);
Route::post('/clients/logout', [ApiClientController::class, 'logout'])->middleware('auth:sanctum');



// Document Upload Routes
Route::post('/drivers/documents/national-id', [ApiDriverController::class, 'uploadNationalId']);
Route::post('/drivers/documents/license', [ApiDriverController::class, 'uploadLicense']);
Route::post('/drivers/documents/insurance', [ApiDriverController::class, 'uploadInsurance']);
Route::post('/drivers/documents/picture', [ApiDriverController::class, 'uploadPicture']);

// Toggle Driver Status Route
Route::post('/drivers/status', [ApiDriverController::class, 'toggleStatus']);


// Request Ride Route
Route::post('/rides/request', [ApiRouteController::class, 'requestRide']);

// estimate fare
Route::post('/rides/estimate', [ApiRouteController::class, 'estimateFare']);

// accept request

Route::post('/rides/accept',[ApiRouteController::class,'acceptRide']);

// Update Driver Location Route
Route::post('/rides/location/update', [ApiDriverController::class, 'updateDriverLocation']);

Route::post('/rides/start', [ApiDriverController::class, 'startRide']);

// Complete Ride Route
Route::post('/rides/complete', [ApiDriverController::class, 'completeRide']);
 
//Test
