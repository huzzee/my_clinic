<?php

namespace App\Http\Controllers;

use App\models\Prescription;
use Illuminate\Http\Request;
use Auth;

class PrescriptionController extends Controller
{
    public function __construct()
    {
        $this->middleware('user_privilage');
    }

    public function index()
    {
        $prescriptions = Prescription::with('user_informations','patients')
        ->where('entity_id','=',Auth::user()->entity_id)->get();

        return view('pages.prescriptions.prescription',array(
            'prescriptions' => $prescriptions
        ));
    }

    public function show($id)
    {
        $prescriptions = Prescription::with('user_informations','patients')
            ->where('id','=',$id)->first();

        return view('pages.prescriptions.showPrescription',array(
            'prescription' => $prescriptions
        ));
    }
}
