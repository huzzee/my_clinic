@extends('layouts.mainHome')



@section('content')
    <!-- Start content -->
    <div class="content">
        <div class="container">


            <div class="row">
                <div class="col-xs-12">
                    <div class="page-title-box">

                        <h4 class="page-title">Add Appointment</h4>

                        <div class="clearfix"></div>

                    </div>
                </div>
            </div>
            <!-- end row -->

            <div class="row">
                <form action="{{ route('appointments.store') }}" enctype="multipart/form-data" method="POST">

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


                                    <a class="btn btn-info" href="{{ url('appointments') }}">Manage Appointments</a>
                                    <hr>


                                    <div class="p-20" style="clear: both;">

                                        <div class="form-group row">
                                            <label for="reason" class="col-sm-2">Patient Name</label>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control"
                                                       value="{{ $patient->patient_info['full_name'] }}" readonly>
                                                <input type="hidden" name="patient_id" value="{{ $patient->id }}">
                                            </div>

                                            <div class="col-sm-2"></div>

                                            <label for="reason" class="col-sm-2">Patient Code</label>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control"
                                                       value="{{ $patient->patient_code }}" readonly>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="doctor_id" class="col-sm-2">Select Doctor<span class="text-danger">*</span></label>
                                            <div class="col-sm-10">
                                                <select class="form-control select2" name="doctor_id" id="app_doc_id">
                                                    <option selected disabled="disabled">Select Doctor</option>

                                                    @foreach($doctors as $doctor)
                                                        <option value="{{ $doctor->id }}">{{ $doctor->users->name }}</option>
                                                    @endforeach

                                                </select>

                                            </div>
                                        </div>


                                        <div class="row" id="app_date_here" style="display: none">
                                            <hr>
                                            <div class="col-sm-7">
                                                <h3 align="center">Available Schedule For Appointments</h3>
                                                <hr>
                                                <table class="table table-striped m-0">

                                                    <thead>
                                                    <tr>


                                                        <th width="25%">Avalaible Days</th>

                                                        <th width="45%">Time</th>
                                                        <th>Available Slots</th>

                                                    </tr>
                                                    </thead>
                                                    <tbody id="table_row_app">

                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="col-sm-5">
                                                <h3 align="center">Select Day</h3>
                                                <hr>

                                                <div class="input-group">
                                                    <input type="text" class="form-control" name="appointment_date" placeholder="mm/dd/yyyy" id="datepicker2"/>
                                                    <span class="input-group-addon bg-custom b-0"><i class="mdi mdi-calendar text-white"></i></span>
                                                </div><!-- input-group -->
                                                <div class="form-group row">

                                                    <div class="col-sm-12" id="time_here">

                                                    </div>

                                                </div>
                                            </div>
                                        </div>


                                        <hr>
                                        <div class="form-group row">
                                            <div class="col-sm-9"></div>
                                            <div class="col-sm-3">
                                                <button type="submit" disabled="disabled" id="problem_app" class="btn btn-teal">Add Appointment</button>
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