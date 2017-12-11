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

                        <div id="con-close-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">

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

                        <table id="datatable-buttons" class="table table-striped table-bordered">
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


                            <tbody>
                            @php $i=1; @endphp
                            @foreach($invoices as $invoice)
                                    <tr>
                                        <td>{{$i}}</td>
                                        <td>{{ $invoice->patients->patient_info['full_name'] }}</td>
                                        <td>{{ $invoice->invoice_code }}</td>
                                        <td>{{ $invoice->user_informations->users['name'] }}</td>
                                        <td>{{ $invoice->grand_total }} {{Auth::user()->entities->currency}}</td>
                                        <td style="color: red;">{{ $invoice->balance }} {{Auth::user()->entities->currency}}</td>
                                        <td style="color: green;">{{ $invoice->paid }} {{Auth::user()->entities->currency}}</td>
                                        <td>
                                            @if($invoice->paid < $invoice->grand_total)
                                                UnPaid
                                            @elseif($invoice->paid == $invoice->grand_total)
                                                Paid
                                            @endif
                                        </td>
                                        <td>
                                            @if($invoice->paid < $invoice->grand_total)
                                                <a href="{{ url('payments/'.$invoice->id) }}"
                                                   style="font-weight: bold; font-size: 140%;color: #2b4a95"
                                                   data-toggle="tooltip" data-placement="top" title=""
                                                   data-original-title="Add Payment"><i class="fa fa-dollar"></i></a>
                                            @elseif($invoice->paid == $invoice->grand_total)
                                                <a
                                                   style="font-weight: bold; font-size: 120%;color: #2abfcc"
                                                   disabled="disabled"><i class="fa fa-dollar"></i></a>
                                            @endif

                                            &nbsp;

                                            <a href="{{ url('invoices/'.$invoice->id) }}"
                                               style="font-weight: bold; font-size: 120%;color: #2b4a95"
                                               data-toggle="tooltip" data-placement="top" title=""
                                               data-original-title="Show Invoice"><i class="fa fa-eye"></i></a>
                                                &nbsp;

                                            @if($invoice->paid !==  $invoice->grand_total && $invoice->user_informations->user_id == Auth::user()->id)
                                            <a href="{{ url('invoices/'.$invoice->id.'/edit') }}"
                                                style="font-weight: bold; font-size: 120%;color: #2b4a95"
                                                data-toggle="tooltip" data-placement="top" title=""
                                                data-original-title="Edit Invoice"><i class="fa fa-pencil"></i></a>
                                            @else

                                            <a
                                               style="font-weight: bold; font-size: 120%;color: #2abfcc"
                                               ><i class="fa fa-pencil"></i></a>
                                            @endif
                                                &nbsp;

                                                &nbsp;

                                            <button
                                               style="font-weight: bold; border: none; background: none; font-size: 120%;color: #2b4a95"
                                               data-toggle="modal" data-target="#full-width-modal{{ $invoice->id }}"><i class="fa fa-list"></i></button>

                                            <div id="full-width-modal{{ $invoice->id }}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="full-width-modalLabel" aria-hidden="true" style="display: none;">
                                                <div class="modal-dialog modal-full">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                            <h4 class="modal-title" id="full-width-modalLabel">Receipts List</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <table class="table m-t-30">
                                                                <thead>
                                                                <tr>
                                                                    <th width="1%">Sr.No</th>
                                                                    <th width="14%">Patient Name</th>
                                                                    <th width="14%">Receipt No</th>
                                                                    <th width="14%">Payment Date</th>
                                                                    <th width="10%">Paid Amount</th>
                                                                    <th width="5%">Action</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                @php $i=1; @endphp
                                                                @foreach($invoice->payments as $payment)
                                                                    <tr>
                                                                        <td>{{$i}}</td>
                                                                        <td>{{ $invoice->patients->patient_info['full_name'] }}</td>

                                                                        <td>{{ $payment->receipt_no }}</td>
                                                                        <td>{{ date('d-M-Y',strtotime($payment->created_at)) }}</td>

                                                                        <td style="color: green;">{{ $payment->paid_amount }} {{Auth::user()->entities->currency}}</td>

                                                                        <td>

                                                                            <a href="{{ url('payments_print/'.$payment->id) }}"
                                                                               class="btn btn-inverse"
                                                                               target="_blank"
                                                                               data-toggle="tooltip" data-placement="top" title=""
                                                                               data-original-title="Print Payment"><i class="fa fa-print"></i></a>

                                                                        </td>
                                                                    </tr>
                                                                    @php $i++; @endphp
                                                                @endforeach
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>

                                                        </div>
                                                    </div><!-- /.modal-content -->
                                                </div><!-- /.modal-dialog -->
                                                </div><!-- /.modal -->


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