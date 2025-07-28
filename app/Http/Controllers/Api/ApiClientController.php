<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Client;

class ApiClientController extends Controller
{
     // Display a listing of clients
    public function index()
    {
        $clients = Client::all();
        return response()->json(['success' => true, 'data' => $clients], 200);
    }

    // Show the form for creating a new client
    // For API, typically not used. You can omit or just return a message
    // public function create()
    // {
    //     return response()->json(['success' => true, 'message' => 'Use POST /clients to create a new client'], 200);
    // }

      public function login(Request $request)
    {
        // Logic for handling POST request for login
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        if(Auth::attempt($credentials)){
            $client = Client::where('email', $request->email)->first();
            $token = $client->createToken("token");
           return response()->json([
    "ok" => true,
    'client' => $client,
    'token' => $token->plainTextToken
], 200);
 }
         return response()->json(["ok" => false, "message" => "Invalid credentials"], 401);
    }

    public function register(Request $request)
{
    $validated = $request->validate([
        'full_name' => 'required|string|max:255',
        'phone_number' => 'required|string|max:15|unique:clients',
        'email' => 'required|email|unique:clients',
        'password' => 'required|string|min:8|confirmed',
        'gender' => 'required|in:Male,Female,Other',
         'status' => 'required|in:Active,Inactive,Suspended',
        'address' => 'required|string|max:500',
        'registration_date' => 'required'

    ]);
    // dd($validated);

    $client = Client::create([
        'full_name' => $validated['full_name'],
        'phone_number' => $validated['phone_number'],
        'gender' => $validated['gender'],
        'email' => $validated['email'],
        'password' => bcrypt($validated['password']),
        'status' => $validated['status'],
        'address' => $validated['address'],
        'registration_date' => $validated['registration_date'],

    ]);

    return response()->json([
        'success' => true,
        'token' => $client->createToken('client-token')->plainTextToken,
        'client' => $client->makeHidden(['password', 'created_at', 'updated_at'])
    ], 201);
}


    // Store a newly created client in storage
    // public function store(Request $request)
    // {
    //     $validatedData = $request->validate([
    //         'full_name' => 'required|string|max:255',
    //         'phone_number' => 'required|string|max:15',
    //         'email' => 'required|email|unique:clients,email',
    //         'gender' => 'required|in:Male,Female,Other',
    //         'address' => 'required|string',
    //         'registration_date' => 'required|date',
    //         'status' => 'required|in:Active,Banned,Pending',
    //     ]);

    //     $client = Client::create($validatedData);

    //     return response()->json(['success' => true, 'message' => 'Client created successfully!', 'data' => $client], 201);
    // }

    // Show the specific client
    public function show($id)
    {
        $client = Client::findOrFail($id);
        return response()->json(['success' => true, 'data' => $client], 200);
    }

    // Show the form for editing a client
    // Again, for API, it's better to just give instructions or omit
    public function edit($id)
    {
        return response()->json(['success' => true, 'message' => 'Use PUT/PATCH /clients/{id} to update'], 200);
    }

    // Update the specified client in storage
    public function update(Request $request, $id)
    {
        $client = Client::findOrFail($id);

        $validatedData = $request->validate([
            'full_name' => 'sometimes|required|string|max:255',
            'phone_number' => 'sometimes|required|string|max:15',
            'email' => 'sometimes|required|email|unique:clients,email,' . $client->id,
            'gender' => 'sometimes|required|in:Male,Female,Other',
            'address' => 'sometimes|required|string',
            'registration_date' => 'sometimes|required|date',
            'status' => 'sometimes|required|in:Active,Banned,Pending',
             'password' => 'sometimes|required_with:password_confirmation|string|min:8|confirmed'
        ]);
         if ($request->filled('password')) {
        $validatedData['password'] = bcrypt($validatedData['password']);
    } else {
        unset($validatedData['password']);
    }

        $client->update($validatedData);

        return response()->json(['success' => true, 'message' => 'Client updated successfully!', 'data' => $client], 200);
    }

    // Remove the specified client from storage
    public function destroy($id)
    {
        $client = Client::findOrFail($id);
        $client->delete();

        return response()->json(['success' => true, 'message' => 'Client deleted successfully!'], 200);
    }
}
