@extends('layouts.mainHome')



@section('content')
    <!-- Start content -->
    <div class="content">
        <div class="container">


            <div class="row">
                <div class="col-xs-12">
                    <div class="page-title-box">

                        <h4 class="page-title">Make Admin</h4>

                        <div class="clearfix"></div>

                    </div>
                </div>
            </div>
            <!-- end row -->

            <div class="row">
                <form action="{{ route('admins.store') }}" enctype="multipart/form-data" method="POST">

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


                                    <a class="btn btn-info" href="{{ url('admins') }}">Manage Admins</a>
                                    <hr>
                                    <h5>General Information</h5>
                                    <hr>


                                    <div class="p-20" style="clear: both;">


                                        <div class="form-group row">
                                            <label for="full_name" class="col-sm-3">Full Name<span class="text-danger">*</span></label>
                                            <div class="col-sm-9">
                                                <input type="text" name="full_name" parsley-trigger="change"
                                                       placeholder="Enter Full Name" value="{{ old('full_name') }}" autocomplete="off" class="form-control"/>

                                            </div>
                                        </div>



                                        <div class="form-group row">
                                            <label for="last_name" class="col-sm-3">Email Address<span class="text-danger">*</span></label>
                                            <div class="col-sm-9">
                                                <input type="email" name="email" parsley-trigger="change"
                                                       placeholder="Enter Email" value="{{ old('email') }}" autocomplete="off" class="form-control"/>

                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="last_name" class="col-sm-3">Password<span class="text-danger">*</span></label>
                                            <div class="col-sm-9">
                                                <input type="email" name="email-fake" style="display: none">
                                                <input type="password" name="password-fake" style="display: none">
                                                <input type="password" name="password" parsley-trigger="change"
                                                       placeholder="Enter Password" autocomplete="off" class="form-control"/>

                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="item_image" class="col-sm-3">Profile Image</label>
                                            <div class="col-sm-9">
                                                <input type="file" class="filestyle" data-placeholder="Not Important" name="profile_image" data-buttonname="btn-inverse">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="reason" class="col-sm-3">Address<span class="text-danger">*</span></label>
                                            <div class="col-sm-9">
                                                <textarea name="address" id="textarea" class="form-control" maxlength="500" rows="5" placeholder="Address" value="{{ old('reason') }}"></textarea>
                                            </div>
                                        </div>


                                        <div class="form-group row">
                                            <label for="status" class="col-sm-3">Gender<span class="text-danger">*</span></label>
                                            <div class="col-sm-9">
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

                                    </div>
                                    <hr>
                                    <h5>Clinic Information</h5>
                                    <hr>

                                    <div class="p-20" style="clear: both;">

                                        <div class="form-group row">
                                            <label for="entity_name" class="col-sm-3">Clinic Name<span class="text-danger">*</span></label>
                                            <div class="col-sm-9">
                                                <input type="text" name="entity_name" parsley-trigger="change"
                                                       placeholder="Enter Clinic Name" value="{{ old('entity_name') }}" autocomplete="off" class="form-control"/>

                                                <input type="hidden" name="role_id" value="2" />
                                            </div>
                                        </div>


                                        <div class="form-group row">
                                            <label for="country" class="col-sm-3">Country<span class="text-danger">*</span></label>
                                            <div class="col-sm-9">
                                                <select class="form-control select2" name="country">
                                                    <option selected disabled>Select Country</option>
                                                    @foreach($countries as $country)
                                                        <option value="{{ $country->countryName }}">{{ $country->countryName }}</option>
                                                    @endforeach

                                                </select>

                                            </div>

                                        </div>
                                        <div class="form-group row">
                                            <label for="country" class="col-sm-3">Currency<span class="text-danger">*</span></label>
                                            <div class="col-sm-9">
                                                <select class="form-control select2" name="currency">
                                                    <option selected disabled>Select Currency</option>
                                                    @foreach($currencies as $currency)
                                                        <option value="{{ $currency->currencyCode }}">{{ $currency->currencyCode }}({{ $currency->countryName }})</option>
                                                    @endforeach

                                                </select>

                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="contact_no" class="col-sm-3">Contact No<span class="text-danger">*</span></label>
                                            <div class="col-sm-9">
                                                <input type="number" name="contact_no" parsley-trigger="change"
                                                       placeholder="Enter Contact No" value="{{ old('contact_no') }}" autocomplete="off" class="form-control"/>

                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="status" class="col-sm-3">Active<span class="text-danger">*</span></label>
                                            <div class="col-sm-9">
                                                <input type="checkbox" id="switch3" name="status" switch="bool" checked/>
                                                <label for="switch3" data-on-label="Yes"
                                                       data-off-label="No"></label>
                                            </div>
                                        </div>


                                        <div class="form-group row">
                                            <div class="col-sm-3"></div>
                                            <div class="col-sm-9">
                                                <button type="submit" class="btn btn-inverse">Create Admin</button>
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