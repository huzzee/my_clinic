<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class ClinicService extends Model
{
    protected $fillable =[
        'service_name','rate','entity_id','service_category_id'
    ];

    public function service_categories()
    {
        return $this->belongsTo('App\models\ServiceCategory','service_category_id');
    }
}
