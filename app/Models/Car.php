<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    protected $fillable =[
        'car_name',
        'car_model',
        'year_manufactured',
        'chassis_number',
        'plate_number',
        'color',
        'type'

    ];

    public function driver(){
        return $this->belongsTo(Driver::class,foreignKey: 'driver_id');
    }

}
