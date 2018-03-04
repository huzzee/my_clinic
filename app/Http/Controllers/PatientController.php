<?php

namespace App\Http\Controllers;

use App\models\MedicalRecord;
use App\models\Patient;
use App\models\Prescription;
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
        //dd(Prescription::with('medicalCertificates')->get());

        $patient = Patient::with('users')->where('entity_id','=',Auth::user()->entity_id)
            ->OrderBy(ucfirst('patient_info->full_name'),'asc')->get();

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

        $patient = Patient::findOrFail($patient_id);

        $prescriptions = Prescription::with('user_informations',
            'medicalRecords','medicalCertificates')
        ->where('patient_id','=',$patient_id)->latest()->get();



        $timline_article = '';

        foreach($prescriptions as $prescription)
        {
            $medical_template = '';

            foreach($prescription->medicalRecords->template as $temp)
            {

                if(sizeof($temp['answers']) > 1)
                {
                    $answer = '';
                    for($o =0 ; $o < sizeof($temp['answers']); $o++)
                    {
                        $answer.= '
                            <div class="col-sm-3">
                                <input type="text" class="form-control"
                                    value="'. $temp['answers'][$o] .'" readonly>

                            </div>
                        ';
                    }

                }
                else
                {
                    $answer = '
                        <div class="col-sm-3">
                            <input type="text" class="form-control"
                                value="'. $temp['answers'] .'" readonly>

                        </div>
                    ';
                }


                $medical_template.='
                    <div class="form-group row">
                        <label for="patient_id" class="form-label col-sm-12"><span style="float: left;">'. $temp['question'] .'?</span></label>
                        '.$answer.'
                    </div>
                ';
            }


            /*for prescriptions*/

            $meds = '';

            foreach ($prescription->prescriptions as $prescribe)
            {
                $meds.= '
                    <tr>
                        <td>'.$prescribe['drug_name'].'</td>
                        <td>'.$prescribe['drug_qnt'].'</td>
                        <td>'.$prescribe['dosage_qnt'].'</td>
                        <td>'.$prescribe['days'].'</td>
                        <td>'.$prescribe['instruction'].'</td>
                    </tr>
                ';
            }


            if($prescription->medicalCertificates !== null)
            {
                $certificate =
                    '
                    <div class="row">
                                                
                        <div class="col-sm-5">
                            <div class="form-group">
                                <label for="full_name" class="control-label">Date Of Visit</label>
                                <p>'.$prescription->medicalCertificates->date_of_visit.'</p>
                            </div>
                        </div>
    
                        <div class="col-sm-5">
                            <div class="form-group">
                                <label for="full_name" class="control-label">Date Of Issue</label>
                                <p>'.$prescription->medicalCertificates->date_of_issue.'</p>
    
                            </div>
                        </div>
    
                        <div class="col-sm-5">
                            <div class="form-group">
                                <label for="full_name" class="control-label">Start Date</label>
                                <p>'.$prescription->medicalCertificates->start_date.'</p>
    
                            </div>
                        </div>
    
                        <div class="col-sm-5">
                            <div class="form-group">
                                <label for="full_name" class="control-label">End Date</label>
                                <p>'.$prescription->medicalCertificates->end_date.'</p>
    
                            </div>
                        </div>
    
                        <div class="col-sm-5">
                            <div class="form-group">
                                <label for="full_name" class="control-label">Time In</label>
                                <p>'.date('g:i a',strtotime($prescription->medicalCertificates->time_in)).'</p>
                            </div>
                        </div>
    
                        <div class="col-sm-5">
                            <div class="form-group">
                                <label for="full_name" class="control-label">Time Out</label>
                                <p>'.date('g:i a',strtotime($prescription->medicalCertificates->time_out)).'</p>
    
                            </div>
                        </div>
    
                        <div class="col-sm-5">
                            <div class="form-group">
                                <label for="full_name" class="control-label">MC Type</label>
                                <p>'.$prescription->medicalCertificates->certificate_type.'</p>
    
                            </div>
                        </div>
    
                        <div class="col-sm-5">
                            <div class="form-group">
                                <label for="full_name" class="control-label">Description</label>
                               <p>'.$prescription->medicalCertificates->description.'</p>
    
                            </div>
                        </div>
    
                        <div class="col-sm-10">
                            <div class="form-group">
                                <label for="full_name" class="control-label">Remarks</label>
                                <p>'.$prescription->medicalCertificates->remarks.'</p>
                            </div>
                        </div>
                    </div>
                ';
            }
            else
            {
                $certificate = '<p> No Certificate </p>';
            }


            /*for multiple files*/
            $upps = '';

            $inc = 1;
            for($j=0; $j < sizeof($prescription->medicalRecords->upload_file); $j++)
            {
                $upps.='
                        <div class="row">
                            <div class="col-sm-1"></div>
                            <div class="col-sm-11">
                                <h5 align="left"><a href="'. asset('uploads/'.$prescription->medicalRecords->upload_file[$j]) .'" target="_blank">Image '. $inc .'</a></h5>
                            </div>
                            
                        </div>
                        ';
                $inc++;
            }




            $timline_article.= '
                <article class="timeline-item left">
                    <div class="timeline-desk">
                        <div class="panel" >
                            <div class="timeline-box" style="background-color: white; border: 1px solid grey;">
                                <span class="arrow-alt"></span>
                                <span class="timeline-icon"
                                      style="width: 60px !important;
                                                height: 50px !important;
                                                border-radius: 0px !important; background-color: white; border: 1px solid grey; color: black">
                                    <div>'. date('d',strtotime($prescription->created_at)) .'<br>
                                                    '. date('M*y',strtotime($prescription->created_at)) .'
                                    </div>
                                </span>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <h4 class="">Records And Prescription</h4>
                                    </div>
                                    <div class="col-sm-4">
                                        <small>'. date('g:i a',strtotime($prescription->created_at)) .' -BY  '. $prescription->user_informations->users['name'] .'</small>
                                    </div>
                                    <div class="col-sm-4">
                                        <select class="select_pres_record2 select2"
                                                 data-prescription_id="'.$prescription->id.'">
                                            <option value="0">Vital Signs</option>
                                            <option value="1">Medical Notes</option>
                                            <option value="2">Medical Templates</option>
                                            <option value="3">Drawing Pad</option>
                                            <option value="4">Prescription</option>
                                            <option value="5">Medical Certificate</option>
                                            <option value="6">Files</option>
                                        </select>
                                    </div>
                                </div>
                                <hr style="color: black; border: 1px solid grey; margin-top: 10px;">
                                <div class="row">
                                    
                                    <div class="col-sm-12" id="vital_sign_hidden'.$prescription->id.'">
                                        <div class="row"><h3 style=" margin-left: 10px;">Vital Signs</h3></div>
                                        <div class="row">
                                            <div class="col-md-1"></div>
                                            <div class="col-md-2 m-t-10 form-group" align="center">
                                                <h1><i class="fa fa-balance-scale"></i></h1>
                                                <h5 style="color: grey;">WEIGHT</h5>
                                                <br>
                                                <br>
                                                <h5 style="color: grey; margin: 0px;">'.$prescription->medicalRecords->health_info['weight'].'</h5>
                                            </div>

                                            <div class="col-md-2 m-t-10 form-group" align="center">
                                                <h1>B.P</h1>
                                                <h5 style="color: grey;">B.Pressure</h5>
                                                <br>
                                                <br>
                                                <h5 style="color: grey; margin: 0px;">'.$prescription->medicalRecords->health_info['blood_pressure'].'</h5>
                                            </div>

                                            <div class="col-md-2 m-t-10 form-group" align="center">
                                                <h1><i class="fa fa-heartbeat"></i></h1>
                                                <h5 style="color: grey;">HEARTBEAT</h5>
                                                <br>
                                                <small>Heartbeat/Mint</small>
                                                <br>
                                                <h5 style="color: grey; margin: 0px;">'.$prescription->medicalRecords->health_info['heartbeat'].'</h5>
                                            </div>

                                            <div class="col-md-2 m-t-10 form-group" align="center">
                                                <h1><i class="mdi mdi-thermometer"></i></h1>
                                                <h5 style="color: grey;">TEMPERATURE</h5>
                                                <br>
                                                <br>
                                                <h5 style="color: grey; margin: 0px;">'.$prescription->medicalRecords->health_info['temperature'].'</h5>
                                            </div>

                                            <div class="col-md-2 m-t-10 form-group" align="center">
                                                <h1><i class="fa fa-odnoklassniki"></i></h1>
                                                <h5 style="color: grey;">RESP.RATE</h5>
                                                <br>
                                                <small>Breaths/Mint</small>
                                                <br>
                                                <h5 style="color: grey; margin: 0px;">'.$prescription->medicalRecords->health_info['breaths'].'</h5>
                                            </div>
                                            <div class="col-md-1"></div>
                                        </div>
                                    </div>

                                    <div class="col-sm-12" id="medical_note_hidden'.$prescription->id.'" style="display: none">

                                        <div class="row">
                                            <h3 style="margin-bottom:20px;margin-left: 10px;">Medical Note</h3>
                                        </div>
                                        
                                        <div>'. $prescription->medicalRecords->typing_Note .'</div>
                                        
                                    </div>

                                    <div class="col-sm-12" id="medical_template_hidden'.$prescription->id.'" style="display: none">

                                        <div class="row"><h3 style="margin-bottom:20px; margin-left: 10px;">Medical Template</h3></div>

                                        <div class="card-box">
                                            '.$medical_template.'
                                        </div>
                                    </div>

                                    <div class="col-sm-12" align="center" id="drawing_template_hidden'.$prescription->id.'" style="display: none">
                                        <img src="'.asset('uploads/'.$prescription->medicalRecords->image_url).'" style="border: 2px solid black;"/>
                                        <br>
                                        <a href="'. asset('uploads/'.$prescription->medicalRecords->image_url) .'" download="Klenic-'.$prescription->patients->patient_info['full_name'].'-'.$prescription->created_at.'" class="btn btn-primary">
                                            Download
                                        </a>
                                    </div>

                                    <div class="col-sm-12" id="prescription_hidden'.$prescription->id.'" style="display: none">

                                        <div class="row">
                                            <div class="col-sm-6">
                                                <h3 style="margin-bottom:20px; margin-left: 10px;">Prescribe Medicines</h3>
                                            </div>
                                           
                                        </div>
                                       
                                        <div class="row">
                                            <table class="table table-striped m-0">
                                                <thead>
                                                    
                                                    <th>Drug Name/Test</th>
                                                    <th>Quantity</th>
                                                    <th>Dosage</th>
                                                    <th>Days</th>
                                                    <th>Instruction</th>
                                                    
                                                </thead>
                                                <tbody>
                                                    '.$meds.'
                                                </tbody>
                                            </table>
                                        </div>

                                    </div>

                                    <div class="col-sm-12" id="medical_certificate_hidden'.$prescription->id.'" style="display: none">

                                        <div class="row"><h3 style="margin-bottom:20px; margin-left: 10px;">Medical Certificate</h3></div>

                                        '.$certificate.'

                                    </div>

                                    <div class="col-sm-12" id="files_hidden'.$prescription->id.'" style="display: none">

                                            <div class="row"><h3 style="margin-bottom:20px; margin-left: 10px;">Files</h3></div>

                                            <div class="row">
                                                '.$upps.'
                                            </div>
                                        </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </article>
            ';
        }



        $age = date('Y',strtotime(Carbon::now(get_local_time()))) - date('Y',strtotime($patient->patient_info['date_of_birth']));

        if($patient->patient_info['gender'] == 0)
        {
            $gender = 'MALE';
        }
        else{
            $gender = 'FEMALE';
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
            'full_name' => ucfirst($request['full_name']),
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
