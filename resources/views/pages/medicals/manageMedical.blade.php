@extends('layouts.mainHome')



@section('content')
    <!-- Start content -->
    <div class="content">
        <div class="container">


            <div class="row">
                <div class="col-xs-12">
                    <div class="page-title-box">

                        <h4 class="page-title">Manage Medical Records</h4>

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

                    <div class="card-box table-responsive">
                        <button class="btn btn-danger waves-effect waves-light" data-toggle="modal"
                                data-target="#con-close-modal">
                            Add Medical Record
                        </button>

                        <a class="btn btn-info" href="{{ url('deleted_medical_records') }}">Deleted Records</a>


                        {{--Modal--}}

                        <div id="con-close-modal" class="modal fade" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">

                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                            <h4 class="modal-title">Add Record</h4>
                                        </div>
                                        <form action="{{ url('medical_edit') }}" method="post">
                                        <div class="modal-body">


                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="pats" class="control-label">Select Patient<span class="text-danger">*</span></label>
                                                        <select class="form-control select2" name="patient_id">
                                                            <option selected disabled="disabled">Select Patient</option>

                                                            @foreach($patients as $patient)
                                                                <option value="{{ $patient->id }}">{{ $patient->patient_info['full_name'] }}({{$patient->patient_code}})</option>
                                                            @endforeach

                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="pats" class="control-label">Select Doctor<span class="text-danger">*</span></label>
                                                        <select class="form-control select2" name="doctor_id">
                                                            <option selected disabled="disabled">Select Doctor</option>

                                                            @foreach($doctors as $doctor)
                                                                <option value="{{ $doctor->id }}">{{ $doctor->users['name'] }}</option>
                                                            @endforeach

                                                        </select>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                        <div class="modal-footer">
                                            {{ csrf_field() }}

                                            <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-inverse waves-effect waves-light">Add Record</button>
                                        </div>
                                        </form>
                                    </div>
                                </div>

                        </div><!-- /.modal -->

                        <hr>


                        <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive">
                            <thead>
                            <tr>
                                <th width="2%">Sr.No</th>

                                <th>Patient Name</th>
                                <th width="12%">Patient Code</th>
                                <th>Doctor Name</th>
                                <th>Created At</th>

                                <th width="15%">Action</th>

                            </tr>
                            </thead>


                            <tbody>
                            @php $i=1;@endphp
                            @foreach($records as $record)
                                <tr>
                                    <td>{{ $i }}</td>

                                    <td>{{ $record->patients->patient_info['full_name'] }}</td>
                                    <td style="color: #017ebc; font-weight: bold">{{ $record->patients['patient_code'] }}</td>
                                    <td>{{ $record->user_informations->doctor_info['first_name'] }} {{ $record->user_informations->doctor_info['last_name'] }}</td>
                                    <td>{{ date('d-M-Y',strtotime($record->created_at)) }}</td>

                                    <td>

                                        <button class="btn btn-icon waves-effect waves-light btn-teal m-b-5" data-toggle="modal" data-target="#full-width-modal-show{{$record->id}}"><i class="fa fa-eye"></i></button>

                                        @if(Auth::user()->role_id == 2)
                                        <button class="btn btn-icon waves-effect waves-light btn-danger m-b-5" data-toggle="modal" data-target="#con-close-modal{{$record->id}}"><i class="fa fa-remove"></i></button>
                                        @endif
                                    </td>
                                </tr>

                                <div id="con-close-modal{{$record->id}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                <h4 class="modal-title">Warning!</h4>
                                            </div>
                                            <div class="modal-body">

                                                Are You Sure.You want to delete This Record.
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal" style="float: right;">Close</button>

                                                <form action="{{ url('medical_records/'.$record->id) }}" method="post">
                                                    {{ csrf_field() }}
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <button type="submit" class="btn btn-danger waves-effect" style="float: right;margin-right: 2%;">Yes Delete it</button>

                                                </form>

                                            </div>
                                        </div>
                                    </div>
                                </div>


                                @php $i++; @endphp
                            @endforeach
                            </tbody>
                        </table>
                        @foreach($records as $record)
                            {{--start show modal--}}

                            <div id="full-width-modal-show{{$record->id}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="full-width-modalLabel" aria-hidden="true" style="display: none;">
                                <div class="modal-dialog" style="width: 70%;">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                            <h4 class="modal-title" id="full-width-modalLabel">Medical Record</h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="text-center card-box">
                                                        <div class="member-card">

                                                            <div class="row">
                                                                <div class="col-md-4">
                                                                    <div class="form-group" align="left">
                                                                        <label for="pats" class="control-label">Patient Name</label>
                                                                        <input type="text" readonly class="form-control input-sm" value="{{ $record->patients->patient_info['full_name'] }}">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group" align="left">
                                                                        <label for="pats" class="control-label">Patient Code</label>
                                                                        <input type="text" readonly class="form-control input-sm" value="{{ $record->patients->patient_code }}">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group" align="left">
                                                                        <label for="pats" class="control-label">Doctor Name</label>
                                                                        <input type="text" readonly class="form-control input-sm" value="{{ $record->user_informations->doctor_info['first_name'] }} {{ $record->user_informations->doctor_info['last_name'] }}">
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-12">
                                                                    <div class="form-group" align="left">
                                                                        <label for="pats" class="control-label">Diagnose</label>
                                                                        <input type="text" readonly class="form-control input-sm" value="{{ $record->diagnose }}">
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-12">
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
                                                                                                        @if(sizeof($temp['answers']) > 1)
                                                                                                            @for($i=0; $i < sizeof($temp['answers']); $i++)
                                                                                                                <div class="col-sm-3">
                                                                                                                    <input type="text" class="form-control"
                                                                                                                           value="{{ $temp['answers'][$i] }}" readonly>

                                                                                                                </div>
                                                                                                            @endfor
                                                                                                        @else
                                                                                                            <div class="col-sm-3">
                                                                                                                <input type="text" class="form-control"
                                                                                                                       value="{{ $temp['answers'] }}" readonly>

                                                                                                            </div>
                                                                                                        @endif
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
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>

                                        </div>
                                    </div><!-- /.modal-content -->
                                </div><!-- /.modal-dialog -->
                            </div><!-- /.modal -->
                            {{--end show modal--}}
                        @endforeach
                    </div>
                </div>
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

    <script src="{{ asset('assets/pages/jquery.form-advanced.init.js') }}"></script>

    <script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables/dataTables.bootstrap.js') }}"></script>



    <script src="{{ asset('assets/plugins/datatables/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables/responsive.bootstrap.min.js') }}"></script>


    <!-- init -->
    <script src="{{ asset('assets/pages/jquery.datatables.init.js') }}"></script>


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
@endsection

<!--*********Page Scripts End*********-->