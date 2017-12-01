<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\Entity;

class ClinicController extends Controller
{
    public function index()
    {
        /*$clinic = Entity::with('users')->where('id','!=',1)->latest()->get();
        //dd($clinic[0]->users[0]->userInformations);
        return view('pages.clinic.manageClinic',array(
            'clinics' => $clinic
        ));*/
    }
    public function show()
    {

    }
}
