<?php

namespace App\Http\Controllers\Api;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\Controller;
use App\Models\Route;
use App\Models\Driver;
use App\Models\Client;
use Illuminate\Http\Request;
use Validator;

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

    // CREATE REQUEST 

    

public function requestRide(Request $request)
{
    // Validate the request
    $validator = Validator::make($request->all(), [
        'client_id' => 'required|string',
        'pickup_location.lat' => 'required|numeric',
        'pickup_location.lng' => 'required|numeric',
        'destination.lat' => 'required|numeric',
        'destination.lng' => 'required|numeric',
        'car_type' => 'required|string',
        'payment_method' => 'required|string',
    ]);

    if ($validator->fails()) {
        return response()->json($validator->errors(), 422);
    }

    // Extract pickup and destination coordinates
    $pickupLat = $request->pickup_location['lat'];
    $pickupLng = $request->pickup_location['lng'];
    $destLat = $request->destination['lat'];
    $destLng = $request->destination['lng'];

    // Call to Maps API to get distance and duration
    $mapsApiKey = config('services.maps.api_key'); // Store your API key in config/services.php
    $response = Http::get("https://maps.googleapis.com/maps/api/distancematrix/json", [
        'origins' => "{$pickupLat},{$pickupLng}",
        'destinations' => "{$destLat},{$destLng}",
        'key' => $mapsApiKey,
    ]);

    // Handle API response
    if ($response->successful()) {
        $data = $response->json();
        $distance = $data['rows'][0]['elements'][0]['distance']['value'] / 1000; // Convert to km
        $duration = $data['rows'][0]['elements'][0]['duration']['value'] / 60; // Convert to minutes
    } else {
        return response()->json(['error' => 'Unable to calculate distance and duration'], 500);
    }

    // Calculate fare
    $fare = $this->calculateFare($distance, $request->car_type);

    // Filter available drivers
    $availableDrivers = Driver::where('is_available', true)
        ->where('vehicle_type', $request->car_type)
        ->get();

    if ($availableDrivers->isEmpty()) {
        return response()->json(['message' => 'No available drivers'], 404);
    }

    // Create a ride entry
    $ride =Route::create([
        'user_id' => $request->user_id,
        'pickup_location' => DB::raw("POINT({$pickupLng} {$pickupLat})"),
        'destination' => DB::raw("POINT({$destLng} {$destLat})"),
        'car_type' => $request->car_type,
        'status' => 'searching',
        'fare' => $fare,
        'distance_km' => $distance,
        'duration_min' => $duration,
    ]);

    return response()->json($ride, 201);
}

// Calculate fare based on distance and car type


public function estimateFare(Request $request)
{
    // Validate the request
    $validator = Validator::make($request->all(), [
        'pickup_lat' => 'required|numeric',
        'pickup_lng' => 'required|numeric',
        'dest_lat' => 'required|numeric',
        'dest_lng' => 'required|numeric',
        'car_type' => 'required|string',
    ]);

    if ($validator->fails()) {
        return response()->json($validator->errors(), 422);
    }

    // Extract coordinates
    $pickupLat = $request->pickup_lat;
    $pickupLng = $request->pickup_lng;
    $destLat = $request->dest_lat;
    $destLng = $request->dest_lng;

    // Call to Maps API to get distance and duration
    $mapsApiKey = config('services.maps.api_key');
    $response = Http::get("https://maps.googleapis.com/maps/api/distancematrix/json", [
        'origins' => "{$pickupLat},{$pickupLng}",
        'destinations' => "{$destLat},{$destLng}",
        'key' => $mapsApiKey,
    ]);

    // Handle API response
    if ($response->successful()) {
        $data = $response->json();
        $distance = $data['rows'][0]['elements'][0]['distance']['value'] / 1000; // Convert to km
        $duration = $data['rows'][0]['elements'][0]['duration']['value'] / 60; // Convert to minutes

        // Estimate fare
        $fare = $this->calculateFare($distance, $request->car_type);

        return response()->json([
            'estimated_fare' => $fare,
            'distance_km' => $distance,
            'duration_minutes' => $duration,
            'currency' => 'ETB'
        ]);
    } else {
        return response()->json(['error' => 'Unable to calculate distance and duration'], 500);
    }
}

private function calculateFare($distance, $carType)
{
    // Basic fare calculation logic
    $baseFare = 50; // Base fare
    $perKmRate = ($carType === 'sedan') ? 10 : 15; // Example rates

    return round($baseFare + ($distance * $perKmRate), 2); // Round to 2 decimal places
}
}
