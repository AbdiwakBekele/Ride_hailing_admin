<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Driver;
use Illuminate\Http\Request;

class ApiDriverController extends Controller
{
     // List all drivers
    public function index()
    {
        $drivers = Driver::all();
        return response()->json(['success' => true, 'data' => $drivers], 200);
    }

    // Show a specific driver
    public function show($id)
    {
        $driver = Driver::findOrFail($id);
        return response()->json(['success' => true, 'data' => $driver], 200);
    }

    // Create a new driver
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'full_name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:15',
            'email' => 'required|email|unique:users,email',
            'license_number' => 'required|string|max:50',
            'status' => 'required|in:Active,Inactive,Suspended',
        ]);
        $driver = Driver::create($validatedData);
        return response()->json(['success' => true, 'message' => 'Driver created successfully', 'data' => $driver], 201);
    }

    // Update an existing driver
    public function update(Request $request, $id)
    {
        $driver = Driver::findOrFail($id);

        $validatedData = $request->validate([
            'full_name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:15',
            'email' => 'required|email|unique:drivers,email,' . $driver->id,
            'license_number' => 'required|string|max:50',
            'status' => 'required|in:Active,Inactive,Suspended',
        ]);

        $driver->update($validatedData);

        return response()->json(['success' => true, 'message' => 'Driver updated successfully', 'data' => $driver], 200);
    }

    // Delete a driver
    public function destroy($id)
    {
        $driver = Driver::findOrFail($id);
        $driver->delete();

        return response()->json(['success' => true, 'message' => 'Driver deleted successfully'], 200);
    }
}
