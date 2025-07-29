<?php

namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens; 

class Client extends Authenticatable
{
     use HasApiTokens;
    protected $fillable =[
        'full_name',
        'phone_number',
        
        'email',
        'gender',
        'address',
        'registration_date',
        'status',
    ];
    protected $casts = [
    'registration_date' => 'datetime'
];
public $timestamps = true;

    
    public function route(){
        return $this->hasMany(Route::class,'client_id');
    }
}
