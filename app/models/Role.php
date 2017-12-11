<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = [
        'role_name'
    ];

    public function users()
    {
        return $this->hasMany('App\User','id');
    }

    public function permissions()
    {
        return $this->hasMany('App\model\Permission','id');
    }
}
