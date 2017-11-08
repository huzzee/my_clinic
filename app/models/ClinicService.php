<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class ClinicService extends Model
{
    protected $fillable =[
        'service_name','rate','entity_id'
    ];
}
