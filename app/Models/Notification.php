<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable = [
        'driver_id',
        'ride_id',
        'client_name',
        'client_contact',
        'pickup_location',
        'destination',
        'estimated_fare',
        'estimated_distance',
        'estimated_duration',
        'status',
    ];
    
    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }

    public function route()
    {
        return $this->belongsTo(Route::class);
    }
}
