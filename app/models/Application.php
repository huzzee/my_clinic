<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    protected $fillable=[
        'application_name'
    ];

    public function users()
    {
        return $this->hasMany('App\User','id');
    }
}
