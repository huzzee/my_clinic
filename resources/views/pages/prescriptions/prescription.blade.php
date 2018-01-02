@extends('layouts.mainHome')



@section('content')
    <!-- Start content -->
    <div class="content">
        <div class="container">


            <div class="row">
                <div class="col-xs-12">
                    <div class="page-title-box">

                        <h4 class="page-title">Manage Prescriptions</h4>

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

                        <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive">
                            <thead>
                            <tr>
                                <th width="5%">Sr.No</th>
                                <th>Patient Name</th>
                                <th>Doctor Name</th>
                                <th width="40%">Prescriptions</th>
                                <th>Action</th>

                            </tr>
                            </thead>


                            <tbody>
                            @php $i=1; @endphp
                            @foreach($prescriptions as $prescription)
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td>{{ $prescription->patients->patient_info['full_name'] }}</td>
                                    <td>{{ $prescription->user_informations->users->name }}</td>
                                    <td>
                                        @foreach($prescription->prescriptions as $items)
                                            {{ $items['drug_name'] }}/
                                        @endforeach
                                    </td>
                                    <td>
                                        {{--<a href="{{ url('prescriptions/'.$prescription->id.'/edit') }}"
                                           class="btn btn-icon waves-effect waves-light btn-teal m-b-5"
                                           >
                                            <i class="fa fa-pencil"></i>
                                        </a>--}}

                                        <a href="{{ url('prescriptions/'.$prescription->id) }}"
                                           class="btn btn-icon waves-effect waves-light btn-inverse m-b-5"
                                            target="_blank">
                                            <i class="fa fa-print"></i>
                                        </a>
                                    </td>

                                </tr>


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