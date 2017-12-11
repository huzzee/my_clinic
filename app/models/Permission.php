<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $fillable = [
        'role_id','menu_id','active'
    ];

    public function roles()
    {
        return $this->belongsTo('App\models\Role','role_id');
    }

    public function menus()
    {
        return $this->belongsTo('App\models\Menu','menu_id');
    }
}
