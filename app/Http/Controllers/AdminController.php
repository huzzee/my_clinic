<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\UserInformation;
use App\models\Entity;
use App\User;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('user_privilage',['except'=>['store','update','show']]);
    }

    public function index()
    {
        $countries = Cache::rememberForever('countries2', function() {
            return DB::table('countries2')->get();
        });
        //check_code($code);

        $edit_countries = Cache::rememberForever('countries22', function() {
            return DB::table('countries2')->pluck('name','name');
        });

        $currency = DB::table('apps_countries_detailed')->orderBy('currencyCode','asc')->get();
        $edit_currency = DB::table('apps_countries_detailed')->pluck('currencyCode','currencyCode');

        $admins = UserInformation::with('users')
            ->whereNotNull('admin_info')->get();
        //dd($admins[0]->admin_info);

        return view('pages.admins.adminManage',array(
            'admins' => $admins,
            'currencies' => $currency,
            'countries' => $countries,
            'edit_countries' => $edit_countries,
            'edit_currencies' => $edit_currency
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
        $countries = Cache::rememberForever('countries2', function() {
            return DB::table('countries2')->get();
        });
        //check_code($code);

        $currency = DB::table('apps_countries_detailed')->orderBy('currencyCode','asc')->get();

        return view('pages.admins.createadmin',array(

            'currencies' => $currency,
            'countries' => $countries
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
                'state' => 'required',
                'city' => 'required',
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
                'state' => 'required',
                'city' => 'required',
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
            'country' => $request['country'],
            'city' => $request['city'],
            'state' => $request['state'],
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
            'city' => $request->city,
            'state' => $request->state,
            'website' => $request->website,

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

        $edit_countries = Cache::rememberForever('countries22', function() {
            return DB::table('countries2')->pluck('name','name');
        });
        $edit_currency = DB::table('apps_countries_detailed')->pluck('currencyCode','currencyCode');

        return view('pages.admins.showAdmin',array(
            'admin' => $admin,
            'edit_countries' => $edit_countries,
            'edit_currencies' => $edit_currency
        ));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
   /* public function edit($id)
    {

        //dd($country);
        $admin = UserInformation::with('users')->where('id',$id)->first();



        return view('pages.admins.editAdmin',array(
            'admin' => $admin,

        ));
    }*/

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
            //Storage::Delete($upload_dir.'/'.$filename);
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
            'city' => $request->city,
            'state' => $request->state,
            'website' => $request->admin_info['website'],
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

        $entity->country = $request['country'];
        $entity->city = $request['city'];
        $entity->state = $request['state'];
        $entity->currency = $request->users['entities']['currency'];


        $entity->save();

        //dd($users);

        //$admin->users->entities->entity_name = $request->users['entities']['entity_name'];


        $admin->save();

        return redirect()->back()
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
