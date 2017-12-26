<?php

namespace App\Http\Controllers;

use App\models\Permission;
use Illuminate\Http\Request;
use App\models\Menu;
use Illuminate\Support\Facades\DB;

class PermissionController extends Controller
{
    public function __construct()
    {
        $this->middleware('user_privilage',['except' => [
            'role_chk',
            'updatePermissions'
        ]]);
    }

    public function index()
    {
        return view('pages.permissions.permission');
    }

    public function role_chk()
    {
        $roleId = request()->role_id;
        $menus = Menu::all()->toArray();

        $pdata = Permission::where('role_id', $roleId)->get();
        if(!isset($pdata[0]))
        {

            for ($i=0; $i < sizeof($menus) ; $i++) {

                $permissions = new Permission;
                $permissions->role_id = $roleId;
                $permissions->menu_id = $menus[$i]['id'];
                $permissions->active = 0;
                $permissions->save();

            }

            $menu_table = Permission::with('menus')
                ->where('role_id','=',$roleId)->get();


        }
        else {

            $menu_table = Permission::with('menus')
                ->where('role_id','=',$roleId)->get();

        }




        return response()->json($menu_table);

    }

    public function updatePermissions() {

        if(request()->ajax()){

            if(request()->get('active')=='true') { $active = 1; }else{  $active = 0; }
            $permissions = Permission::findOrFail(request()->get('permission_id'));
            $permissions->active = $active;
            $permissions->save();
            return Response::json($permissions);

        }

    }
}
