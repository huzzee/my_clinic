<?php

namespace App\Http\Controllers;

use App\models\Diagnose;
use Illuminate\Http\Request;
use Auth;

class DiagnoseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $diagnose = Diagnose::where('entity_id','=',Auth::user()->entity_id)->get();
        return view('pages.medicals.diagnoses',array(
            'diagnoses' => $diagnose
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
           'diagnose_name' => 'required'
        ]);

        $diagnose = new Diagnose;
        $diagnose->entity_id = Auth::user()->entity_id;
        $diagnose->diagnose_name = $request->diagnose_name;
        $diagnose->save();

        return redirect('diagnoses')->with('message','Successfully Added Diagnose');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\models\Diagnose  $diagnose
     * @return \Illuminate\Http\Response
     */
    public function show(Diagnose $diagnose)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\models\Diagnose  $diagnose
     * @return \Illuminate\Http\Response
     */
    public function edit(Diagnose $diagnose)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\models\Diagnose  $diagnose
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Diagnose $diagnose)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\models\Diagnose  $diagnose
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $diagnos = Diagnose::findOrFail($id);

        $diagnos->delete();

        return redirect('diagnoses')->with('message','Successfully Deleted Diagnose');
    }
}
