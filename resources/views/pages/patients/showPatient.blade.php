@extends('layouts.mainHome')



@section('content')
    <!-- Start content -->
    <div class="content">
        <div class="container">


            <div class="row">
                <div class="col-xs-12">
                    <div class="page-title-box">
                        <h4 class="page-title">Patient Profile </h4>

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
                            <div class="col-lg-12 col-md-12">
                                <div class="box-header">

                                    <a href="{{ url('patients') }}"
                                       class="btn btn-icon waves-effect waves-light btn-info m-b-5">
                                        Manage Patient

                                    </a>

                                    <a href="{{ url('patients/'.$patient->id.'/edit') }}" class="btn btn-primary waves-effect m-b-5 waves-light">Edit Profile</a>


                                    <a href="{{ url('medical_records/'.$patient->id.'/edit') }}" style="float: right;" class="btn btn-danger waves-effect waves-light">Add Medical Record</a>



                                </div>
                                <hr>
                                <div class="box-header">
                                    <ul class="nav nav-tabs navtab-bg nav-justified">
                                        <li class="active">
                                            <a href="#general" data-toggle="tab" aria-expanded="false">
                                                <span class="visible-xs"><i class="fa fa-home"></i></span>
                                                <span class="hidden-xs">Patient Info</span>
                                            </a>
                                        </li>
                                        <li class="">
                                            <a href="#drug" data-toggle="tab" aria-expanded="false">
                                                <span class="visible-xs"><i class="fa fa-medkit"></i></span>
                                                <span class="hidden-xs">Drug Allergy</span>
                                            </a>
                                        </li>
                                        <li class="">
                                            <a href="#record" data-toggle="tab" aria-expanded="false">
                                                <span class="visible-xs"><i class="fa fa-pencil-square"></i></span>
                                                <span class="hidden-xs">Medical Records</span>
                                            </a>
                                        </li>


                                    </ul>
                                </div>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="general">
                                        <div class="text-center card-box">
                                            <div class="member-card">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <table border="1" width="100%" cellspacing="10px">

                                                            <tr style="height: 40px;">
                                                                <td width="40%" style="background-color: whitesmoke; font-weight: bold;">Full Name</td>
                                                                <td>{{ $patient->patient_info['full_name'] }}</td>
                                                            </tr>
                                                            <tr style="height: 40px;">
                                                                <td width="40%" style="background-color: whitesmoke; font-weight: bold;">Patient Code</td>
                                                                <td style="font-weight: bold;color: #1f648b;">{{ $patient->patient_code }}</td>
                                                            </tr>
                                                            <tr style="height: 40px;">
                                                                <td width="40%" style="background-color: whitesmoke; font-weight: bold;">Contact No</td>
                                                                <td>{{ $patient->patient_info['contact_no'] }}</td>
                                                            </tr>
                                                            <tr style="height: 40px;">
                                                                <td width="40%" style="background-color: whitesmoke; font-weight: bold;">Date Of Birth</td>
                                                                <td>{{ date('d-M-Y', strtotime($patient->patient_info['date_of_birth'])) }}</td>
                                                            </tr>
                                                            <tr style="height: 40px;">
                                                                @php $age = date('Y', strtotime(Carbon\Carbon::now())) - date('Y', strtotime($patient->patient_info['date_of_birth'])); @endphp
                                                                <td width="40%" style="background-color: whitesmoke; font-weight: bold;">Age</td>
                                                                <td>{{ $age }}</td>
                                                            </tr>
                                                            <tr style="height: 40px;">
                                                                <td width="40%" style="background-color: whitesmoke; font-weight: bold;">Blood Group</td>
                                                                <td>{{ $patient->medical_info['blood_group'] }}</td>
                                                            </tr>

                                                            <tr style="height: 40px;">
                                                                <td width="40%" style="background-color: whitesmoke; font-weight: bold;">Gender</td>

                                                                @if($patient->pateint_info['gender'] == 1)
                                                                    <td>Male</td>
                                                                @else
                                                                    <td>Female</td>
                                                                @endif

                                                            </tr>
                                                            <tr style="height: 40px;">
                                                                <td width="40%" style="background-color: whitesmoke; font-weight: bold;">Address</td>
                                                                <td>{{ $patient->patient_info['address'] }}</td>
                                                            </tr>

                                                            <tr style="height: 40px;">
                                                                <td width="40%" style="background-color: whitesmoke; font-weight: bold;">Created By</td>
                                                                <td>{{ $patient->users['name'] }}({{ $patient->users->roles['role_name'] }})</td>
                                                            </tr>

                                                        </table>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <table border="1" width="100%" cellspacing="10px">

                                                            <tr style="height: 40px;">
                                                                <td width="40%" style="background-color: whitesmoke; font-weight: bold;">Relative Contact</td>
                                                                <td>{{ $patient->patient_info['rel_contact_no'] }}</td>
                                                            </tr>
                                                            <tr style="height: 40px;">
                                                                <td width="40%" style="background-color: whitesmoke; font-weight: bold;">Martial</td>
                                                                <td>{{ $patient->patient_info['martial'] }}</td>
                                                            </tr>
                                                            <tr style="height: 40px;">
                                                                <td width="40%" style="background-color: whitesmoke; font-weight: bold;">{{ $patient->patient_info['patient_identity_name'] }}</td>
                                                                <td>{{ $patient->patient_info['patient_identity_no'] }}</td>
                                                            </tr>
                                                            <tr style="height: 40px;">
                                                                <td width="40%" style="background-color: whitesmoke; font-weight: bold;">Date Of Birth</td>
                                                                <td>{{ date('d-M-Y', strtotime($patient->patient_info['date_of_birth'])) }}</td>
                                                            </tr>
                                                            <tr style="height: 40px;">
                                                                @php $age = date('Y', strtotime(Carbon\Carbon::now())) - date('Y', strtotime($patient->patient_info['date_of_birth'])); @endphp
                                                                <td width="40%" style="background-color: whitesmoke; font-weight: bold;">Age</td>
                                                                <td>{{ $age }}</td>
                                                            </tr>
                                                            <tr style="height: 40px;">
                                                                <td width="40%" style="background-color: whitesmoke; font-weight: bold;">Had an Surgery</td>
                                                                <td>
                                                                    @if($patient->medical_info['surgery'] == 0)
                                                                        Yes
                                                                    @elseif($patient->medical_info['surgery'] == 1)
                                                                        No
                                                                    @else
                                                                        I Don't Know
                                                                    @endif
                                                                </td>
                                                            </tr>

                                                            <tr style="height: 40px;">
                                                                <td width="40%" style="background-color: whitesmoke; font-weight: bold;">Past Illness</td>
                                                                <td>
                                                                    @if($patient->medical_info['illness'] == 0)
                                                                        Yes
                                                                    @elseif($patient->medical_info['illness'] == 1)
                                                                        No
                                                                    @else
                                                                        I Don't Know
                                                                    @endif
                                                                </td>


                                                            </tr>
                                                            <tr style="height: 40px;">
                                                                <td width="40%" style="background-color: whitesmoke; font-weight: bold;">G6PD Deficiency</td>
                                                                <td>
                                                                    @if($patient->medical_info['g6pd'] == 0)
                                                                        Yes
                                                                    @elseif($patient->medical_info['g6pd'] == 1)
                                                                        No
                                                                    @else
                                                                        I Don't Know
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                            <tr style="height: 40px;">
                                                                <td width="40%" style="background-color: whitesmoke; font-weight: bold;">Insurance</td>
                                                                <td>{{ $patient->medical_info['insurance'] }}</td>
                                                            </tr>



                                                        </table>
                                                    </div>

                                                </div>

                                            </div>

                                        </div>
                                    </div>


                                    <div class="tab-pane" id="drug">
                                        <div class="text-center card-box">
                                            <div class="member-card">
                                                <div class="row">
                                                    <div class="col-md-12">

                                                        <table class="table table-striped m-0">
                                                            <thead>
                                                                <tr>
                                                                    <th width="5%" style="text-align: center">SR.No</th>
                                                                    <th width="40%" style="text-align: center">Drug Name</th>
                                                                    <th style="text-align: center">Drug Comment</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @php $i=1; @endphp
                                                                @foreach($patient->drug_allergy as $drug)
                                                                <tr style="height: 40px;">

                                                                    <td>{{ $i }}</td>
                                                                    <td>{{ $drug['drug_name'] }}</td>
                                                                    <td>{{ $drug['drug_comment'] }}</td>

                                                                </tr>
                                                                    @php  $i++ @endphp
                                                                @endforeach
                                                            </tbody>
                                                        </table>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="tab-pane" id="record">
                                        <div class="text-center card-box">
                                            <div class="member-card">
                                                @if($medical_records == null)
                                                    <h5 align="center">No Record</h5>
                                                @endif
                                                @php $ib=1; @endphp
                                                @foreach($medical_records as $record)
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="panel panel-default" style="border: none;">
                                                            <a data-toggle="collapse"
                                                               data-parent="#accordion-test"
                                                               href="#collapseOne{{$record->id}}"
                                                               class="collapsed"
                                                               >

                                                            <div class="panel-heading"
                                                                 style="background-color: whitesmoke;
                                                                 border: 2px solid #2b4a95 !important;border-radius: 25px;color: #2b4a95">
                                                                <h4 class="panel-title">
                                                                    <span style="float: left;color: #2b4a95;">
                                                                        #{{$ib}}
                                                                    </span>

                                                                    {{ date('d-M-Y',strtotime($record->created_at)) }}

                                                                </h4>
                                                            </div>
                                                            </a>
                                                            <div id="collapseOne{{$record->id}}" class="panel-collapse collapse">
                                                                <div class="panel-body">
                                                                    <div class="form-group row">
                                                                        <label for="patient_id" class="form-label col-sm-1">Doctor</label>
                                                                        <div class="col-sm-5">
                                                                                <input type="text" class="form-control"
                                                                                       value="{{ $record->user_informations->doctor_info['first_name'] }} {{ $record->user_informations->doctor_info['last_name'] }}" readonly>

                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group row">
                                                                        <label for="patient_id" class="form-label col-sm-1">Diagnoses</label>
                                                                        @for($i=0; $i < sizeof($record->diagnose); $i++)
                                                                        <div class="col-sm-2">
                                                                            <input type="text" class="form-control"
                                                                                   value="{{ $record->diagnose[$i] }}" readonly>

                                                                        </div>
                                                                        @endfor
                                                                    </div>



                                                                    <hr>



                                                                    <ul class="nav nav-tabs navtab-bg nav-justified">
                                                                        <li class="active">
                                                                            <a href="#health{{ $record->id }}" data-toggle="tab" aria-expanded="false">
                                                                                <span class="visible-xs"><i class="fa fa-home"></i></span>
                                                                                <span class="hidden-xs">Health Info</span>
                                                                            </a>
                                                                        </li>
                                                                        <li class="">
                                                                            <a href="#writing{{ $record->id }}" data-toggle="tab" aria-expanded="false">
                                                                                <span class="visible-xs"><i class="fa fa-user"></i></span>
                                                                                <span class="hidden-xs">Typing Note</span>
                                                                            </a>
                                                                        </li>


                                                                        <li class="">
                                                                            <a href="#drawing{{ $record->id }}" id="draw_pad" data-toggle="tab" aria-expanded="false">
                                                                                <span class="visible-xs"><i class="fa fa-envelope-o"></i></span>
                                                                                <span class="hidden-xs">Drawing Pad</span>
                                                                            </a>
                                                                        </li>

                                                                        <li class="">
                                                                            <a href="#template{{ $record->id }}" data-toggle="tab" aria-expanded="false">
                                                                                <span class="visible-xs"><i class="fa fa-envelope-o"></i></span>
                                                                                <span class="hidden-xs">Template</span>
                                                                            </a>
                                                                        </li>
                                                                        <li class="">
                                                                            <a href="#upload{{ $record->id }}" data-toggle="tab" aria-expanded="false">
                                                                                <span class="visible-xs"><i class="fa fa-envelope-o"></i></span>
                                                                                <span class="hidden-xs">Upload</span>
                                                                            </a>
                                                                        </li>


                                                                    </ul>
                                                                    <div class="tab-content">
                                                                        <div class="tab-pane active" id="health{{ $record->id }}">
                                                                            <div class="row">
                                                                                <div class="col-sm-12 col-xs-12 col-md-12">
                                                                                    <div class="row">
                                                                                        <div class="col-sm-12">
                                                                                            <div class="card-box">
                                                                                                <div class="row">
                                                                                                    <div class="col-md-4">
                                                                                                        <div class="form-group">

                                                                                                            <label for="weight" class="control-label">Weight</label>
                                                                                                            <div class="input-group m-t-10">
                                                                                                                <input type="text"
                                                                                                                       value="{{ $record->health_info['weight'] }}" readonly class="form-control"/>
                                                                                                                <span class="input-group-addon">kg</span>
                                                                                                            </div>



                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <div class="col-md-4">
                                                                                                        <div class="form-group">

                                                                                                            <label for="height" class="control-label">Height</label>
                                                                                                            <div class="input-group m-t-10">
                                                                                                                <input type="text"
                                                                                                                       value="{{ $record->health_info['height'] }}" readonly class="form-control"/>
                                                                                                                <span class="input-group-addon">cm</span>
                                                                                                            </div>


                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <div class="col-md-4">
                                                                                                        <div class="form-group">

                                                                                                            <label for="weight" class="control-label">BSA</label>
                                                                                                            <div class="input-group m-t-10">
                                                                                                                <input type="text"
                                                                                                                       value="{{ $record->health_info['bsa'] }}" readonly class="form-control"/>
                                                                                                                <span class="input-group-addon">m<span style="font-size: 10px; position: relative; top: -5px;">2</span></span>
                                                                                                            </div>


                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>

                                                                            </div>
                                                                        </div>


                                                                        <div class="tab-pane" id="writing{{ $record->id }}">
                                                                            <div class="row">
                                                                                <div class="col-sm-12 col-xs-12 col-md-12">
                                                                                    <div class="row">
                                                                                        <div class="col-sm-12">
                                                                                            <div class="card-box">
                                                                                                <div class="row">
                                                                                                    <div class="col-sm-12">
                                                                                                        {!! $record->typing_Note !!}
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>

                                                                            </div>
                                                                        </div>





                                                                        <div class="tab-pane" id="drawing{{ $record->id }}">
                                                                            <div class="row">
                                                                                <div class="col-sm-12 col-xs-12 col-md-12">
                                                                                    <div class="row">
                                                                                        <div class="col-sm-12">
                                                                                            <div class="card-box">
                                                                                                <div class="row">
                                                                                                    <div class="col-md-12">

                                                                                                        <img src="{{ $record->image_url }}" style="border: 2px solid black;"/>
                                                                                                        <br>
                                                                                                        <a href="{{ $record->image_url }}" download="Klinic" class="btn btn-primary">
                                                                                                            Download
                                                                                                        </a>

                                                                                                    </div>


                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>

                                                                                </div>

                                                                            </div>
                                                                        </div>

                                                                        <div class="tab-pane" id="template{{ $record->id }}">
                                                                            <div class="row">
                                                                                <div class="col-sm-12 col-xs-12 col-md-12">
                                                                                    <div class="row">
                                                                                        <div class="col-sm-12">
                                                                                            <div class="card-box">
                                                                                                @foreach($record->template as $temp)
                                                                                                <div class="form-group row">
                                                                                                    <label for="patient_id" class="form-label col-sm-12"><span style="float: left;">{{ $temp['question'] }} ?</span></label>
                                                                                                    @for($i=0; $i < sizeof($temp['answers']); $i++)
                                                                                                    <div class="col-sm-3">
                                                                                                        <input type="text" class="form-control"
                                                                                                               value="{{ $temp['answers'][$i] }}" readonly>

                                                                                                    </div>
                                                                                                    @endfor
                                                                                                </div>
                                                                                                @endforeach
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>



                                                                            </div>
                                                                        </div>

                                                                        <div class="tab-pane" id="upload{{ $record->id }}">
                                                                            <div class="row">
                                                                                <div class="col-sm-12 col-xs-12 col-md-12">
                                                                                    <div class="row">
                                                                                        <div class="col-sm-12">
                                                                                            <div class="card-box">
                                                                                                <div class="row">
                                                                                                @for($j=0; $j < sizeof($record->upload_file); $j++)
                                                                                                    <h5 align="left"><a href="{{ asset('uploads/'.$record->upload_file[$j]) }}" target="_blank">Image {{ $j+1 }}</a></h5>
                                                                                                @endfor
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>

                                                                            </div>


                                                                        </div>


                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                    @php $ib++ @endphp
                                                @endforeach




                                            </div>
                                        </div>
                                    </div>




                                </div>

                                <!-- end card-box -->

                            </div> <!-- end col -->


                            <!-- end col -->

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