@extends('layouts.mainHome')



@section('content')
    <!-- Start content -->
    <div class="content">
        <div class="container">


            <div class="row">
                <div class="col-xs-12">
                    <div class="page-title-box">

                        <h4 class="page-title">Create Doctor</h4>

                        <div class="clearfix"></div>

                    </div>
                </div>
            </div>
            <!-- end row -->



            <div class="row">
                <div class="col-md-12">
                    <div class="card-box">


                        <form action="{{ route('doctors.store') }}" id="basic-form" enctype="multipart/form-data" method="POST">

                            {{ csrf_field() }}


                            <a class="btn btn-purple" href="{{ url('doctors') }}">Manage Doctors</a>
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
                            <hr>
                            <div>
                                <h3>General Info</h3>
                                <section>
                                    <div class="form-group clearfix">
                                        <label for="first_Name" class="col-lg-2 control-label">First Name<span class="text-danger">*</span></label>
                                        <div class="col-lg-10">
                                            <input type="text" name="first_name" parsley-trigger="change"
                                                   placeholder="Enter First Name" value="{{ old('first_name') }}" autocomplete="off" class="form-control"/>

                                        </div>
                                    </div>
                                    <div class="form-group clearfix">
                                        <label for="last_name" class="col-lg-2 control-label">Last Name<span class="text-danger">*</span></label>
                                        <div class="col-lg-10">
                                            <input type="text" name="last_name" parsley-trigger="change"
                                                   placeholder="Enter Last Name" value="{{ old('last_name') }}" autocomplete="off" class="form-control"/>

                                        </div>
                                    </div>

                                    <div class="form-group clearfix">
                                        <label for="reason" class="col-lg-2 control-label">Address<span class="text-danger">*</span></label>
                                        <div class="col-lg-10">
                                            <textarea name="address" id="textarea" class="form-control" maxlength="500" rows="5" placeholder="Address" value="{{ old('reason') }}"></textarea>
                                        </div>
                                    </div>

                                    <div class="form-group clearfix">
                                        <label for="date_of_birth" class="col-lg-2 control-label">Date Of Birth<span class="text-danger">*</span></label>
                                        <div class="col-lg-10">
                                            <input type="text" class="form-control" name="date_of_birth" placeholder="mm/dd/yyyy" id="datepicker-autoclose">


                                        </div>
                                    </div>

                                    <div class="form-group clearfix">
                                        <label for="contact_no" class="col-lg-2 control-label">Contact No<span class="text-danger">*</span></label>
                                        <div class="col-lg-10">
                                            <input type="text" name="contact_no" parsley-trigger="change"
                                                   placeholder="Enter Contact No" value="{{ old('contact_no') }}" autocomplete="off" class="form-control"/>

                                        </div>
                                    </div>


                                    <div class="form-group clearfix">
                                        <label for="status" class="col-lg-2 control-label">Gender<span class="text-danger">*</span></label>
                                        <div class="col-lg-10">
                                            <div class="radio radio-info radio-inline">
                                                <input type="radio" id="inlineRadio1" name="gender" value="0">
                                                <label for="inlineRadio1"> Male </label>
                                            </div>
                                            <div class="radio radio-pink radio-inline">
                                                <input type="radio" id="inlineRadio2" name="gender" value="1">
                                                <label for="inlineRadio2"> Female </label>
                                            </div>

                                            <div class="radio radio-purple radio-inline">
                                                <input type="radio" id="inlineRadio3" name="gender" value="2">
                                                <label for="inlineRadio3"> Others </label>
                                            </div>
                                        </div>
                                    </div>



                                </section>
                                <h3>Account Info</h3>
                                <section>
                                    <div class="form-group clearfix">
                                        <label for="last_name" class="col-lg-2">Email Address<span class="text-danger">*</span></label>
                                        <div class="col-lg-10">
                                            <input type="email" name="email" parsley-trigger="change"
                                                   placeholder="Enter Email" value="{{ old('email') }}" autocomplete="off" class="form-control"/>

                                        </div>
                                    </div>

                                    <div class="form-group clearfix">
                                        <label for="last_name" class="col-lg-2">Password<span class="text-danger">*</span></label>
                                        <div class="col-lg-10">
                                            <input type="password" name="password" parsley-trigger="change"
                                                   placeholder="Enter Password" autocomplete="off" class="form-control"/>

                                        </div>
                                    </div>

                                    <div class="form-group clearfix">
                                        <label for="item_image" class="col-lg-2">Profile Image<span class="text-danger">*</span></label>
                                        <div class="col-lg-10">

                                            <input type="file" class="filestyle" data-input="false" name="profile_image">


                                        </div>
                                    </div>

                                </section>

                                <h3>Doctor Details</h3>
                                <section>

                                    <div class="form-group clearfix">
                                        <label for="doctor_department" class="col-lg-2">Department<span class="text-danger">*</span></label>
                                        <div class="col-lg-10">
                                            <input type="text" name="doctor_department" parsley-trigger="change"
                                                   placeholder="Enter Department Name" value="{{ old('doctor_department') }}" autocomplete="off" class="form-control"/>

                                        </div>
                                    </div>

                                    <div class="form-group clearfix">
                                        <label for="biography" class="col-lg-2 control-label">Short Biography</label>
                                        <div class="col-lg-10">
                                            <textarea name="biography" id="textarea" class="form-control" maxlength="500" rows="6" placeholder="Short Biography Here" value="{{ old('biography') }}"></textarea>
                                        </div>
                                    </div>

                                    <div class="form-group clearfix">
                                        <label for="blood_group" class="col-lg-2 control-label">Blood group<span class="text-danger">*</span></label>
                                        <div class="col-lg-10">
                                            <select class="form-control select2" name="blood_group">
                                                <option selected disabled>Select Blood Group</option>
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

                                    <div class="form-group clearfix">
                                        <label for="specialist" class="col-lg-2">Specialist<span class="text-danger">*</span></label>
                                        <div class="col-lg-10">
                                            <input type="text" name="specialist" parsley-trigger="change"
                                                   placeholder="Enter Speciality" value="{{ old('specialist') }}" autocomplete="off" class="form-control"/>

                                        </div>
                                    </div>

                                    <div class="form-group clearfix">
                                        <label for="qualification" class="col-lg-2 control-label">Qualification</label>
                                        <div class="col-lg-10">
                                            <textarea name="qualification" id="textarea" class="form-control" maxlength="500" rows="6" placeholder="Doctor Qualification Here" value="{{ old('biography') }}"></textarea>
                                        </div>
                                    </div>

                                </section>
                            </div>
                        </form>

                    </div>
                </div>
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



    <script src="{{ asset('assets/plugins/moment/moment.js') }}"></script>
    <script src="{{ asset('assets/plugins/timepicker/bootstrap-timepicker.js') }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/clockpicker/js/bootstrap-clockpicker.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap-daterangepicker/daterangepicker.js') }}"></script>

    <script src="{{ asset('assets/pages/jquery.form-pickers.init.js') }}"></script>

    <script src="{{ asset('assets/plugins/jquery.steps/js/jquery.steps.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/jquery-validation/js/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('assets/pages/jquery.wizard-init.js') }}"></script>
    <script src="{{ asset('assets/pages/jquery.form-advanced.init.js') }}"></script>


@endsection

<!--*********Page Scripts End*********-->