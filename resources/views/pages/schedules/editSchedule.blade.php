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


                                    <a class="btn btn-info" href="{{ url('schedule') }}">Schedule List</a>
                                    <hr>


                                    <div class="p-20" style="clear: both;">



                                        <div class="form-group row">
                                            <label for="doctor_id" class="col-sm-2">Doctor Name</label>
                                            <div class="col-sm-10">
                                                {!! Form::text('user_informations[users][name]' , null ,['class' => 'form-control','readonly' => 'true','parsley-trigger' => 'change']) !!}

                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row" id="display_schedule">
                                            <div class="col-md-5" style="border-right: 1px solid lightgrey;border-left: 1px solid lightgrey;border-bottom: 1px solid lightgrey;">
                                                <h4 class="text-inverse text-uppercase">Schedule For Opd</h4>
                                                <hr>
                                                <div class="form-group row">

                                                    <div class="col-sm-4 m-b-20">
                                                        <select class="form-control select2 opd_day">
                                                            <option selected disabled="disabled">Select Days</option>
                                                            <option value="0">Sunday</option>
                                                            <option value="1">Monday</option>
                                                            <option value="2">Tuesday</option>
                                                            <option value="3">Wednesday</option>
                                                            <option value="4">Thursday</option>
                                                            <option value="5">Friday</option>
                                                            <option value="6">Saturday</option>

                                                        </select>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div class="input-group clockpicker m-b-20" data-placement="top" data-align="top" data-autoclose="true">
                                                            <input type="text" class="form-control opd_start" placeholder="Start Time">

                                                        </div>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <div class="input-group clockpicker m-b-20" data-placement="top" data-align="top" data-autoclose="true">
                                                            <input type="text" class="form-control opd_end" placeholder="End Time">

                                                        </div>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <button class="btn btn-icon waves-effect waves-light btn-inverse m-b-5 add_opd" type="button">
                                                            <i class="fa fa-plus"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <table class="table table-striped m-0">

                                                        <thead>
                                                        <tr>


                                                            <th width="35%">Days</th>

                                                            <th>Start Time</th>
                                                            <th>End Time</th>

                                                            <th width="20%">Action</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody id="table_row1">
                                                            @foreach($schedule->schedule_details as $detail)
                                                                @if($detail->type == 0)
                                                                    <tr>

                                                                        <td>{{ dformat($detail->days) }}<input type="hidden" name="opd_day[]" value="{{ $detail->days }}"></td>
                                                                        <td>{{ $detail->start_time }}<input type="hidden" name="opd_start_time[]" value="{{ $detail->start_time }}"></td>
                                                                        <td>{{ $detail->end_time }}<input type="hidden" name="opd_end_time[]" value="{{ $detail->end_time }}"></td>
                                                                        <td>
                                                                            <button type="button" class="btn btn-icon btn-danger m-b-5 remove_table1">
                                                                                <i class="fa fa-remove"></i>
                                                                            </button>
                                                                        </td>
                                                                    </tr>
                                                                @endif
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="col-sm-7" style="border-left: 1px solid lightgrey;border-right: 1px solid lightgrey;border-bottom: 1px solid lightgrey;">
                                                <h4 class="text-inverse text-uppercase">Schedule For Appointment</h4>
                                                <hr>
                                                <div class="form-group row">

                                                    <div class="col-md-3 m-b-20">
                                                        <select class="form-control select2 app_day" >
                                                            <option selected disabled="disabled">Select Days</option>
                                                            <option value="0">Sunday</option>
                                                            <option value="1">Monday</option>
                                                            <option value="2">Tuesday</option>
                                                            <option value="3">Wednesday</option>
                                                            <option value="4">Thursday</option>
                                                            <option value="5">Friday</option>
                                                            <option value="6">Saturday</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="input-group clockpicker m-b-20" data-placement="top" data-align="top" data-autoclose="true">
                                                            <input type="text" class="form-control app_start" placeholder="Start Time">

                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="input-group clockpicker m-b-20" data-placement="top" data-align="top" data-autoclose="true">
                                                            <input type="text" class="form-control app_end" placeholder="End Time">

                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">

                                                        <input type="number" class="form-control app_token" placeholder="Slot">

                                                    </div>
                                                    <div class="col-md-2">
                                                        <button class="btn btn-icon waves-effect waves-light btn-inverse m-b-5 add_app" type="button">
                                                            <i class="fa fa-plus"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <table class="table table-striped m-0">

                                                        <thead>
                                                        <tr>


                                                            <th width="35%">Days</th>

                                                            <th>Start Time</th>
                                                            <th>End Time</th>
                                                            <th>Tokens</th>
                                                            <th width="20%">Action</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody id="table_row2">
                                                        @foreach($schedule->schedule_details as $detail)
                                                            @if($detail->type == 1)
                                                                <tr>

                                                                    <td>{{ dformat($detail->days) }}<input type="hidden" name="app_day[]" value="{{ $detail->days }}"></td>
                                                                    <td>{{ $detail->start_time }}<input type="hidden" name="app_start_time[]" value="{{ $detail->start_time }}"></td>
                                                                    <td>{{ $detail->end_time }}<input type="hidden" name="app_end_time[]" value="{{ $detail->end_time }}"></td>
                                                                    <td>{{ $detail->tokens }}<input type="hidden" name="app_tokens[]" value="{{ $detail->tokens }}"></td>
                                                                    <td>
                                                                        <button type="button" class="btn btn-icon btn-danger m-b-5 remove_table2">
                                                                            <i class="fa fa-remove"></i>
                                                                        </button>
                                                                    </td>
                                                                </tr>
                                                            @endif
                                                        @endforeach

                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>


                                        <hr>

                                        <div class="form-group row">
                                            <div class="col-sm-9"></div>
                                            <div class="col-sm-3">
                                                <button type="submit" class="btn btn-teal">Add Schedule</button>
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