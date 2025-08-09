<?php

namespace App\Http\Controllers\Api;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\Controller;
use App\Events\DriverAcceptsRideEvent;
use App\Events\DriverLocationUpdatedEvent;
use App\Events\RideRequestEvent;
use App\Events\RideAcceptedEvent;
use App\Events\RideCompletedEvent;
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
    // public function store(Request $request)
    // {
    //     $validatedData = $request->validate([
    //         'pickup_location' => 'required|string|max:255',
    //         'dropoff_location' => 'required|string|max:255',
    //         'pickup_time' => 'required|date',
    //         'dropoff_time' => 'required|date|after:pickup_time',
    //         'fare_amount' => 'required|numeric',
    //         'distance_km' => 'required|numeric',
    //         'driver_id' => 'required|exists:drivers,id',
    //         'client_id' => 'required|exists:clients,id',
    //         'status' => 'required|in:Completed,Cancelled,In Progress',
    //     ]);

    //     $route = Route::create($validatedData);
    //     return response()->json(['success' => true, 'message' => 'Route created successfully', 'data' => $route], 201);
    // }

    // Update an existing route
    // public function update(Request $request, $id)
    // {
    //     $route = Route::findOrFail($id);

    //     $validatedData = $request->validate([
    //         'pickup_location' => 'required|string|max:255',
    //         'dropoff_location' => 'required|string|max:255',
    //         'pickup_time' => 'required|date',
    //         'dropoff_time' => 'required|date|after:pickup_time',
    //         'fare_amount' => 'required|numeric',
    //         'distance_km' => 'required|numeric',
    //         'driver_id' => 'required|exists:drivers,id',
    //         'client_id' => 'required|exists:clients,id',
    //         'status' => 'required|in:Completed,Cancelled,In Progress',
    //     ]);

    //     $route->update($validatedData);
    //     return response()->json(['success' => true, 'message' => 'Route updated successfully', 'data' => $route], 200);
    // }

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
    $mapsApiKey = config('services.google_maps.api_key'); // Store your API key in config/services.php
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
        'client_id' => $request->client_id,
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

public function acceptRide(Request $request)
{
    // Validate the request
    $validator = Validator::make($request->all(), [
        'route_id' => 'required|string|exists:routes,id',
        'driver_id' => 'required|string|exists:drivers,id',
    ]);

    if ($validator->fails()) {
        return response()->json($validator->errors(), 422);
    }

    // Lock the ride and update status
    $ride = Route::find($request->ride_id);
    $ride->driver_id = $request->driver_id;
    $ride->status = 'accepted';
    $ride->save();

    // Fetch driver details
    $driver = Driver::find($request->driver_id);

    // Notify the rider with driver details
    event(new RideAcceptedEvent(
        $route->id,
        $driver->id,
        $driver->name,
        [
            'model' => $driver->vehicle_model,
            'plate' => $driver->vehicle_plate,
            'color' => $driver->vehicle_color,
        ],
        [
            'lat' => $driver->location->getLat(),
            'lng' => $driver->location->getLng(),
        ],
        3 // Example ETA
    ));

    return response()->json(['message' => 'Ride accepted successfully!', 'ride' => $ride], 200);
}

public function updateDriverLocation(Request $request)
{
    // Validate the request as before
    $validator = Validator::make($request->all(), [
        'driver_id' => 'required|string|exists:drivers,id',
        'route_id' => 'required|string|exists:routes,id',
        'current_location.lat' => 'required|numeric',
        'current_location.lng' => 'required|numeric',
    ]);

    if ($validator->fails()) {
        return response()->json($validator->errors(), 422);
    }

    // Find the ride and update driver's location
    $ride = Route::find($request->ride_id);
    // Update driver's location in the database (not shown here)

    // Notify the rider with the updated location
    event(new DriverLocationUpdatedEvent(
        $route->id,
        $request->driver_id,
        $request->current_location['lat'],
        $request->current_location['lng']
    ));

    return response()->json(['message' => 'Driver location updated successfully!'], 200);
}

public function startRide(Request $request)
{
    // Validate the request
    $validator = Validator::make($request->all(), [
        'ride_id' => 'required|string|exists:rides,id',
        'driver_id' => 'required|string|exists:drivers,id',
    ]);

    if ($validator->fails()) {
        return response()->json($validator->errors(), 422);
    }

    // Find the ride and update status to 'in_progress'
    $ride = Ride::find($request->ride_id);
    
    // Check if the ride is already in progress or completed
    if ($ride->status !== 'accepted') {
        return response()->json(['message' => 'Ride cannot be started.'], 400);
    }

    $ride->status = 'in_progress';
    $ride->save();

    // Optionally, you can dispatch an event to notify the rider
    // event(new RideStartedEvent($ride->id, $request->driver_id));

    return response()->json(['message' => 'Ride started successfully!'], 200);
}

public function completeRide(Request $request)
{
    // Validate the request
    $validator = Validator::make($request->all(), [
        'ride_id' => 'required|string|exists:rides,id',
        'actual_fare' => 'required|numeric|min:0',
        'distance_travelled_km' => 'required|numeric|min:0',
        'duration_minutes' => 'required|integer|min:0',
    ]);

    if ($validator->fails()) {
        return response()->json($validator->errors(), 422);
    }

    // Find the ride and update status to 'completed'
    $ride = Ride::find($request->ride_id);

    // Check if the ride is currently in progress
    if ($ride->status !== 'in_progress') {
        return response()->json(['message' => 'Ride cannot be completed.'], 400);
    }

    // Update ride details
    $ride->status = 'completed';
    $ride->actual_fare = $request->actual_fare;
    $ride->distance_travelled_km = $request->distance_travelled_km;
    $ride->duration_minutes = $request->duration_minutes;
    $ride->save();

    // Notify the rider (client) about the completed ride
    event(new RideCompletedEvent(
        $ride->id,
        $ride->client_id, // Assuming the client_id is stored in the ride
        $request->actual_fare,
        $request->distance_travelled_km,
        $request->duration_minutes
    ));

    return response()->json(['message' => 'Ride completed successfully!'], 200);
}

private function calculateFare($distance, $carType)
{
    // Basic fare calculation logic
    $baseFare = 50; // Base fare
    $perKmRate = ($carType === 'sedan') ? 10 : 15; // Example rates

    return round($baseFare + ($distance * $perKmRate), 2); // Round to 2 decimal places
}
}
