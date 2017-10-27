<?php
use App\models\Menu;

function callMenus(){

    $role_id = Auth::user()->id;

    $menus = Menu::with('menus')->where('menus.status', 1)->where('menus.role_id',$role_id)
        ->where('menus.hidden','=',0)->orderBy('sort_order','desc')->get();

    //dd($menus);
    return $menus;
}