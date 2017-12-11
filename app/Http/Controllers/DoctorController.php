<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\UserInformation;
use App\models\Entity;
use App\User;
use Illuminate\Support\Facades\DB;
use Auth;

class DoctorController extends Controller
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
        $doctors = UserInformation::with('users')
            ->wherehas('users',function ($query){
            $query->where('users.entity_id','=',Auth::user()->entity_id);
            })
            ->whereNotNull('doctor_info')->get();

        //dd($doctors);
        return view('pages.doctors.manageDoctor',array(
            'doctors' => $doctors
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $country = DB::table('apps_countries_detailed')->orderBy('CountryName','asc')->get();

        return view('pages.doctors.createDoctor',array(
            'countries' => $country
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

        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required',
            'address' => 'required',
            'gender' => 'required',
            'contact_no' => 'required',
            'profile_image' => 'required|image|mimes:jpeg,png|max:2048',
            'doctor_department' => 'required',
            'specialist' => 'required',
            'date_of_birth' => 'required',
            'blood_group' => 'required'

        ]);

        $file = $request->file('profile_image');
        $ext = $file->getClientOriginalExtension();
        $filename = $request->get('email').'.'.$ext;
        $file->move($upload_dir, $filename);

        $user = new User;
        $user->name = $request->first_name.' '.$request->last_name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->profile_image = $filename;
        $user->status = 1;
        $user->role_id = 3;
        $user->entity_id = Auth::user()->entity_id;

        $user->save();

        $doctor = new UserInformation;
        $doctor->user_id = $user->id;
        $doctor->doctor_info = [
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'contact_no' => $request->contact_no,
            'address' => $request->address,
            'gender' => $request->gender,
            'blood_group' => $request->blood_group,
            'department' => $request->doctor_department,
            'short_biography' => $request->biography,
            'qualification' => $request->qualification,
            'date_of_birth' => $request->date_of_birth,
            'specialist' => $request->specialist

        ];

        $doctor->save();

        return redirect('doctors')->with('message','Doctor has been created successfully');
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $doctors = UserInformation::with('users')->where('id','=',$id)->first();

        return view('pages.doctors.showDoctor',array(
            'doctor' => $doctors
        ));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $doctor = UserInformation::with('users')->where('id','=',$id)->first();

        return view('pages.doctors.editDoctor',array(
            'doctor' => $doctor
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //dd($request);
        $upload_dir = base_path() . '/public/uploads';

        if($request->profile_image !== null) {
            $request->validate([

                'users' => 'required',
                'profile_image' => 'image|mimes:jpeg,png|max:2048',
                'doctor_info' => 'required'

            ]);

            $file = $request->file('profile_image');
            $ext = $file->getClientOriginalExtension();
            $filename = $request->get('email') . '.' . $ext;
            $file->move($upload_dir, $filename);
        }
        else
        {
            $request->validate([

                'users' => 'required',
                'doctor_info' => 'required'

            ]);
        }

        $doctor = UserInformation::findOrFail($id);

        $doctor->doctor_info = [
            'first_name' => $request->doctor_info['first_name'],
            'last_name' => $request->doctor_info['last_name'],
            'contact_no' => $request->doctor_info['contact_no'],
            'address' => $request->doctor_info['address'],
            'gender' => $request->doctor_info['gender'],
            'blood_group' => $request->doctor_info['blood_group'],
            'department' => $request->doctor_info['department'],
            'short_biography' => $request->doctor_info['short_biography'],
            'qualification' => $request->doctor_info['qualification'],
            'date_of_birth' => $request->doctor_info['date_of_birth'],
            'specialist' => $request->doctor_info['specialist']

        ];

        $doctor->save();

        $user = User::findOrFail($doctor->user_id);

        $user->name = $request->doctor_info['first_name'].' '.$request->doctor_info['last_name'];
        $user->email = $request->users['email'];
        if($request->password !== null)
        {
            $user->password = bcrypt($request->password);
        }
        if($request->profile_image !== null)
        {
            $user->profile_image = $filename;
        }
        $user->save();

        return redirect('doctors')->with('message','Doctor Edited Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $doctor = UserInformation::findOrFail($id);

        $user = User::findOrFail($doctor->user_id);

        //->delete();
        $user->delete();

        return redirect('doctors')->with('message','Clinic Doctor deleted Successfully');
    }

    public function activated(Request $request,$id)
    {
        if ($request->flag == 0)
        {
            $doctor = UserInformation::findOrFail($id);

            $user = User::findOrFail($doctor->user_id);

            $user->status = 0;
            $user->save();

            return redirect('doctors/'.$doctor->id)->with('message','Clinic Doctor Deactivated');
        }
        elseif ($request->flag == 1)
        {
            $doctor = UserInformation::findOrFail($id);

            $user = User::findOrFail($doctor->user_id);

            $user->status = 1;
            $user->save();

            return redirect('doctors/'.$doctor->id)->with('message','Clinic Doctor Activated');
        }



    }
}
