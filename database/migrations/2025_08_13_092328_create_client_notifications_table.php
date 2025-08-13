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
        Schema::create('client_notifications', function (Blueprint $table) {
                  $table->id(); // Primary key
            $table->foreignId('client_id')->constrained('clients')->onDelete('cascade'); // Foreign key to clients
            $table->foreignId('route_id')->constrained('routes')->onDelete('cascade'); // Foreign key to rides
            $table->string('message'); // Notification message
            $table->string('driver_name'); // Driver's name
            $table->string('vehicle_model'); // Vehicle model
            $table->string('plate_number'); // Vehicle plate number
            $table->string('color'); // Vehicle color
            $table->string('estimated_arrival_time'); // Estimated arrival time
            $table->string('status')->default('pending'); // Status (pending, delivered, read)
            $table->timestamps(); // Created and updated timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('client_notifications');
    }
};
