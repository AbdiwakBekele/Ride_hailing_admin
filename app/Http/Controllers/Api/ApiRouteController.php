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
use App\Models\Notification;
use App\Models\ClientNotification;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\DB;

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
    \Log::info($request->all());

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

    // Calculate distance and duration
    $distance = $this->calculateDistance($pickupLat, $pickupLng, $destLat, $destLng);
    $duration = $distance * 2; // Assuming an average speed

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
    try {
        $ride = Route::create([
            'client_id' => $request->client_id,
            'pickup_location' => DB::raw("ST_GeomFromText('POINT({$pickupLng} {$pickupLat})')"),
            'destination' => DB::raw("ST_GeomFromText('POINT({$destLng} {$destLat})')"),
            'car_type' => $request->car_type,
            'status' => 'In Progress',
            'fare' => $fare,
            'distance_km' => $distance,
            'duration_min' => $duration,
        ]);

        

        // Create notifications for each available driver and dispatch events
        foreach ($availableDrivers as $driver) {
            // Dispatch the event to notify the driver
            event(new RideRequestEvent(
                $ride->id,
                $request->pickup_location,
                $request->destination,
                $ride->fare,
                $request->car_type,
                $driver->id
            ));
        }

    } catch (\Exception $e) {
        \Log::error('Error creating ride: ' . $e->getMessage(), [
            'stack' => $e->getTraceAsString(),
        ]);
        return response()->json(['message' => 'Error creating ride'], 500);
    }

    return response()->json($ride, 201);
}

  

//     Notification::create([
//         'driver_id' => $driver->id,
//         'route_id' => $ride->id,
//         'client_name' => $client->full_name,
//         'client_contact' => $client->phone_number,
//         'pickup_location' => json_encode($ride->pickup_location),
//         'destination' => json_encode($ride->destination),
//         'estimated_fare' => $ride->fare,
//         'estimated_distance' => $ride->distance_km,
//         'estimated_duration' => $ride->duration_min,
//         'status' => 'pending',
//         'created_at' => now(),
//     ]);
// }



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

    // Use demo data for distance and duration
    // For simplicity, we can estimate distance as a simple calculation
    $distance = $this->calculateDistance($pickupLat, $pickupLng, $destLat, $destLng); // in kilometers
    $duration = $distance * 2; // Assuming an average speed of 30 km/h

    // Estimate fare
    $fare = $this->calculateFare($distance, $request->car_type);

    return response()->json([
        'estimated_fare' => $fare,
        'distance_km' => $distance,
        'duration_minutes' => $duration,
        'currency' => 'ETB'
    ]);
}

// Function to calculate distance between two coordinates (Haversine formula)
private function calculateDistance($lat1, $lng1, $lat2, $lng2)
{
    $earthRadius = 6371; // Earth radius in kilometers

    $latFrom = deg2rad($lat1);
    $lngFrom = deg2rad($lng1);
    $latTo = deg2rad($lat2);
    $lngTo = deg2rad($lng2);

    $latDelta = $latTo - $latFrom;
    $lngDelta = $lngTo - $lngFrom;

    $a = sin($latDelta / 2) * sin($latDelta / 2) +
         cos($latFrom) * cos($latTo) *
         sin($lngDelta / 2) * sin($lngDelta / 2);
    $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

    return $earthRadius * $c; // Distance in kilometers
}

/////////////////////////////////////////////////// ACCEPT RIDE//////////////////////////////////////////////////////////////////


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

    // Lock the ride and check its status
    $ride = Route::find($request->route_id);
    if (!$ride) {
        return response()->json(['message' => 'Ride not found'], 404);
    }

    // Check if the ride is already accepted
    if ($ride->status === 'Accepted') {
        return response()->json(['message' => 'This ride has already been accepted by another driver.'], 409);
    }

    // Assign the ride to the driver and update the status
    $ride->driver_id = $request->driver_id;
    $ride->status = 'Accepted';
    $ride->save();

    // Mark the driver as unavailable
    $driver = Driver::find($request->driver_id);
    if (!$driver) {
        return response()->json(['message' => 'Driver not found'], 404);
    }

    $driver->is_available = false; // Set driver to unavailable
    $driver->save();

    // Notify the client with driver details
    $this->notifyClient($ride, $driver);

    return response()->json([
        'message' => 'Ride accepted successfully.',
        'ride' => $ride,
        'driver' => [
            'name' => $driver->full_name,
            'vehicle_model' => $driver->vehicle_model, // Ensure this field exists
            'plate_number' => $driver->plate_number, // Ensure this field exists
            'color' => $driver->color, // Ensure this field exists
            'estimated_arrival_time' => $this->calculateEstimatedArrivalTime($ride), // Implement this method
        ],
    ], 200);
}
////////////////////////////////////////////notification logic////////////////////////////////////////////////////


private function notifyClient($ride, $driver)
{
    // Assuming you have a Client model and relationship set up
    $client = Client::find($ride->client_id);
    if ($client) {
        ClientNotification::create([
            'client_id' => $client->id,
            'message' => 'Your ride has been accepted by ' . $driver->full_name,
            'driver_name' => $driver->full_name,
            'vehicle_model' => $driver->vehicle_model,
            'plate_number' => $driver->plate_number,
            'color' => $driver->color,
            'estimated_arrival_time' => $this->calculateEstimatedArrivalTime($ride),
            'status' => 'pending',
            'created_at' => now(),
        ]);
    }
}

////////////////////////////////////////calculate estimated arrival time////////////////////////////////////////////////////



private function calculateEstimatedArrivalTime($ride)
{
    // Implement logic to calculate estimated arrival time based on distance and speed
    return '10 minutes'; // Example placeholder value
}

public function declineRide(Request $request)
{
    // Validate the request
    $validator = Validator::make($request->all(), [
        'route_id' => 'required|string|exists:routes,id',
        'driver_id' => 'required|string|exists:drivers,id',
    ]);

    if ($validator->fails()) {
        return response()->json($validator->errors(), 422);
    }

    // Lock the ride and check its status
    $ride = Route::find($request->route_id);
    if (!$ride) {
        return response()->json(['message' => 'Ride not found'], 404);
    }

    // Check if the ride is already accepted
    if ($ride->status === 'Accepted') {
        return response()->json(['message' => 'This ride has already been accepted and cannot be declined.'], 409);
    }

    // Remove the request from the driver's view and update status
    $ride->status = 'Available'; // Mark the ride as available again
    $ride->driver_id = null; // Remove the assigned driver
    $ride->save();

    // Optionally, you can notify other nearby drivers about the available ride here

    return response()->json([
        'message' => 'Ride declined successfully. You are now available for new requests.',
        'ride' => $ride,
    ], 200);
}
//////////////////////////////////////update driver location////////////////////////////////////////////////////



public function updateDriverLocation(Request $request)
{
    // Validate the request
    $validator = Validator::make($request->all(), [
        'route_id' => 'required|string|exists:routes,id',
        'driver_id' => 'required|string|exists:drivers,id',
        'location' => 'required|json', // Expecting location data in JSON format
    ]);

    if ($validator->fails()) {
        return response()->json($validator->errors(), 422);
    }

    // Find the ride
    $ride = Route::find($request->route_id);
    if (!$ride) {
        return response()->json(['message' => 'Ride not found'], 404);
    }

    // Update driver's current location
    $ride->driver_location = json_encode($request->location);
    $ride->save();

    // Notify the client with the updated driver location
    $this->notifyClientWithLocation($ride);

    return response()->json(['message' => 'Driver location updated successfully.'], 200);
}
//////////////////////////////////////////notify client with driver location////////////////////////////////////////////////////


private function notifyClientWithLocation($ride)
{
    $client = Client::find($ride->client_id);
    if ($client) {
        // Create a new notification or update existing notification logic
        ClientNotification::create([
            'client_id' => $client->id,
            'route_id' => $ride->id,
            'message' => 'Your driver is on the way and is currently located at: ' . $ride->driver_location,
            'status' => 'pending',
        ]);
    }
}

////////////////////////////////////////////////////confirm arrival at pickup point////////////////////////////////////////////////////

public function confirmArrival(Request $request)
{
    // Validate the request
    $validator = Validator::make($request->all(), [
        'route_id' => 'required|string|exists:routes,id',
        'driver_id' => 'required|string|exists:drivers,id',
    ]);

    if ($validator->fails()) {
        return response()->json($validator->errors(), 422);
    }

    // Find the ride
    $ride = Route::find($request->route_id);
    if (!$ride) {
        return response()->json(['message' => 'Ride not found'], 404);
    }

    // Confirm the driver has arrived
    $ride->status = 'At Pickup'; // Update ride status
    $ride->save();

    // Notify the client that the driver has arrived
    $this->notifyClientArrival($ride);

    return response()->json(['message' => 'Driver has confirmed arrival at the pickup point.'], 200);
}

////////////////////////////////////////////////////////notify client about arrival////////////////////////////////////////////////////


private function notifyClientArrival($ride)
{
    $client = Client::find($ride->client_id);
    if ($client) {
        ClientNotification::create([
            'client_id' => $client->id,
            'route_id' => $ride->id,
            'message' => 'Your driver has arrived at your pickup location.',
            'status' => 'pending',
        ]);
    }
}

///////////////////////////////////////////////////cancel ride////////////////////////////////////////////////////


public function cancelRide(Request $request)
{
    // Validate the request
    $validator = Validator::make($request->all(), [
        'route_id' => 'required|string|exists:routes,id',
        'driver_id' => 'required|string|exists:drivers,id',
    ]);

    if ($validator->fails()) {
        return response()->json($validator->errors(), 422);
    }

    // Find the ride
    $ride = Route::find($request->route_id);
    if (!$ride) {
        return response()->json(['message' => 'Ride not found'], 404);
    }

    // Cancel the ride
    $ride->status = 'Cancelled';
    $ride->save();

    // Notify the client about the cancellation
    $this->notifyClientCancellation($ride);

    return response()->json(['message' => 'Ride cancelled successfully.'], 200);
}

////////////////////////////////////////////notify client about cancellation////////////////////////////////////////////////////


private function notifyClientCancellation($ride)
{
    $client = Client::find($ride->client_id);
    if ($client) {
        ClientNotification::create([
            'client_id' => $client->id,
            'route_id' => $ride->id,
            'message' => 'Your ride has been cancelled. Please request a new ride.',
            'status' => 'pending',
        ]);
    }
}

///////////////////////////////////////////////////////////////start ride////////////////////////////////////////////////////


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

//////////////////////////////////////////////////////////complete ride////////////////////////////////////////////////////


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


    return response()->json(['message' => 'Ride completed successfully!'], 200);
}


///////////////////////////////////////////////////////////////////calculate fare////////////////////////////////////////////////////


private function calculateFare($distance, $carType)
{
    // Basic fare calculation logic
    $baseFare = 50; // Base fare
    $perKmRate = ($carType === 'sedan') ? 10 : 15; // Example rates

    return round($baseFare + ($distance * $perKmRate), 2); // Round to 2 decimal places
}
}
