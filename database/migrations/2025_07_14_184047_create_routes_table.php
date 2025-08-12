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
        $table->id(); 
        $table->foreignId('client_id')->constrained('clients')->onDelete('cascade');
        $table->foreignId('driver_id')->nullable()->constrained('drivers')->onDelete('cascade'); // Make driver_id nullable
        $table->geometry('pickup_location'); 
        $table->geometry('destination'); 
        $table->string('car_type'); 
        $table->enum('status', ['Accepted','Completed', 'Cancelled', 'In Progress'])->default('In Progress');
        $table->decimal('fare', 8, 2); 
        $table->decimal('distance_km', 5, 2); 
        $table->integer('duration_min'); 
        $table->timestamps(); 
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
