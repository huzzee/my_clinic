<?php
use App\models\Menu;


function callMenus(){



    $menus = Menu::where('menus.status', 1)
        ->where('menus.hidden','=',0)
        ->orderBy('sort_order','desc')->get();

    //dd($menus);
    return $menus;
}

function check_code($code)
{
    if(Auth::user()->entities->entity_code !== $code)
    {
        return abort(404);
    }
}