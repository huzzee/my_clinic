<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Leave extends Model
{
    protected $fillable=[
        'doctor_id','leave_type','entity_id','leave_length'
    ];

    protected $casts =[
        'leave_length' => 'array'
    ];

    public function user_informations()
    {
        return $this->belongsTo('App\models\UserInformation','doctor_id');
    }
}
