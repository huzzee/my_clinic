<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\UserInformation;
use App\models\Entity;
use App\User;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index()
    {
        $admins = UserInformation::with('users')
            ->whereNotNull('admin_info')->get();
        //dd($admins[0]->admin_info);

        return view('pages.admins.adminManage',array(
            'admins' => $admins
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //dd(Entity::all());
        //check_code($code);
        $country = DB::table('apps_countries_detailed')->orderBy('CountryName','asc')->get();
        $currency = DB::table('apps_countries_detailed')->orderBy('currencyCode','asc')->get();

        return view('pages.admins.createAdmin',array(
            'countries' => $country,
            'currencies' => $currency
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



        $upload_dir = base_path() . '/public/uploads';

        if ($request->profile_image !== null)
        {
            $request->validate([
                'full_name' => 'required',
                'email' => 'required|unique:users',
                'password' => 'required',
                'address' => 'required',
                'gender' => 'required',
                'entity_name' => 'required|unique:entities',
                'country' => 'required',
                'currency' => 'required',
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
                'entity_name' => 'required|unique:entities',
                'country' => 'required',
                'currency' => 'required',
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
            'currency' => $request->currency
        ]);
        $entity->save();

        $entity_id = $entity->id;

        $user_id = User::createUsers($request,$filename,$entity_id,$status);

        $admin = new UserInformation;

        $admin->user_id = $user_id;
        $admin->admin_info = [
            'full_name' => $request->full_name,
            'country' => $request->country,
            'address' => $request->address,
            'gender' => $request->gender,
            'contact_no' => $request->contact_no,
        ];


        $admin->save();

        return redirect('admins')
            ->with('message', 'Admin Created Successfully!');


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $admin = UserInformation::with('users')->where('id',$id)->first();

        return view('pages.admins.showAdmin',array(
            'admin' => $admin
        ));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $country = DB::table('apps_countries_detailed')->orderBy('CountryName','asc')->pluck('countryName','countryName');
        //dd($country);
        $admin = UserInformation::with('users')->where('id',$id)->first();

        return view('pages.admins.editAdmin',array(
            'admin' => $admin,
            'country' => $country
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //dd($request->all());
        $upload_dir = base_path() . '/public/uploads';

        if ($request->profile_image !== null)
        {
            $request->validate([

                'admin_info' => 'required',
                'email' => 'required',
                'users' => 'required',
                'profile_image' => 'image|mimes:jpeg,png|max:2048'
            ]);

            $file = $request->file('profile_image');
            $ext = $file->getClientOriginalExtension();
            $filename = $request->get('email').'.'.$ext;
            $file->move($upload_dir, $filename);
        }
        else{
            $request->validate([
                'admin_info' => 'required',
                'email' => 'required',
                'users' => 'required',


            ]);


        }
        $admin = UserInformation::with('users')->where('id',$id)->first();

        //dd($admin->users->entities);

        $admin->admin_info = [
            'full_name' => $request->admin_info['full_name'],
            'country' => $request->admin_info['country'],
            'address' => $request->admin_info['address'],
            'gender' => $request->admin_info['gender'],
            'contact_no' => $request->admin_info['contact_no'],
        ];

        $users = User::findOrFail($admin->users->id);

        $users->name =  $request->admin_info['full_name'];
        $users->email = $request->email;
        if ($request->profile_image !== null){
            $users->profile_image = $filename;
        }
        if ($request->password !== null){
            $users->password = bcrypt($request->password);
        }
        $users->save();

        $entity = Entity::findOrFail($users->entity_id);

        $entity->entity_name = $request->users['entities']['entity_name'];
        $entity->save();

        //dd($users);

        //$admin->users->entities->entity_name = $request->users['entities']['entity_name'];


        $admin->save();

        return redirect('admins')
            ->with('message', 'Admin Edited Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $admin = UserInformation::findOrFail($id);

        $user = User::findOrFail($admin->user_id);
        $user->status = 0;

        $user->save();

        $entity = Entity::findOrFail($user->entity_id);

        $entity->status = 0;
        $entity->save();

        return redirect('admins/'.$admin->id)->with('message','Clinic Admin Deactivated');
    }

    public function activated($id)
    {
        $admin = UserInformation::findOrFail($id);

        $user = User::findOrFail($admin->user_id);
        $user->status = 1;

        $user->save();


        $entity = Entity::findOrFail($user->entity_id);

        $entity->status = 1;
        $entity->save();

        return redirect('admins/'.$admin->id)->with('message','Clinic Admin Activated');
    }
}
