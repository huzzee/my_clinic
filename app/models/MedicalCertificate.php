<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class MedicalCertificate extends Model
{
    protected $fillable = [
        'entity_id','doctor_id','patient_id','prescription_id','date_of_visit','date_of_issue',
        'start_date','end_date','time_in','time_out','certificate_type','description','remarks'
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
        return $this->belongsTo(Prescription::class,'prescription_id');
    }
}
