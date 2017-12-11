<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $fillable = [
        'menu_name','menu_slug','menu_route','parent_menu_id','menu_icon','sort_order','status',
        'hidden','super_admin_role'
    ];

    public function permissions()
    {
        return $this->hasMany('App\model\Permission','id');
    }
}
