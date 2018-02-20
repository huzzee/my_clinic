@extends('layouts.mainHome')



@section('content')
    <!-- Start content -->
    <div class="content">
        <div class="container">


            <div class="row">
                <div class="col-xs-12">
                    <div class="page-title-box">

                        <h4 class="page-title">Manage Drugs</h4>

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
                        <div class="alert alert-icon alert-info alert-dismissible fade in" role="alert">
                            <button type="button" class="close" data-dismiss="alert"
                                    aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <i class="mdi mdi-information"></i>
                            <strong>Heads up!</strong> Red Background drugs stock low.
                        </div>
                    <div class="card-box table-responsive">

                        <a class="btn btn-danger" href="{{ url('drugs/create') }}">Create Drugs</a>

                        <hr>


                        <table id="datatable_laravel" class="table table-striped table-bordered dt-responsive">
                            <thead>
                                <tr>

                                    <th width="5%">Sr.No</th>
                                    <th width="15%">Name</th>
                                    <th>Type</th>
                                    <th>Dosage</th>
                                    <th>Retail Price</th>
                                    <th>Current Qnt</th>
                                    <th>Used Qnt</th>
                                    <th>status</th>


                                    <th width="15%">Action</th>

                                </tr>
                            </thead>
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

        $(function() {

            $('#datatable_laravel').DataTable({
                processing: false,
                serverSide: false,
                ajax: '{!! route('get_datatable_drug.data') !!}',
                columns: [
                    { data: 'DT_Row_Index', name: 'DT_Row_Index' },
                    { data: 'medicine_info.drug_name', name: 'medicine_info.drug_name' },
                    { data: 'medicine_info.drug_type', name: 'medicine_info.drug_type' },
                    { data: 'dosage_amount', name: 'dosage_amount' },
                    { data: 'retail_price', name: 'retail_price' },
                    { data: 'medicine_info.current_qnt', name: 'medicine_info.current_qnt' },
                    { data: 'medicine_info.used_qnt', name: 'medicine_info.used_qnt' },
                    { data: 'status', name: 'status' },
                    {data: 'action', name: 'action', orderable: false, searchable: false}

                ]
            });

        });

    </script>
@endsection

<!--*********Page Scripts End*********-->