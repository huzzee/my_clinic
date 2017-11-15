
@extends('layouts.mainHome')



@section('content')
    <!-- Start content -->
    <div class="content">
        <div class="container">


            <div class="row">
                <div class="col-xs-12">
                    <div class="page-title-box">

                        <h4 class="page-title">Pending Leaves</h4>

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

                        <a class="btn btn-danger" href="{{ url('leaves') }}">Manage Leave</a>

                        <hr>


                        <table id="datatable-buttons" class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th width="2%">Sr.No</th>
                                <th width="5%">Image</th>

                                <th>Doctor Name </th>
                                <th width="15%">Leave Type</th>
                                <th>Leave Date</th>
                                <th>Reason</th>

                                <th width="15%">Permission</th>

                            </tr>
                            </thead>


                            <tbody>
                            @php $i=1;@endphp
                            @foreach($leaves as $leave)
                                @if($leave->approved == null || $leave->approved == 0)
                                <tr>
                                    <td>{{ $i }}</td>

                                    <td><img src="{{ asset('uploads/'.$leave->user_informations->users->profile_image) }}"
                                             alt="{{ $leave->user_informations->users->profile_image }}" style="height: 50px; width: 50px;"></td>
                                    <td>{{ $leave->user_informations->users->name }}</td>
                                    @if($leave->leave_type == 0)
                                        <td>Half Day Leave</td>
                                    @elseif($leave->leave_type == 1)
                                        <td>Full Day leave</td>
                                    @else
                                        <td>Many Days Leave</td>
                                    @endif

                                    @if($leave->leave_type == 0)
                                        <td>
                                            {{date('d-M-Y',strtotime($leave->leave_length['half_day_date']))}}
                                            ({{$leave->leave_length['start_time_half']}} to {{$leave->leave_length['end_time_hlaf']}})
                                        </td>
                                    @elseif($leave->leave_type == 1)
                                        <td>{{date('d-M-Y',strtotime($leave->leave_length['ful_day_date']))}}</td>
                                    @else
                                        <td>{{date('d-M-Y',strtotime($leave->leave_length['start_many']))}} to {{date('d-M-Y',strtotime($leave->leave_length['end_many']))}}</td>
                                    @endif

                                    <td>{{$leave->reason}}</td>

                                    @if($leave->approved === null)
                                    <td>
                                        <form action="{{ url('leaves_approved/'.$leave->id) }}" method="post">
                                            {{ csrf_field() }}

                                            <button type="submit" class="btn btn-icon waves-effect waves-light btn-success m-b-5" style="float: left"><i class="fa fa-check"></i></button>

                                        </form>
                                        <form action="{{ url('leaves_rejected/'.$leave->id) }}" method="post">
                                            {{ csrf_field() }}

                                            <button type="submit" class="btn btn-icon waves-effect waves-light btn-danger m-b-5"><i class="fa fa-remove"></i></button>

                                        </form>



                                    </td>
                                    @else
                                    <td>Rejected</td>
                                    @endif
                                </tr>




                                @php $i++; @endphp
                                @endif
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