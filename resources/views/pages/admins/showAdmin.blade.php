@extends('layouts.mainHome')



@section('content')
    <!-- Start content -->
    <div class="content">
        <div class="container">


            <div class="row">
                <div class="col-xs-12">
                    <div class="page-title-box">
                        <h4 class="page-title">Profile </h4>

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
                    <div class="card-box">
                        <div class="row">
                            <div class="col-lg-5 col-md-5">
                                <div class="text-center card-box">
                                    <div class="member-card">
                                        <div class="thumb-xl member-thumb m-b-10 center-block">
                                            <img src="{{ asset('uploads/'.$admin->users->profile_image) }}" class="img-circle img-thumbnail" alt="profile-image">
                                            <i class="mdi mdi-star-circle member-star text-success" title="verified user"></i>
                                        </div>

                                        <div class="">
                                            <h4 class="m-b-5">{{ $admin->admin_info['full_name'] }}</h4>
                                            <p class="text-muted">ADMIN</p>
                                        </div>
                                        <div class="box-header">
                                            <button type="button" class="btn btn-icon waves-effect waves-light btn-info m-b-5 edit_patient_modal" data-patientId="{{$admin->id}}" data-toggle="modal" data-target="#full-width-modal-edit{{$admin->id}}">Edit Profile</button>


                                            @if(Auth::user()->role_id == 1)
                                                @if($admin->users->entities->status == 0)
                                                    <button type="button" class="btn btn-icon waves-effect waves-light btn-success m-b-5" data-toggle="modal" data-target="#con-close-modalactive">Activate</button>
                                                @elseif($admin->users->entities->status == 1)

                                                    <button type="button" class="btn btn-icon waves-effect waves-light btn-danger m-b-5" data-toggle="modal" data-target="#con-close-modaldeactive">Deactivate</button>
                                                @endif
                                            @endif
                                        </div>
                                        {{--edit admin modal--}}
                                        <div id="full-width-modal-edit{{$admin->id}}"  class="modal fade" role="dialog" aria-labelledby="full-width-modalLabel-create" aria-hidden="true" style="display: none;">
                                            <div class="modal-dialog modal-full">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                        <h4 class="modal-title" id="full-width-modalLabel-create">Edit Admin</h4>
                                                    </div>
                                                    {!! Form::model($admin, ['method' => 'PATCH','url' => ['admins', $admin->id], 'files'=>true]) !!}


                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-md-1"></div>
                                                            <div class="col-md-10">

                                                                <div class="p-20" style="clear: both;">


                                                                    <div class="row">
                                                                        <div class="col-sm-4">
                                                                            <div class="form-group" align="left">
                                                                                <label for="full_name" class="control-label">Full Name<span class="text-danger">*</span></label>
                                                                                {!! Form::text('admin_info[full_name]' , null ,['class' => 'form-control input-sm','parsley-trigger' => 'change']) !!}

                                                                            </div>
                                                                        </div>


                                                                        <div class="col-sm-4">
                                                                            <div class="form-group" align="left">
                                                                                <label for="full_name" class="control-label">Email Address<span class="text-danger">*</span></label>

                                                                                {!! Form::email('email' , $admin->users->email ,['class' => 'form-control input-sm','parsley-trigger' => 'change']) !!}

                                                                            </div>
                                                                        </div>

                                                                        <div class="col-sm-4">
                                                                            <div class="form-group" align="left">
                                                                                <label for="full_name" class="control-label">Password<span class="text-danger">*</span></label>
                                                                                <input type="email" name="email-fake" style="display: none">
                                                                                <input type="password" name="password-fake" style="display: none">
                                                                                <input type="password" name="password" parsley-trigger="change"
                                                                                       placeholder="Change Password If needed" autocomplete="off" class="form-control input-sm"/>

                                                                            </div>
                                                                        </div>


                                                                        <div class="col-sm-4">
                                                                            <div class="form-group" align="left">
                                                                                <label for="full_name" class="control-label">Gender<span class="text-danger">*</span></label>
                                                                                <div>
                                                                                    <div class="radio radio-info radio-inline">
                                                                                        {!! Form::radio('admin_info[gender]', 0,['id' => 'inlineRadio1']) !!}
                                                                                        <label for="inlineRadio1"> Male </label>
                                                                                    </div>
                                                                                    <div class="radio radio-pink radio-inline">
                                                                                        {!! Form::radio('admin_info[gender]', 1,['id' => 'inlineRadio2']) !!}
                                                                                        <label for="inlineRadio2"> Female </label>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-sm-4">
                                                                            <div class="form-group" align="left">
                                                                                <label for="full_name" class="control-label">Clinic Name<span class="text-danger">*</span></label>
                                                                                {!! Form::text('users[entities][entity_name]' , null ,['class' => 'form-control input-sm','parsley-trigger' => 'change']) !!}

                                                                                <input type="hidden" name="role_id" value="2" />
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-sm-4">
                                                                            <div class="form-group" align="left">
                                                                                <label for="website" class="control-label">Website</label>
                                                                                {!! Form::text('admin_info[website]' , null ,['class' => 'form-control input-sm','parsley-trigger' => 'change']) !!}

                                                                            </div>
                                                                        </div>

                                                                        <div class="col-sm-4">
                                                                            <div class="form-group" align="left">
                                                                                <label for="full_name" class="control-label">Country<span class="text-danger">*</span></label>
                                                                                {!!Form::select('admin_info[country]',$edit_countries,null ,['class' => 'form-control select2 country2','id' => 'country'.$admin->id,'data-patientId' => $admin->id])!!}

                                                                            </div>
                                                                        </div>
                                                                        <div class="col-sm-4">
                                                                            <div class="form-group" align="left">
                                                                                <label for="full_name" class="control-label">State<span class="text-danger">*</span></label>
                                                                                <select class="form-control select2 state2" name="state" id="{{'state'.$admin->id}}" data-patientId="{{$admin->id}}">
                                                                                    <option value="{{ $admin->admin_info['state'] }}" selected>{{ $admin->admin_info['state'] }}</option>

                                                                                </select>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-sm-4">
                                                                            <div class="form-group" align="left">
                                                                                <label for="full_name" class="control-label">City<span class="text-danger">*</span></label>
                                                                                <select class="form-control select2 city2" name="city" id="{{'city'.$admin->id}}">
                                                                                    <option value="{{ $admin->admin_info['city'] }}" selected>{{ $admin->admin_info['city'] }}</option>

                                                                                </select>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-sm-4">
                                                                            <div class="form-group" align="left">
                                                                                <label for="contact_no" class="control-label">Contact No<span class="text-danger">*</span></label>

                                                                                {!! Form::text('admin_info[contact_no]' , null ,['class' => 'form-control input-sm','parsley-trigger' => 'change']) !!}
                                                                            </div>

                                                                        </div>

                                                                        <div class="col-sm-4">
                                                                            <div class="form-group" align="left">
                                                                                <label for="contact_no" class="control-label">Currency<span class="text-danger">*</span></label>
                                                                                {!!Form::select('users[entities][currency]',$edit_currencies,null ,['class' => 'form-control select2'])!!}

                                                                            </div>
                                                                        </div>


                                                                        <div class="col-sm-2">
                                                                            <div class="form-group" align="left">
                                                                                <label for="full_name" class="control-label">Profile Image</label>
                                                                                <input type="file" data-input="false" class="filestyle input-sm" data-placeholder="Not Important" name="profile_image">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-sm-2">
                                                                            <div style="width: 200px; height: 150px;">

                                                                                <img src="{{ asset('uploads/'.$admin->users->profile_image) }}" style="width: 100%; height: 100%;">

                                                                            </div>
                                                                        </div>

                                                                        <div class="col-sm-8">
                                                                            <div class="form-group" align="left">
                                                                                <label for="full_name" class="control-label">Address<span class="text-danger">*</span></label>
                                                                                {!!Form::textarea('admin_info[address]',null ,['class' => 'form-control','maxlength' => '225','rows' => '3', 'id' => 'textarea'])!!}
                                                                            </div>
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


                                                        <button type="submit" class="btn btn-inverse waves-effect" style="float: right;margin-left: 1%;">Update Admin</button>


                                                    </div>
                                                    </form>
                                                </div><!-- /.modal-content -->
                                            </div><!-- /.modal-dialog -->
                                        </div><!-- /.modal -->


                                        {{--end edit modal--}}
                                        {{--model for activate and deactivate users--}}
                                        <div id="con-close-modalactive" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                        <h4 class="modal-title">Warning!</h4>
                                                    </div>
                                                    <div class="modal-body">

                                                        Are You Sure.You want to Activate This User.
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default waves-effect" data-dismiss="modal" style="float: right;">Close</button>

                                                        <form action="{{ url('adminsactivate/'.$admin->id) }}" method="post">
                                                            {{ csrf_field() }}

                                                            <button type="submit" class="btn btn-success waves-effect" style="float: right;margin-right: 2%;">Yes Activate it</button>

                                                        </form>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div id="con-close-modaldeactive" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                        <h4 class="modal-title">Warning!</h4>
                                                    </div>
                                                    <div class="modal-body">

                                                        Are You Sure.You want to Deactivate This User.
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default waves-effect" data-dismiss="modal" style="float: right;">Close</button>

                                                        <form action="{{ url('admins/'.$admin->id) }}" method="post">
                                                            {{ csrf_field() }}
                                                            <input type="hidden" name="_method" value="DELETE">
                                                            <button type="submit" class="btn btn-danger waves-effect" style="float: right;margin-right: 2%;">Yes Deactivate it</button>

                                                        </form>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>                                     <hr/>
                                        {{--end model--}}
                                        <div class="text-left">
                                            <p class="text-muted font-13"><strong>Full Name :</strong> <span class="m-l-15">{{ $admin->admin_info['full_name'] }}</span></p>

                                            <p class="text-muted font-13"><strong>Gender :</strong><span class="m-l-15">
                                                    @if($admin->admin_info['gender'] == 0)
                                                        Male
                                                    @elseif($admin->admin_info['gender'] == 1)
                                                        Female
                                                    @else
                                                        Others
                                                    @endif
                                                </span></p>

                                            <p class="text-muted font-13"><strong>Email :</strong> <span class="m-l-15">
                                                    {{ $admin->users->email }}</span></p>

                                            <p class="text-muted font-13"><strong>Status :</strong>
                                                <span class="m-l-15">
                                                    @if($admin->users->entities->status == 1)
                                                        Activate
                                                    @elseif($admin->users->entities->status == 0)
                                                        Deactivate

                                                    @endif
                                                </span></p>
                                        </div>



                                    </div>

                                </div> <!-- end card-box -->

                            </div> <!-- end col -->

                            <div class="col-md-7 col-lg-7">



                                <div class="box-header">

                                    <a href="javascript:void(0);"
                                       onclick="window.print();"
                                       class="btn btn-icon waves-effect waves-light btn-inverse m-b-5" style="float: right">
                                        <i class="fa fa-print"></i>

                                    </a>


                                </div>



                                <div class="row">
                                    <div class="col-md-8 col-sm-6">
                                        <h4>Clinic Info</h4>

                                        <div class=" p-t-10">

                                            <p><b>Clinic Name</b></p>

                                            <p class="text-muted font-13 m-b-0">{{ $admin->users->entities->entity_name }}
                                            </p>
                                        </div>
                                        <div class=" p-t-10">

                                            <p><b>Location</b></p>

                                            <p class="text-muted font-13 m-b-0">{{ $admin->admin_info['country'] }}
                                            </p>
                                        </div>
                                        <div class=" p-t-10">

                                            <p><b>Contact No</b></p>

                                            <p class="text-muted font-13 m-b-0">{{ $admin->admin_info['contact_no'] }}
                                            </p>
                                        </div>

                                        <div class=" p-t-10">

                                            <p><b>Address</b></p>

                                            <p class="text-muted font-13 m-b-0">{{ $admin->admin_info['address'] }}
                                            </p>
                                        </div>

                                        <hr/>
                                        <h4>Account Detail</h4>
                                        <div class="">

                                            <p><b>Account No</b></p>

                                            <p class="text-muted font-13">
                                            </p>
                                        </div>
                                    </div> <!-- end col -->


                                </div> <!-- end row -->




                            </div>
                            <!-- end col -->

                        </div>
                    </div>
                </div>
            </div>
            <!-- End row -->



        </div> <!-- container -->

    </div>

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

    <script src="{{ asset('assets/pages/jquery.form-advanced.init.js') }}"></script>
@endsection

<!--*********Page Scripts End*********-->