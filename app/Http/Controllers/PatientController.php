<?php

namespace App\Http\Controllers;

use App\models\Patient;
use Illuminate\Http\Request;
use App\models\UserInformation;
use App\models\Entity;
use App\User;
use Illuminate\Support\Facades\DB;
use Auth;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $patient = Patient::with('users')->where('entity_id','=',Auth::user()->entity_id)
            ->get();
         return view('pages.patients.managePatient',array(
             'patients' => $patient
         ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $doctor = UserInformation::with('users')->whereNotNull('doctor_info')
            ->whereHas('users',function ($query){
                $query->where('users.status','=',1);
            })->get();

        return view('pages.patients.createPatient',array(
            'doctors' => $doctor
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());
        $upload_dir = base_path() . '/public/uploads';

        $request->validate([
            'full_name' =>' required|string',
            'gender' => 'required',
            'contact_no' => 'required',
            'date_of_birth' => 'required'
        ]);

        /**/

        $patient = new Patient;

        $patient->creator_id = Auth::user()->id;
        $patient->patient_code = Auth::user()->id.''.$request->patient_code;
        $patient->entity_id = Auth::user()->entity_id;
        $patient->patient_info = [
            'full_name' => $request['full_name'],
            'contact_no' => $request['contact_no'],
            'gender' => $request['gender'],
            'date_of_birth' => $request['date_of_birth'],
            'email' => $request['email'],
            'address' => $request['address'],
            'rel_contact_no' => $request['rel_contact_no'],
            'patient_identity_name' => $request['patient_identity_name'],
            'patient_identity_no' => $request['patient_identity_no'],
            'martial' => $request['martial']
        ];
        if($request->patient_file !== null)
        {
            $file = $request->file('patient_file');
            $ext = $file->getClientOriginalExtension();
            $filename = $request->get('patient_code').'.'.$ext;
            $file->move($upload_dir, $filename);
        }
        else
        {
            $filename = null;
        }

        $patient->medical_info = [
            'blood_group' => $request['blood_group'],
            'surgery' => $request['surgery'],
            'illness' => $request['illness'],
            'g6pd' => $request['g6pd'],
            'insurance' => $request['insurance'],
            'patient_file' => $filename,
        ];
        $patient->drug_allergy = $request->drug_allergy;

        $patient->save();

        return redirect('patients')->with('message','Patient Successfully Added');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $patient = Patient::with('users')->where('id','=',$id)->first();

        return view('pages.patients.showPatient',array(
            'patient' => $patient
        ));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $patient = Patient::with('users')->where('id','=',$id)->first();
        //dd($patient->drug_allergy['drug_name']);
        return view('pages.patients.editPatient',array(
            'patient' => $patient
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //dd($request['patient_info']['patient_identity_name']);
        $upload_dir = base_path() . '/public/uploads';


        /**/

        $patient = Patient::findOrFail($id);


        $patient->patient_info = [
            'full_name' => $request['patient_info']['full_name'],
            'contact_no' => $request['patient_info']['contact_no'],
            'gender' => $request['patient_info']['gender'],
            'date_of_birth' => $request['patient_info']['date_of_birth'],
            'email' => $request['patient_info']['email'],
            'address' => $request['patient_info']['address'],
            'rel_contact_no' => $request['patient_info']['rel_contact_no'],
            'patient_identity_name' => $request['patient_info']['patient_identity_name'],
            'patient_identity_no' => $request['patient_info']['patient_identity_no'],
            'martial' => $request['patient_info']['martial']
        ];
        if($request->patient_file !== null)
        {
            $file = $request->file('patient_file');
            $ext = $file->getClientOriginalExtension();
            $filename = $patient->patient_code.'.'.$ext;
            $file->move($upload_dir, $filename);
        }
        else
        {
            $filename = $patient->medical_info['patient_file'];
        }

        $patient->medical_info = [
            'blood_group' => $request['medical_info']['blood_group'],
            'surgery' => $request['medical_info']['surgery'],
            'illness' => $request['medical_info']['illness'],
            'g6pd' => $request['medical_info']['g6pd'],
            'insurance' => $request['medical_info']['insurance'],
            'patient_file' => $filename,
        ];
        $patient->drug_allergy = $request->drug_allergy;

        $patient->save();

        return redirect('patients')->with('message','Patient Successfully Edited');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $patient = Patient::findOrFail($id);
        $patient->delete();

        return redirect('patients')->with('message','Patient Successfully Deleted');
    }
}