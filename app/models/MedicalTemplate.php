<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class MedicalTemplate extends Model
{
    protected $fillable=[
        'entity_id','template','title'
    ];

    public function medical_template_details()
    {
        return $this->hasMany(MedicalTemplateDetail::class);
    }
}
