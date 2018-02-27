<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{
    protected $fillable = [
        'entity_id','doctor_id','patient_id','prescriptions','queue_id'
    ];

    protected $casts = [
        'prescriptions' => 'array'
    ];

    public function user_informations()
    {
        return $this->belongsTo('App\models\UserInformation','doctor_id');
    }

    public function patients()
    {
        return $this->belongsTo('App\models\Patient','patient_id');
    }

    public function queues()
    {
        return $this->belongsTo('App\models\Queue','queue_id');
    }

    public function invoices()
    {
        return $this->hasOne('App\models\Invoice','id');
    }

    public function medicalRecords()
    {
        return $this->hasOne('App\models\MedicalRecord','id');
    }

    public function medicalCertificates()
    {
        $this->hasOne('App\models\MedicalCertificate','id');
    }
}
