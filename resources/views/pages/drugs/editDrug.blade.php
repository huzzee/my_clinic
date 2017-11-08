@extends('layouts.mainHome')



@section('content')
    <!-- Start content -->
    <div class="content">
        <div class="container">


            <div class="row">
                <div class="col-xs-12">
                    <div class="page-title-box">

                        <h4 class="page-title">Edit Drug</h4>

                        <div class="clearfix"></div>

                    </div>
                </div>
            </div>
            <!-- end row -->

            <div class="row">
                {!! Form::model($drug, ['method' => 'PATCH','url' => ['drugs', $drug->id], 'files'=>true]) !!}

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
                    <div class="col-xs-12">
                        <div class="card-box">

                            <div class="row">
                                <div class="col-sm-12 col-xs-12 col-md-12">


                                    <a class="btn btn-info" href="{{ url('drugs') }}">Drugs List</a>

                                    <hr>

                                    <div class="p-20" style="clear: both;">


                                        <div class="form-group row">
                                            <label for="item_name" class="col-sm-3">Drug Name<span class="text-danger">*</span></label>
                                            <div class="col-sm-9">
                                                {!! Form::text('medicine_info[drug_name]' , null ,['class' => 'form-control','parsley-trigger' => 'change']) !!}

                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="drug_type" class="col-sm-3">Drug Type<span class="text-danger">*</span></label>
                                            <div class="col-sm-9">
                                                {!!Form::select('medicine_info[drug_type]',$drugType,null ,['class' => 'form-control select2'])!!}


                                            </div>
                                        </div>


                                        <div class="form-group row">
                                            <label for="dosage_unit" class="col-sm-3">Dosage Unit<span class="text-danger">*</span></label>
                                            <div class="col-sm-9">

                                                {!!Form::select('medicine_info[dosage_unit]',['Amp' => 'Amp','Mg' => 'Mg',
                                                'Bott' => 'Bott','Box' => 'Box','Capes' => 'Capes','Capsule' => 'Capsule','cc' => 'cc',
                                                'Dose' => 'Dose','Drop' => 'Drop','Gms' => 'Gms','Ink' => 'Ink','Mls' => 'Mls',
                                                'Puffs' => 'Puffs','Tabs' => 'Tabs','Times' => 'Times',
                                                'Tube' => 'Tube','Others' => 'Others',],null ,['class' => 'form-control select2'])!!}


                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="dosage_amount" class="col-sm-3">Dosage Amount<span class="text-danger">*</span></label>
                                            <div class="col-sm-9">
                                                {!! Form::number('medicine_info[dosage_amount]' , null ,['class' => 'form-control','parsley-trigger' => 'change']) !!}


                                            </div>
                                        </div>


                                        <div class="form-group row">

                                            <label for="purchase_price" class="col-sm-3">Purchase Price</label>
                                            <div class="col-sm-4">
                                                {!! Form::number('medicine_info[purchase_price]' , null ,['placeholder' => 'Enter Purchase Price','class' => 'form-control','parsley-trigger' => 'change']) !!}


                                            </div>
                                            <label for="retail_price" class="col-sm-1">GST in %</label>
                                            <div class="col-sm-4">
                                                {!! Form::number('medicine_info[purchase_gst]' , null ,['placeholder' => 'Enter Gst %','class' => 'form-control','parsley-trigger' => 'change']) !!}


                                            </div>

                                        </div>

                                        <div class="form-group row">

                                            <label for="retail_price" class="col-sm-3">Retail Price<span class="text-danger">*</span></label>
                                            <div class="col-sm-4">
                                                {!! Form::number('medicine_info[retail_price]' , null ,['placeholder' => 'Enter Retail Price','class' => 'form-control','parsley-trigger' => 'change']) !!}


                                            </div>
                                            <label for="retail_price" class="col-sm-1">GST in %</label>
                                            <div class="col-sm-4">
                                                {!! Form::number('medicine_info[retail_gst]' , null ,['placeholder' => 'Enter Gst %',
                                                'class' => 'form-control','parsley-trigger' => 'change']) !!}


                                            </div>

                                        </div>

                                        <div class="form-group row">
                                            <label for="generic" class="col-sm-3">Generic Name</label>
                                            <div class="col-sm-9">
                                                {!! Form::text('medicine_info[generic]' , null ,['placeholder' => 'Enter Generic Name',
                                               'class' => 'form-control','parsley-trigger' => 'change']) !!}


                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="company" class="col-sm-3">Company Name</label>
                                            <div class="col-sm-9">
                                                {!! Form::text('medicine_info[company]' , null ,['placeholder' => 'Enter Company Name',
                                              'class' => 'form-control','parsley-trigger' => 'change']) !!}

                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="drug_type" class="col-sm-3">Stock Unit<span class="text-danger">*</span></label>
                                            <div class="col-sm-9">
                                                {!!Form::select('medicine_info[stock_unit]',$drugStock,null ,['class' => 'form-control select2'])!!}

                                            </div>
                                        </div>


                                        <div class="form-group row">

                                            <label for="min_qnt" class="col-sm-3">Warning Quantity<span class="text-danger">*</span></label>
                                            <div class="col-sm-9">
                                                {!! Form::number('medicine_info[min_qnt]' , null ,['placeholder' => 'Enter Warning Quantity',
                                                'class' => 'form-control','parsley-trigger' => 'change']) !!}

                                            </div>

                                        </div>


                                        <div class="form-group row">
                                            <label for="precaution" class="col-sm-3">Precaution</label>
                                            <div class="col-sm-9">
                                                {!! Form::textarea('medicine_info[precaution]' , null ,['placeholder' => 'Precaution Here If Important',
                                                'class' => 'form-control','id' => 'textarea','maxlength' => '225',
                                                'rows' => '5','parsley-trigger' => 'change']) !!}

                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="drug_image" class="col-sm-3">Drug Image</label>
                                            <div class="col-sm-9">
                                                <input type="file" class="filestyle" placeholder="{{ $drug->medicine_info['drug_image'] }}" name="drug_image" data-buttonname="btn-danger">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="status" class="col-sm-3">Active<span class="text-danger">*</span></label>
                                            <div class="col-sm-9">
                                                @if($drug->medicine_info['status'] == 1)
                                                <input type="checkbox" id="switch3" name="status" switch="bool" checked/>
                                                @else
                                                <input type="checkbox" id="switch3" name="status" switch="bool"/>
                                                @endif
                                                <label for="switch3" data-on-label="Yes"
                                                       data-off-label="No"></label>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-sm-3"></div>
                                            <div class="col-sm-9">
                                                <button type="submit" class="btn btn-inverse">Update Drug</button>
                                            </div>
                                        </div>



                                    </div>

                                </div>

                            </div>
                            <!-- end row -->


                        </div> <!-- end ard-box -->
                    </div><!-- end col-->
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