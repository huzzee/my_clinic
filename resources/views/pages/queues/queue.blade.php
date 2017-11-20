@extends('layouts.mainHome')



@section('content')
    <!-- Start content -->
    <div class="content">
        <div class="container">


            <div class="row">
                <div class="col-xs-12">
                    <div class="page-title-box">

                        <h4 class="page-title">Manage Queue</h4>

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
                            Add Patient to Queue
                        </button>




                        {{--Modal--}}

                        <div id="con-close-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">

                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                        <h4 class="modal-title">Add To Queue</h4>
                                    </div>
                                    <form action="{{ route('queues.store') }}" method="post">
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

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="pats" class="control-label">Select Doctors<span class="text-danger">*</span></label>
                                                    <select class="form-control select2" id="doctor_id" name="doctor_id">
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


                                        <button type="submit" class="btn btn-inverse waves-effect" style="float: left;margin-right: 2%;">Add To Queue</button>
                                    </div>
                                    </form>
                                </div>
                            </div>

                        </div><!-- /.modal -->

                        <hr>


                        <table id="datatable-buttons" class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th width="1%">Sr.No</th>

                                <th width="12%">Patient</th>

                                <th width="12%">Doctor Name</th>

                                <th width="12%">Note</th>
                                <th width="8%">Bill</th>
                                <th width="8%">Paid</th>

                                <th width="14%">Actions</th>
                                <th width="10%">Status</th>
                                <th width="15%">Procedure</th>

                            </tr>
                            </thead>


                            <tbody>
                            @php $i=1;@endphp
                            @foreach($queues as $queue)
                                @if(Auth::user()->role_id == 3)
                                    @if($queue->user_informations->user_id == Auth::user()->id)
                                    <tr>
                                        <td>{{ $i }}</td>

                                        <td>{{ $queue->patients->patient_info['full_name'] }}({{ $queue->patients['patient_code'] }})</td>

                                        <td>{{ $queue->user_informations->doctor_info['first_name'] }} {{ $queue->user_informations->doctor_info['last_name'] }}</td>
                                        @if($queue->note == null)
                                            <td><button style=" font-size: 90%; background: none;float: left;text-align: left;
                                             border: none; color: #2b4a95" data-toggle="modal"
                                                        data-target="#con-close-modal{{$queue->id}}note">Add Note</button></td>
                                        @else
                                            <td><button style=" font-size: 90%; background: none;float: left;text-align: left;
                                             border: none; color: #2b4a95" data-toggle="modal"
                                                        data-target="#con-close-modal{{$queue->id}}note">{{$queue->note}}</button></td>


                                        @endif
                                        <div id="con-close-modal{{$queue->id}}note" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">

                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                        <h4 class="modal-title">Change Doctor</h4>
                                                    </div>
                                                    <form action="{{ url('queues_note') }}" method="post">
                                                        <div class="modal-body">

                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label for="pats" class="control-label">Important Note<span class="text-danger">*</span></label>
                                                                        <input name="note" class="form-control"
                                                                                  value="{{ $queue->note }}"/>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>

                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                                                            {{ csrf_field() }}

                                                            <input type="hidden" name="que_id" value="{{ $queue->id }}">
                                                            <button type="submit" class="btn btn-inverse waves-effect" style="float: left;margin-right: 2%;">Add Note</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>

                                        </div><!-- /.modal -->

                                        @if($queue->bill == null)
                                            <td>No</td>
                                        @else
                                            <td>{{$queue->bill}}</td>
                                        @endif

                                        @if($queue->paid == null)
                                            <td>No</td>
                                        @else
                                            <td>{{$queue->paid}}</td>
                                        @endif
                                        <td>
                                            @if($queue->status == 0)
                                                <button style=" font-size: 80%; background: none;float: left;text-align: left;
                                             border: none; color: #2b4a95" data-toggle="modal"
                                                        data-target="#con-close-modal{{$queue->id}}delete">#Delete Queue</button><br>


                                                <div id="con-close-modal{{$queue->id}}delete" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                <h4 class="modal-title">Warning!</h4>
                                                            </div>
                                                            <div class="modal-body">

                                                                Are You Sure.You want to delete This Queue.
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal" style="float: right;">Close</button>

                                                                <form action="{{ url('queues/'.$queue->id) }}" method="post">
                                                                    {{ csrf_field() }}
                                                                    <input type="hidden" name="_method" value="DELETE">
                                                                    <button type="submit" class="btn btn-danger waves-effect" style="float: right;margin-right: 2%;">Yes Delete it</button>

                                                                </form>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                            <a style=" font-size: 80%; background: none;float: left;text-align: left;
                                             border: none; color: #2b4a95" href="{{ url('medical_records/'.$queue->patients->id.'/edit') }}">#Add Medical Record</a><br>

                                            <button style=" font-size: 80%; background: none;float: left;text-align: left;
                                             border: none; color: #2b4a95" data-toggle="modal"
                                                    data-target="#con-close-modal{{$queue->user_informations->id}}">#Add MC</button><br>
                                        </td>
                                        @if($queue->status == 0)
                                            <td>Waiting</td>
                                        @elseif($queue->status == 1)
                                            <td>Engaged with doctor</td>
                                        @elseif($queue->status == 2)
                                            <td>Checked but Unpaid</td>
                                        @elseif($queue->status == 3)
                                            <td>Checked and Paid</td>
                                        @elseif($queue->status == 4)
                                            <td>Deleted</td>
                                        @endif


                                        @if($queue->status == 0)
                                            <td><a style=" font-size: 100%; font-weight: bold; background: none;float: left;text-align: left;
                                             border: none; color: #2b4a95" href="{{ url('payments/'.$queue->id.'/edit') }}">Check Out</a><br>
                                            </td>
                                        @elseif($queue->status == 1)
                                            <td><a style=" font-size: 100%; font-weight: bold; background: none;float: left;text-align: left;
                                             border: none; color: #2b4a95" href="{{ url('payments/'.$queue->id.'/edit') }}">Check Out</a><br>
                                            </td>
                                        @elseif($queue->status == 2)
                                            <td>Add Payment</td>
                                        @elseif($queue->status == 3)
                                            <td>Payment Completed</td>
                                        @elseif($queue->status == 4)
                                            <td>Deleted</td>
                                        @endif
                                    </tr>
                                    @endif
                                @else
                                    <tr>
                                        <td>{{ $i }}</td>

                                        <td>{{ $queue->patients->patient_info['full_name'] }}({{ $queue->patients['patient_code'] }})</td>

                                        <td>{{ $queue->user_informations->doctor_info['first_name'] }} {{ $queue->user_informations->doctor_info['last_name'] }}</td>
                                        @if($queue->note == null)
                                            <td><button style=" font-size: 90%; background: none;float: left;text-align: left;
                                             border: none; color: #2b4a95" data-toggle="modal"
                                                        data-target="#con-close-modal{{$queue->id}}note">Add Note</button></td>
                                        @else
                                            <td><button style=" font-size: 90%; background: none;float: left;text-align: left;
                                             border: none; color: #2b4a95" data-toggle="modal"
                                                        data-target="#con-close-modal{{$queue->id}}note">{{$queue->note}}</button></td>


                                        @endif
                                        <div id="con-close-modal{{$queue->id}}note" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">

                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                        <h4 class="modal-title">Add Note</h4>
                                                    </div>
                                                    <form action="{{ url('queues_note') }}" method="post">
                                                        <div class="modal-body">

                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label for="pats" class="control-label">Important Note<span class="text-danger">*</span></label>
                                                                        <input name="note" class="form-control"
                                                                               value="{{ $queue->note }}"/>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>

                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                                                            {{ csrf_field() }}

                                                            <input type="hidden" name="que_id" value="{{ $queue->id }}">
                                                            <button type="submit" class="btn btn-inverse waves-effect" style="float: left;margin-right: 2%;">Add Note</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>

                                        </div><!-- /.modal -->

                                        @if($queue->bill == null)
                                            <td>No</td>
                                        @else
                                            <td>{{$queue->bill}}</td>
                                        @endif

                                        @if($queue->paid == null)
                                            <td>No</td>
                                        @else
                                            <td>{{$queue->paid}}</td>
                                        @endif
                                        <td>
                                        @if($queue->status == 0 || $queue->status == 1)
                                                <button style=" font-size: 80%; background: none;float: left;text-align: left;
                                             border: none; color: #2b4a95" data-toggle="modal"
                                                        data-target="#con-close-modal{{$queue->id}}delete">#Delete Queue</button><br>


                                                <div id="con-close-modal{{$queue->id}}delete" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                <h4 class="modal-title">Warning!</h4>
                                                            </div>
                                                            <div class="modal-body">

                                                                Are You Sure.You want to delete This Queue.
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal" style="float: right;">Close</button>

                                                                <form action="{{ url('queues/'.$queue->id) }}" method="post">
                                                                    {{ csrf_field() }}
                                                                    <input type="hidden" name="_method" value="DELETE">
                                                                    <button type="submit" class="btn btn-danger waves-effect" style="float: right;margin-right: 2%;">Yes Delete it</button>

                                                                </form>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                        @endif
                                        @if($queue->status == 0)
                                                <button style=" font-size: 80%; background: none;float: left;text-align: left;
                                             border: none; color: #2b4a95" data-toggle="modal"
                                                        data-target="#con-close-modal{{$queue->user_informations->id}}doc">#Change Doctor</button><br>

                                                <div id="con-close-modal{{$queue->user_informations->id}}doc" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">

                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                <h4 class="modal-title">Change Doctor</h4>
                                                            </div>
                                                            <form action="{{ url('queues_doc') }}" method="post">
                                                                <div class="modal-body">

                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <div class="form-group">
                                                                                <label for="pats" class="control-label">Select Doctors<span class="text-danger">*</span></label>
                                                                                <select class="form-control select2" id="doctor_id" name="doctor_id">
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

                                                                    <input type="hidden" name="old_doc" value="{{ $queue->user_informations->id }}">
                                                                    <button type="submit" class="btn btn-inverse waves-effect" style="float: left;margin-right: 2%;">Add To Queue</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>

                                                </div><!-- /.modal -->
                                        @endif
                                            
                                            <a style=" font-size: 80%; background: none;float: left;text-align: left;
                                             border: none; color: #2b4a95" href="{{ url('medical_records/'.$queue->patients->id.'/edit') }}">#Add Medical Record</a><br>

                                            <button style=" font-size: 80%; background: none;float: left;text-align: left;
                                             border: none; color: #2b4a95" data-toggle="modal"
                                                    data-target="#con-close-modal{{$queue->user_informations->id}}">#Add MC</button><br>


                                        </td>
                                        @if($queue->status == 0)
                                            <td>Waiting</td>
                                        @elseif($queue->status == 1)
                                            <td>Engaged with doctor</td>
                                        @elseif($queue->status == 2)
                                            <td>Checked but Unpaid</td>
                                        @elseif($queue->status == 3)
                                            <td>Checked and Paid</td>
                                        @elseif($queue->status == 4)
                                            <td>Deleted</td>
                                        @endif




                                        @if($queue->status == 0)
                                            <td>Waiting</td>
                                        @elseif($queue->status == 1)
                                            <td>Engaging</td>
                                        @elseif($queue->status == 2)
                                            <td>Add Payment</td>
                                        @elseif($queue->status == 3)
                                            <td>Payment Completed</td>
                                        @elseif($queue->status == 4)
                                            <td>Deleted</td>
                                        @endif
                                    </tr>
                                @endif
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