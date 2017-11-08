<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\UserInformation;
use App\models\Entity;
use App\User;
use Illuminate\Support\Facades\DB;
use Auth;


class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = UserInformation::with('users')
            ->wherehas('users',function ($query){
                $query->where('users.entity_id','=',Auth::user()->entity_id);
            })
            ->whereNotNull('employee_info')->get();
            //dd($employees);
            return view('pages.employees.manageEmployee',array(
               'employees' => $employees
            ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.employees.createEmployee');
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
                'first_name' => 'required',
                'last_name' => 'required',
                'role_id' => 'required',
                'email' => 'required|unique:users',
                'password' => 'required',
                'address' => 'required',
                'gender' => 'required',
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
                'first_name' => 'required',
                'last_name' => 'required',
                'role_id' => 'required',
                'email' => 'required|unique:users',
                'password' => 'required',
                'address' => 'required',
                'gender' => 'required',
                'contact_no' => 'required',

            ]);

            $filename = 'avatar.png';
        }
        $status = 1;


        $users = new User([
            'email' => $request['email'],
            'password' => bcrypt($request['password']),
            'name' => $request['first_name'].' '.$request['last_name'],
            'role_id' => $request['role_id'],
            'entity_id' => Auth::user()->entity_id,
            'status' => $status,
            'profile_image' => $filename

        ]);

        $users->save();

        $employee = new UserInformation;
        $employee->user_id = $users->id;
        $employee->employee_info = [
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'address' => $request->address,
            'gender' => $request->gender,
            'contact_no' => $request->contact_no,
        ];

        $employee->save();

        return redirect('employee')->with('message','Employee Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $employee = UserInformation::with('users')->where('id','=',$id)->first();

        return view('pages.employees.showEmployee',array(
            'employee' => $employee
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
        $employee = UserInformation::with('users')->where('id','=',$id)->first();

        return view('pages.employees.editEmployee',array(
            'employee' => $employee
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

        $upload_dir = base_path() . '/public/uploads';

        if ($request->profile_image !== null)
        {
            $request->validate([
                'employee_info' => 'required',
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
                'employee_info' => 'required',
                'users' => 'required',

            ]);

        }

        $employee = UserInformation::findOrFail($id);

        $employee->employee_info = [
            'first_name' => $request->employee_info['first_name'],
            'last_name' => $request->employee_info['last_name'],
            'address' => $request->employee_info['address'],
            'gender' => $request->employee_info['gender'],
            'contact_no' => $request->employee_info['contact_no'],
        ];
        $employee->save();
        //dd($request);
        $user = User::findOrFail($employee->user_id);

        $user->email = $request->users['email'];
        if($request->password !== null)
        {

            $user->password = bcrypt($request->password);
        }
        if($request->profile_image !== null)
        {
            $user->profile_image = $request->profile_image;
        }
        $user->save();

        return redirect('employee')->with('message','Employee Edited Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $employee = UserInformation::findOrFail($id);

        $user = User::findOrFail($employee->user_id);

        $user->status = 0;
        $user->save();

        return redirect('employee/'.$employee->id)->with('message','Clinic Employee Deactivated');
    }

    public function activated($id)
    {
        $employee = UserInformation::findOrFail($id);

        $user = User::findOrFail($employee->user_id);

        $user->status = 1;
        $user->save();

        return redirect('employee/'.$employee->id)->with('message','Clinic Employee Activated');
    }
}
