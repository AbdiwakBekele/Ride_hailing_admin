<?php

namespace App\Http\Controllers\Api;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use App\Models\Driver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        if(Auth::guard('driver')->attempt($credentials)){
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
             'vehicle_type' => 'required|string',
            'password' => 'required|string|min:8|confirmed'
    ]);

    $driver = Driver::create([
         'full_name' => $validated['full_name'],
        'phone_number' => $validated['phone_number'],
        'email' => $validated['email'],
        'password' => bcrypt($validated['password']),
        'vehicle_type' => $validated['vehicle_type'],
    ]);
return response()->json(['success' => true, 'message' => 'Driver created successfully', 'data' => $driver], 201);
    // return response()->json([
    //     'success' => true,
    //     'token' => $driver->createToken('driver-token')->plainTextToken,
    //     'driver' => $driver->makeHidden(['password', 'remember_token'])
    // ], 201);
}

// Upload National ID
public function uploadNationalId(Request $request)
{
    $validated = $request->validate([
        'driver_id' => 'required|exists:drivers,id',
        'national_id.file_name' => 'required|string',
        'national_id.file_data' => 'required|string',
        'national_id.id_number' => 'required|string',
        'national_id.expiry_date' => 'required|date',
    ]);

    // Save the national ID file
    $filePath = $this->uploadBase64File($validated['national_id']['file_data'], $validated['national_id']['file_name']);
    
    // Update driver record with the national ID URL
    $driver = Driver::find($validated['driver_id']);
    $driver->national_id_url = $filePath;
    $driver->save();

    return response()->json(['message' => 'National ID uploaded successfully!']);
}

// Upload License
public function uploadLicense(Request $request)
{
    $validated = $request->validate([
        'driver_id' => 'required|exists:drivers,id',
        'driver_license.file_name' => 'required|string',
        'driver_license.file_data' => 'required|string',
        'driver_license.license_number' => 'required|string',
        'driver_license.issue_date' => 'required|date',
        'driver_license.expiry_date' => 'required|date',
    ]);

    // Save the driver license file
    $filePath = $this->uploadBase64File($validated['driver_license']['file_data'], $validated['driver_license']['file_name']);
    
    // Update driver record with the license URL
    $driver = Driver::find($validated['driver_id']);
    $driver->license_url = $filePath;
    $driver->save();

    return response()->json(['message' => 'Driver license uploaded successfully!']);
}

// Upload Insurance
public function uploadInsurance(Request $request)
{
    $validated = $request->validate([
        'driver_id' => 'required|exists:drivers,id',
        'insurance.file_name' => 'required|string',
        'insurance.file_data' => 'required|string',
        'insurance.policy_number' => 'required|string',
        'insurance.provider' => 'required|string',
        'insurance.expiry_date' => 'required|date',
    ]);

    // Save the insurance file
    $filePath = $this->uploadBase64File($validated['insurance']['file_data'], $validated['insurance']['file_name']);
    
    // Update driver record with the insurance URL
    $driver = Driver::find($validated['driver_id']);
    $driver->insurance_url = $filePath;
    $driver->save();

    return response()->json(['message' => 'Insurance uploaded successfully!']);
}

// Upload Picture
public function uploadPicture(Request $request)
{
    $validated = $request->validate([
        'driver_id' => 'required|exists:drivers,id',
        'picture.file_name' => 'required|string',
        'picture.file_data' => 'required|string',
    ]);

    // Save the driver picture file
    $filePath = $this->uploadBase64File($validated['picture']['file_data'], $validated['picture']['file_name']);
    
    // Update driver record with the picture URL
    $driver = Driver::find($validated['driver_id']);
    $driver->picture_url = $filePath;
    $driver->save();

    return response()->json(['message' => 'Driver picture uploaded successfully!']);
}

// Toggle Driver Status
public function toggleStatus(Request $request)
{
    $validated = $request->validate([
        'driver_id' => 'required|exists:drivers,id',
        'is_available' => 'required|boolean',
    ]);

    // Update driver availability status
    $driver = Driver::find($validated['driver_id']);
    $driver->is_available = $validated['is_available'];
    $driver->save();

    return response()->json(['message' => 'Driver status updated successfully!']);
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
            'password' => 'sometimes|required_with:password_confirmation|string|min:8|confirmed'
        ]);
         if ($request->filled('password')) {
        $validatedData['password'] = bcrypt($validatedData['password']);
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
        $user = Auth::guard('driver')->user();
        if ($user) {
            $user->tokens()->delete();
        }
        // $request->user()->currentAccessToken()->delete();
        return response()->json(["ok" => true, "message" => "Logged out successfully"]);

    }


    // private  function for base64file

    private function uploadBase64File($base64Data, $fileName)
{
    // Decode the base64 data
    $fileData = base64_decode($base64Data);
    
    // Define the local storage path
    $path = 'documents/' . $fileName; // Adjust this to your desired structure
    
    // Store the file locally
    Storage::disk('local')->put($path, $fileData);

    return Storage::url($path); // Returns the URL for accessing the file
}
}
