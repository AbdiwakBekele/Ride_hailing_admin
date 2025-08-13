<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClientNotification extends Model
{
   
    // Mass assignable attributes
      protected $fillable = [
        'client_id',
        'route_id',
        'message',
        'driver_name',
        'vehicle_model',
        'plate_number',
        'color',
        'estimated_arrival_time',
        'status',
    ];

    // Relationships
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function route()
    {
        return $this->belongsTo(Route::class);
    }
}
