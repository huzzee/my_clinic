<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{
    protected $fillable = [
        'entity_id','doctor_id','patient_id','medicine_info'
    ];

    protected $casts = [
        'medicine_info' => 'array'
    ];

    public function user_informations()
    {
        return $this->belongsTo('App\models\UserInformation','doctor_id');
    }

    public function patients()
    {
        return $this->belongsTo('App\models\Patient','patient_id');
    }

}
