<?php

namespace App\Http\Controllers;

use App\models\MedicalRecord;
use App\models\Patient;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\models\UserInformation;
use Illuminate\Support\Facades\Cache;
use App\models\Entity;
use App\User;
use Auth;
use DB;
use Illuminate\Support\Facades\Storage;
use Form;

class PatientController extends Controller
{
    public function __construct()
    {
        $this->middleware('user_privilage',['except'=>[
            'store','update','get_state','get_cities','get_patient_info'
        ]]);
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
             'languages' => $languages


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

    public function get_patient_info()
    {
        $patient_id = request()->patient_id;

        $edit_languages =  DB::table('languages')->pluck('name','name');

        $edit_countries = Cache::rememberForever('countries22', function() {
            return DB::table('countries2')->pluck('name','name');
        });

        $patient = Patient::with('users','medical_records','appointments','invoices')
            ->where('entity_id','=',Auth::user()->entity_id)
            ->where('id','=',$patient_id)->first();




        $age = date('Y',strtotime(Carbon::now(get_local_time()))) - date('Y',strtotime($patient->patient_info['date_of_birth']));

        if($patient->patient_info['gender'] == 0)
        {
            $gender = 'MALE';
        }
        else{
            $gender = 'FEMALE';
        }


        $timline_article = '';

        foreach($patient->medical_records as $records)
        {
            $timline_article .= '
                <article class="timeline-item ">
                    <div class="timeline-desk">
                        <div class="panel">
                            <div class="timeline-box">
                                <span class="arrow"></span>
                                <span class="timeline-icon" 
                                        style="width: 60px !important;
                                        height: 50px !important;
                                        border-radius: 0px !important; background-color: white; border: 1px solid grey; color: black">
                                    <div>'. date('d',strtotime($records->created_at)) .' <br>
                                            '. date('M*y',strtotime($records->created_at)) .'
                                    </div>
                                </span>
                                
                            </div>
                        </div>
                    </div>
                </article>
            ';

        }

        $drug_allergy = '';

        for($i=0; $i < sizeof($patient->drug_allergy); $i++)
        {
            $drug_allergy .= '
                <div class="col-sm-12">
                    <h6 style="margin: 2px;">- '.$patient->drug_allergy[$i].' &nbsp;&nbsp;<button type="button" class="btn btn-pink remove_item1" style="font-size: 11px; padding: 2px;">X</button></h6>
                    <input type="hidden" name="drug_name[]" value="'.$patient->drug_allergy[$i].'">
                </div>
            ';
        }

        $medical_history = '';

        for($j=0; $j < sizeof($patient->medical_info); $j++)
        {
            $medical_history .= '
                    <div class="col-sm-12">
					    <h6 style="margin: 2px;">- '.$patient->medical_info[$j].'&nbsp;&nbsp; <button type="button" class="btn btn-pink remove_item1" style="font-size: 11px; padding: 2px;">X</button></h6>
					    <input type="hidden" name="medical_info[]" value="'.$patient->medical_info[$j].'">
                    </div>
            ';
        }

        $patient_profile ='
                <div class="col-md-9">
                    <div class="row">
                        <div class="col-md-1" style="height: 50px;">

                            <img src="'.asset('uploads/'.$patient->patient_info['profile_image'].'?v='.Carbon::now()).'"
                             style="width: 50px; height: 50px;
                             border: 2px solid lightseagreen;
                             border-radius: 50px;
                             margin: 0;">
                             &nbsp;&nbsp;&nbsp;

                        </div>
                        <div class="col-md-4">
                            <p>
                                <strong style="color: darkslategrey">'. $patient->patient_info['full_name'] .'</strong>
                                <br/>

                                 <small>'.$gender.'</small>
                                 &nbsp;

                                 <small>'.$age.' Age</small>
                             </p>
                        </div>
                        <div class="col-md-5">

                            <strong style="color: darkslategrey">Email: </strong><small>'.$patient->patient_info['email'].'</small>
                            <br/>
                            <strong style="color: darkslategrey">Contact No: </strong><small>'.$patient->patient_info['contact_no'].'</small>

                        </div>
                        <div class="col-md-2">
                            <button type="button" class="btn btn-default waves-effect edit_patient_modal" data-patientId="'.$patient->id.'" data-toggle="modal" data-target="#full-width-modal-edit'.$patient->id.'">Edit Patient</button>
                            
                            <div id="full-width-modal-edit'.$patient->id.'" class="modal fade" role="dialog" aria-labelledby="full-width-modal-edit'.$patient->id.'" aria-hidden="true" style="display: none;">
                                <div class="modal-dialog modal-full">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                <h4 class="modal-title" id="full-width-modalLabel-create">Edit Patient</h4>
                                            </div>
                                            '.Form::model($patient, ['method' => 'PATCH','url' => ['patients', $patient->id], 'files'=>true]).'
                                           
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-sm-12"><h4>General Information</h4><hr></div>
                                                    <div class="col-sm-2">
        
                                                        <div class="col-sm-8 hidden-md hidden-sm hidden_div2"></div>
                                                        <div class="col-md-8 uploading2" style="display: none; align-items: left">
                                                            <div class="form-group">
        
                                                                <input type="file" class="filestyle upload_to_plus2" data-input="false">
        
                                                            </div>
                                                        </div>
                                                        <div class="col-md-8 taking_pic2" style="display: none;">
                                                            <div class="row">
        
        
                                                                <div class="col-md-4" align="center">
                                                                    <div id="main_camera2">
        
                                                                    </div>
                                                                    <button type="button" style="align-self:center; " class="btn btn-primary take_snapshot2">take snap</button>
        
                                                                </div>
        
        
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
        
                                                            <button id="results2" type="button" class="dropdown-toggle"
                                                                    data-toggle="dropdown" aria-expanded="false"
                                                                    style="border-radius: 130px;
                                                                            border: none;
                                                                            background-color: white;
                                                                            width: 70px;height: 70px;">
                                                                            <img src="'.asset('uploads/'.$patient->patient_info['profile_image'].'?v='.Carbon::now()).'"
                                                                             style="width: 100%; height: 100%;
                                                                             border-radius: 60px;
                                                                                ">
                                                                             
                                                            </button>
                                                            <ul class="dropdown-menu">
                                                                <li><a href="#" class="upload_image_pat2">Upload Image</a></li>
                                                                <li><a href="#" class="snap_image_pat2">Take Snapshot</a></li>
                                                            </ul>
        
        
                                                        </div>
        
        
                                                    </div>
                                                    <div class="col-sm-10">
        
                                                        <div class="row p-20" style="clear: both;">
        
                                                            <div class="col-sm-4">
                                                                <div class="form-group">
                                                                    <label for="full_name" class="control-label">Full Name<span class="text-danger">*</span></label>

                                                                    '.Form::text('patient_info[full_name]' , null ,['class' => 'form-control input-sm','parsley-trigger' => 'change']).'
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <div class="form-group">
                                                                    <label for="full_name" class="control-label">Contact No<span class="text-danger">*</span></label>

                                                                    '.Form::number('patient_info[contact_no]' , null ,['class' => 'form-control input-sm','parsley-trigger' => 'change']).'

                                                                </div>
                                                            </div>

                                                            <div class="col-sm-4">
                                                                <div class="form-group">
                                                                    <label for="full_name" class="control-label">Email</label>
                                                                    <input type="email" id="fake-email" name="fake-email" style="display: none;">

                                                                    '.Form::text('patient_info[email]' , null ,['class' => 'form-control input-sm','parsley-trigger' => 'change']).'
                                                                </div>
                                                            </div>


                                                            <div class="col-sm-4">
                                                                <div class="form-group">
                                                                    <label for="full_name" class="control-label">Gender<span class="text-danger">*</span></label>
                                                                    <div>
                                                                        <div class="radio radio-info radio-inline">

                                                                            '.Form::radio('patient_info[gender]', 0,['id' => 'inlineRadio8']).'
                                                                            <label for="inlineRadio8"> Male </label>
                                                                        </div>
                                                                        <div class="radio radio-pink radio-inline">

                                                                            '.Form::radio('patient_info[gender]', 1,['id' => 'inlineRadio9']).'
                                                                            <label for="inlineRadio9"> Female </label>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-sm-4">
                                                                <div class="form-group">
                                                                    <label for="full_name" class="control-label">Date Of Birth<span class="text-danger">*</span></label>

                                                                    '.Form::text('patient_info[date_of_birth]' , null ,['class' => 'form-control input-sm','id' => 'datepicker-autoclose','placeholder' => 'mm/dd/yyyy']).'

                                                                </div>
                                                            </div>

                                                            <div class="col-sm-4">
                                                                <div class="form-group">
                                                                    <label for="full_name" class="control-label">Language Preference</label>
                                                                    '.Form::select('patient_info[language]',$edit_languages,null ,['class' => 'form-control select2']).'

                                                                </div>
                                                            </div>

                                                            <div class="col-sm-4">
                                                                <div class="form-group">
                                                                    <label for="full_name" class="control-label">Country<span class="text-danger">*</span></label>
                                                                    '.Form::select('patient_info[country]',$edit_countries,null ,['class' => 'form-control select2 country2','id' => 'country'.$patient->id,'data-patientId' => $patient->id]).'

                                                                </div>
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <div class="form-group">
                                                                    <label for="full_name" class="control-label">State<span class="text-danger">*</span></label>
                                                                    <select class="form-control select2 state2" name="state" id="state'.$patient->id.'" data-patientId="'.$patient->id.'">
                                                                        <option value="'.$patient->patient_info['state'].'" selected>'.$patient->patient_info['state'].'</option>

                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="col-sm-4">
                                                                <div class="form-group">
                                                                    <label for="full_name" class="control-label">City<span class="text-danger">*</span></label>
                                                                    <select class="form-control select2 city2" name="city" id="city'.$patient->id.'">
                                                                        <option value="'.$patient->patient_info['city'].'" selected>'.$patient->patient_info['city'].'</option>

                                                                    </select>
                                                                </div>
                                                            </div>

        
                                                            <div class="col-sm-8">
                                                                <div class="form-group">
                                                                    <label for="address" class="control-label">Address</label>
                                                                    '.Form::text('patient_info[address]' , null ,['placeholder'=> 'Enter Address','class' => 'form-control input-sm','parsley-trigger' => 'change']).'
                                                                    
                                                                </div>
                                                            </div>
        
        
                                                        </div>
        
                                                    </div>
        
        
                                                </div>
        
                                                <div class="row">
                                                    <div class="col-md-12"><h4>Medical Profile</h4><hr></div>
                                                    <div class="col-md-12">
        
                                                        <div class="row p-20" style="clear: both;">
                                                            <div class="col-sm-4">
                                                                <label for="medical_history" class="control-label">Personal Medical History</label>
                                                                <div class="row">
        
                                                                    <div class="col-sm-10" style="border: 1px solid grey; padding: 10px;">
                                                                        <div class="row" id="here_medical_history2">
                                                                        
                                                                            '. $medical_history .'
        
                                                                        </div>
        
                                                                        <div class="row">
                                                                            <div class="col-xs-8">
                                                                                <input type="text" parsley-trigger="change"
                                                                                       placeholder="Add Medical History" autocomplete="off" class="form-control input-sm medical_history_pat2"/>
        
                                                                            </div>
                                                                            <div class="col-xs-4">
                                                                                <button type="button" class="btn btn-teal add_history2" style="font-size: 11px;" >Add</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
        
        
                                                            <div class="col-sm-4">
                                                                <label for="medical_history" class="control-label">Drug Allergy</label>
                                                                <div class="row">
        
                                                                    <div class="col-sm-10" style="border: 1px solid grey; padding: 10px;">
                                                                        <div class="row" id="here_drug_allegy2">
                                                                            '.$drug_allergy.'
                                                                        </div>
        
                                                                        <div class="row">
                                                                            <div class="col-xs-8">
                                                                                <input type="text" parsley-trigger="change"
                                                                                       placeholder="Add Drug Allergy" autocomplete="off" class="drug_name_pat2 form-control input-sm"/>
        
                                                                            </div>
                                                                            <div class="col-xs-4">
                                                                                <button type="button" class="btn btn-teal add_drug2" style="font-size: 11px;">Add</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
        
                                                            <div class="col-sm-4">
                                                                <div class="form-group">
                                                                    <label for="medical_history" class="control-label">Important Patient Note</label>
                                                                    
                                                                  '.Form::textarea('patient_info[important_note]',null ,['placeholder' => 'Enter Important Here','class' => 'form-control','maxlength' => '225','rows' => '3', 'id' => 'textarea2']).'
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row" id="error_here">
        
                                                        </div>
        
                                                    </div>
                                                </div>
                                            </div>
        
        
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cancel</button>
                                                '.csrf_field().'
        
        
                                                <button type="submit" class="btn btn-inverse waves-effect" style="float: right;margin-left: 1%;">Edit Patient</button>
        
        
                                            </div>
                                        </form>
                                    </div><!-- /.modal-content -->
                                </div><!-- /.modal-dialog -->
                            </div><!-- /.modal -->

                        </div>
                    </div>

                    <hr style="margin: 5px 0px 0px 0px;">

                    <div class="row">
                        <div class="col-xs-12">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="timeline timeline-left">
                                        <article class="timeline-item alt">
                                            <div class="text-left">
                                                <div class="time-show first">
                                                    <a href="javascript:void(0);" class="" style="color: black">Medical Records</a>
                                                </div>
                                            </div>
                                        </article>
                                        <article class="timeline-item left">
                                            <div class="timeline-desk">
                                                <div class="panel" >
                                                    <div class="timeline-box" style="background-color: white; border: 1px solid grey;">
                                                        <span class="arrow-alt"></span>
                                                        <span class="timeline-icon" 
                                                                style="width: 60px !important;
                                                                height: 50px !important;
                                                                border-radius: 0px !important; background-color: white; border: 1px solid grey; color: black">
                                                            <div>'. date('d',strtotime($patient->created_at)) .' <br>
                                                                    '. date('M*y',strtotime($patient->created_at)) .'
                                                            </div>
                                                        </span>
                                                        <div class="row">
                                                            <div class="col-sm-3">
                                                                <h4 class="">Record Data</h4>
                                                            </div>
                                                            <div class="col-sm-3">
                                                                <small>'. date('h:i',strtotime($patient->created_at)) .'-BY  Doctor name</small>
                                                            </div>
                                                        </div>
                                                        <hr style="color: black; border: 1px solid grey;">
                                                        <div class="row">
                                                            <p>'. $patient->patient_info['full_name'] .' Registered By '. $patient->users->name .'('.$patient->users->roles->role_name.')</p>
                                                        
                                                        </div>
                                                        
                                                        
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </article>
                                        '.$timline_article.'
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>';

        return response()->json($patient_profile);
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
                'profile_photo' => 'image|mimes:jpeg,png'
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
            'language' => $request['language'],
            'important_note' => $request['patient_note']
        ];


        $patient->medical_info = $request->medical_info;

        $patient->drug_allergy = $request->drug_name;

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

        //dd($request->all());
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
            //dd($request->all());
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
            'language' => $request['patient_info']['language'],
            'important_note' => $request['patient_info']['important_note']
        ];

        $patient->medical_info = $request->medical_info;

        $patient->drug_allergy = $request->drug_name;

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
