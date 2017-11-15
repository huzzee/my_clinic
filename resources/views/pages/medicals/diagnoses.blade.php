@extends('layouts.mainHome')



@section('content')
    <!-- Start content -->
    <div class="content">
        <div class="container">


            <div class="row">
                <div class="col-xs-12">
                    <div class="page-title-box">

                        <h4 class="page-title">Diagnoses</h4>

                        <div class="clearfix"></div>

                    </div>
                </div>
            </div>
            <!-- end row -->

            <div class="row">
                <div class="col-xs-12">
                    <div class="card-box">




                        <div class="row">
                            <div class="col-sm-12">
                                @if (count($errors) > 0)
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                @if(session()->has('message'))
                                    <div class="alert alert-success">
                                        {{ session()->get('message') }}
                                    </div>
                                @endif
                                <div class="card-box table-responsive">
                                    <button class="btn btn-info waves-effect waves-light" data-toggle="modal"
                                            data-target="#con-close-modal">
                                        Add Diagnose

                                    </button>

                                    {{--Modal--}}

                                    <div id="con-close-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                        <form action="{{ url('diagnoses') }}" method="post" enctype="multipart/form-data">
                                            {{ csrf_field() }}
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                        <h4 class="modal-title">Add Diagnos</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label for="diagnose_name" class="control-label">Diagnose Name<span class="text-danger">*</span></label>
                                                                    <input type="text" name="diagnose_name" class="form-control" id="field-1" placeholder="Quantity" required>
                                                                </div>
                                                            </div>

                                                        </div>

                                                    </div>

                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-inverse waves-effect waves-light">Add Diagnose</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div><!-- /.modal -->
                                    <hr>


                                    <table id="datatable-buttons" class="table table-striped table-bordered">
                                        <thead>
                                        <tr>
                                            <th width="5%">Sr.No</th>

                                            <th>Title</th>
                                            <th width="20%">Action</th>

                                        </tr>
                                        </thead>


                                        <tbody>
                                        @php $i=1; @endphp
                                        @foreach($diagnoses as $diagnose)
                                            <tr>
                                                <td style="color: teal;">{{ $i }}</td>

                                                <td>{{ $diagnose->diagnose_name }}</td>

                                                <td>
                                                    <button class="btn btn-icon waves-effect waves-light btn-danger m-b-5" data-toggle="modal" data-target="#con-close-modal{{$diagnose->id}}"><i class="fa fa-remove"></i></button>
                                                </td>

                                            </tr>

                                            <div id="con-close-modal{{$diagnose->id}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
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

                                                            <form action="{{ url('diagnoses/'.$diagnose->id) }}" method="post">
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
                    <script src="{{ asset('assets/plugins/custombox/js/custombox.min.js') }}"></script>
                    <script src="{{ asset('assets/plugins/custombox/js/legacy.min.js') }}"></script>

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