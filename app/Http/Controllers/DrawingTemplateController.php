<?php

namespace App\Http\Controllers;

use App\models\DrawingTemplate;
use Illuminate\Http\Request;
use Auth;

class DrawingTemplateController extends Controller
{

    public function __construct()
    {
        $this->middleware('user_privilage',['except'=>['store','update']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $drawTemplates = DrawingTemplate::where('entity_id','=',Auth::user()->entity_id)->get();
        return view('pages.medicals.drawingTemplate',array(
            'drawTemplates' => $drawTemplates
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
           'title' => 'required',
           'images' => 'required|image|mimes:jpeg,png|max:2048'
        ]);

        $upload_dir = base_path() . '/public/uploads';


        $file = $request->file('images');
        $ext = $file->getClientOriginalName();
        $filename = $ext;
        $file->move($upload_dir, $filename);

        $drawing = new DrawingTemplate;
        $drawing->entity_id = Auth::user()->entity_id;
        $drawing->title = $request->title;
        $drawing->images = $filename;

        $drawing->save();

        return redirect('drawing_templates')->with('message','Successfully Added Template');
    }



    /**
     * Display the specified resource.
     *
     * @param  \App\DrawingTemplate  $drawingTemplate
     * @return \Illuminate\Http\Response
     */
    public function show(DrawingTemplate $drawingTemplate)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\DrawingTemplate  $drawingTemplate
     * @return \Illuminate\Http\Response
     */
    public function edit(DrawingTemplate $drawingTemplate)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\DrawingTemplate  $drawingTemplate
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DrawingTemplate $drawingTemplate)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\DrawingTemplate  $drawingTemplate
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $drawing = DrawingTemplate::findOrFail($id);

        $drawing->delete();

        return redirect('drawing_templates')->with('message','Successfully Deleted Template');
    }
}
