@extends('layouts.mainHome')



@section('content')
    <!-- Start content -->
    <div class="content">
        <div class="container">


            <div class="row">
                <div class="col-xs-12">
                    <div class="page-title-box">

                        <h4 class="page-title">Edit Schedule</h4>

                        <div class="clearfix"></div>

                    </div>
                </div>
            </div>
            <!-- end row -->

            <div class="row">
                {!! Form::model($schedule, ['method' => 'PATCH','url' => ['schedule', $schedule->id], 'files'=>true]) !!}

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


                                <a class="btn btn-info" href="{{ url('schedule') }}">Schedule List</a>
                                <hr>


                                <div class="p-20" style="clear: both;">



                                    <div class="form-group row">
                                        <label for="doctor_id" class="col-sm-2">Doctor Name</label>
                                        <div class="col-sm-10">
                                            {!! Form::text('user_informations[users][name]' , null ,['class' => 'form-control','readonly' => 'true','parsley-trigger' => 'change']) !!}

                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="doctor_id" class="col-sm-2">Doctor Email</label>
                                        <div class="col-sm-10">
                                            {!! Form::text('user_informations[users][email]' , null ,['class' => 'form-control','readonly' => 'true','parsley-trigger' => 'change']) !!}

                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row" id="display_schedule">
                                        <div class="col-md-6" style="border-right: 1px solid lightgrey;border-left: 1px solid lightgrey;border-bottom: 1px solid lightgrey;">
                                            <h4 class="text-inverse text-uppercase">Schedule For Opd</h4>
                                            <hr>

                                            <div class="form-group row">
                                                <table class="table table-striped m-0">

                                                    <thead>
                                                    <tr>


                                                        <th width="35%">Days</th>

                                                        <th>Start Time</th>
                                                        <th>End Time</th>

                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($schedule->schedule_details as $detail)
                                                        @if($detail->type == 0)
                                                            <tr>

                                                                <td>{{ $detail->days }}</td>
                                                                <td>{{ $detail->start_time }}</td>
                                                                <td>{{ $detail->end_time }}</td>
                                                            </tr>
                                                        @endif
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="col-sm-6" style="border-left: 1px solid lightgrey;border-right: 1px solid lightgrey;border-bottom: 1px solid lightgrey;">
                                            <h4 class="text-inverse text-uppercase">Schedule For Appointment</h4>
                                            <hr>

                                            <div class="form-group row">
                                                <table class="table table-striped m-0">

                                                    <thead>
                                                    <tr>


                                                        <th width="35%">Days</th>

                                                        <th>Start Time</th>
                                                        <th>End Time</th>

                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($schedule->schedule_details as $detail)
                                                        @if($detail->type == 1)
                                                            <tr>

                                                                <td>{{ $detail->days }}</td>
                                                                <td>{{ $detail->start_time }}</td>
                                                                <td>{{ $detail->end_time }}</td>

                                                            </tr>
                                                        @endif
                                                    @endforeach

                                                    </tbody>
                                                </table>
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