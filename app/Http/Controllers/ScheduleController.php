<?php

namespace App\Http\Controllers;

use App\models\Schedule;
use App\models\ScheduleDetail;
use Illuminate\Http\Request;
use App\models\UserInformation;
use App\models\Entity;
use App\User;
use Illuminate\Support\Facades\DB;
use Auth;
use App\models\DrugCategory;
use App\models\DrugStockUnit;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $schedule = Schedule::with('user_informations','schedule_details')
                ->where('entity_id','=',Auth::user()->entity_id)->get();

        return view('pages.schedules.manageSchedule',array(
            'schedules' => $schedule
        ));

        //dd($schedule);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $doctors = UserInformation::with('users')
            ->whereHas('users',function ($query){
                $query->where('entity_id','=',Auth::user()->entity_id);
            })
            ->whereNotNull('doctor_info')->get();

        //dd($doctors);

        return view('pages.schedules.createSchedule',array(
            'doctors' => $doctors
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
        $request->validate([
            'opd_day' => 'required',
            'opd_start_time' => 'required',
            'opd_end_time' => 'required'
        ]);

        $schedule = new Schedule;
        $schedule->entity_id = Auth::user()->entity_id;
        $schedule->doctor_id = $request->doctor_id;
        $schedule->save();

        for($i = 0; $i < sizeof($request->opd_day); $i++)
        {
            $schedule_detail = new ScheduleDetail;
            $schedule_detail->type = 0;
            $schedule_detail->schedule_id = $schedule->id;
            $schedule_detail->days = $request->opd_day[$i];
            $schedule_detail->start_time = $request->opd_start_time[$i];
            $schedule_detail->end_time = $request->opd_end_time[$i];

            $schedule_detail->save();
        }

        for($i = 0; $i < sizeof($request->app_day); $i++)
        {
            $schedule_detail = new ScheduleDetail;
            $schedule_detail->type = 1;
            $schedule_detail->schedule_id = $schedule->id;
            $schedule_detail->days = $request->app_day[$i];
            $schedule_detail->start_time = $request->app_start_time[$i];
            $schedule_detail->end_time = $request->app_end_time[$i];

            $schedule_detail->save();
        }

        return redirect('schedule')->with('message','Successfully Added Schedule');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\models\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function show(Schedule $schedule)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\models\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function edit(Schedule $schedule)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\models\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Schedule $schedule)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\models\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function destroy(Schedule $schedule)
    {
        //
    }


    /*Ajax Routes*/

    public function schedule_chk()
    {
        $doctor = Schedule::where('doctor_id','=',request()->doc_id)->get();

        if(!isset($doctor->doctor_id))
        {
            return response()->json(0);
        }
        else
        {
            return response()->json(1);
        }


    }
}
