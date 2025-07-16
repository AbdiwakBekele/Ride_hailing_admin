<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ApiCarController extends Controller
{
      /**
     * Display a listing of the cars.
     */
    public function index(): JsonResponse
    {
        $cars = Car::with('driver')->get();
        return response()->json(['success' => true, 'data' => $cars], 200);
    }

    /**
     * Store a newly created car.
     */
    public function store(Request $request): JsonResponse
    {
        $validatedData = $request->validate([
            'driver_id' => 'required|exists:drivers,id',
            'car_name' => 'required|string|max:255',
            'car_model' => 'required|string|max:255',
            'year_manufactured' => 'required|integer|digits:4',
            'chassis_number' => 'required|string|max:255|unique:cars',
            'plate_number' => 'required|string|max:255|unique:cars',
            'color' => 'required|string|max:50',
            'type' => 'required|in:Sedan,SUV,Minivan,Other',
        ]);

        $car = Car::create($validatedData);

        return response()->json(['success' => true, 'data' => $car], 201);
    }

    /**
     * Display the specified car.
     */
    public function show(Car $car): JsonResponse
    {
        return response()->json(['success' => true, 'data' => $car->load('driver')], 200);
    }

    /**
     * Update the specified car.
     */
    public function update(Request $request, Car $car): JsonResponse
    {
        $validatedData = $request->validate([
            'driver_id' => 'required|exists:drivers,id',
            'car_name' => 'required|string|max:255',
            'car_model' => 'required|string|max:255',
            'year_manufactured' => 'required|integer|digits:4',
            'chassis_number' => 'required|string|max:255|unique:cars,chassis_number,' . $car->id,
            'plate_number' => 'required|string|max:255|unique:cars,plate_number,' . $car->id,
            'color' => 'required|string|max:50',
            'type' => 'required|in:Sedan,SUV,Minivan,Other',
        ]);

        $car->update($validatedData);

        return response()->json(['success' => true, 'data' => $car], 200);
    }

    /**
     * Remove the specified car.
     */
    public function destroy(Car $car): JsonResponse
    {
        $car->delete();
        return response()->json(['success' => true, 'message' => 'Car deleted successfully.'], 200);
    }
}
