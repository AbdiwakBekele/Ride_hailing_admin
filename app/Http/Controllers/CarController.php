<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Driver;
use Illuminate\Http\Request;

class CarController extends Controller
{
    /**
     * Display a listing of the cars.
     */
    public function index()
    {
        $cars = Car::with('driver')->get(); // Eager load drivers
        return view('cars.index', compact('cars'));
    }

    /**
     * Show the form for creating a new car.
     */
    public function create()
    {
        $drivers = Driver::all(); 
        // Get all drivers for the dropdown
       
        return view('cars.create', compact('drivers'));
    }

    /**
     * Store a newly created car in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'driver_id' => 'required|exists:drivers,id',
            'car_name' => 'required|string|max:255',
            'car_model' => 'required|string|max:255',
            'year_manufactured' => 'required|integer|digits:4',
            'chassis_number' => 'required|string|max:255|unique:cars',
            'plate_number' => 'required|string|max:255|unique:cars',
            'color' => 'required|string|max:50',
            'type' => 'required|in:Sedan,SUV,Minivan,Other',
        ]);

        Car::create($request->all()); // Mass assignment
        return redirect()->route('cars.index')->with('success', 'Car added successfully.');
    }

    /**
     * Display the specified car.
     */
    public function show(Car $car)
    {
        return view('cars.show', compact('car'));
    }

    /**
     * Show the form for editing the specified car.
     */
    public function edit(Car $car)
    {
        $drivers = Driver::all(); // Get all drivers for the dropdown
        return view('cars.edit', compact('car', 'drivers'));
    }

    /**
     * Update the specified car in storage.
     */
    public function update(Request $request, Car $car)
    {
       
        $request->validate([
            'driver_id' => 'required|exists:drivers,id',
            'car_name' => 'required|string|max:255',
            'car_model' => 'required|string|max:255',
            'year_manufactured' => 'required|integer|digits:4',
            'chassis_number' => 'required|string|max:255|unique:cars,chassis_number,' . $car->id,
            'plate_number' => 'required|string|max:255|unique:cars,plate_number,' . $car->id,
            'color' => 'required|string|max:50',
            'type' => 'required|in:Sedan,SUV,Minivan,Other',
        ]);

        $car->update($request->all()); // Mass assignment
        return redirect()->route('cars.index')->with('success', 'Car updated successfully.');
    }

    /**
     * Remove the specified car from storage.
     */
    public function destroy(Car $car)
    {
        $car->delete();
        return redirect()->route('cars.index')->with('success', 'Car deleted successfully.');
    }
}
