@extends('layouts.mainHome')



@section('content')
    <!-- Start content -->
    <div class="content">
        <div class="container">


            <div class="row">
                <div class="col-xs-12">
                    <div class="page-title-box">

                        <h4 class="page-title">Add Schedule</h4>

                        <div class="clearfix"></div>

                    </div>
                </div>
            </div>
            <!-- end row -->

            <div class="row">
                <form action="{{ route('schedule.store') }}" enctype="multipart/form-data" method="POST">

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


                                    <a class="btn btn-info" href="{{ url('employee') }}">Schedule List</a>
                                    <hr>


                                    <div class="p-20" style="clear: both;">


                                        <input type="hidden" name="role_id" value="4" />

                                        <div class="form-group row">
                                            <label for="first_name" class="col-sm-3">Doctor<span class="text-danger">*</span></label>
                                            <div class="col-sm-9">
                                                <select class="form-control select2" name="stock_unit">
                                                    <option selected disabled="disabled">Select Doctor</option>

                                                    @foreach($doctors as $doctor)
                                                        <option value="{{ $doctor->id }}">{{ $doctor->users->name }}</option>
                                                    @endforeach



                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group row">
                                                    <label for="first_name" class="col-sm-3">Doctor<span class="text-danger">*</span></label>
                                                    <div class="col-sm-9">
                                                        <select class="form-control select2" name="stock_unit">
                                                            <option selected disabled="disabled">Select Doctor</option>

                                                            @foreach($doctors as $doctor)
                                                                <option value="{{ $doctor->id }}">{{ $doctor->users->name }}</option>
                                                            @endforeach



                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6"></div>
                                        </div>


                                        {{--<div class="form-group row">
                                            <div class="col-sm-3"></div>
                                            <div class="col-sm-9">
                                                <div class="input-group clockpicker m-b-20" data-placement="top" data-align="top" data-autoclose="true">
                                                    <input type="text" class="form-control" value="13:14">
                                                    <span class="input-group-addon"> <span class="mdi mdi-clock"></span> </span>
                                                </div>
                                            </div>
                                        </div>--}}


                                        <div class="form-group row">
                                            <div class="col-sm-3"></div>
                                            <div class="col-sm-9">
                                                <button type="submit" class="btn btn-inverse">Add Schedule</button>
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