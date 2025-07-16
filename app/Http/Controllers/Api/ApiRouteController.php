<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Route;
use App\Models\Driver;
use App\Models\Client;
use Illuminate\Http\Request;

class ApiRouteController extends Controller
{
     // List all routes with associated drivers and clients
    public function index()
    {
        $routes = Route::with(['driver', 'client'])->get();
        return response()->json(['success' => true, 'data' => $routes], 200);
    }

    // Show specific route
    public function show($id)
    {
        $route = Route::with(['driver', 'client'])->findOrFail($id);
        return response()->json(['success' => true, 'data' => $route], 200);
    }

    // Store a new route
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'pickup_location' => 'required|string|max:255',
            'dropoff_location' => 'required|string|max:255',
            'pickup_time' => 'required|date',
            'dropoff_time' => 'required|date|after:pickup_time',
            'fare_amount' => 'required|numeric',
            'distance_km' => 'required|numeric',
            'driver_id' => 'required|exists:drivers,id',
            'client_id' => 'required|exists:clients,id',
            'status' => 'required|in:Completed,Cancelled,In Progress',
        ]);

        $route = Route::create($validatedData);
        return response()->json(['success' => true, 'message' => 'Route created successfully', 'data' => $route], 201);
    }

    // Update an existing route
    public function update(Request $request, $id)
    {
        $route = Route::findOrFail($id);

        $validatedData = $request->validate([
            'pickup_location' => 'required|string|max:255',
            'dropoff_location' => 'required|string|max:255',
            'pickup_time' => 'required|date',
            'dropoff_time' => 'required|date|after:pickup_time',
            'fare_amount' => 'required|numeric',
            'distance_km' => 'required|numeric',
            'driver_id' => 'required|exists:drivers,id',
            'client_id' => 'required|exists:clients,id',
            'status' => 'required|in:Completed,Cancelled,In Progress',
        ]);

        $route->update($validatedData);
        return response()->json(['success' => true, 'message' => 'Route updated successfully', 'data' => $route], 200);
    }

    // Delete a route
    public function destroy($id)
    {
        $route = Route::findOrFail($id);
        $route->delete();

        return response()->json(['success' => true, 'message' => 'Route deleted successfully'], 200);
    }
}
