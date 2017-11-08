<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
    protected $fillable = [
        'entity_id','medicine_info'
    ];

    protected $casts = [
        'medicine_info' => 'array'
    ];

    public function adjustments()
    {
        return $this->hasMany(Adjustment::class)->orderBy('adjustments.id','desc');
    }
}
