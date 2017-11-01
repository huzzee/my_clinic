<?php
use App\models\Menu;


function callMenus(){



    $menus = Menu::where('menus.status', 1)
        ->where('menus.hidden','=',0)
        ->where('menus.super_admin_role','=',1)
        ->orderBy('sort_order','asc')->get();

    //dd($menus);
    return $menus;
}

function callMenus2(){



    $menus = Menu::where('menus.status', 1)
        ->where('menus.hidden','=',0)
        ->where('menus.super_admin_role','=',null)
        ->orderBy('sort_order','asc')->get();

    //dd($menus);
    return $menus;
}

