<?php

namespace App\Http\Controllers;

use App\models\Appointment;
use App\models\Patient;
use App\models\Queue;
use App\models\UserInformation;
use Illuminate\Http\Request;
use Auth;
use Carbon\Carbon;


class QueueController extends Controller
{

    public function __construct()
    {
        $this->middleware('user_privilage',['except'=>['store','queue_doc'.'queue_note']]);
    }


    public function index()
    {
        $queues = Queue::with('user_informations','patients','invoices')
            ->where('entity_id','=',Auth::user()->entity_id)
            ->where('status','!=',4)
            ->where('status','!=',3)
            ->latest()->get();

        $patients = Patient::with('users')
            ->where('entity_id','=',Auth::user()->entity_id)->get();

        $doctor = UserInformation::with('users')
            ->whereNotNull('doctor_info')
            ->whereHas('users',function ($query){
                $query->where('entity_id','=',Auth::user()->entity_id);
            })->get();

        return view('pages.queues.queue',array(
            'queues' => $queues,
            'patients' => $patients,
            'doctors' => $doctor
        ));
    }

    public function store(Request $request)
    {
        //dd($request->all());
        $request->validate([
            'doctor_id' => 'required'
        ]);

        $appointments = Appointment::with('patients')
            ->where('patient_id','=',$request->patient_id)
            ->where('status','=',0)
            ->where('appointment_date','=',date('Y-m-d',strtotime(Carbon::now(get_local_time()))))
            ->first();
        //dd($appointments);

        if($appointments !== null)
        {
            $appointments->status = 1;
            $appointments->save();
        }

        $queue = new Queue;
        $queue->doctor_id = $request->doctor_id;
        $queue->patient_id = $request->patient_id;
        $queue->entity_id = Auth::user()->entity_id;

        $queue->save();

        return redirect('queues');
    }


    public function queue_doc(Request $request)
    {
        //dd($request);
        $queue = Queue::where('doctor_id','=',$request->old_doc)->first();
        $queue->doctor_id = $request->doctor_id;
        $queue->save();

        return redirect('queues')->with('message','Doctor Changed successfully');
    }

    public function queue_note(Request $request)
    {
        $queue = Queue::findOrFail($request->que_id);
        $queue->note = $request->note;

        $queue->save();

        return redirect('queues')->with('message','Added Note successfully');
    }

    public function settled_queues()
    {
        $queues = Queue::with('user_informations','patients','invoices')
            ->where('entity_id','=',Auth::user()->entity_id)
            ->where('status','=',3)
            ->latest()->get();

        return view('pages.queues.settledQueue',array(
            'queues' => $queues,
        ));
    }

    public function deleted_queues()
    {
        $queues = Queue::with('invoices','user_informations','patients')
            ->where('entity_id','=',Auth::user()->entity_id)
            ->where('status','=',4)
            ->latest()->get();

        return view('pages.queues.deletedQueue',array(
            'queues' => $queues,
        ));
    }

    public function destroy($id)
    {
        $queue = Queue::findOrFail($id);

        $queue->status = 4;
        $queue->save();

        return redirect('queues')->with('message','deleted successfully');
    }




}
