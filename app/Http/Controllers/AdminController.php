<?php

namespace App\Http\Controllers;

use App\models\Admin;
use Illuminate\Http\Request;
use App\models\Entity;
use App\User;

class AdminController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($code)
    {
        //dd(Entity::all());
        check_code($code);
        return view('pages.admins.createAdmin');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$code)
    {
        check_code($code);
        $upload_dir = base_path() . '/public/uploads';

        if ($request->profile_image === null)
        {
            $request->validate([
                'full_name' => 'required',
                'email' => 'required|unique:users',
                'password' => 'required',
                'address' => 'required',
                'gender' => 'required',
                'entity_name' => 'required|unique:entity',
                'country' => 'required',
                'contact_no' => 'required',
                'profile_image' => 'image|mimes:jpeg,png|max:2048'
            ]);

            $file = $request->file('profile_image');
            $ext = $file->getClientOriginalExtension();
            $filename = $request->get('email').'.'.$ext;
            $file->move($upload_dir, $filename);
        }
        else{
            $request->validate([
                'full_name' => 'required',
                'email' => 'required|unique:users',
                'password' => 'required',
                'address' => 'required',
                'gender' => 'required',
                'entity_name' => 'required|unique:entity',
                'country' => 'required',
                'contact_no' => 'required',

            ]);

            $filename = 'avatar.png';
        }

        if(!$request->has('status'))
        {
            $status = 0;
        }
        else{
            $status = 1;
        }

        $entity = new Entity([
            'entity_name' => $request['entity_name'],
            'entity_code' => str_random(10),
        ]);
        $entity->save();

        $entity_id = $entity->id;

        $user_id = User::createUsers($request,$filename,$entity_id,$status);

        $admin = new Admin;
        $admin->full_name = $request->full_name;
        $admin->user_id = $user_id;
        $admin->country = $request->country;
        $admin->gender = $request->gender;
        $admin->contact_no = $request->contact_no;
        $admin->address = $request->address;
        $admin->status = $status;

        $admin->save();

        return redirect(Auth::user()->entities->entity_code.'admins')
            ->with('message', 'Admin Created Successfully!');


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function show(Admin $admin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function edit(Admin $admin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Admin $admin)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy(Admin $admin)
    {
        //
    }
}
