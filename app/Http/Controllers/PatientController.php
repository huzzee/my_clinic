<?php

namespace App\Http\Controllers;

use App\models\MedicalRecord;
use App\models\Patient;
use Illuminate\Http\Request;
use App\models\UserInformation;
use Illuminate\Support\Facades\Cache;
use App\models\Entity;
use App\User;
use Auth;
use DB;
use Illuminate\Support\Facades\Storage;

class PatientController extends Controller
{
    public function __construct()
    {
        $this->middleware('user_privilage',['except'=>['store','update','get_state','get_cities']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $patient = Patient::with('users','medical_records')->where('entity_id','=',Auth::user()->entity_id)
            ->latest()->get();

        //dd($patient);
        //$states = DB::table('states')->get();
        $countries = Cache::rememberForever('countries2', function() {
            return DB::table('countries2')->get();
        });

        $languages =  DB::table('languages')->get();
        $edit_languages =  DB::table('languages')->pluck('name','name');

        $edit_countries = Cache::rememberForever('countries22', function() {
            return DB::table('countries2')->pluck('name','name');
        });

        //dd($edit_countries);

        //$cities = DB::table('cities')->get();
        /*$cities = Cache::rememberForever('cities', function() {
            return DB::table('cities')->get();
        });*/

        $doctor = UserInformation::with('users')
            ->whereNotNull('doctor_info')
            ->whereHas('users',function ($query){
                $query->where('entity_id','=',Auth::user()->entity_id);
            })->get();

        $doctor_create = UserInformation::with('users')->whereNotNull('doctor_info')
            ->whereHas('users',function ($query){
                $query->where('users.status','=',1);
            })->get();

         return view('pages.patients.managePatient',array(
             'patients' => $patient,
             'doctors' => $doctor,
             'docs' => $doctor_create,
             'countries' => $countries,
             'languages' => $languages,
             'edit_languages' => $edit_languages,
             'edit_countries' => $edit_countries

         ));
    }

    /*
     * ajax functions
     * also have privilage security
     * add to constructor*/
    public function get_state()
    {
        $country = DB::table('countries2')->where('countries2.name',request()->country_id)->first();
        $state = DB::table('states')->where('states.country_id',$country->id)->get();

        return response()->json($state);
    }

    public function get_cities()
    {
        $state = DB::table('states')->where('states.name',request()->state_id)->first();
        $cities = DB::table('cities')->where('cities.state_id',$state->id)->get();

        return response()->json($cities);
    }




    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->upload_photo);
        $upload_dir = base_path() . '/public/uploads';

        if($request->upload_photo == "0")
        {
            //dd($request->profile_photo);
            $request->validate([
                'full_name' =>' required|string',
                'gender' => 'required',
                'contact_no' => 'required',
                'date_of_birth' => 'required',
                'country' => 'required',
                'state' => 'required',
                'profile_photo' => 'image|mimes:jpeg,png|max:2048'
            ]);

            $profile = $request->file('profile_photo');
            $ext = $profile->getClientOriginalExtension();
            $profilename = $request->get('contact_no').'-'.'.'.$ext;
            $profile->move($upload_dir, $profilename);
        }
        elseif ($request->upload_photo == "1")
        {
            //dd($request->upload_photo);
            $request->validate([
                'full_name' =>' required|string',
                'gender' => 'required',
                'contact_no' => 'required',
                'date_of_birth' => 'required',
                'country' => 'required',
                'state' => 'required',
            ]);

            $binary_data = file($request->webcam_photo);

            $profilename = $request->get('contact_no').'-'.'.jpeg';

            $result = file_put_contents( $upload_dir.'/'.$profilename, $binary_data );
            //dd($result);
        }
        elseif ($request->upload_photo == null)
        {
            $request->validate([
                'full_name' =>' required|string',
                'gender' => 'required',
                'contact_no' => 'required',
                'date_of_birth' => 'required',
                'country' => 'required',
                'state' => 'required',
            ]);
            $profilename = 'avatar.png';
        }


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
            'country' => $request['country'],
            'city' => $request['city'],
            'state' => $request['state'],
            'profile_image' => $profilename,
            'language' => $request['language']
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
        $allergy = [];
        for($i=0; $i < sizeof($request->drug_name); $i++)
        {
           $drugs = [
               'drug_name' => $request->drug_name[$i],
               'drug_comment' => $request->drug_comment[$i],
           ];

           array_push($allergy,$drugs);
        }
        $patient->drug_allergy = $allergy;

        $patient->save();

        return redirect('patients')->with('message','Patient Successfully Added');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\models\Patient  $patient
     * @return \Illuminate\Http\Response
     */


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\models\Patient  $patient
     * @return \Illuminate\Http\Response
     */

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $upload_dir = base_path() . '/public/uploads';



        /**/

        $patient = Patient::findOrFail($id);

        if($request->upload_photo == "0")
        {

            if ($request->file('profile_photo'))
            {


                $profile = $request->file('profile_photo');
                $ext = $profile->getClientOriginalExtension();
                $profilename = $request['patient_info']['contact_no'].'-'.'.'.$ext;

                Storage::Delete($upload_dir.'/'.$profilename);
                $profile->move($upload_dir, $profilename);
            }
            else
            {
                $profilename = $patient->patient_info['profile_image'];
            }
            //dd($request->profile_photo);


        }
        elseif ($request->upload_photo == "1")
        {
            //dd($patient->patient_info['profile_image']);
            if($request->webcam_photo !== null)
            {
                //dd($request->webcam_photo);
                $binary_data = file($request->webcam_photo);

                $profilename = $request['patient_info']['contact_no'].'-'.'.jpeg';

                Storage::Delete($upload_dir.'/'.$profilename);

                $result = file_put_contents( $upload_dir.'/'.$profilename, $binary_data );
            }
            else
            {
                $profilename = $patient->patient_info['profile_image'];
            }

            //dd($result);
        }
        elseif ($request->upload_photo == null)
        {


            $profilename = $patient->patient_info['profile_image'];
        }


        $patient->patient_info = [
            'full_name' => $request['patient_info']['full_name'],
            'contact_no' => $request['patient_info']['contact_no'],
            'gender' => $request['patient_info']['gender'],
            'date_of_birth' => $request['patient_info']['date_of_birth'],
            'email' => $request['patient_info']['email'],
            'address' => $request['patient_info']['address'],
            'country' => $request['patient_info']['country'],
            'city' => $request['city'],
            'state' => $request['state'],
            'profile_image' => $profilename,
            'language' => $request['patient_info']['language']
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
        $allergy = [];
        for($i=0; $i < sizeof($request->drug_name); $i++)
        {
            $drugs = [
                'drug_name' => $request->drug_name[$i],
                'drug_comment' => $request->drug_comment[$i],
            ];

            array_push($allergy,$drugs);
        }
        $patient->drug_allergy = $allergy;


        $patient->save();

        return redirect('patients')->with('message','Patient Successfully Updated');
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
