<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin; // Assuming you have an Admin model
use Illuminate\Support\Facades\Auth;

class AdminAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.login');
    }

    public function showRegisterForm()
    {
        return view('admin.register');
    }

    // Add other methods for handling login, registration, etc.
    public function register(Request $request)
    {
        // Handle registration logic here
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:4',
        ]);
         $existingemail=Admin::where('email',$request->email)->first();
    

        if ($existingemail) {
            return redirect()->back()->withErrors(['email' => 'Email already exists']);
        }

        $admin = new Admin();
        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->password = bcrypt($request->password);
        $admin->save();

        return redirect()->route('admin.dashboard')->with('success', 'Registration successful');
    }
    public function login(Request $request)
    {
        // dd($request->all());

        // Handle login logic here
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string|min:4',
        ]);
        $credentials = $request->only('email', 'password');
        // if (Auth::attempt($credentials)) {
        if ($credentials) {
            return redirect()->route('admin.dashboard')->with('success', 'Login successful');
        }
        // return redirect()->back()->withErrors(['email' => 'Invalid credentials']);
    }
}
