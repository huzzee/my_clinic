<?php

namespace App\Http\Controllers;

use App\models\DrawingTemplate;
use App\models\MedicalCertificate;
use App\models\MedicalRecord;
use App\models\MedicalTemplate;
use App\models\Medicine;
use App\models\Patient;
use App\models\Prescription;
use App\models\Queue;
use App\models\ServiceCategory;
use Illuminate\Http\Request;
use Auth;
use App\models\DrugCategory;

class PrescriptionController extends Controller
{
    public function __construct()
    {
        $this->middleware('user_privilage',['except'=>['store',
            'drugs_autocomplete','drug_qnt_check','dosage_qnt_check','drug_type_check']]);
    }

    public function index()
    {
        $prescriptions = Prescription::with('user_informations','patients','queues','invoices')
        ->where('entity_id','=',Auth::user()->entity_id)->latest()->paginate(20);
        //dd($prescriptions);

        return view('pages.prescriptions.prescription',array(
            'prescriptions' => $prescriptions
        ));
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {

        $queue = Queue::with('user_informations')
            ->where('id','=',$id)->first();

        $queue->status = 1;
        $queue->save();

        $patient = Patient::with('medical_records','prescriptions')
            ->where('id','=',$queue->patient_id)->first();

        $prescriptions = Prescription::with('medicalRecords','MedicalCertificates')
            ->where('patient_id','=',$queue->patient_id)->latest()->paginate(6);

        //dd($prescriptions);

        $templates = MedicalTemplate::with('medical_template_details')
            ->where('entity_id','=',Auth::user()->entity_id)->get();

        $drawings = DrawingTemplate::where('entity_id','=',Auth::user()->entity_id)->get();

        $medicines = Medicine::where('entity_id','=',Auth::user()->entity_id)->get();

        $services = ServiceCategory::where('entity_id','=',Auth::user()->entity_id)->get();

        $drugType = DrugCategory::where('entity_id','=',Auth::user()->entity_id)->get();

        return view('pages.prescriptions.checkPatient',array(
            'patient' => $patient,
            'medicines' => $medicines,
            'services' => $services,
            'queue' => $queue,
            'drawings' => $drawings,
            'templates' => $templates,
            'drugTypes' => $drugType,
            'prescriptions' => $prescriptions
        ));
    }


    public function store(Request $request)
    {
        //dd($request->file('uploads')[0]);

        $request->validate([
            'pres_type' => 'required'
        ]);
        if($request->check_mc !== null)
        {
            $request->validate([
                'date_of_visit' => 'required',
                'date_of_issue' => 'required',
                'start_date' => 'required',
                'end_date' => 'required',
                'time_in' => 'required',
                'time_out' => 'required',
                'description' => 'required',
            ]);
        }

        $queue = Queue::findOrFail($request->queue_id);
        $queue->status = 2;
        $queue->save();

        $pres=[];
        if($request->pres_type !== null)
        {
            for ($i=0; $i < sizeof($request->pres_type); $i++)
            {

                $abc = [
                    'drug_name' => $request->drug_name[$i],
                    'drug_qnt' => $request->drug_qnt[$i],
                    'dosage_qnt' => $request->dosage_qnt[$i],
                    'days' => $request->days[$i],
                    'instruction' => $request->instruction[$i],
                ];

                array_push($pres,$abc);

            }

        }

        $prescription = new Prescription;
        $prescription->doctor_id = $request->doctor_id;
        $prescription->patient_id = $request->patient_id;
        $prescription->queue_id = $request->queue_id;
        $prescription->entity_id = Auth::user()->entity_id;
        $prescription->prescriptions = $pres;

        $prescription->save();

        $upload_dir = base_path() . '/public/uploads';

        $binary_data = file($request->canvas_image);

        $profilename = $queue->queue_code.'-'.'.jpeg';

        $result = file_put_contents( $upload_dir.'/'.$profilename, $binary_data );


        $record = new MedicalRecord;

        $record->patient_id = $request->patient_id;
        $record->prescription_id = $prescription->id;
        $record->doctor_id = $request->doctor_id;
        $record->entity_id = Auth::user()->entity_id;
        $record->image_url =  $profilename;
        $record->typing_Note =  $request->typing_Note;
        $record->health_info = [
            'weight' => $request->weight,
            'blood_pressure' => $request->blood_pressure,
            'heartbeat' => $request->heartbeat,
            'temperature' => $request->temperature,
            'breaths' => $request->breaths,
        ];
        $temps = [];
        for($i=0; $i < sizeof($request->questions); $i++) {

            $temp = [
                'question' => $request->questions[$i],
                'answers' => $request->answers[$i]
            ];

            array_push($temps,$temp);
        }

        $record->template = $temps;

        $filesname = [];
        for($i=0; $i < sizeof($request->uploads); $i++)
        {
            if($request->uploads[$i] !== null)
            {
                $file = $request->file('uploads')[$i];
                $ext = $file->getClientOriginalName();
                $filename = $request->patient_code.'_'.$i.'_'.$ext;
                $file->move($upload_dir, $filename);

                array_push($filesname,$filename);
            }

        }
        $record->upload_file = $filesname;
        $record->diagnose = $request->diagnose;

        $record->save();

        if($request->check_mc !== null)
        {
            $mc = new MedicalCertificate;
            $mc->patient_id = $request->patient_id;
            $mc->prescription_id = $prescription->id;
            $mc->doctor_id = $request->doctor_id;
            $mc->entity_id = Auth::user()->entity_id;
            $mc->date_of_visit = date('Y-m-d',strtotime($request->date_of_visit));
            $mc->date_of_issue = date('Y-m-d',strtotime($request->date_of_issue));
            $mc->start_date = date('Y-m-d',strtotime($request->start_date));
            $mc->end_date = date('Y-m-d',strtotime($request->end_date));
            $mc->time_in = date('H:i',strtotime($request->time_in));
            $mc->time_out = date('H:i',strtotime($request->time_out));
            $mc->certificate_type = $request->certificate_type;
            $mc->description = $request->description;
            $mc->remarks = $request->remarks;

            $mc->save();

        }

        return redirect('queues');
    }

    public function drugs_autocomplete()
    {
        $medicines = Medicine::where('entity_id','=',Auth::user()->entity_id)->get();

        return response()->json($medicines);
    }

    public function drug_qnt_check()
    {
        $medicines = Medicine::where('entity_id','=',Auth::user()->entity_id)
                    ->where('medicine_info->drug_name','=',request()->medicine_name)
                    ->where('medicine_info->drug_type','=',request()->medicine_type)
                    ->where('medicine_info->dosage_amount','=',request()->medicine_dosage)->first();
        if(isset($medicines))
        {
            $ok = 1;
            $response = [
                'medicines' =>$medicines,
                'ok' => $ok
            ];
        }
        else
        {
            $ok = 0;
            $response = [
                'medicines' =>$medicines,
                'ok' => $ok
            ];
        }

        return response()->json($response);
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
