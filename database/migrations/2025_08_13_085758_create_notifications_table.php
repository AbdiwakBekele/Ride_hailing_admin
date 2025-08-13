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
        Schema::create('notifications', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->foreignId('driver_id')->constrained('drivers')->onDelete('cascade'); // Foreign key to drivers
            $table->foreignId('route_id')->constrained('routes')->onDelete('cascade'); // Foreign key to rides
            $table->string('client_name'); // Client's name
            $table->string('client_contact'); // Client's contact information
            $table->json('pickup_location'); // JSON for pickup latitude and longitude
            $table->json('destination'); // JSON for destination latitude and longitude
            $table->decimal('estimated_fare', 8, 2); // Estimated fare
            $table->decimal('estimated_distance', 8, 2); // Estimated distance
            $table->integer('estimated_duration'); // Estimated duration in minutes
            $table->string('status')->default('pending'); // Status (pending, accepted, declined)
            $table->timestamps(); // Created and updated timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
