<?php
use App\models\Menu;
use App\models\Permission;


function callMenus(){

    $menus = Permission::with('menus')
        ->where('role_id','=',Auth::user()->role_id)
        ->where('active','=',1)
        ->whereHas('menus',function ($e){
            $e->where('status','=',1);
        })->get();

    /*$menus = Menu::where('menus.status', 1)
        ->where('menus.hidden','=',0)
        ->where('menus.super_admin_role','=',1)
        ->orderBy('sort_order','asc')->get();*/

    //dd($menus);
    return $menus;
}

function check_user_privilage($role_id){

    //dd(Request::getRequestUri());
    $p_arr = [];

    $permissions = DB::table('permissions')
        ->leftjoin('menus', 'menus.id', '=', 'permissions.menu_id')
        ->select('menus.menu_route')
        ->where('permissions.role_id','=', $role_id)
        ->where('permissions.active', '=', 1)
        ->whereNotNull('menus.menu_route')
        ->get();


    /*$permissions = Permission::with('menus')
    ->whereHas('menus',function($query){
        $query->whereNotNull('menu_route');
    })->where('user_id',Auth::user()->id)->where('status',1)->get();*/


    foreach ($permissions as $value) {

        array_push($p_arr, $value->menu_route);
    }

    $data = in_array(Request::route()->getName(), $p_arr);

    /*if(!$data) {
        return abort(404);
    }*/
    return $data;


}

