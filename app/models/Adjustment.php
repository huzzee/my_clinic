<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Adjustment extends Model
{
    protected $fillable = [
        'medicine_id','user_id','bought_qnt','adjust',''
    ];

    public function medicines()
    {
        return $this->belongsTo(Medicine::class);
    }

    public function users()
    {
        return $this->belongsTo('App\User','user_id');
    }
}
