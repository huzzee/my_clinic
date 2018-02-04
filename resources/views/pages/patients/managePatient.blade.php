@extends('layouts.mainHome')



@section('content')
    <!-- Start content -->
    <div class="content">
        <div class="container">
            <div class="row" style="height: 10px;">
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif</div>
            <div class="row">
                <div class="col-md-3 card-box table-responsive" >
                    @if(session()->has('message'))
                        <div class="alert alert-success">
                            {{ session()->get('message') }}
                        </div>
                    @endif
                    <div>
                        <h4 style="margin: 0px auto;padding: 0px auto; float:left;">Patient List</h4>
                        <button class="modal_select btn btn-icon waves-effect waves-light btn-danger m-b-5"
                                data-toggle="modal" data-target="#full-width-modal-create"
                                style="float: right; font-size: 11px; margin-top: 0px;">Add Patient</button>
                    </div>
                    {{--start model--}}
                    <div id="full-width-modal-create" class="modal fade" role="dialog" aria-labelledby="full-width-modalLabel-create" aria-hidden="true" style="display: none;">
                        <div class="modal-dialog modal-full">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                    <h4 class="modal-title" id="full-width-modalLabel-create">Add Patient</h4>
                                </div>
                                <form id="patient_add_submit" action="{{ route('patients.store') }}" method="post" enctype="multipart/form-data">

                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-sm-12"><h4>General Information</h4><hr></div>
                                            <div class="col-sm-2">

                                                <div class="col-sm-8 hidden-md hidden-sm hidden_div"></div>
                                                <div class="col-md-8 uploading" style="display: none; align-items: left">
                                                    <div class="form-group">

                                                        <input type="file" class="filestyle upload_to_plus" data-input="false">

                                                    </div>
                                                </div>
                                                <div class="col-md-8 taking_pic" style="display: none;">
                                                    <div class="row">


                                                        <div class="col-md-4" align="center">
                                                            <div id="main_camera">

                                                            </div>
                                                            <button type="button" style="align-self:center; " class="btn btn-primary take_snapshot">take snap</button>

                                                        </div>


                                                    </div>
                                                </div>
                                                <div class="col-md-4">

                                                    <button id="results" type="button" class="dropdown-toggle"
                                                            data-toggle="dropdown" aria-expanded="false"
                                                            style="background-image: url('{{ asset('src/img/image_upload.png') }}');
                                                                    background-size:cover ;
                                                                    background-color: white;
                                                                    border-radius: 130px;
                                                                    border: none;
                                                                    width: 70px;height: 70px;"></button>
                                                    <ul class="dropdown-menu">
                                                        <li><a href="#" class="upload_image_pat">Upload Image</a></li>
                                                        <li><a href="#" class="snap_image_pat">Take Snapshot</a></li>
                                                    </ul>


                                                </div>


                                            </div>
                                            <div class="col-sm-10">

                                                <div class="row p-20" style="clear: both;">

                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <label for="full_name" class="control-label">Full Name<span class="text-danger">*</span></label>

                                                            <input type="text" name="full_name" parsley-trigger="change"
                                                                   placeholder="Enter Full Name" value="{{ old('full_name') }}" autocomplete="off" class="form-control input-sm"/>
                                                            <input type="hidden" name="patient_code" value="{{ str_random(8) }}">

                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <label for="full_name" class="control-label">Contact No<span class="text-danger">*</span></label>
                                                            <input type="number" name="contact_no" parsley-trigger="change"
                                                                   placeholder="Enter Contact No" value="{{ old('contact_no') }}" autocomplete="off" class="form-control input-sm"/>

                                                        </div>
                                                    </div>

                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <label for="full_name" class="control-label">Email</label>
                                                            <input type="email" id="fake-email" name="fake-email" style="display: none;">
                                                            <input type="text" name="email" parsley-trigger="change"
                                                                   placeholder="Enter Email If needed" value="{{ old('email') }}" autocomplete="off" class="form-control input-sm"/>

                                                        </div>
                                                    </div>


                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <label for="full_name" class="control-label">Gender<span class="text-danger">*</span></label>
                                                            <div>
                                                                <div class="radio radio-info radio-inline">
                                                                    <input type="radio" id="inlineRadio8" name="gender" value="0">
                                                                    <label for="inlineRadio8"> Male </label>
                                                                </div>
                                                                <div class="radio radio-pink radio-inline">
                                                                    <input type="radio" id="inlineRadio9" name="gender" value="1">
                                                                    <label for="inlineRadio9"> Female </label>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <label for="full_name" class="control-label">Date Of Birth<span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control input-sm" name="date_of_birth" placeholder="mm/dd/yyyy" id="datepicker-autoclose">

                                                        </div>
                                                    </div>

                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <label for="full_name" class="control-label">Language Preference</label>
                                                            <select class="form-control select2" name="language">
                                                                <option value="Burmese(default)" selected>Burmese(default)</option>
                                                                @foreach($languages as $language)
                                                                    <option value="{{ $language->name }}">{{ $language->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <label for="full_name" class="control-label">Country<span class="text-danger">*</span></label>
                                                            <select class="form-control select2" name="country" id="country">
                                                                <option disabled selected value="0">Select Country</option>
                                                                @foreach($countries as $country)
                                                                    <option value="{{ $country->name }}">{{ $country->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <label for="full_name" class="control-label">State<span class="text-danger">*</span></label>
                                                            <select class="form-control select2" name="state" id="state">
                                                                <option disabled selected value="0">Select State</option>

                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <label for="full_name" class="control-label">City<span class="text-danger">*</span></label>
                                                            <select class="form-control select2" name="city" id="city">
                                                                <option disabled selected value="0">Select City</option>

                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-8">
                                                        <div class="form-group">
                                                            <label for="address" class="control-label">Address</label>
                                                            <input type="text" name="address" parsley-trigger="change"
                                                                   placeholder="Enter Address" value="{{ old('address') }}" autocomplete="off" class="form-control input-sm"/>

                                                        </div>
                                                    </div>


                                                </div>

                                            </div>


                                        </div>

                                        <div class="row">
                                            <div class="col-md-12"><h4>Medical Profile</h4><hr></div>
                                            <div class="col-md-12">

                                                <div class="row p-20" style="clear: both;">
                                                    <div class="col-sm-4">
                                                        <label for="medical_history" class="control-label">Personal Medical History</label>
                                                        <div class="row">

                                                            <div class="col-sm-10" style="border: 1px solid grey; padding: 10px;">
                                                                <div class="row" id="here_medical_history1">

                                                                </div>

                                                                <div class="row">
                                                                    <div class="col-xs-8">
                                                                        <input type="text" parsley-trigger="change"
                                                                               placeholder="Add Medical History" autocomplete="off" class="form-control input-sm medical_history_pat1"/>

                                                                    </div>
                                                                    <div class="col-xs-4">
                                                                        <button type="button" class="btn btn-teal add_history1" style="font-size: 11px;" >Add</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <div class="col-sm-4">
                                                        <label for="medical_history" class="control-label">Drug Allergy</label>
                                                        <div class="row">

                                                            <div class="col-sm-10" style="border: 1px solid grey; padding: 10px;">
                                                                <div class="row" id="here_drug_allegy1">

                                                                </div>

                                                                <div class="row">
                                                                    <div class="col-xs-8">
                                                                        <input type="text" parsley-trigger="change"
                                                                               placeholder="Add Drug Allergy" autocomplete="off" class="drug_name_pat form-control input-sm"/>

                                                                    </div>
                                                                    <div class="col-xs-4">
                                                                        <button type="button" class="btn btn-teal add_drug1" style="font-size: 11px;">Add</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-4">
                                                        <div class="form-group">
                                                            <label for="medical_history" class="control-label">Important Patient Note</label>
                                                            <textarea name="patient_note" id="textarea2" class="form-control"
                                                                      rows="3" placeholder="Important Patient Note"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row" id="error_here">

                                                </div>

                                            </div>
                                        </div>
                                    </div>


                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cancel</button>
                                        {{ csrf_field() }}


                                        <button type="submit" class="btn btn-inverse waves-effect" style="float: right;margin-left: 1%;">Add Patient</button>


                                    </div>
                                </form>
                            </div><!-- /.modal-content -->
                        </div><!-- /.modal-dialog -->
                    </div><!-- /.modal -->

                    {{--end model--}}
                    <hr style="margin: 10px 0px; clear: both;">

                    <ul class="nav nav-tabs navtab-bg nav-justified" style="font-size: 10px !important; clear: both;">
                        <li class="active">
                            <a href="#all_record" data-toggle="tab" aria-expanded="false">
                                <span class="visible-xs"><i class="fa fa-pencil-square"></i></span>
                                <span class="hidden-xs">All</span>
                            </a>
                        </li>
                        <li class="">
                            <a href="#todays" data-toggle="tab" aria-expanded="false">
                                <span class="visible-xs"><i class="fa fa-home"></i></span>
                                <span class="hidden-xs">Today</span>
                            </a>
                        </li>
                        <li class="">
                            <a href="#this_month" data-toggle="tab" aria-expanded="false">
                                <span class="visible-xs"><i class="fa fa-medkit"></i></span>
                                <span class="hidden-xs">Recent</span>
                            </a>
                        </li>



                    </ul>

                    <div class="tab-content">
                        <div class="tab-pane active" id="all_record">
                            <div class="text-center card-box">
                                <div class="member-card" style="max-height: 350px;min-height: 350px; overflow: auto;">
                                    <table class="table table-responsive">
                                        @php $ai=1; @endphp
                                        @foreach($patients as $patient)
                                            <tr>
                                                <td width="5%" style="font-size: 11px;">{{ $ai }}#</td>
                                                <td align="left">
                                                    <a href="javascript:void(0);" class="patient_all_info" data-patient_id="{{$patient->id}}"
                                                    style="font-weight: bold;color: #1f648b; font-size: 11px;">
                                                        {{ $patient->patient_info['full_name'] }}
                                                        ({{ $patient->patient_code }})</a></td>
                                            </tr>

                                            @php $ai++ @endphp
                                        @endforeach
                                    </table>

                                </div>
                            </div>
                        </div>
                        <div class="tab-pane " id="todays">
                            <div class="text-center card-box">
                                <div class="member-card">
                                    <table class="table table-responsive">
                                        @php
                                            $ti=1;

                                            $today = date('d-m-Y',strtotime(\Carbon\Carbon::now(get_local_time())));


                                        @endphp
                                        @foreach($patients as $patient)
                                            @if($today == date('d-m-Y', strtotime($patient->created_at)))
                                            <tr>
                                                <td width="5%" style="font-size: 11px;">{{ $ti }}#</td>
                                                <td align="left">
                                                    <a href="javascript:void(0);" class="patient_all_info" data-patient_id="{{$patient->id}}"
                                                       style="font-weight: bold;color: #1f648b; font-size: 11px;">
                                                        {{ $patient->patient_info['full_name'] }}
                                                        ({{ $patient->patient_code }})</a></td>
                                            </tr>

                                            @endif

                                        @php $ti++ @endphp
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane" id="this_month">
                            <div class="text-center card-box">
                                <div class="member-card">
                                    <table class="table table-responsive">
                                        @php
                                            $mi=1;

                                            $this_month = date('m-Y',strtotime(\Carbon\Carbon::now(get_local_time())));

                                        @endphp
                                        @foreach($patients as $patient)

                                            @if($this_month == date('m-Y',strtotime($patient->created_at)))
                                            <tr>
                                                <td width="5%" style="font-size: 11px;">{{ $ai }}#</td>
                                                <td align="left">
                                                    <a href="javascript:void(0);" class="patient_all_info" data-patient_id="{{$patient->id}}"
                                                       style="font-weight: bold;color: #1f648b; font-size: 11px;">
                                                        {{ $patient->patient_info['full_name'] }}
                                                        ({{ $patient->patient_code }})</a></td>
                                            </tr>

                                            @php $mi++ @endphp
                                            @endif
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
                <div id="profie_pat_here">
                    <div class="col-md-9">
                        <h3 align="center">Choose Patient</h3>
                    </div>
                </div>
            </div>

        </div> <!-- container -->
        <input type="hidden" value="{{ url('/') }}" id="basepath">
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

    <script src="{{ asset('assets/pages/jquery.form-advanced.init.js') }}"></script>


    <script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables/dataTables.bootstrap.js') }}"></script>



    <script src="{{ asset('assets/plugins/datatables/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables/responsive.bootstrap.min.js') }}"></script>


    <!-- init -->
    <script src="{{ asset('assets/pages/jquery.datatables.init.js') }}"></script>
    <script src="{{ asset('assets/plugins/tooltipster/tooltipster.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/pages/jquery.tooltipster.js') }}"></script>


    <script type="text/javascript">
        $(document).ready(function () {
            $('#datatable').dataTable();
            $('#datatable-keytable').DataTable({keys: true});
            $('#datatable-responsive').DataTable();
            $('#datatable-colvid').DataTable({
                "dom": 'C<"clear">lfrtip',
                "colVis": {
                    "buttonText": "Change columns"
                }
            });
            $('#datatable-scroller').DataTable({
                ajax: "../plugins/datatables/json/scroller-demo.json",
                deferRender: true,
                scrollY: 380,
                scrollCollapse: true,
                scroller: true
            });
            var table = $('#datatable-fixed-header').DataTable({fixedHeader: true});
            var table = $('#datatable-fixed-col').DataTable({
                scrollY: "300px",
                scrollX: true,
                scrollCollapse: true,
                paging: false,
                fixedColumns: {
                    leftColumns: 1,
                    rightColumns: 1
                }
            });
        });
        TableManageButtons.init();

    </script>


    <script src="{{ asset('js/webcam/webcam.js') }}"></script>


    <script src="{{ asset('js/patient_info.js') }}"></script>
@endsection

<!--*********Page Scripts End*********-->