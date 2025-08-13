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
        Schema::create('drivers', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('phone_number');
            $table->string('password');
            $table->string('email')->nullable();
     
    $table->enum('vehicle_type', ['sedan', 'suv', 'truck', 'van']); 
    $table->boolean('is_available')->default(false);
    $table->geometry('location')->nullable(); // Requires spatial support
    $table->string('national_id_url')->default('default_value_here');
    $table->enum('national_id_status', ['pending', 'verified', 'rejected'])->default('pending');
    $table->string('national_id_number')->default('default_value_here');
    $table->string('license_url')->default('default_value_here');
    $table->enum('license_status', ['pending', 'verified', 'rejected'])->default('pending');
    $table->string('license_number')->default('default_value_here');
    $table->string('insurance_url')->default('default_value_here');
    $table->enum('insurance_status', ['pending', 'verified', 'rejected'])->default('pending');
    $table->string('picture_url')->default('default_value_here');
    $table->enum('picture_status', ['pending', 'verified', 'rejected'])->default('pending');
     $table->enum('status', ['Active', 'Banned', 'Pending'])->default('Pending');
    
    $table->timestamp('verified_at')->nullable();
    $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('drivers');
    }
};
