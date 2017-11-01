<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class UserInformation extends Model
{


    protected $fillable = [
        'admin_info','user_id','doctor_info','employee_info'

    ];

    protected $casts = [
        'admin_info' => 'array',
        'doctor_info' => 'array',
        'employee_info' => 'array'

    ];


    public function users()
    {
        return $this->belongsTo('App\User','user_id');
    }
}
