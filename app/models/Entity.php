<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Entity extends Model
{
    protected $fillable=[
        'entity_name','entity_code'
    ];

    protected $table = 'entities';

    public function users()
    {
        return $this->hasMany('App\User','id');
    }
}
