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
       //dd($code);

        return view('home');
    }
}
