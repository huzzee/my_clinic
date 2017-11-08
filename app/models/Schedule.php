<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $fillable = [
        'entity_id','doctor_id','status'
    ];

    public function schedule_details()
    {
        return $this->hasMany(ScheduleDetail::class);
    }

    public function user_informations()
    {
        return $this->belongsTo('App\models\UserInformation','doctor_id');
    }
}
