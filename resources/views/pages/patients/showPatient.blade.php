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
                                       class="btn btn-icon waves-effect waves-light btn-danger m-b-5">
                                        Manage Patient

                                    </a>



                                    <a href="javascript:void(0);"
                                       onclick="window.print();"
                                       class="btn btn-icon waves-effect waves-light btn-inverse m-b-5">
                                        <i class="fa fa-print"></i>

                                    </a>


                                </div>

                                <div class="text-center card-box">
                                    <div class="member-card">
                                        <div class="row">
                                            <div class="col-sm-4">

                                        {{--end model--}}
                                                <div class="text-left">
                                                    <h5>Patient General Info</h5>
                                                    <hr>
                                                    <p class="text-muted font-13"><strong>Full Name :</strong> <span class="m-l-15">{{ $patient->patient_info['full_name'] }}</span></p>

                                                    <p class="text-muted font-13"><strong>Patient_code :</strong> <span class="m-l-15">{{ $patient->patient_code }}</span></p>


                                                    <p class="text-muted font-13"><strong>Contact No :</strong> <span class="m-l-15">
                                                            {{ $patient->patient_info['contact_no'] }}</span></p>


                                                    <p class="text-muted font-13"><strong>Email :</strong> <span class="m-l-15">{{ $patient->patient_info['email'] }}</span></p>

                                                    <p class="text-muted font-13"><strong>Relative Contact :</strong> <span class="m-l-15">{{ $patient->patient_info['rel_contact_no'] }}</span></p>

                                                    <p class="text-muted font-13"><strong>Address :</strong> <span class="m-l-15">{{ $patient->patient_info['address'] }}</span></p>

                                                    <p class="text-muted font-13"><strong>Martial Status :</strong> <span class="m-l-15">{{ $patient->patient_info['martial'] }}</span></p>

                                                    <p class="text-muted font-13"><strong>{{ $patient->patient_info['patient_identity_name'] }}:</strong> <span class="m-l-15">{{ $patient->patient_info['patient_identity_no'] }}</span></p>

                                                    <p class="text-muted font-13"><strong>Created By :</strong> <span class="m-l-15">{{ $patient->users['name'] }}({{ $patient->users->roles['role_name'] }})</span></p>


                                                    <hr>
                                                </div>



                                            </div>
                                            <div class="col-sm-4">

                                                {{--end model--}}
                                                <div class="text-left">
                                                    <h5>Medical Info</h5>
                                                    <hr>

                                                    <p class="text-muted font-13"><strong>Gender :</strong><span class="m-l-15">
                                                        @if($patient->patient_info['gender'] == 0)
                                                            Male
                                                        @elseif($patient->patient_info['gender'] == 1)
                                                            Female
                                                        @else
                                                            Others
                                                        @endif
                                                    </span></p>


                                                    @php $age = date('Y', strtotime(Carbon\Carbon::now())) - date('Y', strtotime($patient->patient_info['date_of_birth'])); @endphp
                                                    <p class="text-muted font-13"><strong>Age :</strong>
                                                        <span class="m-l-15">
                                                        {{$age}}
                                                        </span>
                                                    </p>

                                                    <p class="text-muted font-13"><strong>Blood Group :</strong> <span class="m-l-15">{{ $patient->medical_info['blood_group'] }}</span></p>

                                                    <p class="text-muted font-13"><strong>Had Any Surgery :</strong> <span class="m-l-15">
                                                            @if($patient->medical_info['surgery'] == 0)
                                                                Yes
                                                            @elseif($patient->medical_info['surgery'] == 1)
                                                                No
                                                            @else
                                                                I Don't Know
                                                            @endif
                                                        </span>
                                                    </p>

                                                    <p class="text-muted font-13"><strong>Past Illness :</strong> <span class="m-l-15">
                                                            @if($patient->medical_info['illness'] == 0)
                                                                Yes
                                                            @elseif($patient->medical_info['illness'] == 1)
                                                                No
                                                            @else
                                                                I Don't Know
                                                            @endif
                                                        </span>
                                                    </p>

                                                    <p class="text-muted font-13"><strong>G6PD deficiency :</strong> <span class="m-l-15">
                                                            @if($patient->medical_info['g6pd'] == 0)
                                                                Yes
                                                            @elseif($patient->medical_info['g6pd'] == 1)
                                                                No
                                                            @else
                                                                I Don't Know
                                                            @endif
                                                        </span>
                                                    </p>

                                                    <p class="text-muted font-13"><strong>Insurance :</strong> <span class="m-l-15">{{ $patient->medical_info['insurance'] }}</span></p>
                                                </div>
                                                <hr>

                                            </div>
                                            <div class="col-sm-4">

                                                {{--end model--}}
                                                <div class="text-left">
                                                    <h5>Drug Allergy</h5>
                                                    <hr>
                                                    @foreach($patient->drug_allergy['drug_name'] as $drug)
                                                     <span class="m-l-15">{{ $drug }}</span></p>
                                                    @endforeach


                                                </div>



                                            </div>
                                        </div>

                                            {{--model for activate and deactivate users--}}
                                    </div>
                                    <hr/>

                                    <div class="box-header">
                                        <a href="{{ url('patients/'.$patient->id.'/edit') }}" class="btn btn-info btn-sm w-sm waves-effect m-t-10 waves-light">Edit Profile</a>

                                    </div>

                                </div><!-- end card-box -->

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

@endsection

<!--*********Page Scripts End*********-->