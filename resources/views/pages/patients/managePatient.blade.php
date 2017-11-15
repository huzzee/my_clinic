@extends('layouts.mainHome')



@section('content')
    <!-- Start content -->
    <div class="content">
        <div class="container">


            <div class="row">
                <div class="col-xs-12">
                    <div class="page-title-box">

                        <h4 class="page-title">Manage Patients</h4>

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

                        <a class="btn btn-danger" href="{{ url('patients/create') }}">Create Patient</a>

                        <hr>


                        <table id="datatable-buttons" class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th width="2%">Sr.No</th>

                                <th>Name</th>
                                <th width="12%">Patient Code</th>
                                <th width="18%">Contact No</th>


                                <th width="8%">Gender</th>

                                <th width="8%">Age</th>


                                <th width="18%">Shortcuts</th>
                                <th width="15%">Action</th>

                            </tr>
                            </thead>


                            <tbody>
                            @php $i=1;@endphp
                            @foreach($patients as $patient)
                                <tr>
                                    <td>{{ $i }}</td>

                                    <td>{{ $patient->patient_info['full_name'] }}</td>
                                    <td style="color: #017ebc; font-weight: bold">{{ $patient['patient_code'] }}</td>
                                    <td>{{ $patient->patient_info['contact_no'] }}</td>



                                    @if($patient->patient_info['gender'] == 0)
                                        <td>Male</td>
                                    @elseif($patient->patient_info['gender'] == 1)
                                        <td>Female</td>
                                    @else
                                        <td>Other</td>
                                    @endif
                                    @php $age = date('Y', strtotime(Carbon\Carbon::now())) - date('Y', strtotime($patient->patient_info['date_of_birth'])); @endphp
                                    <td>{{ $age }}</td>
                                    <td>
                                        <a href="{{ url('medical_records/'.$patient->id.'/edit') }}"
                                        style="font-weight: bold; font-size: 200%;"
                                           data-toggle="tooltip" data-placement="top" title=""
                                           data-original-title="Add Medical Record">M</a>
                                        &nbsp;
                                        <a href="#"
                                           style="font-weight: bold; font-size: 200%;"
                                           data-toggle="tooltip" data-placement="top" title=""
                                           data-original-title="Add Queue">Q</a>
                                        &nbsp;
                                        <a href="#"
                                           style="font-weight: bold; font-size: 200%;"
                                           data-toggle="tooltip" data-placement="top" title=""
                                           data-original-title="Add Payment">P</a>
                                        &nbsp;
                                        <a href="#"
                                           style="font-weight: bold; font-size: 200%;"
                                           data-toggle="tooltip" data-placement="top" title=""
                                           data-original-title="Add Appointment ">A</a>
                                        &nbsp;
                                        <a href="#"
                                           style="font-weight: bold; font-size: 200%;"
                                           data-toggle="tooltip" data-placement="top" title=""
                                           data-original-title="Add Invoice">I</a>
                                        &nbsp;

                                    </td>
                                    <td>

                                        <a href="{{ url('patients/'.$patient->id) }}" class="btn btn-icon waves-effect waves-light btn-teal m-b-5" style="">
                                            <i class="fa fa-eye"></i>
                                        </a>


                                        <a href="{{ url('patients/'.$patient->id.'/edit') }}" class="btn btn-icon waves-effect waves-light btn-info m-b-5" style=""><i class="fa fa-edit"></i></a>

                                        <button class="btn btn-icon waves-effect waves-light btn-danger m-b-5" data-toggle="modal" data-target="#con-close-modal{{$patient->id}}"><i class="fa fa-remove"></i></button>

                                    </td>
                                </tr>

                                <div id="con-close-modal{{$patient->id}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                <h4 class="modal-title">Warning!</h4>
                                            </div>
                                            <div class="modal-body">

                                                Are You Sure.You want to delete This patient.
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal" style="float: right;">Close</button>

                                                <form action="{{ url('patients/'.$patient->id) }}" method="post">
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
                    </div>
                </div>
            </div>

        </div> <!-- container -->

    </div> <!-- content -->

@endsection

<!--*********Page Scripts Here*********-->

@section('scripts')
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
@endsection

<!--*********Page Scripts End*********-->