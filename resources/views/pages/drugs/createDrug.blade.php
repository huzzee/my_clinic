@extends('layouts.mainHome')



@section('content')
    <!-- Start content -->
    <div class="content">
        <div class="container">


            <div class="row">
                <div class="col-xs-12">
                    <div class="page-title-box">

                        <h4 class="page-title">Add Drugs</h4>

                        <div class="clearfix"></div>

                    </div>
                </div>
            </div>
            <!-- end row -->

            <div class="row">
                <form action="{{ route('drugs.store') }}" enctype="multipart/form-data" method="POST">

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
                                                <input type="text" name="drug_name" parsley-trigger="change"
                                                       placeholder="Enter Drug Name" class="form-control" value="{{ old('drug_name') }}" />

                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="drug_type" class="col-sm-3">Drug Type<span class="text-danger">*</span></label>
                                            <div class="col-sm-9">
                                                <select class="form-control select2" name="drug_type">
                                                    <option selected disabled="disabled">Select Drug Type</option>

                                                    @foreach($drugTypes as $type)
                                                        <option value="{{ $type->category_name }}">{{ $type->category_name }}</option>
                                                    @endforeach


                                                </select>

                                            </div>
                                        </div>


                                        <div class="form-group row">
                                            <label for="dosage_unit" class="col-sm-3">Dosage Unit<span class="text-danger">*</span></label>
                                            <div class="col-sm-9">
                                                <select class="form-control select2" name="dosage_unit">
                                                    <option selected disabled="disabled">Select Dosage Unit</option>
                                                    <option value="Amp">Amp</option>
                                                    <option value="Mg">Mg</option>
                                                    <option value="Bott">Bott</option>
                                                    <option value="Box">Box</option>
                                                    <option value="Capes">Capes</option>
                                                    <option value="Capsule">Capsule</option>
                                                    <option value="cc">cc</option>
                                                    <option value="Dose">Dose</option>
                                                    <option value="Drop">Drop</option>
                                                    <option value="Gms">Gms</option>
                                                    <option value="Ink">Ink</option>
                                                    <option value="Mls">Mls</option>
                                                    <option value="Puffs">Puffs</option>
                                                    <option value="Tabs">Tabs</option>
                                                    <option value="Times">Times</option>
                                                    <option value="Tube">Tube</option>
                                                    <option value="Others">Others</option>






                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="dosage_amount" class="col-sm-3">Dosage Amount<span class="text-danger">*</span></label>
                                            <div class="col-sm-9">

                                                <input type="number" name="dosage_amount" parsley-trigger="change"
                                                       placeholder="Enter Dosage Amount" class="form-control" value="{{ old('dosage_amount') }}" />

                                            </div>
                                        </div>


                                        <div class="form-group row">

                                            <label for="purchase_price" class="col-sm-3">Purchase Price</label>
                                            <div class="col-sm-4">
                                                <div class="input-group">
                                                    <input type="number" id="purchase_price" name="purchase_price" parsley-trigger="change"
                                                       class="form-control" placeholder="Enter Purchase Price"
                                                       value="{{ old('purchase_price') }}"  />
                                                    <span class="input-group-addon">{{ Auth::user()->entities->currency }}</span>
                                                </div>

                                            </div>
                                            <label for="retail_price" class="col-sm-1">GST in %</label>
                                            <div class="col-sm-4">
                                                <input type="number" id="gst" name="purchase_gst" parsley-trigger="change"
                                                       class="form-control" placeholder="Enter Gst %" value="0"  />

                                            </div>

                                        </div>

                                        <div class="form-group row">

                                            <label for="retail_price" class="col-sm-3">Retail Price<span class="text-danger">*</span></label>
                                            <div class="col-sm-4">
                                                <div class="input-group">
                                                    <input type="number" id="retail_price" name="retail_price" parsley-trigger="change"
                                                           class="form-control" placeholder="Enter Retail Price" value="{{ old('retail_price') }}"  />
                                                    <span class="input-group-addon">{{ Auth::user()->entities->currency }}</span>
                                                </div>

                                            </div>
                                            <label for="retail_price" class="col-sm-1">GST in %</label>
                                            <div class="col-sm-4">
                                                <input type="number" id="gst" name="retail_gst" parsley-trigger="change"
                                                       class="form-control" placeholder="Enter Gst %" value="0"  />

                                            </div>

                                        </div>

                                        <div class="form-group row">
                                            <label for="generic" class="col-sm-3">Generic Name</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="generic" parsley-trigger="change"
                                                       placeholder="Enter Generic Name" class="form-control" value="{{ old('dosage_unit') }}" />

                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="company" class="col-sm-3">Company Name</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="company" parsley-trigger="change"
                                                       placeholder="Enter Company Name" class="form-control" value="{{ old('dosage_unit') }}" />

                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="drug_type" class="col-sm-3">Stock Unit<span class="text-danger">*</span></label>
                                            <div class="col-sm-9">
                                                <select class="form-control select2" name="stock_unit">
                                                    <option selected disabled="disabled">Select Stock Unit</option>

                                                    @foreach($drugUnits as $type)
                                                        <option value="{{ $type->unit_name }}">{{ $type->unit_name }}</option>
                                                    @endforeach



                                                </select>

                                            </div>
                                        </div>


                                        <div class="form-group row">

                                            <label for="min_qnt" class="col-sm-3">Warning Quantity<span class="text-danger">*</span></label>
                                            <div class="col-sm-9">
                                                <input type="number" id="min_qnt" name="min_qnt" parsley-trigger="change"
                                                       class="form-control" value="0"  />

                                            </div>

                                        </div>


                                        <div class="form-group row">
                                            <label for="precaution" class="col-sm-3">Precaution</label>
                                            <div class="col-sm-9">
                                                <textarea name="precaution" id="textarea" class="form-control" maxlength="225" rows="5" placeholder="Precaution Here If Important" value="{{ old('precaution') }}"></textarea>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="drug_image" class="col-sm-3">Drug Image</label>
                                            <div class="col-sm-9">
                                                <input type="file" class="filestyle" placeholder="Not Important" name="drug_image" data-buttonname="btn-danger">
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
                                                <button type="submit" class="btn btn-inverse">Add Drug</button>
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