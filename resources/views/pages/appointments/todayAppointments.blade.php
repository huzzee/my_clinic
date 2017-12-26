
@extends('layouts.mainHome')



@section('content')
    <!-- Start content -->
    <div class="content">
        <div class="container">


            <div class="row">
                <div class="col-xs-12">
                    <div class="page-title-box">

                        <h4 class="page-title">Completed Appointment List</h4>

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

                        <a class="btn btn-info" href="{{ url('appointments') }}">Pending Appointments</a>

                        <button class="btn btn-danger waves-effect waves-light" data-toggle="modal"
                                data-target="#con-close-modal">
                            Add Appointment
                        </button>

                        <div id="con-close-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">

                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                        <h4 class="modal-title">Add Appointment</h4>
                                    </div>
                                    <form action="{{ url('appointments_add') }}" method="post">
                                        <div class="modal-body">


                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="pats" class="control-label">Select Patient<span class="text-danger">*</span></label>
                                                        <select class="form-control select2" id="patient_id" name="patient_id">
                                                            <option selected disabled="disabled">Select Patient</option>

                                                            @foreach($patients as $patient)
                                                                <option value="{{ $patient->id }}">{{ $patient->patient_info['full_name'] }}({{$patient->patient_code}})</option>
                                                            @endforeach

                                                        </select>
                                                    </div>
                                                </div>

                                            </div>

                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                                            {{ csrf_field() }}


                                            <button type="submit" class="btn btn-inverse waves-effect" style="float: left;margin-right: 2%;">Submit</button>
                                        </div>
                                    </form>
                                </div>
                            </div>

                        </div><!-- /.modal -->

                        <a class="btn btn-pink" href="{{ url('appointments_cancel') }}">Canceled Appointments</a>

                        <hr>


                        <table id="datatable-buttons" class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th width="2%">Sr.No</th>
                                <th>Patient Name</th>
                                <th>Patient Code</th>
                                <th>Doctor Name </th>
                                <th>Appointment Date</th>
                                <th>Appointment Time</th>
                                <th>Manage</th>
                                @if(Auth::user()->role_id == 2)
                                <th width="5%">Action</th>
                                @endif

                            </tr>
                            </thead>


                            <tbody>
                            @php $i=1;@endphp
                            @foreach($appointments as $appointment)
                                <tr>
                                    <td>{{ $i }}</td>

                                    <td>{{ $appointment->patients->patient_info['full_name'] }}</td>
                                    <td>{{ $appointment->patients->patient_code }}</td>
                                    <td>{{ $appointment->user_informations->users->name }}</td>
                                    <td>{{ date('d-M-Y',strtotime($appointment->appointment_date)) }}</td>
                                    <td>{{ $appointment->schedule_details->start_time }}  <b>TO</b>  {{ $appointment->schedule_details->end_time }}</td>
                                    <td>
                                        <button
                                            style="font-weight: bold; font-size: 100%; background: none; border: none; color: #2b4a95"
                                            data-toggle="modal" data-target="#con-close-modal{{$patient->patient_code}}">#Add to queue</button>

                                        <div id="con-close-modal{{$patient->patient_code}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">

                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                        <h4 class="modal-title">Add To Queue</h4>
                                                    </div>
                                                    <form action="{{ route('queues.store') }}" method="post">

                                                        <div class="modal-body">


                                                            <div class="row">
                                                                <div class="col-sm-12">
                                                                    <div class="form-group">
                                                                        <label for="pats" class="control-label">Select Doctor<span class="text-danger">*</span></label>
                                                                        <select class="form-control select2" name="doctor_id">
                                                                            <option selected disabled="disabled">Select Doctors</option>

                                                                            @foreach($doctors as $doctor)
                                                                                <option value="{{ $doctor->id }}">{{ $doctor->users->name}}</option>
                                                                            @endforeach

                                                                        </select>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>


                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                                                            {{ csrf_field() }}
                                                            <input type="hidden" name="patient_id" value="{{$appointment->patients->id}}">

                                                            <button type="submit" class="btn btn-inverse waves-effect" style="float: left;margin-right: 2%;">Add To Queue</button>


                                                        </div>
                                                    </form>
                                                </div>

                                            </div>

                                        </div>
                                    </td>
                                    @if(Auth::user()->role_id == 2)
                                    <td>

                                        <button class="btn btn-icon waves-effect waves-light btn-danger m-b-5" data-toggle="modal" data-target="#con-close-modal{{$appointment->id}}"><i class="fa fa-remove"></i></button>

                                    </td>
                                    @endif
                                </tr>

                                <div id="con-close-modal{{$appointment->id}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                <h4 class="modal-title">Warning!</h4>
                                            </div>
                                            <div class="modal-body">

                                                Are You Sure.You want to delete it.
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal" style="float: right;">Close</button>

                                                <form action="{{ url('appointments/'.$appointment->id) }}" method="post">
                                                    {{ csrf_field() }}
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <button type="submit" class="btn btn-danger waves-effect" style="float: right;margin-right: 2%;">Delete it</button>

                                                </form>





                                            </div>
                                        </div>
                                    </div>
                                </div>


                                @php $i++; @endphp
                            @endforeach
                            </tbody>
                        </table>
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

    <script src="{{ asset('assets/plugins/datatables/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables/buttons.bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables/jszip.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables/pdfmake.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables/vfs_fonts.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables/buttons.print.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables/dataTables.fixedHeader.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables/dataTables.keyTable.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables/responsive.bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables/dataTables.scroller.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables/dataTables.colVis.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatables/dataTables.fixedColumns.min.js') }}"></script>

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