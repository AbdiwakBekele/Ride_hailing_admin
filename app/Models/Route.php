<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Route extends Model
{
    protected $fillable =[
        'pickup_location',
        'dropoff_location',
        'pickup_time',
        'dropoff_time',
        'fare_amount',
        'distance_km',
        'status',
    ];

    
public function driver()
{
    return $this->belongsTo(Driver::class, 'driver_id');
}

public function client()
{
    return $this->belongsTo(Client::class, 'client_id');
}
}
