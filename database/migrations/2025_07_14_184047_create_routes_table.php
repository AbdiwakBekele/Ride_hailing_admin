<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('routes', function (Blueprint $table) {
          $table->id(); // Auto-incrementing ID
$table->foreignId('client_id')->constrained('clients')->onDelete('cascade');
$table->foreignId('driver_id')->constrained('drivers')->onDelete('cascade');
$table->point('pickup_location'); // Pickup location as a POINT
$table->point('destination'); // Destination as a POINT
$table->string('car_type'); // Car type
$table->enum('status', ['Completed', 'Cancelled', 'In Progress'])->default('In Progress');
$table->decimal('fare', 8, 2); // Fare with 2 decimal places
$table->decimal('distance_km', 5, 2); // Distance in kilometers
$table->integer('duration_min'); // Duration in minutes
$table->timestamps(); // Created at and updated at timestamps
           
            
          
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('routes');
    }
};
