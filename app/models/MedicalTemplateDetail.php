<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class MedicalTemplateDetail extends Model
{
    protected $fillable=[
        'question','medical_template_id','type','answers'
    ];

    protected $casts = [
        'answers' => 'array'
    ];

    public function medical_templates()
    {
        return $this->belongsTo(MedicalTemplate::class);
    }
}
