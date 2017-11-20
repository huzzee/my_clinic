@extends('layouts.mainHome')



@section('content')
    <!-- Start content -->
    <div class="content">
        <div class="container">


            <div class="row">
                <div class="col-xs-12">
                    <div class="page-title-box">
                        <h4 class="page-title">Add Invoice $ Prescription</h4>

                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <!-- end row -->

            <div class="row">
                <div class="col-sm-12">
                    @if(session()->has('message'))
                        <div class="alert alert-success">
                            {{ session()->get('message') }}
                        </div>
                    @endif
                    <div class="card-box">
                        <div class="row">
                            <div class="col-lg-6 col-md-6">
                                <div class="text-center card-box">
                                    <div class="member-card">

                                        <h4>Patient Information</h4>
                                        <hr>
                                        <div class="text-left">
                                            <p class="text-muted font-13"><strong>Full Name :</strong> <span class="m-l-15">
                                                    {{ $queue->patients->patient_info['full_name'] }}</span></p>

                                            <p class="text-muted font-13"><strong>Patient Code :</strong><span class="m-l-15">
                                                {{ $queue->patients->patient_code }}</span></p>

                                            <p class="text-muted font-13"><strong>Age :</strong> <span class="m-l-15">
                                                    @php $age = date('Y', strtotime(Carbon\Carbon::now())) - date('Y', strtotime($queue->patients->patient_info['date_of_birth'])); @endphp
                                                    {{ $age }}</span></p>

                                            <p class="text-muted font-13"><strong>Gender :</strong>
                                                <span class="m-l-15">
                                                    @if($queue->patients->patient_info['gender'] == 0)
                                                        Male
                                                    @elseif($queue->patients->patient_info['gender'] == 1)
                                                        Female
                                                    @elseif($queue->patients->patient_info['gender'] == 2)
                                                        Other

                                                    @endif
                                                </span></p>

                                            <p class="text-muted font-13"><strong>Drug Allergy :</strong><span class="m-l-15">
                                                @foreach($queue->patients->drug_allergy as $allergy)
                                                    {{ $allergy['drug_name'] }},
                                                @endforeach</span></p>

                                        </div>

                                    </div>
                                </div> <!-- end card-box -->
                            </div> <!-- end col -->
                            <div class="col-lg-6 col-md-6" >
                                <div class="text-center card-box" style="min-height: 270px">
                                    <div class="member-card">

                                        <h4>Doctor Information</h4>
                                        <hr>
                                        <div class="text-left">
                                            <p class="text-muted font-13"><strong>Full Name :</strong> <span class="m-l-15">
                                                    {{ $queue->user_informations->users['name'] }}</span></p>

                                            <p class="text-muted font-13"><strong>Department :</strong><span class="m-l-15">
                                                {{ $queue->user_informations->doctor_info['department'] }}</span></p>



                                        </div>


                                    </div>
                                </div> <!-- end card-box -->
                            </div> <!-- end col -->


                            <div class="col-lg-12 col-md-12">
                                <div class="text-center card-box">
                                    <div class="member-card">
                                        <div class="row">

                                            <button class="btn btn-primary waves-effect waves-light" data-toggle="modal"
                                                    data-target="#con-close-modalmed">
                                                <i class="fa fa-plus"></i>
                                                Add Medicine
                                            </button>

                                            <button class="btn btn-success waves-effect waves-light" data-toggle="modal"
                                                    data-target="#con-close-modalservice">
                                                <i class="fa fa-plus"></i>
                                                Add Service
                                            </button>



                                            <div id="con-close-modalmed" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">

                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                            <h4 class="modal-title">Add Medicine</h4>
                                                        </div>
                                                        <div class="modal-body">


                                                            <div class="row" id="hide_press">
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label for="pats" class="control-label" style="float:left;">Prescription<span class="text-danger">*</span></label>
                                                                        <select class="form-control select2" id="presc">
                                                                            <option selected="selected">Prescription</option>
                                                                            <option value="1">New Prescription</option>


                                                                        </select>
                                                                    </div>
                                                                </div>

                                                            </div>

                                                            <div class="row" id="show_press" style="display: none;">
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label for="pats" class="control-label"  style="float:left;">Select Medicines<span class="text-danger">*</span></label>
                                                                        <select class="form-control select2" id="drug_pres">
                                                                            <option selected value="0">Select Medicines</option>

                                                                            @foreach($medicines as $medicine)
                                                                                <option value="{{$medicine->id}}">{{$medicine->medicine_info['drug_name']}}</option>
                                                                            @endforeach

                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="pats" class="control-label"  style="float:left;">Stock Unit<span class="text-danger">*</span></label>
                                                                        <input type="text" class="form-control" value="" readonly="true" id="stock_unit">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="pats" class="control-label"  style="float:left;">Quantity<span class="text-danger">*</span></label>
                                                                        <input type="number" class="form-control" placeholder="Enter Quantity" id="medicine_qnt">
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="pats" class="control-label"  style="float:left;">Dosage Unit<span class="text-danger">*</span></label>
                                                                        <input type="text" class="form-control" value="" readonly="true" id="dosage_unit">
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="pats" class="control-label"  style="float:left;">Dosage Quantity<span class="text-danger">*</span></label>
                                                                        <input type="number" class="form-control" placeholder="Enter Dose" id="dosage_qnt">
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="pats" class="control-label"  style="float:left;">Price</label>
                                                                        <input type="text" class="form-control" readonly id="price_med">
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="pats" class="control-label"  style="float:left;">Gst In %</label>
                                                                        <input type="text" class="form-control" id="gst">
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="pats" class="control-label"  style="float:left;">Discount in %</label>
                                                                        <input type="number" class="form-control" value="0" placeholder="Enter Discount in %" id="discount">
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="pats" class="control-label"  style="float:left;">Discount Remarks</label>
                                                                        <input type="text" class="form-control" placeholder="Enter Discount Remarks" id="remark">
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-8">
                                                                    <div class="form-group">
                                                                        <label for="pats" class="control-label"  style="float:left;">Instruction<span class="text-danger">*</span></label>
                                                                        <textarea id="textarea" class="instruction form-control" maxlength="500" rows="5" placeholder="Instruction"></textarea>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label for="pats" class="control-label"  style="float:left;">Days<span class="text-danger">*</span></label>
                                                                        <input type="number" class="form-control" placeholder="Enter Days" id="days">
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                        <div class="modal-footer" id="pres_foot" style="display: none;">
                                                            <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                                                            <a href="#" class="btn btn-inverse waves-effect waves-light" id="add_pres_here">Add Medicine</a>
                                                        </div>


                                                    </div>
                                                </div>

                                            </div><!-- /.modal -->
                                        </div>
                                        <div class="row" style="height: 20px;"></div>
                                        <div class="row">

                                            <table class="table table-striped m-0">
                                                <thead>
                                                <tr>
                                                    
                                                    <th width="15%" style="text-align: center">Item Name</th>
                                                    <th>Quantity</th>
                                                    <th>Price</th>
                                                    <th>Sub Total</th>
                                                    <th>Discount</th>
                                                    <th width="15%">Discount Remark</th>
                                                    <th>Gst</th>
                                                    <th>Line Total</th>
                                                    <th>Action</th>
                                                </tr>
                                                </thead>
                                                <tbody id="insert_medicine">

                                                </tbody>
                                            </table>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End row -->



        </div> <!-- container -->

    </div>

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