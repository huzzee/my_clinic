<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $fillable = [
        'entity_id','patient_id','doctor_id','schedule_detail_id','appointment_date',
        'token_no','status'
    ];

    public function patients()
    {
        return $this->belongsTo('App\models\Patient','patient_id');
    }

    public function user_informations()
    {
        return $this->belongsTo('App\models\UserInformation','doctor_id');
    }

    public function schedule_details()
    {
        return $this->belongsTo('App\models\ScheduleDetail','schedule_detail_id');
    }
}
