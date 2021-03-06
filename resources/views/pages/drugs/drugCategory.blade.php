@extends('layouts.mainHome')



@section('content')
    <!-- Start content -->
    <div class="content">
        <div class="container">


            <div class="row">
                <div class="col-xs-12">
                    <div class="page-title-box">

                        <h4 class="page-title">Drugs Type</h4>

                        <div class="clearfix"></div>

                    </div>
                </div>
            </div>
            <!-- end row -->

            <div class="row">
                <div class="col-xs-12">
                    <div class="card-box">

                        <div class="row">
                            <div class="col-sm-12 col-xs-12 col-md-12">

                                <h4 class="header-title m-t-0">Create Drug Type</h4>


                                <div class="p-20">
                                    <form action="{{ url('drugCategory') }}" method="POST">
                                        {{ csrf_field() }}
                                        @if (count($errors) > 0)
                                            <div class="alert alert-danger">
                                                <ul>
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif

                                        <div class="form-group row">
                                            <label for="drug_type" class="col-sm-3">Drug Type Name<span class="text-danger">*</span></label>
                                            <div class="col-sm-7">
                                                <input type="text" name="drug_type" parsley-trigger="change" required
                                                       placeholder="Enter Drug Type Name" class="form-control" id="service_name"/>
                                            </div>

                                            <div class="col-sm-2">
                                                <button class="btn btn-teal">Submit</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                            </div>

                        </div>
                        <!-- end row -->


                    </div> <!-- end ard-box -->
                </div><!-- end col-->

            </div>


            <div class="row">
                <div class="col-sm-12">
                    @if(session()->has('message'))
                        <div class="alert alert-success">
                            {{ session()->get('message') }}
                        </div>
                    @endif
                    <div class="card-box table-responsive">
                        <h4 class="m-t-0 header-title"><b>Drug Types List</b></h4>


                        <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive">
                            <thead>
                            <tr>
                                <th width="5%">Sr.No</th>
                                <th>Drug Type Name</th>
                                <th width="20%">Status</th>
                                <th width="20%">Action</th>

                            </tr>
                            </thead>


                            <tbody>
                            @php $i=1; @endphp
                            @foreach($drugTypes as $type)
                                <tr>
                                    <td style="color: teal;">{{ $i }}</td>
                                    <td style="font-size: 16px;">{{ $type->category_name }}</td>
                                    <td style="font-size: 16px;">
                                        @if($type->status == 1)
                                            Active
                                            @else
                                            InActive
                                        @endif
                                    </td>
                                    <td>
                                        <button class="btn btn-icon waves-effect waves-light btn-danger m-b-5" data-toggle="modal" data-target="#con-close-modal{{$type->id}}"><i class="fa fa-remove"></i></button>
                                    </td>

                                </tr>

                                <div id="con-close-modal{{$type->id}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                <h4 class="modal-title">Warning!</h4>
                                            </div>
                                            <div class="modal-body">

                                                Are You Sure.You want to Delete it.
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal" style="float: right;">Close</button>

                                                <form action="{{ url('drugCategory/'.$type->id) }}" method="post">
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