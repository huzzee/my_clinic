<?php

namespace App\models;

use App\models\MedicalRecord;
use Illuminate\Database\Eloquent\Model;
use App\models\Queue;

class Patient extends Model
{
    protected $fillable = [
        'creator_id','patient_info','patient_code','drug_allergy','medical_info','entity_id'
    ];

    protected $casts =[
        'patient_info' => 'array',
        'drug_allergy' => 'array',
        'medical_info' => 'array'
    ];

    public function users()
    {
        return $this->belongsTo('App\User','creator_id');
    }

    public function medical_records()
    {
        return $this->hasMany(MedicalRecord::class);
    }

    public function queues()
    {
        return $this->hasMany(Queue::class);
    }
    public function prescriptions()
    {
        return $this->hasMany(Prescription::class);
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class,'id')->orderBy('id','desc');
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }
}
