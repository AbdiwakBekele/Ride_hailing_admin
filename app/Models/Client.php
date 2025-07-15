<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable =[
        'full_name',
        'phone_number',
        'email',
        'gender',
        'address',
        'registration_date',
        'status',
    ];
    
    public function route(){
        return $this->belongsTo(Route::class,'client_id');
    }
}
