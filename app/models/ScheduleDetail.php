<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class ScheduleDetail extends Model
{
    protected $fillable = [
        'days','start_time','end_time','per_patient_time','schedule_id','type'
    ];

    public function schedules()
    {
        return $this->belongsTo(Schedule::class);
    }
}
