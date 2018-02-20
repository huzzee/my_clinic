<?php

namespace App\Http\Controllers;

use App\models\Appointment;
use App\models\Patient;
use App\models\Schedule;
use App\models\ScheduleDetail;
use App\models\UserInformation;
use Carbon\Carbon;
use function GuzzleHttp\Psr7\str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;
use DB;

class AppointmentController extends Controller
{

    public function __construct()
    {
        $this->middleware('user_privilage',['except'=>['datatable','add_app','get_token_time_chek','store','get_token_chek','get_schedule']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

       /* $appointments = Appointment::with('schedule_details','user_informations','patients')
            ->where('status','=',0)
            ->where('appointment_date','>=',date('Y-m-d',strtotime(Carbon::now(get_local_time()))))
            ->where('entity_id','=',auth()->user()->entity_id)->latest()->get();*/

        $patients = Patient::with('users')
            ->where('entity_id','=',Auth::user()->entity_id)->get();

        //$cities = DB::table('cities')->get();

        return view('pages.appointments.manageAppointments',array(

            'patients' => $patients
        ));
        //return view('pages.appointments.manageAppointments');
    }

    public function datatable()
    {
        return DataTables::of(DB::table('cities')->get())->make(true);
    }

    public function canceled()
    {
        $appointments = Appointment::with('schedule_details','user_informations','patients')
            ->where('status','=',2)
            ->where('entity_id','=',auth()->user()->entity_id)->get();

        $patients = Patient::with('users')
            ->where('entity_id','=',Auth::user()->entity_id)->get();

        return view('pages.appointments.cancelAppointments',array(
            'appointments' => $appointments,
            'patients' => $patients
        ));
    }

    public function today_app()
    {
        $appointments = Appointment::with('schedule_details','user_informations','patients')
            ->where('status','=',0)
            ->where('appointment_date','=',date('Y-m-d',strtotime(Carbon::now(get_local_time()))))
            ->where('entity_id','=',auth()->user()->entity_id)->latest()->get();

        $patients = Patient::with('users')
            ->where('entity_id','=',Auth::user()->entity_id)->get();

        $doctor = UserInformation::with('users')
            ->whereNotNull('doctor_info')
            ->whereHas('users',function ($query){
                $query->where('entity_id','=',Auth::user()->entity_id);
            })->get();

        return view('pages.appointments.todayAppointments',array(
            'appointments' => $appointments,
            'patients' => $patients,
            'doctors' => $doctor
        ));
    }

    public function complete_app()
    {
        $appointments = Appointment::with('schedule_details','user_informations','patients')
            ->where('status','=',1)
            ->where('entity_id','=',auth()->user()->entity_id)->latest()->get();

        $patients = Patient::with('users')
            ->where('entity_id','=',Auth::user()->entity_id)->get();

        return view('pages.appointments.completeAppointments',array(
            'appointments' => $appointments,
            'patients' => $patients
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add_app(Request $request)
    {

        return redirect('appointments/'.$request->patient_id.'/edit');
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
        $request->validate([
            'doctor_id' => 'required',
            'schedule_detail_id' => 'required',
            'appointment_date' => 'required',
        ]);

        $last_app = Appointment::with('schedule_details')
            ->where('schedule_detail_id','=',$request->schedule_detail_id)
            ->where('status','=',0)
            ->where('appointment_date','=',date('Y-m-d',strtotime($request->appointment_date)))
            ->orderBy('created_at','desc')->first();
        //dd($last_app);

        $appointments = new Appointment;
        $appointments->doctor_id = $request->doctor_id;
        $appointments->patient_id = $request->patient_id;
        $appointments->schedule_detail_id = $request->schedule_detail_id;
        $appointments->entity_id = Auth::user()->entity_id;
        $appointments->status = 0;
        $appointments->appointment_date = date('Y-m-d',strtotime($request->appointment_date));
        if($last_app == null)
        {
            $appointments->token_no = 1;
        }
        else
        {
            $appointments->token_no = ($last_app->token_no*1) + 1;
        }


        $appointments->save();

        return redirect('appointments')->with('message','Successfully Added Appointment');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function show(Appointment $appointment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $patient = Patient::findOrFail($id);
        $doctors = UserInformation::with('users','schedules')
            ->where('doctor_info','!=',null)
            ->whereHas('users',function ($data){
                $data->where('entity_id','=',auth()->user()->entity_id);
            })->get();

        $last_app = Appointment::with('schedule_details')
            ->where('patient_id','=',$id)
            ->where('status','=',0)->first();
        if($last_app !== null)
        {
            return redirect()->back()->withErrors('Patient Already Has Appointment');
        }
        //dd(auth()->user()->entity_id);
        return view('pages.appointments.createAppointment',array(
            'patient' => $patient,
            'doctors' => $doctors
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Appointment $appointment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\models\Appointment  $appointment
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $appointment = Appointment::findOrFail($id);

        $appointment->delete();

        return redirect('appointments')->with('message','Successfully Deleted Appointment');
    }

    public function cancelation(Request $request,$id)
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->status = 2;
        $appointment->save();

        return redirect('appointments')->with('message','Successfully Cancel Appointment');
    }

    /*ajax Request*/

    public function get_schedule()
    {
        $schedules = Schedule::where('doctor_id','=',request()->doc_id)->first();



        if(!isset($schedules))
        {
            return response()->json(0);
        }
        else
        {
            $schedule_details = ScheduleDetail::where('schedule_id','=',$schedules->id)
                ->where('type','=',1)->get();
            return response()->json(array(
                'schedule' => $schedules,
                'schedule_details' => $schedule_details
            ));
        }
    }

    public function get_token_chek()
    {
        $app_date = date('N',strtotime(request()->app_date));
        $schedules = Schedule::where('doctor_id','=',request()->doc_id)->first();

        $schedule_details = ScheduleDetail::where('schedule_id','=',$schedules->id)
            ->where('type','=',1)
            ->where('days','=',$app_date)->get();
        $count = count($schedule_details);

        $abc = '';
        if($count > 1)
        {
            $abc = 2;
            return response()->json(array(
                'schedule_details' => $schedule_details,
                'check' => $abc
            ));
        }
        else
        {
            $app_chk = Appointment::with('schedule_details')
                ->where('schedule_detail_id','=',$schedule_details[0]->id)
                ->where('status','=',0)
                ->where('appointment_date','=',date('Y-m-d',strtotime(request()->app_date)))->get();
            if(count($app_chk) < $schedule_details[0]->tokens)
            {
                $abc = 1;
                return response()->json(array(
                    'schedule_details' => $schedule_details,
                    'check' => $abc
                ));
            }
            else
            {
                $abc = 0;
                return response()->json(array(
                    'schedule_details' => $schedule_details,
                    'check' => $abc
                ));
            }
        }

    }

    public function get_token_time_chek()
    {
        $schedule_details = ScheduleDetail::findOrFail(request()->schedule_id);

        $app_chk = Appointment::with('schedule_details')
            ->where('schedule_detail_id','=',$schedule_details->id)
            ->where('status','=',0)
            ->where('appointment_date','=',date('Y-m-d',strtotime(request()->app_date)))->get();
        if(count($app_chk) < $schedule_details->tokens)
        {
            $abc = 1;
            return response()->json(array(
                'schedule_details' => $schedule_details,
                'check' => $abc
            ));
        }
        else
        {
            $abc = 0;
            return response()->json(array(
                'schedule_details' => $schedule_details,
                'check' => $abc
            ));
        }
        //return response()->json(request()->schedule_id);
    }
}
