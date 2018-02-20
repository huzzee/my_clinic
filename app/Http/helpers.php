<?php
use App\models\Menu;
use App\models\Permission;
use App\models\Appointment;
use Carbon\Carbon;

function dformat($nday) {

    $dowMap = array('Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday');
    return $dowMap[$nday];
}

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

function delete_app()
{
    $appointments = Appointment::with('schedule_details','user_informations','patients')
        ->where('status','=',0)
        ->where('appointment_date','<',date('Y-m-d',strtotime(Carbon::now(get_local_time()))))
        ->where('entity_id','=',auth()->user()->entity_id)->get()->toArray();

    //dd($appointments[0]);

    if (sizeof($appointments) >= 1)
    {
        for($i=0; $i < sizeof($appointments); $i++)
        {
            $app = Appointment::findOrFail($appointments[$i]['id']);
            $app->status = 2;
            $app->save();
        }
    }
}

function get_local_time()
{
    $ip = file_get_contents("http://ipecho.net/plain");
    $url = 'http://ip-api.com/json/'.$ip;
    $tz = file_get_contents($url);
    $tz = json_decode($tz,true)['timezone'];

    return $tz;
}

function age() {
    return $this->dob->diffInYears(Carbon::now());
}

