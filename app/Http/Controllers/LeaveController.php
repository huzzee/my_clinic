<?php

namespace App\Http\Controllers;


use App\models\Leave;
use App\models\Patient;
use App\models\UserInformation;
use Illuminate\Http\Request;
use Auth;



class LeaveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $leaves = Leave::with('user_informations')
                ->where('entity_id','=',Auth::user()->entity_id)
                ->where('approved','=',1)
                ->latest()->get();

        return view('pages.leaves.manageLeave',array(
            'leaves' => $leaves
        ));
    }

    public function approved()
    {
        //dd('ok');
        $leaves = Leave::with('user_informations')
            ->where('entity_id','=',Auth::user()->entity_id)
            ->latest()->get();

        //dd($leaves[1]->approved);

        return view('pages.leaves.approvedLeave',array(
            'leaves' => $leaves
        ));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $doctor = UserInformation::with('users')
            ->whereNotNull('doctor_info')
            ->whereHas('users',function ($r){
                $r->where('entity_id','=',Auth::user()->entity_id);
            })->get();
        //dd($doctor);
        return view('pages.leaves.createLeave',array(
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
        if($request->leave_type == 0) {
            $request->validate([
                'doctor_id' => 'required',
                'leave_type' => 'required',
                'half_day_date' => 'required',
                'start_time_half' => 'required',
                'end_time_hlaf' => 'required',
                'reason' =>'required'
            ]);
        }
        elseif ($request->leave_type == 1)
        {
            $request->validate([
                'doctor_id' => 'required',
                'leave_type' => 'required',
                'ful_day_date' => 'required',
                'reason' =>'required'

            ]);
        }
        elseif($request->leave_type == 2){
            $request->validate([
                'doctor_id' => 'required',
                'leave_type' => 'required',
                'start_many' => 'required',
                'end_many' => 'required',
                'reason' =>'required'

            ]);
        }

        $leave = new Leave;
        $leave->entity_id = Auth::user()->entity_id;
        $leave->doctor_id = $request->doctor_id;
        $leave->leave_type = $request->leave_type;
        $leave->reason = $request->reason;
        if($request->leave_type == 0) {
            $leave->leave_length = [
                'half_day_date' => $request['half_day_date'],
                'start_time_half' => $request['start_time_half'],
                'end_time_hlaf' => $request['end_time_hlaf'],
            ];
        }
        elseif($request->leave_type == 1) {
            $leave->leave_length = [
                'ful_day_date' => $request['ful_day_date'],

            ];
        }
        elseif($request->leave_type == 2) {
            $leave->leave_length = [
                'start_many' => $request['start_many'],
                'end_many' => $request['end_many'],
            ];
        }
        $leave->save();


        return redirect('leaves/create')->with('message','Successfully added leave wait for approval');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\models\Leave  $leave
     * @return \Illuminate\Http\Response
     */
    public function show(Leave $leave)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\models\Leave  $leave
     * @return \Illuminate\Http\Response
     */
    public function edit(Leave $leave)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\models\Leave  $leave
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Leave $leave)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\models\Leave  $leave
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $leave = Leave::findOrFail($id);

        $leave->delete();

        return redirect('leaves')->with('message','Successfully Deleted leave');


    }

    public function approval($id)
    {
        $leave = Leave::findOrFail($id);

        $leave->approved = 1;

        $leave->save();

        return redirect('leaves')->with('message','Successfully Approved leave');
    }

    public function reject($id)
    {
        $leave = Leave::findOrFail($id);

        $leave->approved = 0;

        $leave->save();

        return redirect('leaves_approved')->with('message','Rejected leave');
    }


}
