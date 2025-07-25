<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserAuthController extends Controller
{
    public function login_get(Request $request)
    {
        // Logic for handling GET request for login
        return response()->json(["ok" => false,"status"=>401]);
    }
    public function login_post(Request $request)
    {
        // Logic for handling POST request for login
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        if(Auth::attempt($credentials)){
            $user = User::where('email', $request->email)->first();
            $token = $user->createToken("token");
           return response()->json([
    "ok" => true,
    'user' => $user,
    'token' => $token->plainTextToken
], 200);
        }
         return response()->json(["ok" => false, "message" => "Invalid credentials"], 401);
    }
    public function register(Request $request){
        // 1|0UVoSHJIBsOoncfYsISoPZ0HXV8bY4mzCW1uzdAi0f5d0780
        $validatedData = $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone_number' => 'required|string|max:15',
            'password' => 'required',
            'user_type' => 'sometimes|in:user,driver'
        ]);
        $user = User::create([
            'full_name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
            'phone_number' => $validatedData['phone_number'],
            'user_type' => $validated['user_type'] ?? 'user'
        ]);
          // Create driver profile if needed
    if ($user->user_type === 'driver') {
        Driver::create([
            'user_id' => $user->id,
            'license_number' => $request->license_number,
            'status' => 'pending'
        ]);
    }
        $token = $user->createToken("token");
        return response()->json(["ok" => true, 'user' => $user, 'token' => $token->plainTextToken, "status" => 201]);
    }
    public  function logout()
    {
        $user = auth()->user();
           $user->tokens()->delete();
            // $request->user()->currentAccessToken()->delete();
            return response()->json(["ok" => true, "message" => "Logged out successfully"]);

    }

}
