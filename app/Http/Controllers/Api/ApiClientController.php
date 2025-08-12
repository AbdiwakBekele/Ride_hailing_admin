<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Client;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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
    // Validate the incoming request
    $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    // Attempt to authenticate the client
    $client = Client::where('email', $request->email)->first();

    if ($client && Hash::check($request->password, $client->password)) {
        // Create a token for the authenticated client
        $token = $client->createToken("token");

        return response()->json([
            "ok" => true,
            'client' => $client,
            'token' => $token->plainTextToken,
        ], 200);
    }

    return response()->json([
        "ok" => false,
        "message" => "Invalid credentials"
    ], 401);
}

    public function register(Request $request)
{
    // return $request;
  
    $validated = $request->validate([
        'full_name' => 'required|string|max:255',
        'phone_number' => 'required|string|max:15|unique:clients',
        'email' => 'required|email|unique:clients',
        'password' => 'required|string|min:8',
        'gender' => 'required|in:Male,Female,Other',
         'status' => 'required',
        'address' => 'required|string|max:500',
        

    ]);
    
    

    $client = Client::create([
        'full_name' => $validated['full_name'],
        'phone_number' => $validated['phone_number'],
        'gender' => $validated['gender'],
        'email' => $validated['email'],
        'password' => bcrypt($validated['password']),
        'status' => $validated['status'],
        'address' => $validated['address'],
        'registration_date' => now(),

    ]);
    $token = $client->createToken("token");
        return response()->json(["ok" => true, 'client' => $client, 'token' => $token->plainTextToken, "status" => 201]);

    // return response()->json([
    //     'success' => true,
    //     'token' => $client->createToken('client-token')->plainTextToken,
    //     'client' => $client->makeHidden(['password', 'created_at', 'updated_at'])
    // ], 201);
}


    // Store a newly created client in storage
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'full_name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:15',
            'email' => 'required|email|unique:clients,email',
            'gender' => 'required|in:Male,Female,Other',
            'address' => 'required|string',
            'registration_date' => 'required|date',
            'status' => 'required|in:Active,Banned,Pending',
        ]);

        $client = Client::create($validatedData);

        return response()->json(['success' => true, 'message' => 'Client created successfully!', 'data' => $client], 201);
    }

    // Show the specific client
    public function show($id)
    {
        $client = Client::findOrFail($id);
        return response()->json(['success' => true, 'data' => $client], 200);
    }

    // Show the form for editing a client
    // Again, for API, it's better to just give instructions or omit
    // public function edit($id)
    // {
    //     return response()->json(['success' => true, 'message' => 'Use PUT/PATCH /clients/{id} to update'], 200);
    // }

    // Update the specified client in storage
   public function update(Request $request, $id)
{
    // Basic authentication check (via auth:api middleware)
    // if (!auth()->check()) {
    //     return response()->json(['error' => 'Unauthenticated'], 401);
    // }
// \Log::debug('Request data:', $request->all());
//     $client = Client::findOrFail($id);

    // Simple ownership check (optional but recommended)
    // if ($client->user_id && auth()->id() !== $client->user_id) {
    //     return response()->json(['error' => 'Not your client'], 403);
    // }

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

     // Add debug logging
    // \Log::debug('Update Data:', $validatedData);
    
    if ($request->filled('password')) {
    $client->password = bcrypt($validatedData['password']); // Direct assignment
}
     

    // Explicit save instead of update()
   \Log::debug('Before fill:', $client->toArray());

$client->fill($validatedData);

\Log::debug('Current client data:', $client->getAttributes());
\Log::debug('Validated data:', $validatedData);
\Log::debug('Dirty attributes before fill:', $client->getDirty());

    $wasSaved = $client->save();

    \Log::debug('Save Result:', ['saved' => $wasSaved, 'changes' => $client->getChanges()]);
    
    return response()->json([
        'success' => $wasSaved,
        'message' => $wasSaved ? 'Client updated!' : 'Update failed',
        'data' => $client->refresh() // Get fresh DB state
    ], $wasSaved ? 200 : 500);
}


    // Remove the specified client from storage
    public function destroy($id)
    {
        $client = Client::findOrFail($id);
        $client->delete();

        return response()->json(['success' => true, 'message' => 'Client deleted successfully!'], 200);
    }

    public  function logout()
    {
        $user = auth()->user();
           $user->tokens()->delete();
            // $request->user()->currentAccessToken()->delete();
            return response()->json(["ok" => true, "message" => "Logged out successfully"]);

    }
}
