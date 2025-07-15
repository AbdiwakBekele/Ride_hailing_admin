<?php

namespace App\Http\Controllers;

use App\Models\Route;
use App\Models\Driver;
use App\Models\Client;
use Illuminate\Http\Request;

class RouteController extends Controller
{
    // Display a listing of the routes
    public function index()
    {
        $routes = Route::all(); 
          $drivers= Driver::all(); 
     $clients= Client::all(); 
     
        
        return view('routes.index', compact('routes','clients','drivers')); 
    }

    // Show the form for creating a new route
  public function create()
{
    // Fetch all drivers and cars from the database
    $drivers = Driver::all(); 
    $clients = Client::all(); 
   

    // Pass drivers and cars to the view
    return view('routes.create', compact('drivers', 'clients'));
}


    // Store a newly created route in storage
    public function store(Request $request)
    {
      
        $request->validate([
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

        Route::create($request->all()); // Mass assignment to create a new route

        return redirect()->route('routes.index')->with('success', 'Route created successfully.');
    }

    // Display the specified route
    public function show(Route $route)
    {
        return view('routes.show', compact('route')); 
    }

   
    public function edit(Route $route)
    {
        $drivers=Driver::all();
        $clients=Client::all();
        return view('routes.edit', compact('route','drivers','clients')); 
    }

    
    public function update(Request $request, Route $route)
    {
        $request->validate([
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

        $route->update($request->all()); 

        return redirect()->route('routes.index')->with('success', 'Route updated successfully.');
    }

    // Remove the specified route from storage
    public function destroy(Route $route)
    {
        $route->delete(); // Delete the route

        return redirect()->route('routes.index')->with('success', 'Route deleted successfully.');
    }
}
