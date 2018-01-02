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

                                    <div class="p-20" style="clear: both;">


                                        <div class="row">
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="full_name" class="control-label">Full Name<span class="text-danger">*</span></label>

                                                    <input type="text" name="full_name" parsley-trigger="change"
                                                           placeholder="Enter Full Name" value="{{ old('full_name') }}" autocomplete="off" class="form-control input-sm"/>

                                                </div>
                                            </div>


                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="full_name" class="control-label">Email Address<span class="text-danger">*</span></label>

                                                    <input type="email" name="email" parsley-trigger="change"
                                                           placeholder="Enter Email" value="{{ old('email') }}" autocomplete="off" class="form-control input-sm"/>

                                                </div>
                                            </div>

                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="full_name" class="control-label">Password<span class="text-danger">*</span></label>
                                                    <input type="email" name="email-fake" style="display: none">
                                                    <input type="password" name="password-fake" style="display: none">
                                                    <input type="password" name="password" parsley-trigger="change"
                                                           placeholder="Enter Password" autocomplete="off" class="form-control input-sm"/>

                                                </div>
                                            </div>


                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="full_name" class="control-label">Gender<span class="text-danger">*</span></label>
                                                    <div>
                                                        <div class="radio radio-info radio-inline">
                                                            <input type="radio" id="inlineRadio1" name="gender" value="0">
                                                            <label for="inlineRadio1"> Male </label>
                                                        </div>
                                                        <div class="radio radio-pink radio-inline">
                                                            <input type="radio" id="inlineRadio2" name="gender" value="1">
                                                            <label for="inlineRadio2"> Female </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="full_name" class="control-label">Clinic Name<span class="text-danger">*</span></label>
                                                    <input type="text" name="entity_name" parsley-trigger="change"
                                                           placeholder="Enter Clinic Name" value="{{ old('entity_name') }}" autocomplete="off" class="form-control input-sm"/>

                                                    <input type="hidden" name="role_id" value="2" />
                                                </div>
                                            </div>

                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="website" class="control-label">Website</label>
                                                    <input type="text" name="website" parsley-trigger="change"
                                                           placeholder="Enter Website" value="{{ old('website') }}" autocomplete="off" class="form-control input-sm"/>


                                                </div>
                                            </div>

                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="full_name" class="control-label">Country<span class="text-danger">*</span></label>
                                                    <select class="form-control select2" name="country" id="country2">
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
                                                    <select class="form-control select2" name="state" id="state2">
                                                        <option disabled selected>Select State</option>

                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="full_name" class="control-label">City<span class="text-danger">*</span></label>
                                                    <select class="form-control select2" name="city" id="city2">
                                                        <option disabled selected>Select City</option>

                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="contact_no" class="control-label">Contact No<span class="text-danger">*</span></label>

                                                    <input type="text" name="contact_no" parsley-trigger="change"
                                                           placeholder="Enter Contact" value="{{ old('contact_no') }}" autocomplete="off" class="form-control input-sm"/>

                                                </div>
                                            </div>

                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="contact_no" class="control-label">Currency<span class="text-danger">*</span></label>
                                                    <select class="form-control select2" name="currency">
                                                        <option selected disabled>Select Currency</option>
                                                        @foreach($currencies as $currency)
                                                            <option value="{{ $currency->currencyCode }}">{{ $currency->currencyCode }}({{ $currency->countryName }})</option>
                                                        @endforeach

                                                    </select>
                                                </div>
                                            </div>


                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="full_name" class="control-label">Profile Image</label>
                                                    <input type="file" data-input="false" class="filestyle input-sm" data-placeholder="Not Important" name="profile_image">
                                                </div>
                                            </div>

                                            <div class="col-sm-8">
                                                <div class="form-group">
                                                    <label for="full_name" class="control-label">Address<span class="text-danger">*</span></label>
                                                    <textarea name="address" id="textarea" class="form-control" maxlength="500" rows="3" placeholder="Address" value="{{ old('reason') }}"></textarea>
                                                </div>
                                            </div>

                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="full_name" class="control-label">Active<span class="text-danger">*</span></label>
                                                    <div>
                                                        <input type="checkbox" id="switch3" name="status" switch="bool" checked/>
                                                        <label for="switch3" data-on-label="Yes"
                                                               data-off-label="No"></label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-10">

                                            </div>

                                            <div class="col-sm-2">
                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-inverse">Create Admin</button>
                                                </div>
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