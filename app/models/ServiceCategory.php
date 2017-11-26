<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class ServiceCategory extends Model
{
    protected $fillable =[
        'category_name','entity_id'
    ];

    public function clinic_services()
    {
        return $this->hasMany(ClinicService::class);
    }
}
