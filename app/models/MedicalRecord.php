<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class MedicalRecord extends Model
{
    protected $fillable = [
      'entity_id','doctor_id','patient_id','health_info','image_url','typing_Note',
        'upload_file','template','diagnose','status','prescription_id'
    ];

    protected $casts = [
        'health_info' => 'array',
        'upload_file' => 'array',
        'template' => 'array',
        'diagnose' => 'array'

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
        return $this->belongsTo('App\models\Prescription','prescription_id');
    }
}
