<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    protected $fillable =[
        'full_name',
        'phone_number',
        'email',
        'license_number',
        'status',
        

    ];

    public function car(){
        return $this->hasOne(Car::class,'driver_id');
    }
    public function route(){
        return $this->hasOne(Route::class,'driver_id');
    }
    public function user()
{
    return $this->belongsTo(User::class);
}
}
