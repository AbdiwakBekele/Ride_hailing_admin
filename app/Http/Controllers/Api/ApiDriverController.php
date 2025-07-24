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

     public function login(Request $request)
    {
        // Logic for handling POST request for login
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        if(Auth::attempt($credentials)){
            $driver = Driver::where('email', $request->email)->first();
            $token = $driver->createToken("token");
           return response()->json([
    "ok" => true,
    'driver' => $driver,
    'token' => $token->plainTextToken
], 200);
 }
         return response()->json(["ok" => false, "message" => "Invalid credentials"], 401);
    }

    public function register(Request $request)
{
    $validated = $request->validate([
           'full_name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:15',
            'email' => 'required|email|unique:users,email',
            'license_number' => 'required|string|max:50',
            'status' => 'required|in:Active,Inactive,Suspended',
            'password' => 'required|string|min:8|confirmed'
    ]);

    $driver = Driver::create([
        ...$validated,
        'password' => Hash::make($validated['password'])
    ]);
return response()->json(['success' => true, 'message' => 'Driver created successfully', 'data' => $driver], 201);
    // return response()->json([
    //     'success' => true,
    //     'token' => $driver->createToken('driver-token')->plainTextToken,
    //     'driver' => $driver->makeHidden(['password', 'remember_token'])
    // ], 201);
}

    // Create a new driver
    // public function store(Request $request)
    // {
    //     $validatedData = $request->validate([
    //         'full_name' => 'required|string|max:255',
    //         'phone_number' => 'required|string|max:15',
    //         'email' => 'required|email|unique:users,email',
    //         'license_number' => 'required|string|max:50',
    //         'status' => 'required|in:Active,Inactive,Suspended',
    //     ]);
    //     $driver = Driver::create($validatedData);
    //     return response()->json(['success' => true, 'message' => 'Driver created successfully', 'data' => $driver], 201);
    // }

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
            'password' => 'sometimes|required_with:password_confirmation|string|min:8|confirmed'
        ]);
         if ($request->filled('password')) {
        $validatedData['password'] = Hash::make($validatedData['password']);
    } else {
        unset($validatedData['password']);
    }

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

    public  function logout()
    {
        $user = auth()->user();
           $user->tokens()->delete();
            // $request->user()->currentAccessToken()->delete();
            return response()->json(["ok" => true, "message" => "Logged out successfully"]);

    }
}
