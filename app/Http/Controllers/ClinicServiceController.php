<?php

namespace App\Http\Controllers;

use App\models\ClinicService;
use App\models\ServiceCategory;
use Illuminate\Http\Request;
use App\models\UserInformation;
use App\models\Entity;
use App\User;
use Illuminate\Support\Facades\DB;
use Auth;

class ClinicServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $services = ClinicService::with('service_categories')
            ->where('entity_id','=',Auth::user()->entity_id)->get();

        $categories = ServiceCategory::where('entity_id','=',Auth::user()->entity_id)->get();


        return view('pages.services.createService',array(
            'services' => $services,
            'categories' => $categories
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
            'service_category_id' => 'required',
            'service_name' => 'required',
            'rate' => 'required'
        ]);

        $service = new ClinicService;

        $service->service_name = $request->service_name;
        $service->service_category_id = $request->service_category_id;
        $service->rate = $request->rate;
        $service->entity_id = Auth::user()->entity_id;

        $service->save();

        return redirect('services')->with('message','Service Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ClinicService  $clinicService
     * @return \Illuminate\Http\Response
     */
    public function show(ClinicService $clinicService)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ClinicService  $clinicService
     * @return \Illuminate\Http\Response
     */
    public function edit(ClinicService $clinicService)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ClinicService  $clinicService
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ClinicService $clinicService)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ClinicService  $clinicService
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $service = ClinicService::findOrFail($id);

        $service->delete();

        return redirect('services')->with('message','Service deleted Successfully');

    }
}
