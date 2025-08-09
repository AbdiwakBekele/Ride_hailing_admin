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

// --- Driver Routes ---
// Specific routes should come before resource routes to avoid conflicts.
Route::post('/drivers/register', [ApiDriverController::class, 'register']);
Route::post('/drivers/login', [ApiDriverController::class, 'login']);
Route::post('/drivers/logout', [ApiDriverController::class, 'logout'])->middleware('auth:driver');

// --- Client Routes ---
Route::post('/clients/register', [ApiClientController::class, 'register']) ->withoutMiddleware(['web']);;
Route::post('/clients/login', [ApiClientController::class, 'login']);
Route::post('/clients/logout', [ApiClientController::class, 'logout']);
// Document Upload Routes
Route::post('/drivers/documents/national-id', [ApiDriverController::class, 'uploadNationalId'])->middleware('auth:driver');
Route::post('/drivers/documents/license', [ApiDriverController::class, 'uploadLicense'])->middleware('auth:driver');
Route::post('/drivers/documents/insurance', [ApiDriverController::class, 'uploadInsurance'])->middleware('auth:driver');
Route::post('/drivers/documents/picture', [ApiDriverController::class, 'uploadPicture'])->middleware('auth:driver');

// Toggle Driver Status Route
Route::put('/drivers/status', [ApiDriverController::class, 'toggleStatus'])->middleware('auth:driver');

// General Driver Resource Route
Route::apiResource('drivers', ApiDriverController::class)->except(['store']);




Route::apiResource('clients', ApiClientController::class);


// --- Other Routes ---
Route::apiResource('cars', ApiCarController::class);
Route::apiResource('routes', ApiRouteController::class);

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
