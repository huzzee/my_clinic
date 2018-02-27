<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Queue extends Model
{
    protected $fillable = [
        'entity_id','doctor_id','patient_id','bill','paid','note','status','queue_code'
    ];

    public function user_informations()
    {
        return $this->belongsTo('App\models\UserInformation','doctor_id');
    }

    public function patients()
    {
        return $this->belongsTo('App\models\Patient','patient_id');
    }

    public function prescriptions()
    {
        return $this->hasOne(Prescription::class);
    }
}
