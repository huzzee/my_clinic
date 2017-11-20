<?php

namespace App\Http\Controllers;

use App\models\MedicalRecord;
use App\models\Diagnose;
use App\models\DrawingTemplate;
use App\models\MedicalTemplate;
use App\models\MedicalTemplateDetail;
use App\models\Patient;
use App\models\UserInformation;
use Illuminate\Http\Request;
use Auth;

class MedicalRecordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $records = MedicalRecord::with('patients','user_informations')
            ->where('entity_id','=',Auth::user()->entity_id)
            ->where('status','=',1)->latest()->get();

        $patient = Patient::with('users')
            ->where('entity_id','=',Auth::user()->id)->get();
        //dd($records);
        return view('pages.medicals.manageMedical' ,array(
            'records' => $records,
            'patients' => $patient
        ));
    }

    public function deleted_record()
    {
        $records = MedicalRecord::with('patients','user_informations')
            ->where('entity_id','=',Auth::user()->entity_id)
            ->where('status','=',0)->get();


        //dd($records);
        return view('pages.medicals.manageDeleteMedical' ,array(
            'records' => $records,

        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }
    /*---ajax Functions*/
    public function template()
    {
        $temp_id = request()->temp_id;
        $templates = MedicalTemplateDetail::where('medical_template_id','=',$temp_id)->get();
        return response()->json($templates);
    }

    public function temp_change()
    {
        $drawing = DrawingTemplate::findOrFail(request()->temp);

        return response()->json($drawing);
    }
    /*---ajax Functions*/
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
            'patient_id' => 'required',
            'doctor_id' => 'required'
        ]);
        $record = new MedicalRecord;

        $record->patient_id = $request->patient_id;
        $record->doctor_id = $request->doctor_id;
        $record->entity_id = Auth::user()->entity_id;
        $record->image_url =  $request->canvas_image;
        $record->typing_Note =  $request->typing_Note;
        $record->health_info = [
            'weight' => $request->weight,
            'height' => $request->height,
            'bsa' => $request->bsa,
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
            $file = $request->file('uploads')[$i];
            $ext = $file->getClientOriginalName();
            $filename = $request->patient_id.'_'.$ext;
            $file->move($upload_dir, $filename);

            array_push($filesname,$filename);
        }
        $record->upload_file = $filesname;
        $record->diagnose = $request->diagnose;

        $record->save();

        return redirect('medical_records')->with('message','Successfully Added Medical Record');



    }

    /**
     * Display the specified resource.
     *
     * @param  \App\MedicalRecord  $medicalRecord
     * @return \Illuminate\Http\Response
     */
    public function show(MedicalRecord $medicalRecord)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\MedicalRecord  $medicalRecord
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $patient = Patient::with('users')
            ->where('id','=',$id)->first();


        $doctors = UserInformation::with('users')
            ->whereNotNull('doctor_info')
            ->whereHas('users',function ($r){
                $r->where('entity_id','=',Auth::user()->entity_id);
            })->get();

        $diagnoses = Diagnose::where('entity_id','=',Auth::user()->entity_id)->get();

        $templates = MedicalTemplate::with('medical_template_details')
            ->where('entity_id','=',Auth::user()->entity_id)->get();

        $drawing = DrawingTemplate::where('entity_id','=',Auth::user()->entity_id)->get();

        return view('pages.medicals.createMedical' ,array(
            'doctors' => $doctors,
            'patients' => $patient,
            'diagnoses' => $diagnoses,
            'templates' => $templates,
            'drawings' => $drawing
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\MedicalRecord  $medicalRecord
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MedicalRecord $medicalRecord)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\MedicalRecord  $medicalRecord
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $record = MedicalRecord::findOrFail($id);
        $record->status = 0;
        $record->save();

        return redirect('medical_records')->with('message','Successfully Deleted Medical Record');
    }
}
