@extends('layouts.mainHome')



@section('content')
    <!-- Start content -->
    <div class="content">
        <div class="container">


            <div class="row">
                <div class="col-xs-12">
                    <div class="page-title-box">

                        <h4 class="page-title">Add Leave</h4>

                        <div class="clearfix"></div>

                    </div>
                </div>
            </div>
            <!-- end row -->

            <div class="row">
                <form action="{{ route('leaves.store') }}" enctype="multipart/form-data" method="POST">

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


                                    <a class="btn btn-info" href="{{ url('leaves') }}">Manage Leave</a>
                                    <hr>


                                    <div class="p-20" style="clear: both;">



                                        <div class="form-group row">
                                            <label for="doctor_id" class="col-sm-3">Select Doctor<span class="text-danger">*</span></label>
                                            <div class="col-sm-9">
                                                <select class="form-control select2" name="doctor_id">
                                                    <option selected disabled="disabled">Select Doctor</option>

                                                    @foreach($doctors as $doctor)
                                                        <option value="{{ $doctor->id }}">{{ $doctor->users->name }}</option>
                                                    @endforeach



                                                </select>

                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="reason" class="col-sm-3">Reason<span class="text-danger">*</span></label>
                                            <div class="col-sm-9">
                                                <textarea name="reason" id="textarea" class="form-control" maxlength="500" rows="5" placeholder="Reason" value="{{ old('reason') }}"></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="doctor_id" class="col-sm-3">Select Leave Type<span class="text-danger">*</span></label>
                                            <div class="col-sm-9">
                                                <select class="form-control select2" id="my_type" name="leave_type">
                                                    <option selected disabled="disabled">Select Leave Type</option>

                                                    <option value="0">Half Day</option>
                                                    <option value="1">Full Day</option>
                                                    <option value="2">Many Days</option>

                                                </select>

                                            </div>

                                        </div>
                                        <hr>
                                        <div id="half_leave" style="display: none">
                                            <div class="form-groupp row">

                                                <label for="doctor_id" class="col-sm-3">Select Date And Time<span class="text-danger">*</span></label>
                                                <div class="col-sm-3">
                                                    <input type="text" class="form-control" name="half_day_date" placeholder="mm/dd/yyyy" id="datepicker-autoclose">
                                                </div>
                                                <div class="col-sm-3">
                                                    <div class="input-group clockpicker m-b-20" data-placement="top" data-align="top" data-autoclose="true">
                                                        <input type="text" name="start_time_half" class="form-control app_start" placeholder="Start Time">

                                                    </div>
                                                </div>
                                                <div class="col-sm-3">
                                                    <div class="input-group clockpicker m-b-20" data-placement="top" data-align="top" data-autoclose="true">
                                                        <input type="text" name="end_time_hlaf" class="form-control app_start" placeholder="End Time">

                                                    </div>
                                                </div>


                                            </div>
                                        </div>

                                        <div id="full_leave" style="display: none">
                                            <div class="form-groupp row">

                                                <label for="doctor_id" class="col-sm-3">Select Date<span class="text-danger">*</span></label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" name="ful_day_date" placeholder="mm/dd/yyyy" id="datepicker">
                                                </div>



                                            </div>
                                        </div>

                                        <div id="many_leave" style="display: none">
                                            <div class="form-groupp row">

                                                <label for="doctor_id" class="col-sm-3">Select Date<span class="text-danger">*</span></label>
                                                <div class="col-sm-9">
                                                    <div class="input-daterange input-group" id="date-range">
                                                        <input type="text" class="form-control" name="start_many" />
                                                        <span class="input-group-addon bg-inverse text-white b-0">to</span>
                                                        <input type="text" class="form-control" name="end_many" />
                                                    </div>
                                                </div>



                                            </div>
                                        </div>

                                        <hr>


                                        <div class="form-group row">
                                            <div class="col-sm-9"></div>
                                            <div class="col-sm-3">
                                                <button type="submit" class="btn btn-teal">Add Leave</button>
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




@endsection

<!--*********Page Scripts End*********-->