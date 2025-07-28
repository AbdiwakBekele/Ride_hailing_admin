<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    // Display a listing of clients
    public function index()
    {
        $clients = Client::all();
        return view('client.index', compact('clients')); // Adjust the view path as needed
    }

    // Show the form for creating a new client
    public function create()
    {
        return view('client.create'); // Adjust the view path as needed
    }

    // Store a newly created client in storage
    public function store(Request $request)
    {
       
        $request->validate([
            'full_name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:15',
            'email' => 'required|email|unique:clients,email',
            'password' => 'required|string|min:8|confirmed',
            'gender' => 'required|in:Male,Female,Other',
            'address' => 'required|string',
            'registration_date' => 'required|date',
            'status' => 'required|in:Active,Banned,Pending',
        ]);

        Client::create($request->all());

        return redirect()->route('clients.index')->with('success', 'Client created successfully!');
    }

    // Show the form for editing the specified client
    public function edit($id)
    {
        $client = Client::findOrFail($id);
        return view('client.edit', compact('client')); // Adjust the view path as needed
    }

    // Update the specified client in storage
    public function update(Request $request, $id)
    {
        $client = Client::findOrFail($id);

        $request->validate([
            'full_name' => 'sometimes|required|string|max:255',
            'phone_number' => 'sometimes|required|string|max:15',
            'email' => 'sometimes|required|email|unique:clients,email,' . $client->id,
            'gender' => 'sometimes|required|in:Male,Female,Other',
            'address' => 'sometimes|required|string',
            'registration_date' => 'sometimes|required|date',
            'status' => 'sometimes|required|in:Active,Banned,Pending',
        ]);

        $client->update($request->all());

        return redirect()->route('clients.index')->with('success', 'Client updated successfully!');
    }

    // Remove the specified client from storage
    public function destroy($id)
    {
        $client = Client::findOrFail($id);
        $client->delete();

        return redirect()->route('clients.index')->with('success', 'Client deleted successfully!');
    }
}
