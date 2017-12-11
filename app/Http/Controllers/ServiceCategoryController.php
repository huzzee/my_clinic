<?php

namespace App\Http\Controllers;

use App\models\ServiceCategory;
use Illuminate\Http\Request;
use Auth;

class ServiceCategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('user_privilage',['except'=>['store']]);
    }

    public function index()
    {
        $categories = ServiceCategory::where('entity_id','=',Auth::user()->entity_id)->latest()->get();

        return view('pages.services.createCategoryService',array(
            'categories' => $categories
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_name' => 'required'
        ]);

        $cats = new ServiceCategory;
        $cats->category_name = $request->category_name;
        $cats->entity_id = Auth::user()->entity_id;
        $cats->save();

        return redirect('service_categories')
            ->with('message','Successfully created Category');
    }

    public function destroy($id)
    {
        $service = ServiceCategory::findOrFail($id);

        $service->delete();

        return redirect('services')->with('message','Category deleted Successfully');

    }
}
