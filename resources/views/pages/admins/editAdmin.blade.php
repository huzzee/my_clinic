@extends('layouts.mainHome')



@section('content')
    <!-- Start content -->
    <div class="content">
        <div class="container">


            <div class="row">
                <div class="col-xs-12">
                    <div class="page-title-box">

                        <h4 class="page-title">Edit Admin</h4>

                        <div class="clearfix"></div>

                    </div>
                </div>
            </div>
            <!-- end row -->

            <div class="row">

                    {!! Form::model($admin, ['method' => 'PATCH','url' => ['admins', $admin->id], 'files'=>true]) !!}
                    {{ csrf_field() }}

                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @if(session()->has('message'))
                        <div class="alert alert-success">
                            {{ session()->get('message') }}
                        </div>
                    @endif

                    <div class="col-xs-12">
                        <div class="card-box">


                            <div class="row">
                                <div class="col-sm-12 col-xs-12 col-md-12">


                                    <a class="btn btn-purple" href="{{ url('admins') }}">Manage Admins</a>
                                    <hr>
                                    <h5>General Information</h5>
                                    <hr>


                                    <div class="p-20" style="clear: both;">


                                        <div class="form-group row">
                                            <label for="full_name" class="col-sm-3">Full Name<span class="text-danger">*</span></label>
                                            <div class="col-sm-9">
                                                {!! Form::text('admin_info[full_name]' , null ,['class' => 'form-control','parsley-trigger' => 'change']) !!}


                                            </div>
                                        </div>



                                        <div class="form-group row">
                                            <label for="last_name" class="col-sm-3">Email Address<span class="text-danger">*</span></label>
                                            <div class="col-sm-9">
                                                {!! Form::email('email' , $admin->users->email ,['class' => 'form-control','parsley-trigger' => 'change']) !!}

                                            </div>
                                        </div>


                                        <div class="form-group row">
                                            <label for="full_name" class="col-sm-3">Password</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="password" parsley-trigger="change"
                                                       placeholder="Change Password If needed"  autocomplete="off" class="form-control"/>


                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="item_image" class="col-sm-3">Profile Image</label>
                                            <div class="col-sm-9">
                                                <input type="file" class="filestyle" data-placeholder="{{ $admin->users->profile_image }}" name="profile_image" data-buttonname="btn-inverse">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="reason" class="col-sm-3">Address<span class="text-danger">*</span></label>
                                            <div class="col-sm-9">
                                                {!!Form::textarea('admin_info[address]',null ,['class' => 'form-control','maxlength' => '225','rows' => '5', 'id' => 'textarea'])!!}
                                            </div>
                                        </div>


                                        <div class="form-group row">
                                            <label for="status" class="col-sm-3">Gender<span class="text-danger">*</span></label>
                                            <div class="col-sm-9">
                                                <div class="radio radio-info radio-inline">
                                                    {!! Form::radio('admin_info[gender]', 0,['id' => 'inlineRadio1']) !!}
                                                    <label for="inlineRadio1"> Male </label>
                                                </div>
                                                <div class="radio radio-pink radio-inline">
                                                    {!! Form::radio('admin_info[gender]', 1,['id' => 'inlineRadio1']) !!}
                                                    <label for="inlineRadio2"> Female </label>
                                                </div>

                                                <div class="radio radio-purple radio-inline">
                                                    {!! Form::radio('admin_info[gender]', 2,['id' => 'inlineRadio1']) !!}
                                                    <label for="inlineRadio3"> Others </label>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <hr>
                                    <h5>Clinic Information</h5>
                                    <hr>

                                    <div class="p-20" style="clear: both;">

                                        <div class="form-group row">
                                            <label for="entity_name" class="col-sm-3">Clinic Name<span class="text-danger">*</span></label>
                                            <div class="col-sm-9">
                                                {!! Form::text('users[entities][entity_name]' , null ,['class' => 'form-control','parsley-trigger' => 'change']) !!}

                                                <input type="hidden" name="role_id" value="2" />
                                            </div>
                                        </div>


                                        <div class="form-group row">
                                            <label for="country" class="col-sm-3">Country<span class="text-danger">*</span></label>
                                            <div class="col-sm-9">
                                                 {!!Form::select('admin_info[country]',$country,null ,['class' => 'form-control select2'])!!}

                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="contact_no" class="col-sm-3">Contact No<span class="text-danger">*</span></label>
                                            <div class="col-sm-9">
                                                {!! Form::number('admin_info[contact_no]' , null ,['class' => 'form-control','parsley-trigger' => 'change']) !!}

                                            </div>
                                        </div>


                                        <div class="form-group row">
                                            <div class="col-sm-3"></div>
                                            <div class="col-sm-9">
                                                <button type="submit" class="btn btn-inverse">Update Admin</button>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                            </div>

                        </div> <!-- end ard-box -->
                    </div>
                </form>
            </div>



        </div> <!-- container -->

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

    <script src="{{ asset('assets/pages/jquery.form-advanced.init.js') }}"></script>


@endsection

<!--*********Page Scripts End*********-->