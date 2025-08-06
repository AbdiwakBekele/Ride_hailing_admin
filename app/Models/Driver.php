<?php

namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens; 

class Driver extends Authenticatable
{
    use HasApiTokens;
    protected $fillable =[
        'full_name',
        'phone_number',
        'password',
        'email',
        'status',
        'vehicle_type',
        'is_available',
        'national_id_url',
        'national_id_status',
        'national_id_number',
        'license_url',
        'license_status',
        'license_number',
        'insurance_url',
        'insurance_status',
        'picture_url',
        'picture_statu',
        'location'
        
        

    ];

    public function car(){
        return $this->hasOne(Car::class,'driver_id');
    }
    public function route(){
        return $this->hasOne(Route::class,'driver_id');
    }
//     public function user()
// {
//     return $this->belongsTo(User::class);
// }
}
