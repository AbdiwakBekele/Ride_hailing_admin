<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Route extends Model
{
    protected $fillable =[
        'pickup_location',
        'destination',
        'fare_amount',
        'distance_km',
        'status',
        'car_type',
        'fare',
        'duration_min',
        'driver_id',
        'client_id',
    ];

    
public function driver()
{
    return $this->belongsTo(Driver::class, 'driver_id');
}

public function client()
{
    return $this->belongsTo(Client::class, 'client_id');
}
 public function notifications()
    {
        return $this->hasMany(Notification::class);
    }
 public function clientnotifications()
    {
        return $this->hasMany(ClientNotification::class);
    }
}
