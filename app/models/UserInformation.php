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

    public function schedules()
    {
        return $this->hasMany('App\models\Schedule','id');
    }

    public function leaves()
    {
        return $this->hasMany('App\models\Leave','id');
    }
    public function medical_records()
    {
        return $this->hasMany('App\models\MedicalRecord','id');
    }

    public function queues()
    {
        return $this->hasMany('App\models\Queue','id');
    }

    public function prescriptions()
    {
        return $this->hasMany('App\models\Prescription','id');
    }

    public function payments()
    {
        return $this->hasMany('App\models\Prescription','id');
    }

    public function invoices()
    {
        return $this->hasMany('App\models\Invoice','id');
    }
}
