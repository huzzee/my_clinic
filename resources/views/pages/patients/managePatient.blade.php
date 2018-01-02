@extends('layouts.mainHome')



@section('content')
    <!-- Start content -->
    <div class="content">
        <div class="container">


            <div class="row">
                <div class="col-xs-12">
                    <div class="page-title-box">

                        <h4 class="page-title">Manage Patients</h4>

                        <div class="clearfix"></div>

                    </div>
                </div>
            </div>
            <!-- end row -->



            <div class="row">
                <div class="col-sm-12">
                    @if(session()->has('message'))
                        <div class="alert alert-success">
                            {{ session()->get('message') }}
                        </div>
                    @endif
                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="card-box table-responsive">


                        <button class="modal_select btn btn-icon waves-effect waves-light btn-danger m-b-5" data-toggle="modal" data-target="#full-width-modal-create">Add Patient</button>
                        {{--start model--}}
                        <div id="full-width-modal-create" class="modal fade" role="dialog" aria-labelledby="full-width-modalLabel-create" aria-hidden="true" style="display: none;">
                            <div class="modal-dialog modal-full">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                        <h4 class="modal-title" id="full-width-modalLabel-create">Add Patient</h4>
                                    </div>
                                    <form action="{{ route('patients.store') }}" method="post" enctype="multipart/form-data">

                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-1"></div>
                                                <div class="col-md-10">

                                                    <div class="row p-20" style="clear: both;">

                                                        <div class="col-sm-4">
                                                            <div class="form-group">
                                                                <label for="full_name" class="control-label">Full Name<span class="text-danger">*</span></label>

                                                                    <input type="text" name="full_name" parsley-trigger="change"
                                                                           placeholder="Enter Full Name" value="{{ old('full_name') }}" autocomplete="off" class="form-control input-sm"/>
                                                                    <input type="hidden" name="patient_code" value="{{ str_random(8) }}">

                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <div class="form-group">
                                                                <label for="full_name" class="control-label">Contact No<span class="text-danger">*</span></label>
                                                                <input type="number" name="contact_no" parsley-trigger="change"
                                                                       placeholder="Enter Contact No" value="{{ old('contact_no') }}" autocomplete="off" class="form-control input-sm"/>

                                                            </div>
                                                        </div>

                                                        <div class="col-sm-4">
                                                            <div class="form-group">
                                                                <label for="full_name" class="control-label">Email</label>
                                                                <input type="email" id="fake-email" name="fake-email" style="display: none;">
                                                                <input type="text" name="email" parsley-trigger="change"
                                                                       placeholder="Enter Email If needed" value="{{ old('email') }}" autocomplete="off" class="form-control input-sm"/>

                                                            </div>
                                                        </div>


                                                        <div class="col-sm-4">
                                                            <div class="form-group">
                                                                <label for="full_name" class="control-label">Gender<span class="text-danger">*</span></label>
                                                                <div>
                                                                    <div class="radio radio-info radio-inline">
                                                                        <input type="radio" id="inlineRadio8" name="gender" value="0">
                                                                        <label for="inlineRadio8"> Male </label>
                                                                    </div>
                                                                    <div class="radio radio-pink radio-inline">
                                                                        <input type="radio" id="inlineRadio9" name="gender" value="1">
                                                                        <label for="inlineRadio9"> Female </label>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-4">
                                                            <div class="form-group">
                                                                <label for="full_name" class="control-label">Date Of Birth<span class="text-danger">*</span></label>
                                                                <input type="text" class="form-control input-sm" name="date_of_birth" placeholder="mm/dd/yyyy" id="datepicker-autoclose">

                                                            </div>
                                                        </div>

                                                        <div class="col-sm-4">
                                                            <div class="form-group">
                                                                <label for="full_name" class="control-label">Language Preference</label>
                                                                <select class="form-control select2" name="language">
                                                                    <option value="Burmese(default)" selected>Burmese(default)</option>
                                                                    @foreach($languages as $language)
                                                                        <option value="{{ $language->name }}">{{ $language->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-4">
                                                            <div class="form-group">
                                                                <label for="full_name" class="control-label">Country<span class="text-danger">*</span></label>
                                                                <select class="form-control select2" name="country" id="country">
                                                                    <option disabled selected>Select Country</option>
                                                                    @foreach($countries as $country)
                                                                        <option value="{{ $country->name }}">{{ $country->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <div class="form-group">
                                                                <label for="full_name" class="control-label">State<span class="text-danger">*</span></label>
                                                                <select class="form-control select2" name="state" id="state">
                                                                    <option disabled selected>Select State</option>

                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-4">
                                                            <div class="form-group">
                                                                <label for="full_name" class="control-label">City<span class="text-danger">*</span></label>
                                                                <select class="form-control select2" name="city" id="city">
                                                                    <option disabled selected>Select City</option>

                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-5">
                                                            <div class="form-group">
                                                                <label for="full_name" class="control-label">Address</label>
                                                                <textarea name="address" id="textarea" class="form-control" maxlength="500" rows="3" placeholder="Address If needed" value="{{ old('address') }}"></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <div class="form-group">
                                                                <label for="full_name" class="control-label">Upload photo/Take Photo</label>
                                                                <select class="form-control select2 upload_photo" name="upload_photo">
                                                                    <option disabled selected>Add Photo Or Take Photo</option>
                                                                    <option value="0">Upload Photo</option>
                                                                    <option value="1">Take a Photo</option>

                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-3 uploading" style="display: none;">
                                                            <div class="form-group">
                                                                <label for="full_name" class="control-label">Upload photo</label>
                                                                <input type="file" class="filestyle" data-input="false" name="profile_photo">

                                                            </div>
                                                        </div>

                                                        <div class="col-sm-12 taking_pic" style="display: none;">
                                                            <div class="row">
                                                                <div class="col-md-2"></div>
                                                                <div class="col-md-4" align="center">

                                                                    <div id = "results" style="width: 322px; height: 265px; border:1px solid; background:#ccc;">

                                                                    </div>

                                                                </div>
                                                                <div class="col-md-4" align="center">
                                                                    <div id="main_camera">

                                                                    </div>
                                                                    <button type="button" style="align-self:center; " onclick="take_snapshot()" class="btn btn-primary">take snap</button>

                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                        <hr>
                                                        <h4>Medical Profile</h4>
                                                        <hr>
                                                    <div class="row p-20" style="clear: both;">
                                                            <div class="form-group row">
                                                                <label for="blood_group" class="col-sm-3">Blood group</label>
                                                                <div class="col-sm-9">
                                                                    <select class="form-control select2" name="blood_group">
                                                                        <option selected>Select Blood Group</option>
                                                                        <option value="A+">A+</option>
                                                                        <option value="A-">A-</option>
                                                                        <option value="B+">B+</option>
                                                                        <option value="B-">B-</option>
                                                                        <option value="O+">O+</option>
                                                                        <option value="O-">O-</option>
                                                                        <option value="AB+">AB+</option>
                                                                        <option value="AB-">AB-</option>
                                                                    </select>
                                                                </div>
                                                            </div>


                                                            <div class="form-group row">
                                                                <label for="status" class="col-sm-3">Had any Surgery?</label>
                                                                <div class="col-sm-9">
                                                                    <div class="radio radio-danger radio-inline">
                                                                        <input type="radio" id="inlineRadio1" name="surgery" value="0">
                                                                        <label for="inlineRadio1"> Yes </label>
                                                                    </div>
                                                                    <div class="radio radio-success radio-inline">
                                                                        <input type="radio" id="inlineRadio2" name="surgery" value="1">
                                                                        <label for="inlineRadio2"> No </label>
                                                                    </div>

                                                                    <div class="radio radio-purple radio-inline">
                                                                        <input type="radio" id="inlineRadio3" name="surgery" value="2">
                                                                        <label for="inlineRadio3"> I Don't Know </label>
                                                                    </div>


                                                                </div>
                                                            </div>

                                                            <div class="form-group row">
                                                                <label for="status" class="col-sm-3">Had any medical illness?</label>
                                                                <div class="col-sm-9">
                                                                    <div class="radio radio-danger radio-inline">
                                                                        <input type="radio" id="inlineRadio4" name="illness" value="0">
                                                                        <label for="inlineRadio4"> Yes </label>
                                                                    </div>
                                                                    <div class="radio radio-success radio-inline">
                                                                        <input type="radio" id="inlineRadio5" name="illness" value="1">
                                                                        <label for="inlineRadio5"> No </label>
                                                                    </div>

                                                                    <div class="radio radio-purple radio-inline">
                                                                        <input type="radio" id="inlineRadio6" name="illness" value="2">
                                                                        <label for="inlineRadio6"> I Don't Know </label>
                                                                    </div>


                                                                </div>
                                                            </div>

                                                            <div class="form-group row">
                                                                <label for="status" class="col-sm-3">G6PD deficiency?</label>
                                                                <div class="col-sm-9">
                                                                    <div class="radio radio-danger radio-inline">
                                                                        <input type="radio" id="inlineRadio11" name="g6pd" value="0">
                                                                        <label for="inlineRadio1"> Yes </label>
                                                                    </div>
                                                                    <div class="radio radio-success radio-inline">
                                                                        <input type="radio" id="inlineRadio12" name="g6pd" value="1">
                                                                        <label for="inlineRadio12"> No </label>
                                                                    </div>

                                                                    <div class="radio radio-purple radio-inline">
                                                                        <input type="radio" id="inlineRadio13" name="g6pd" value="2">
                                                                        <label for="inlineRadio13"> I Don't Know </label>
                                                                    </div>


                                                                </div>
                                                            </div>

                                                            <div class="form-group row">
                                                                <label for="email" class="col-sm-3">Insurance</label>
                                                                <div class="col-sm-9">

                                                                    <input type="text" name="insurance" parsley-trigger="change"
                                                                           placeholder="Enter Insurance If needed" value="{{ old('insurance') }}" autocomplete="off" class="form-control"/>

                                                                </div>
                                                            </div>

                                                            <div class="form-group row">
                                                                <label for="item_image" class="col-sm-3">Attach Patient Note</label>
                                                                <div class="col-sm-9">
                                                                    <input type="file" class="filestyle" data-placeholder="Not Important" name="patient_file" data-buttonname="btn-danger">
                                                                </div>
                                                            </div>
                                                    </div>
                                                    <hr>
                                                    <h4>Drug Allergy</h4>
                                                    <hr>
                                                    <div class="row p-20" style="clear: both;">


                                                            <div class="form-group row">
                                                                <div class="col-sm-5">

                                                                    <div class="form-group row">
                                                                        <div class="col-sm-4"></div>
                                                                        <label for="full_name" class="col-sm-3">Add Drug</label>
                                                                    </div>
                                                                    <div class="form-group row">
                                                                        <div class="col-sm-12">
                                                                            <input type="text" parsley-trigger="change"
                                                                                   placeholder="Drug Name" autocomplete="off" class="form-control drug_name"/>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group row">
                                                                        <div class="col-sm-12">
                                                                            <textarea id="textarea" class="form-control drug_comment" maxlength="500" rows="5" placeholder="Comment If needed"></textarea>

                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group row">

                                                                        <div class="col-sm-4">
                                                                            <button class="btn btn-icon waves-effect waves-light btn-inverse m-b-5 add_drug" type="button">
                                                                                <i class="fa fa-plus"></i> Add Drug
                                                                            </button>
                                                                        </div>
                                                                    </div>

                                                                </div>



                                                                <div class="col-sm-7">
                                                                    <table class="table table-striped m-0">

                                                                        <thead>
                                                                        <tr>


                                                                            <th width="35%">Drug Name</th>

                                                                            <th>Comment</th>
                                                                            <th width="20%">Action</th>
                                                                        </tr>
                                                                        </thead>
                                                                        <tbody id="item_row">

                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>


                                                        </div>

                                                </div>
                                                <div class="col-md-1"></div>

                                            </div>
                                        </div>


                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cancel</button>
                                            {{ csrf_field() }}


                                            <button type="submit" class="btn btn-inverse waves-effect" style="float: right;margin-left: 1%;">Add Patient</button>


                                        </div>
                                    </form>
                                </div><!-- /.modal-content -->
                            </div><!-- /.modal-dialog -->
                        </div><!-- /.modal -->

                        {{--end model--}}
                        <hr>


                        <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive">
                            <thead>
                            <tr>
                                <th width="2%">Sr.No</th>

                                <th>Name</th>
                                <th width="12%">Patient Code</th>
                                <th width="18%">Contact No</th>


                                <th width="8%">Gender</th>

                                <th width="8%">Age</th>


                                <th width="15%">Shortcuts</th>
                                <th width="15%">Action</th>

                            </tr>
                            </thead>


                            <tbody>
                            @php $i=1;@endphp
                            @foreach($patients as $patient)
                                <tr>
                                    <td>{{ $i }}</td>

                                    <td><button
                                                data-toggle="modal" data-target="#full-width-modal-show{{$patient->id}}"
                                                style=" border:none;background: none;color: #017ebc">{{ $patient->patient_info['full_name'] }}</button></td>
                                    <td style="font-weight: bold">{{ $patient['patient_code'] }}</td>
                                    <td>{{ $patient->patient_info['contact_no'] }}</td>



                                    @if($patient->patient_info['gender'] == 0)
                                        <td>Male</td>
                                    @elseif($patient->patient_info['gender'] == 1)
                                        <td>Female</td>
                                    @else
                                        <td>Other</td>
                                    @endif
                                    @php $age = date('Y', strtotime(Carbon\Carbon::now())) - date('Y', strtotime($patient->patient_info['date_of_birth'])); @endphp
                                    <td>{{ $age }}</td>
                                    <td>
                                        <form action="{{ url('invoice_add') }}" method="post">
                                            {{csrf_field()}}
                                            <input type="hidden" name="patient_id" value="{{ $patient->id }}">
                                            <input type="hidden" name="doctor_id" value="{{ Auth::user()->id }}">
                                            <button
                                                    style="margin-right:10px; font-weight: bold;float: left; font-size: 200%; background: none; border: none; color: #2b4a95"
                                                    type="submit">I</button>
                                        </form>

                                        <button
                                                style="font-weight: bold; font-size: 200%; background: none; border: none; color: #2b4a95"
                                                data-toggle="modal" data-target="#con-close-modal-medical{{$patient->id}}">M</button>

                                        <button
                                           style="font-weight: bold; font-size: 200%; background: none; border: none; color: #2b4a95"
                                            data-toggle="modal" data-target="#con-close-modal{{$patient->patient_code}}">Q</button>

                                        <a href="{{ url('appointments/'.$patient->id.'/edit') }}"
                                           style="font-weight: bold; font-size: 200%;color: #2b4a95; margin-left: 5px;"
                                           data-toggle="tooltip" data-placement="top" title=""
                                           data-original-title="Add Appointment ">A</a>


                                        &nbsp;

                                    </td>
                                    <td>

                                        <button class="btn btn-icon waves-effect waves-light btn-teal m-b-5" data-toggle="modal" data-target="#full-width-modal-show{{$patient->id}}"><i class="fa fa-eye"></i></button>

                                        <button class="btn btn-icon waves-effect waves-light btn-info m-b-5 edit_patient_modal" data-patientId="{{$patient->id}}" data-toggle="modal" data-target="#full-width-modal-edit{{$patient->id}}"><i class="fa fa-edit"></i></button>

                                        @if(Auth::user()->role_id == 2)
                                        <button class="btn btn-icon waves-effect waves-light btn-danger m-b-5" data-toggle="modal" data-target="#con-close-modal{{$patient->id}}"><i class="fa fa-remove"></i></button>
                                        @endif

                                    </td>
                                </tr>


                                {{--start delete modal--}}
                                <div id="con-close-modal{{$patient->id}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                <h4 class="modal-title">Warning!</h4>
                                            </div>
                                            <div class="modal-body">

                                                Are You Sure.You want to delete This patient.
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal" style="float: right;">Close</button>

                                                <form action="{{ url('patients/'.$patient->id) }}" method="post">
                                                    {{ csrf_field() }}
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <button type="submit" class="btn btn-danger waves-effect" style="float: right;margin-right: 2%;">Yes Delete it</button>

                                                </form>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{--end delete modal--}}

                                {{--for Add to Queue Model--}}
                                <div id="con-close-modal{{$patient->patient_code}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">

                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                <h4 class="modal-title">Add To Queue</h4>
                                            </div>
                                            <form action="{{ route('queues.store') }}" method="post">

                                            <div class="modal-body">


                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="pats" class="control-label">Select Doctor<span class="text-danger">*</span></label>
                                                            <select class="form-control select2" name="doctor_id" id="doctor_id">
                                                                <option selected disabled="disabled">Select Doctors</option>

                                                                @foreach($doctors as $doctor)
                                                                    <option value="{{ $doctor->id }}">{{ $doctor->users->name}}</option>
                                                                @endforeach

                                                            </select>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>


                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                                                {{ csrf_field() }}
                                                <input type="hidden" name="patient_id" value="{{$patient->id}}">

                                                <button type="submit" class="btn btn-inverse waves-effect" style="float: left;margin-right: 2%;">Add To Queue</button>


                                            </div>
                                            </form>
                                        </div>

                                    </div>

                                </div>
                                {{-- end queue model--}}

                                {{--start medica record modal--}}
                                <div id="con-close-modal-medical{{$patient->id}}" class="modal fade" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">

                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                <h4 class="modal-title">Add Record</h4>
                                            </div>
                                            <form action="{{ url('medical_edit') }}" method="post">
                                                <div class="modal-body">


                                                    <div class="row">
                                                        <input type="hidden" name="patient_id" value="{{ $patient->id }}">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="pats" class="control-label">Select Doctor<span class="text-danger">*</span></label>
                                                                <select class="form-control select2" name="doctor_id">
                                                                    <option selected disabled="disabled">Select Doctor</option>

                                                                    @foreach($doctors as $doctor)
                                                                        <option value="{{ $doctor->id }}">{{ $doctor->users['name'] }}</option>
                                                                    @endforeach

                                                                </select>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>

                                                <div class="modal-footer">
                                                    {{ csrf_field() }}

                                                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-inverse waves-effect waves-light">Add Record</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>

                                </div><!-- /.modal -->

                                {{--end medical record modal--}}


                                @php $i++; @endphp
                            @endforeach
                            </tbody>
                        </table>
                        @foreach($patients as $patient)
                            {{--start edit modal--}}

                            <div id="full-width-modal-edit{{$patient->id}}"  class="modal fade" role="dialog" aria-labelledby="full-width-modalLabel-create" aria-hidden="true" style="display: none;">
                                <div class="modal-dialog modal-full">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                            <h4 class="modal-title" id="full-width-modalLabel-create">Edit Patient</h4>
                                        </div>
                                        {!! Form::model($patient, ['method' => 'PATCH','url' => ['patients', $patient->id], 'files'=>true]) !!}


                                        <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-md-1"></div>
                                                    <div class="col-md-10">

                                                        <div class="row p-20" style="clear: both;">

                                                            <div class="col-sm-4">
                                                                <div class="form-group">
                                                                    <label for="full_name" class="control-label">Full Name<span class="text-danger">*</span></label>

                                                                    {!! Form::text('patient_info[full_name]' , null ,['class' => 'form-control input-sm','parsley-trigger' => 'change']) !!}
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <div class="form-group">
                                                                    <label for="full_name" class="control-label">Contact No<span class="text-danger">*</span></label>

                                                                    {!! Form::number('patient_info[contact_no]' , null ,['class' => 'form-control input-sm','parsley-trigger' => 'change']) !!}

                                                                </div>
                                                            </div>

                                                            <div class="col-sm-4">
                                                                <div class="form-group">
                                                                    <label for="full_name" class="control-label">Email</label>
                                                                    <input type="email" id="fake-email" name="fake-email" style="display: none;">

                                                                    {!! Form::text('patient_info[email]' , null ,['class' => 'form-control input-sm','parsley-trigger' => 'change']) !!}
                                                                </div>
                                                            </div>


                                                            <div class="col-sm-4">
                                                                <div class="form-group">
                                                                    <label for="full_name" class="control-label">Gender<span class="text-danger">*</span></label>
                                                                    <div>
                                                                        <div class="radio radio-info radio-inline">

                                                                            {!! Form::radio('patient_info[gender]', 0,['id' => 'inlineRadio8']) !!}
                                                                            <label for="inlineRadio8"> Male </label>
                                                                        </div>
                                                                        <div class="radio radio-pink radio-inline">

                                                                            {!! Form::radio('patient_info[gender]', 1,['id' => 'inlineRadio9']) !!}
                                                                            <label for="inlineRadio9"> Female </label>
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-sm-4">
                                                                <div class="form-group">
                                                                    <label for="full_name" class="control-label">Date Of Birth<span class="text-danger">*</span></label>

                                                                    {!! Form::text('patient_info[date_of_birth]' , null ,['class' => 'form-control input-sm','id' => 'datepicker-autoclose','placeholder' => 'mm/dd/yyyy']) !!}

                                                                </div>
                                                            </div>

                                                            <div class="col-sm-4">
                                                                <div class="form-group">
                                                                    <label for="full_name" class="control-label">Language Preference</label>
                                                                    {!!Form::select('patient_info[language]',$edit_languages,null ,['class' => 'form-control select2'])!!}

                                                                </div>
                                                            </div>

                                                            <div class="col-sm-4">
                                                                <div class="form-group">
                                                                    <label for="full_name" class="control-label">Country<span class="text-danger">*</span></label>
                                                                    {!!Form::select('patient_info[country]',$edit_countries,null ,['class' => 'form-control select2 country2','id' => 'country'.$patient->id,'data-patientId' => $patient->id])!!}

                                                                </div>
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <div class="form-group">
                                                                    <label for="full_name" class="control-label">State<span class="text-danger">*</span></label>
                                                                    <select class="form-control select2 state2" name="state" id="{{'state'.$patient->id}}" data-patientId="{{$patient->id}}">
                                                                        <option value="{{ $patient->patient_info['state'] }}" selected>{{ $patient->patient_info['state'] }}</option>

                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="col-sm-4">
                                                                <div class="form-group">
                                                                    <label for="full_name" class="control-label">City<span class="text-danger">*</span></label>
                                                                    <select class="form-control select2 city2" name="city" id="{{'city'.$patient->id}}">
                                                                        <option value="{{ $patient->patient_info['city'] }}" selected>{{ $patient->patient_info['city'] }}</option>

                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="col-sm-5">
                                                                <div class="form-group">
                                                                    <label for="full_name" class="control-label">Address</label>
                                                                    {!!Form::textarea('patient_info[address]',null ,['class' => 'form-control','maxlength' => '225','rows' => '3', 'id' => 'textarea'])!!}

                                                                </div>
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <div class="form-group">
                                                                    <label for="full_name" class="control-label">Upload photo/Take Photo</label>
                                                                    <select data-patientId="{{$patient->id}}" class="form-control select2 upload_photo2" name="upload_photo">
                                                                        <option disabled selected>Add Photo Or Take Photo</option>
                                                                        <option value="0">Upload Photo</option>
                                                                        <option value="1">Take a Photo</option>

                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-3 uploading{{$patient->id}}" style="display: none;">
                                                                <div class="form-group">
                                                                    <label for="full_name" class="control-label">Upload photo</label>
                                                                    <input type="file" class="filestyle" data-input="false" name="profile_photo">

                                                                </div>
                                                            </div>

                                                            <div class="col-sm-12 taking_pic{{$patient->id}}">
                                                                <div class="row">
                                                                    <div class="col-md-4"></div>

                                                                    <div class="col-md-4" align="center" id="button_upload{{$patient->id}}" style="display:none;">
                                                                        <div id="main_camera{{$patient->id}}">

                                                                        </div>
                                                                        <button type="button" data-patientId="{{$patient->id}}" style="align-self:center;" onclick="take_snapshot2()" class="btn btn-primary">take snap</button>

                                                                    </div>
                                                                    <div class="col-md-4" align="center">

                                                                        <div id = "results2{{$patient->id}}" style="width: 322px; height: 265px; border:1px solid; background:#ccc;">
                                                                            <img src="{{ asset('uploads/'.$patient->patient_info['profile_image']) }}" style="width: 322px; height: 265px;">

                                                                        </div>

                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                        <hr>
                                                        <h4>Medical Profile</h4>
                                                        <hr>
                                                        <div class="row p-20" style="clear: both;">
                                                            <div class="form-group row">
                                                                <label for="blood_group" class="col-sm-3">Blood group</label>
                                                                <div class="col-sm-9">
                                                                    {!!Form::select('medical_info[blood_group]',
                                                                    ['A+'=>'A+', 'A-'=>'A-', 'B+'=>'B+', 'B-'=>'B-',
                                                                    'O+'=>'O+', 'O-'=>'O-', 'AB+'=>'AB+', 'AB-'=>'AB-'],
                                                                    null ,['class' => 'form-control select2'])!!}
                                                                </div>
                                                            </div>


                                                            <div class="form-group row">
                                                                <label for="status" class="col-sm-3">Had any Surgery?</label>
                                                                <div class="col-sm-9">
                                                                    <div class="radio radio-danger radio-inline">
                                                                        {!! Form::radio('medical_info[surgery]', 0,['id' => 'inlineRadio331']) !!}

                                                                        <label for="inlineRadio331"> Yes </label>
                                                                    </div>
                                                                    <div class="radio radio-success radio-inline">
                                                                        {!! Form::radio('medical_info[surgery]', 1,['id' => 'inlineRadio332']) !!}
                                                                        <label for="inlineRadio332"> No </label>
                                                                    </div>

                                                                    <div class="radio radio-purple radio-inline">
                                                                        {!! Form::radio('medical_info[surgery]', 2,['id' => 'inlineRadio333']) !!}
                                                                        <label for="inlineRadio333"> I Don't Know </label>
                                                                    </div>


                                                                </div>
                                                            </div>

                                                            <div class="form-group row">
                                                                <label for="status" class="col-sm-3">Had any medical illness?</label>
                                                                <div class="col-sm-9">
                                                                    <div class="radio radio-danger radio-inline">
                                                                        {!! Form::radio('medical_info[illness]', 0,['id' => 'inlineRadio221']) !!}
                                                                        <label for="inlineRadio221"> Yes </label>
                                                                    </div>
                                                                    <div class="radio radio-success radio-inline">
                                                                        {!! Form::radio('medical_info[illness]', 1,['id' => 'inlineRadio222']) !!}
                                                                        <label for="inlineRadio222"> No </label>
                                                                    </div>

                                                                    <div class="radio radio-purple radio-inline">
                                                                        {!! Form::radio('medical_info[illness]', 2,['id' => 'inlineRadio223']) !!}
                                                                        <label for="inlineRadio223"> I Don't Know </label>
                                                                    </div>


                                                                </div>
                                                            </div>

                                                            <div class="form-group row">
                                                                <label for="status" class="col-sm-3">G6PD deficiency?</label>
                                                                <div class="col-sm-9">
                                                                    <div class="radio radio-danger radio-inline">
                                                                        {!! Form::radio('medical_info[g6pd]', 0,['id' => 'inlineRadio111']) !!}
                                                                        <label for="inlineRadio111"> Yes </label>
                                                                    </div>
                                                                    <div class="radio radio-success radio-inline">
                                                                        {!! Form::radio('medical_info[g6pd]', 1,['id' => 'inlineRadio112']) !!}
                                                                        <label for="inlineRadio112"> No </label>
                                                                    </div>

                                                                    <div class="radio radio-purple radio-inline">
                                                                        {!! Form::radio('medical_info[g6pd]', 2,['id' => 'inlineRadio113']) !!}
                                                                        <label for="inlineRadio113"> I Don't Know </label>
                                                                    </div>


                                                                </div>
                                                            </div>

                                                            <div class="form-group row">
                                                                <label for="email" class="col-sm-3">Insurance</label>
                                                                <div class="col-sm-9">

                                                                    {!! Form::text('medical_info[insurance]' , null ,['class' => 'form-control','parsley-trigger' => 'change','placeholder' => 'Insurance']) !!}


                                                                </div>
                                                            </div>

                                                            <div class="form-group row">
                                                                <label for="item_image" class="col-sm-3">Attach Patient file</label>
                                                                <div class="col-sm-9">
                                                                    <input type="file" class="filestyle" data-placeholder="{{ $patient->medical_info['patient_file'] }}" name="patient_file" data-buttonname="btn-danger">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <hr>
                                                        <h4>Drug Allergy</h4>
                                                        <hr>
                                                        <div class="row p-20" style="clear: both;">
                                                            <div class="form-group row">
                                                                <div class="col-sm-5">

                                                                    <div class="form-group row">
                                                                        <div class="col-sm-4"></div>
                                                                        <label for="full_name" class="col-sm-3">Add Drug</label>
                                                                    </div>
                                                                    <div class="form-group row">
                                                                        <div class="col-sm-12">
                                                                            <input type="text" parsley-trigger="change"
                                                                                   placeholder="Drug Name" autocomplete="off" class="form-control drug_name1"/>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group row">
                                                                        <div class="col-sm-12">
                                                                            <textarea id="textarea" class="form-control drug_comment1" maxlength="500" rows="5" placeholder="Comment If needed"></textarea>

                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group row">

                                                                        <div class="col-sm-4">
                                                                            <button class="btn btn-icon waves-effect waves-light btn-inverse m-b-5 add_drug1" type="button">
                                                                                <i class="fa fa-plus"></i> Add Drug
                                                                            </button>
                                                                        </div>
                                                                    </div>

                                                                </div>



                                                                <div class="col-sm-7">
                                                                    <table class="table table-striped m-0">

                                                                        <thead>
                                                                        <tr>


                                                                            <th width="35%">Drug Name</th>

                                                                            <th>Comment</th>
                                                                            <th width="20%">Action</th>
                                                                        </tr>
                                                                        </thead>
                                                                        <tbody id="item_row1">
                                                                        @foreach($patient->drug_allergy as $drug)
                                                                            <tr>
                                                                                <td>{{ $drug['drug_name'] }}<input type="hidden" name="drug_name[]" value="{{ $drug['drug_name'] }}"></td>
                                                                                <td>{{ $drug['drug_comment'] }}<input type="hidden" name="drug_comment[]" value="{{ $drug['drug_comment'] }}"></td>
                                                                                <td>
                                                                                    <button type="button" class="btn btn-icon btn-danger m-b-5 remove_item1">
                                                                                        <i class="fa fa-remove"></i>
                                                                                    </button>
                                                                                </td>
                                                                            </tr>
                                                                        @endforeach


                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>


                                                        </div>

                                                    </div>
                                                    <div class="col-md-1"></div>

                                                </div>
                                            </div>


                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cancel</button>
                                                {{ csrf_field() }}


                                                <button type="submit" class="btn btn-inverse waves-effect" style="float: right;margin-left: 1%;">Update Patient</button>


                                            </div>
                                        </form>
                                    </div><!-- /.modal-content -->
                                </div><!-- /.modal-dialog -->
                            </div><!-- /.modal -->

                            {{--end edit modal--}}
                            {{--start show modal--}}

                            <div id="full-width-modal-show{{$patient->id}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="full-width-modalLabel" aria-hidden="true" style="display: none;">
                                <div class="modal-dialog modal-full">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                            <h4 class="modal-title" id="full-width-modalLabel">Patient Profile</h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="box-header">
                                                        <ul class="nav nav-tabs navtab-bg nav-justified">
                                                            <li class="active">
                                                                <a href="#general-{{$patient->id}}" data-toggle="tab" aria-expanded="false">
                                                                    <span class="visible-xs"><i class="fa fa-home"></i></span>
                                                                    <span class="hidden-xs">Patient Info</span>
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="#drug-{{$patient->id}}" data-toggle="tab" aria-expanded="false">
                                                                    <span class="visible-xs"><i class="fa fa-medkit"></i></span>
                                                                    <span class="hidden-xs">Drug Allergy</span>
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="#record-{{$patient->id}}" data-toggle="tab" aria-expanded="false">
                                                                    <span class="visible-xs"><i class="fa fa-pencil-square"></i></span>
                                                                    <span class="hidden-xs">Medical Records</span>
                                                                </a>
                                                            </li>


                                                        </ul>
                                                    </div>
                                                    <div class="tab-content">
                                                        <div class="tab-pane active" id="general-{{$patient->id}}">
                                                            <div class="text-center card-box">
                                                                <div class="member-card">
                                                                    <div class="row">
                                                                        <div class="col-lg-4 col-md-4">
                                                                            <div class="text-center card-box">
                                                                                <div class="member-card">
                                                                                    <div class="thumb-xl member-thumb m-b-10 center-block">
                                                                                        <img src="{{ asset('uploads/'.$patient->patient_info['profile_image']) }}" class="img-circle img-thumbnail" alt="profile-image">
                                                                                        <i class="mdi mdi-star-circle member-star text-success" title="verified user"></i>
                                                                                    </div>

                                                                                    <div class="">

                                                                                        <p class="text-muted">Patient</p>
                                                                                    </div>

                                                                                    {{--model for activate and deactivate users--}}

                                                                                    <hr/>
                                                                                    {{--end model--}}
                                                                                    <div class="text-left">
                                                                                        <p class="text-muted font-13"><strong>Full Name :</strong> <span class="m-l-15">{{ $patient->patient_info['full_name'] }}</span></p>

                                                                                        <p class="text-muted font-13"><strong>Gender :</strong>
                                                                                            <span class="m-l-15">
                                                                                                @if($patient->patient_info['gender'] == 0)
                                                                                                    Male
                                                                                                @elseif($patient->patient_info['gender'] == 1)
                                                                                                    Female

                                                                                                @endif
                                                                                            </span>
                                                                                        </p>

                                                                                        <p class="text-muted font-13"><strong>Patient Code :</strong>
                                                                                            <span class="m-l-15" style="color: #1f648b; font-weight: bold">
                                                                                                {{ $patient->patient_code }}</span></p>

                                                                                        <p class="text-muted font-13"><strong>Contact NO :</strong>
                                                                                            <span class="m-l-15">
                                                                                                {{ $patient->patient_info['contact_no'] }}</span></p>


                                                                                        <p class="text-muted font-13"><strong>Date Of Birth :</strong>
                                                                                            <span class="m-l-15">
                                                                                                {{ $patient->patient_info['date_of_birth'] }}</span></p>

                                                                                        <p class="text-muted font-13"><strong>Address :</strong>
                                                                                            <span class="m-l-15">
                                                                                                {{ $patient->patient_info['address'] }}</span></p>
                                                                                    </div>



                                                                                </div>

                                                                            </div> <!-- end card-box -->

                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <table border="1" width="100%" cellspacing="10px">
                                                                                
                                                                                {{--<tr>
                                                                                    <td colspan="2" align="center">
                                                                                        <div class="thumb-xl member-thumb m-b-10 center-block">
                                                                                            <img src="{{ asset('uploads/'.$patient->patient_info['profile_image']) }}" class="img-circle img-thumbnail" alt="profile-image">
                                                                                            <i class="mdi mdi-star-circle member-star text-success" title="verified user"></i>
                                                                                        </div>

                                                                                    </td>
                                                                                </tr>
--}}                                                                            <tr style="height: 40px;">
                                                                                    <td width="40%" style="background-color: whitesmoke; font-weight: bold;">Email Address</td>
                                                                                    <td style="font-weight: bold;color: #1f648b;">{{ $patient->patient_info['email'] }}</td>
                                                                                </tr>

                                                                                <tr style="height: 40px;">
                                                                                    @php $age = date('Y', strtotime(Carbon\Carbon::now())) - date('Y', strtotime($patient->patient_info['date_of_birth'])); @endphp
                                                                                    <td width="40%" style="background-color: whitesmoke; font-weight: bold;">Age</td>
                                                                                    <td>{{ $age }}</td>
                                                                                </tr>
                                                                                <tr style="height: 40px;">
                                                                                    <td width="40%" style="background-color: whitesmoke; font-weight: bold;">Blood Group</td>
                                                                                    <td>{{ $patient->medical_info['blood_group'] }}</td>
                                                                                </tr>


                                                                                <tr style="height: 40px;">
                                                                                    <td width="40%" style="background-color: whitesmoke; font-weight: bold;">Created By</td>
                                                                                    <td>{{ $patient->users['name'] }}({{ $patient->users->roles['role_name'] }})</td>
                                                                                </tr>


                                                                                <tr style="height: 40px;">
                                                                                    @php $age = date('Y', strtotime(Carbon\Carbon::now())) - date('Y', strtotime($patient->patient_info['date_of_birth'])); @endphp
                                                                                    <td width="40%" style="background-color: whitesmoke; font-weight: bold;">Age</td>
                                                                                    <td>{{ $age }}</td>
                                                                                </tr>
                                                                                <tr style="height: 40px;">
                                                                                    <td width="40%" style="background-color: whitesmoke; font-weight: bold;">Had an Surgery</td>
                                                                                    <td>
                                                                                        @if($patient->medical_info['surgery'] == 0)
                                                                                            Yes
                                                                                        @elseif($patient->medical_info['surgery'] == 1)
                                                                                            No
                                                                                        @else
                                                                                            I Don't Know
                                                                                        @endif
                                                                                    </td>
                                                                                </tr>

                                                                                <tr style="height: 40px;">
                                                                                    <td width="40%" style="background-color: whitesmoke; font-weight: bold;">Past Illness</td>
                                                                                    <td>
                                                                                        @if($patient->medical_info['illness'] == 0)
                                                                                            Yes
                                                                                        @elseif($patient->medical_info['illness'] == 1)
                                                                                            No
                                                                                        @else
                                                                                            I Don't Know
                                                                                        @endif
                                                                                    </td>


                                                                                </tr>
                                                                                <tr style="height: 40px;">
                                                                                    <td width="40%" style="background-color: whitesmoke; font-weight: bold;">G6PD Deficiency</td>
                                                                                    <td>
                                                                                        @if($patient->medical_info['g6pd'] == 0)
                                                                                            Yes
                                                                                        @elseif($patient->medical_info['g6pd'] == 1)
                                                                                            No
                                                                                        @else
                                                                                            I Don't Know
                                                                                        @endif
                                                                                    </td>
                                                                                </tr>
                                                                                <tr style="height: 40px;">
                                                                                    <td width="40%" style="background-color: whitesmoke; font-weight: bold;">Insurance</td>
                                                                                    <td>{{ $patient->medical_info['insurance'] }}</td>
                                                                                </tr>

                                                                                <tr style="height: 40px;">
                                                                                    <td width="40%" style="background-color: whitesmoke; font-weight: bold;">Patient Note</td>
                                                                                    <td><a style="color: #1f648b; font-weight: bold"
                                                                                           href="{{ asset('uploads/'.$patient->medical_info['patient_file']) }}" target="_blank">{{ $patient->medical_info['patient_file'] }}</a></td>
                                                                                </tr>




                                                                            </table>
                                                                        </div>

                                                                    </div>

                                                                </div>

                                                            </div>
                                                        </div>


                                                        <div class="tab-pane" id="drug-{{$patient->id}}">
                                                            <div class="text-center card-box">
                                                                <div class="member-card">
                                                                    <div class="row">
                                                                        <div class="col-md-12">

                                                                            <table class="table table-striped m-0">
                                                                                <thead>
                                                                                <tr>
                                                                                    <th width="5%" style="text-align: center">SR.No</th>
                                                                                    <th width="40%" style="text-align: center">Drug Name</th>
                                                                                    <th style="text-align: center">Drug Comment</th>
                                                                                </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                @php $p=1; @endphp
                                                                                @foreach($patient->drug_allergy as $drug)
                                                                                    <tr style="height: 40px;">

                                                                                        <td>{{ $p }}</td>
                                                                                        <td>{{ $drug['drug_name'] }}</td>
                                                                                        <td>{{ $drug['drug_comment'] }}</td>

                                                                                    </tr>
                                                                                    @php  $p++ @endphp
                                                                                @endforeach
                                                                                </tbody>
                                                                            </table>

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>


                                                        <div class="tab-pane" id="record-{{$patient->id}}">
                                                            <div class="text-center card-box">
                                                                <div class="member-card">
                                                                    @if($patient->medical_records == null)
                                                                        <h5 align="center">No Record</h5>
                                                                    @endif
                                                                    @php $ib=1; @endphp
                                                                    @foreach($patient->medical_records as $record)
                                                                        <div class="row">
                                                                            <div class="col-md-12">
                                                                                <div class="panel panel-default" style="border: none;">
                                                                                    <a data-toggle="collapse"
                                                                                       data-parent="#accordion-test"
                                                                                       href="#collapseOne{{$record->id}}"
                                                                                       class="collapsed"
                                                                                    >

                                                                                        <div class="panel-heading"
                                                                                             style="background-color: whitesmoke;
                                                                                                 border: 2px solid #2b4a95 !important;border-radius: 25px;color: #2b4a95">
                                                                                            <h4 class="panel-title">
                                                                                                    <span style="float: left;color: #2b4a95;">
                                                                                                        #{{$ib}}
                                                                                                    </span>

                                                                                                {{ date('d-M-Y',strtotime($record->created_at)) }}

                                                                                            </h4>
                                                                                        </div>
                                                                                    </a>
                                                                                    <div id="collapseOne{{$record->id}}" class="panel-collapse collapse">
                                                                                        <div class="panel-body">
                                                                                            <div class="form-group row">
                                                                                                <label for="patient_id" class="form-label col-sm-1">Doctor</label>
                                                                                                <div class="col-sm-5">
                                                                                                    <input type="text" class="form-control"
                                                                                                           value="{{ $record->user_informations->doctor_info['first_name'] }} {{ $record->user_informations->doctor_info['last_name'] }}" readonly>

                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="form-group row">
                                                                                                <label for="diagnose" class="form-label col-sm-1">Diagnoses</label>

                                                                                                <div class="col-sm-2">
                                                                                                    <textarea name="diagnose" id="textarea" class="form-control" maxlength="500" rows="3" placeholder="Address If needed" value="{{ $record->diagnose }}"></textarea>
                                                                                                </div>

                                                                                            </div>



                                                                                            <hr>



                                                                                            <ul class="nav nav-tabs navtab-bg nav-justified">
                                                                                                <li class="active">
                                                                                                    <a href="#health{{ $record->id }}" data-toggle="tab" aria-expanded="false">
                                                                                                        <span class="visible-xs"><i class="fa fa-home"></i></span>
                                                                                                        <span class="hidden-xs">Health Info</span>
                                                                                                    </a>
                                                                                                </li>
                                                                                                <li class="">
                                                                                                    <a href="#writing{{ $record->id }}" data-toggle="tab" aria-expanded="false">
                                                                                                        <span class="visible-xs"><i class="fa fa-user"></i></span>
                                                                                                        <span class="hidden-xs">Typing Note</span>
                                                                                                    </a>
                                                                                                </li>


                                                                                                <li class="">
                                                                                                    <a href="#drawing{{ $record->id }}" id="draw_pad" data-toggle="tab" aria-expanded="false">
                                                                                                        <span class="visible-xs"><i class="fa fa-envelope-o"></i></span>
                                                                                                        <span class="hidden-xs">Drawing Pad</span>
                                                                                                    </a>
                                                                                                </li>

                                                                                                <li class="">
                                                                                                    <a href="#template{{ $record->id }}" data-toggle="tab" aria-expanded="false">
                                                                                                        <span class="visible-xs"><i class="fa fa-envelope-o"></i></span>
                                                                                                        <span class="hidden-xs">Template</span>
                                                                                                    </a>
                                                                                                </li>
                                                                                                <li class="">
                                                                                                    <a href="#upload{{ $record->id }}" data-toggle="tab" aria-expanded="false">
                                                                                                        <span class="visible-xs"><i class="fa fa-envelope-o"></i></span>
                                                                                                        <span class="hidden-xs">Upload</span>
                                                                                                    </a>
                                                                                                </li>


                                                                                            </ul>
                                                                                            <div class="tab-content">
                                                                                                <div class="tab-pane active" id="health{{ $record->id }}">
                                                                                                    <div class="row">
                                                                                                        <div class="col-sm-12 col-xs-12 col-md-12">
                                                                                                            <div class="row">
                                                                                                                <div class="col-sm-12">
                                                                                                                    <div class="card-box">
                                                                                                                        <div class="row">
                                                                                                                            <div class="col-md-4">
                                                                                                                                <div class="form-group">

                                                                                                                                    <label for="weight" class="control-label">Weight</label>
                                                                                                                                    <div class="input-group m-t-10">
                                                                                                                                        <input type="text"
                                                                                                                                               value="{{ $record->health_info['weight'] }}" readonly class="form-control"/>
                                                                                                                                        <span class="input-group-addon">kg</span>
                                                                                                                                    </div>



                                                                                                                                </div>
                                                                                                                            </div>
                                                                                                                            <div class="col-md-4">
                                                                                                                                <div class="form-group">

                                                                                                                                    <label for="height" class="control-label">Height</label>
                                                                                                                                    <div class="input-group m-t-10">
                                                                                                                                        <input type="text"
                                                                                                                                               value="{{ $record->health_info['height'] }}" readonly class="form-control"/>
                                                                                                                                        <span class="input-group-addon">cm</span>
                                                                                                                                    </div>


                                                                                                                                </div>
                                                                                                                            </div>
                                                                                                                            <div class="col-md-4">
                                                                                                                                <div class="form-group">

                                                                                                                                    <label for="weight" class="control-label">BSA</label>
                                                                                                                                    <div class="input-group m-t-10">
                                                                                                                                        <input type="text"
                                                                                                                                               value="{{ $record->health_info['bsa'] }}" readonly class="form-control"/>
                                                                                                                                        <span class="input-group-addon">m<span style="font-size: 10px; position: relative; top: -5px;">2</span></span>
                                                                                                                                    </div>


                                                                                                                                </div>
                                                                                                                            </div>
                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>

                                                                                                    </div>
                                                                                                </div>


                                                                                                <div class="tab-pane" id="writing{{ $record->id }}">
                                                                                                    <div class="row">
                                                                                                        <div class="col-sm-12 col-xs-12 col-md-12">
                                                                                                            <div class="row">
                                                                                                                <div class="col-sm-12">
                                                                                                                    <div class="card-box">
                                                                                                                        <div class="row">
                                                                                                                            <div class="col-sm-12">
                                                                                                                                {!! $record->typing_Note !!}
                                                                                                                            </div>
                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>

                                                                                                    </div>
                                                                                                </div>





                                                                                                <div class="tab-pane" id="drawing{{ $record->id }}">
                                                                                                    <div class="row">
                                                                                                        <div class="col-sm-12 col-xs-12 col-md-12">
                                                                                                            <div class="row">
                                                                                                                <div class="col-sm-12">
                                                                                                                    <div class="card-box">
                                                                                                                        <div class="row">
                                                                                                                            <div class="col-md-12">

                                                                                                                                <img src="{{ $record->image_url }}" style="border: 2px solid black;"/>
                                                                                                                                <br>
                                                                                                                                <a href="{{ $record->image_url }}" download="Klinic" class="btn btn-primary">
                                                                                                                                    Download
                                                                                                                                </a>

                                                                                                                            </div>


                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                            </div>

                                                                                                        </div>

                                                                                                    </div>
                                                                                                </div>

                                                                                                <div class="tab-pane" id="template{{ $record->id }}">
                                                                                                    <div class="row">
                                                                                                        <div class="col-sm-12 col-xs-12 col-md-12">
                                                                                                            <div class="row">
                                                                                                                <div class="col-sm-12">
                                                                                                                    <div class="card-box">
                                                                                                                        @foreach($record->template as $temp)
                                                                                                                            <div class="form-group row">
                                                                                                                                <label for="patient_id" class="form-label col-sm-12"><span style="float: left;">{{ $temp['question'] }} ?</span></label>
                                                                                                                                @if(sizeof($temp['answers']) > 1)
                                                                                                                                    @for($i=0; $i < sizeof($temp['answers']); $i++)
                                                                                                                                        <div class="col-sm-3">
                                                                                                                                            <input type="text" class="form-control"
                                                                                                                                                   value="{{ $temp['answers'][$i] }}" readonly>

                                                                                                                                        </div>
                                                                                                                                    @endfor
                                                                                                                                @else
                                                                                                                                    <div class="col-sm-3">
                                                                                                                                        <input type="text" class="form-control"
                                                                                                                                               value="{{ $temp['answers'] }}" readonly>

                                                                                                                                    </div>
                                                                                                                                @endif
                                                                                                                            </div>
                                                                                                                        @endforeach
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>



                                                                                                    </div>
                                                                                                </div>

                                                                                                <div class="tab-pane" id="upload{{ $record->id }}">
                                                                                                    <div class="row">
                                                                                                        <div class="col-sm-12 col-xs-12 col-md-12">
                                                                                                            <div class="row">
                                                                                                                <div class="col-sm-12">
                                                                                                                    <div class="card-box">
                                                                                                                        <div class="row">
                                                                                                                            @for($j=0; $j < sizeof($record->upload_file); $j++)
                                                                                                                                <h5 align="left"><a href="{{ asset('uploads/'.$record->upload_file[$j]) }}" target="_blank">Image {{ $j+1 }}</a></h5>
                                                                                                                            @endfor
                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>

                                                                                                    </div>


                                                                                                </div>


                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        @php $ib++ @endphp
                                                                    @endforeach




                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>

                                        </div>
                                    </div><!-- /.modal-content -->
                                </div><!-- /.modal-dialog -->
                            </div><!-- /.modal -->
                            {{--end show modal--}}
                        @endforeach
                    </div>
                </div>
            </div>

        </div> <!-- container -->
        <input type="hidden" value="{{ url('/') }}" id="basepath">
    </div> <!-- content -->

@endsection

<!--*********Page Scripts Here*********-->

@section('scripts')

    <script src="{{ asset('assets/plugins/bootstrap-tagsinput/js/bootstrap-tagsinput.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/multiselect/js/jquery.multi-select.js') }}"></script>
    <script src="{{ asset('assets/plugins/jquery-quicksearch/jquery.quicksearch.js') }}"></script>
    <script src="{{ asset('assets/plugins/select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap-select/js/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap-filestyle/js/bootstrap-filestyle.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap-touchspin/js/jquery.bootstrap-touchspin.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js') }}"></script>

    <script src="{{ asset('assets/plugins/autocomplete/jquery.mockjax.js') }}"></script>
    <script src="{{ asset('assets/plugins/autocomplete/jquery.autocomplete.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/autocomplete/countries.js') }}"></script>
    <script src="{{ asset('assets/pages/jquery.autocomplete.init.js') }}"></script>



    <script src="{{ asset('assets/plugins/moment/moment.js') }}"></script>
    <script src="{{ asset('assets/plugins/timepicker/bootstrap-timepicker.js') }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/clockpicker/js/bootstrap-clockpicker.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap-daterangepicker/daterangepicker.js') }}"></script>

    <script src="{{ asset('assets/pages/jquery.form-pickers.init.js') }}"></script>

    <script src="{{ asset('assets/pages/jquery.form-advanced.init.js') }}"></script>


    <script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables/dataTables.bootstrap.js') }}"></script>



    <script src="{{ asset('assets/plugins/datatables/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables/responsive.bootstrap.min.js') }}"></script>


    <!-- init -->
    <script src="{{ asset('assets/pages/jquery.datatables.init.js') }}"></script>
    <script src="{{ asset('assets/plugins/tooltipster/tooltipster.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/pages/jquery.tooltipster.js') }}"></script>


    <script type="text/javascript">
        $(document).ready(function () {
            $('#datatable').dataTable();
            $('#datatable-keytable').DataTable({keys: true});
            $('#datatable-responsive').DataTable();
            $('#datatable-colvid').DataTable({
                "dom": 'C<"clear">lfrtip',
                "colVis": {
                    "buttonText": "Change columns"
                }
            });
            $('#datatable-scroller').DataTable({
                ajax: "../plugins/datatables/json/scroller-demo.json",
                deferRender: true,
                scrollY: 380,
                scrollCollapse: true,
                scroller: true
            });
            var table = $('#datatable-fixed-header').DataTable({fixedHeader: true});
            var table = $('#datatable-fixed-col').DataTable({
                scrollY: "300px",
                scrollX: true,
                scrollCollapse: true,
                paging: false,
                fixedColumns: {
                    leftColumns: 1,
                    rightColumns: 1
                }
            });
        });
        TableManageButtons.init();

    </script>


    <script src="{{ asset('js/webcam/webcam.js') }}"></script>
    <script>

        $('.upload_photo').change(function () {
            var upp_code = $(this).val();
            //alert(upp_code);
            if(upp_code == 0)
            {
                $('.uploading').css('display','block');
                $('.taking_pic').css('display','none');
            }
            else if(upp_code == 1)
            {
                Webcam.set({
                    width: 322,
                    height: 265,
                    image_format: 'jpeg',
                    jpeg_quality: 90
                });
                Webcam.attach('#main_camera');

                $('.uploading').css('display','none');
                $('.taking_pic').css('display','block');
            }
        });

        $('.upload_photo2').change(function () {
            var upp_code = $(this).val();
            var patient_id = $(this).data('patientid');
            //alert(patient_id);
            //alert(upp_code);
            if(upp_code == 0)
            {
                $('.uploading'+patient_id).css('display','block');
                $('.taking_pic'+patient_id).css('display','none');
            }
            else if(upp_code == 1)
            {
                Webcam.set({
                    width: 322,
                    height: 265,
                    image_format: 'jpeg',
                    jpeg_quality: 90
                });
                Webcam.attach('#main_camera'+patient_id);

                $('.uploading'+patient_id).css('display','none');
                $('.taking_pic'+patient_id).css('display','block');
                $('#button_upload'+patient_id).css('display','block');
            }
        });
    </script>

    <script>
        function take_snapshot() {

            var url = $('#basepath').val();
            //var csrf_token = $("meta[name=csrf-token]").attr('content');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            Webcam.snap( function(data_uri) {
                var html = `
                        <img src="`+data_uri+`" id="webcam_photo" width="100%" height="100%"/>
                        <input type="hidden" name="webcam_photo" value="`+data_uri+`">
                `;
                $('#results').html(html);

                //console.log(data_uri);
                /*Webcam.upload(data_uri, url+'/take_snap',function(code, text) {

                    /!*$data = JSON.parse(text);
                    $fname = url+$data['filepath']+$data['filename'];
                    $('#results').html('<img src="'+$fname+'"/>');
                    $('#picture').val($data['filepath']+$data['filename']);*!/
                    console.log(code);
                });*/
            });
        }

        function take_snapshot2() {

            var url = $('#basepath').val();
            var patient_id = event.target.dataset.patientid;
            //alert(patient_id);

            //var csrf_token = $("meta[name=csrf-token]").attr('content');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            Webcam.snap( function(data_uri) {
                var html = `
                        <img src="`+data_uri+`" id="webcam_photo" width="100%" height="100%"/>
                        <input type="hidden" name="webcam_photo" value="`+data_uri+`">
                `;
                $('#results2'+patient_id).html(html);

                //console.log(data_uri);
                /*Webcam.upload(data_uri, url+'/take_snap',function(code, text) {

                    /!*$data = JSON.parse(text);
                    $fname = url+$data['filepath']+$data['filename'];
                    $('#results').html('<img src="'+$fname+'"/>');
                    $('#picture').val($data['filepath']+$data['filename']);*!/
                    console.log(code);
                });*/
            });
        }
    </script>
@endsection

<!--*********Page Scripts End*********-->