<?php

namespace App\Http\Controllers;

use App\models\MedicalTemplate;
use App\models\MedicalTemplateDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MedicalTemplateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $templates = MedicalTemplate::with('medical_template_details')
            ->where('entity_id','=',Auth::user()->entity_id)->get();
        //dd($templates);
        return view('pages.medicals.manageMedicalTemplate',array(
            'templates' => $templates
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.medicals.createMedicalTemplate');
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
            'title' => 'required',
            'type' => 'template_type',
            'questions' => 'required',
            'type' => 'required'
        ]);

        $template = new MedicalTemplate;
        $template->entity_id = Auth::user()->entity_id;
        $template->title = $request->title;

        $template->save();

        for ($i=0; $i < sizeof($request->questions); $i++)
        {
            $detail = new MedicalTemplateDetail;
            $detail->medical_template_id = $template->id;
            $detail->question = $request->questions[$i];
            $detail->type = $request->type[$i];
            $detail->answers = $request->answers[$i];
            $detail->save();
        }

        return redirect('medical_templates')->with('message','Successfully created template');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\medicalTemplate  $medicalTemplate
     * @return \Illuminate\Http\Response
     */
    public function show(medicalTemplate $medicalTemplate)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\medicalTemplate  $medicalTemplate
     * @return \Illuminate\Http\Response
     */
    public function edit(medicalTemplate $medicalTemplate)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\medicalTemplate  $medicalTemplate
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, medicalTemplate $medicalTemplate)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\medicalTemplate  $medicalTemplate
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $template = MedicalTemplate::findOrFail($id);

        $template->delete();

        return redirect('medical_templates')->with('message','Successfully deleted template');
    }
}
