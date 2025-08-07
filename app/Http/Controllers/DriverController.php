<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DriverController extends Controller
{
    public function index(){
        $drivers=Driver::all();
      
        return view('driver.index',compact('drivers'));
    }

    public function create()
{
    return view('driver.create');

}
    public function show($id){
        $driver=Driver::findOrFail($id);
        return view('driver.show',compact('driver'));
    }

   public function store(Request $request)
{
    
    // Validate the request data
    $validatedData = $request->validate([
        'full_name' => 'required|string|max:255',
        'phone_number' => 'required|string|max:15',
        'email' => 'nullable|email',
        'vehicle_type' => 'required|string',
        'password' => 'required|string|min:8'
    ]);
    

    // Check if the creation is successful
    try {
        // Hash the password before saving
        $driver = Driver::create([
         'full_name' => $validatedData['full_name'],
        'phone_number' => $validatedData['phone_number'],
        'email' => $validatedData['email'],
        'password' => bcrypt($validatedData['password']),
        'vehicle_type' => $validatedData['vehicle_type'],
    ]);

        if ($driver) {
            // Success message
            return redirect()->route('drivers.index')->with('success', 'Driver added successfully!');
        } else {
            // Failure message
            return redirect()->back()->with('error', 'Failed to add driver.');
        }
    } catch (\Exception $e) {
        // Handle exception and show error message
         // Log the error message
    Log::error('Failed to create driver: ' . $e->getMessage());

    // Optionally, dump the error for immediate debugging
    dd($e->getMessage());
        return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
    }
}

    
    public function edit($id){
         $driver = Driver::findOrFail($id); 
         return view('driver.edit', compact('driver')); 
    }

    
  public function update(Request $request, $id)
{
    // Find the driver or fail
    $driver = Driver::findOrFail($id);

    // Validate the request
    $request->validate([
        'full_name' => 'required|string|max:255',
        'phone_number' => 'required|string|max:15',
        'email' => 'required|email|unique:drivers,email,' . $driver->id,
        'license_number' => 'required|string|max:50',
        'status' => 'required|in:Active,Inactive,Suspended',
    ]);

   
    $driver->update($request->all());

    
    return redirect()->route('drivers.index')->with('success', 'Driver updated successfully!');
   
}

    public function destroy($id)
{
    // Find the driver or fail
    $driver = Driver::findOrFail($id);
    
    
    $driver->delete();

    // Redirect back to the index with a success message
    return redirect()->route('drivers.index')->with('success', 'Driver deleted successfully!');
}

}

