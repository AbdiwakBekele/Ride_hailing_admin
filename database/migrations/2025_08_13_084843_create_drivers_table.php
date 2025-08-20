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
    //         $table->id();
    //         $table->string('full_name');
    //         $table->string('phone_number');
    //         $table->string('password');
    //         $table->string('email')->nullable();
     
    // $table->enum('vehicle_type', ['sedan', 'suv', 'truck', 'van']); 
    // $table->boolean('is_available')->default(false);
    // $table->geometry('location')->nullable(); // Requires spatial support
    // $table->string('national_id_url')->default('default_value_here');
    // $table->enum('national_id_status', ['pending', 'verified', 'rejected'])->default('pending');
    // $table->string('national_id_number')->default('default_value_here');
    // $table->string('license_url')->default('default_value_here');
    // $table->enum('license_status', ['pending', 'verified', 'rejected'])->default('pending');
    // $table->string('license_number')->default('default_value_here');
    // $table->string('insurance_url')->default('default_value_here');
    // $table->enum('insurance_status', ['pending', 'verified', 'rejected'])->default('pending');
    // $table->string('picture_url')->default('default_value_here');
    // $table->enum('picture_status', ['pending', 'verified', 'rejected'])->default('pending');
    //  $table->enum('status', ['Active', 'Banned', 'Pending'])->default('Pending');
    
    // $table->timestamp('verified_at')->nullable();
    // $table->timestamps();

             $table->bigIncrements('id'); 
            $table->string('full_name');
            $table->string('phone_number');
            $table->string('password');
            $table->string('email')->nullable(); // DEFAULT NULL
            $table->enum('vehicle_type', ['sedan', 'suv', 'truck', 'van']); // NOT NULL
            $table->boolean('is_available')->default(0); // tinyint(1) NOT NULL DEFAULT 0
            $table->string('location')->nullable(); // varchar(255) DEFAULT NULL
            $table->string('national_id_url')->nullable(); // DEFAULT NULL
            $table->string('national_id_status')->nullable(); // DEFAULT NULL
            $table->string('national_id_number')->nullable(); // DEFAULT NULL
            $table->string('national_id_expiry_date')->nullable(); // DEFAULT NULL
            $table->string('license_url')->nullable(); // DEFAULT NULL
            $table->string('license_status')->nullable(); // DEFAULT NULL
            $table->string('license_number')->nullable(); // DEFAULT NULL
            $table->string('license_issue_date')->nullable(); // DEFAULT NULL
            $table->string('license_expiry_date')->nullable(); // DEFAULT NULL
            $table->string('insurance_url')->nullable(); // DEFAULT NULL
            $table->string('insurance_policy_number')->nullable(); // DEFAULT NULL
            $table->string('insurance_status')->nullable(); // DEFAULT NULL
            $table->string('insurance_provider')->nullable(); // DEFAULT NULL
            $table->string('insurance_issue_date')->nullable(); // DEFAULT NULL
            $table->string('insurance_expiry_date')->nullable(); // DEFAULT NULL
            $table->string('picture_url')->nullable(); // DEFAULT NULL
            $table->string('picture_status')->nullable(); // DEFAULT NULL
            $table->enum('status', ['Active', 'Banned', 'Pending'])->default('Pending'); // NOT NULL DEFAULT 'Pending'
            $table->timestamp('verified_at')->nullable(); // NULL DEFAULT NULL
            $table->timestamps(); // Creates created_at and updated_at
        });
        
     // Set the default character set and collation
        DB::statement('ALTER TABLE drivers ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('drivers');
    }
};
