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
    public function index($code)
    {
       //dd($code);
        check_code($code);
        return view('home');
    }
}
