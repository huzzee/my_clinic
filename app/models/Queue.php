<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Queue extends Model
{
    protected $fillable = [
        'entity_id','doctor_id','patient_id','bill','paid','note','status'
    ];

    public function user_informations()
    {
        return $this->belongsTo('App\models\UserInformation','doctor_id');
    }

    public function patients()
    {
        return $this->belongsTo('App\models\Patient','patient_id');
    }
    public function invoices()
    {
        return $this->hasOne(Invoice::class);
    }
}
