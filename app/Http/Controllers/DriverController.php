<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use Illuminate\Http\Request;

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

    public function store(Request $request){
        $request->validate([  'full_name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:15',
            'email' => 'nullable|email',
            'license_number' => 'required|string|max:50',
            'status' => 'required|in:Active,Inactive,Suspended',
        ]);
        $driver = Driver::create($request->all());

    // Redirect to the index page or show page
    return redirect()->route('drivers.index');

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

    // Update the driver with validated data
    $driver->update($request->all());

    // Return a response (could be a redirect or JSON response)
    return redirect()->route('drivers.index')->with('success', 'Driver updated successfully!');
    // Or for API response:
    // return response()->json(['message' => 'Driver updated successfully!', 'driver' => $driver]);
}

    public function destroy($id)
{
    // Find the driver or fail
    $driver = Driver::findOrFail($id);
    
    // Delete the driver
    $driver->delete();

    // Redirect back to the index with a success message
    return redirect()->route('drivers.index')->with('success', 'Driver deleted successfully!');
}

}

