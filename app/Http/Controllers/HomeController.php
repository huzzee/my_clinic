<?php

namespace App\Http\Controllers;

use Auth;
use App\models\Entity;

use Illuminate\Http\Request;


class HomeController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //dd(Auth::user()->user_informations);
       //dd('ok');
        /*if(Auth::user()->role_id == 2)
        {
            return view('dashboards.adminDashboard');
        }*/
        return view('dashboards.adminDashboard');
    }
}
