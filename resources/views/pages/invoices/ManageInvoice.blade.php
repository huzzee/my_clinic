@extends('layouts.mainHome')



@section('content')
    <!-- Start content -->
    <div class="content">
        <div class="container">


            <div class="row">
                <div class="col-xs-12">
                    <div class="page-title-box">

                        <h4 class="page-title">Manage Invoice</h4>

                        <div class="clearfix"></div>

                    </div>
                </div>
            </div>
            <!-- end row -->


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

                        @if(Auth::user()->role_id == 3 || Auth::user()->role_id == 2)
                        <button class="btn btn-danger waves-effect waves-light" data-toggle="modal"
                                data-target="#con-close-modal">
                            Add Invoice
                        </button>
                        @endif

                        <div id="con-close-modal" class="modal fade" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">

                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                        <h4 class="modal-title">Add Invoice</h4>
                                    </div>
                                    <form action="{{ url('invoice_add') }}" method="post">
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
                                            <input type="hidden" name="doctor_id" value="{{Auth::user()->id}}">
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                                            {{ csrf_field() }}


                                            <button type="submit" class="btn btn-inverse waves-effect" style="float: left;margin-right: 2%;">Add To Invoice</button>
                                        </div>
                                    </form>
                                </div>
                            </div>

                        </div><!-- /.modal -->

                        <hr>

                        <table id="datatable_laravel" class="table table-striped table-bordered dt-responsive">
                            <thead>
                            <tr>
                                <th width="1%">Sr.No</th>
                                <th width="14%">Patient Name</th>
                                <th>Invoice No</th>
                                <th width="14%">Created By</th>
                                <th width="12%">Grand Total</th>
                                <th width="10%">Balance</th>
                                <th width="10%">Paid</th>
                                <th width="10%">Status</th>
                                <th width="12%">Action</th>

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
        $(function() {

            $('#datatable_laravel').DataTable({
                processing: false,
                serverSide: false,
                ajax: '{!! route('get_datatable_invoice.data') !!}',
                columns: [
                    { data: 'DT_Row_Index', name: 'DT_Row_Index' },
                    { data: 'patient_name', name: 'patient_name' },
                    { data: 'invoice_code', name: 'invoice_code' },
                    { data: 'users_name', name: 'users_name' },
                    { data: 'grand_total', name: 'grand_total' },
                    { data: 'balance', name: 'balance' },
                    { data: 'paid', name: 'paid' },
                    { data: 'status', name: 'status' },
                    { data: 'action', name: 'action',orderable: false, searchable: false},



                ]
            });

        });

    </script>
@endsection

<!--*********Page Scripts End*********-->