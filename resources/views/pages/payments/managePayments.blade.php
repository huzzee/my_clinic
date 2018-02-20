
@extends('layouts.mainHome')



@section('content')
    <!-- Start content -->
    <div class="content">
        <div class="container">


            <div class="row">
                <div class="col-xs-12">
                    <div class="page-title-box">

                        <h4 class="page-title">Manage Payments</h4>

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

                        <table id="datatable_laravel" class="table table-striped table-bordered dt-responsive">
                            <thead>
                            <tr>
                                <th width="1%">Sr.No</th>
                                <th width="14%">Patient Name</th>
                                <th>Invoice No</th>

                                <th>Receipt No</th>
                                <th>Payment Date</th>
                                <th>Paid Amount</th>
                                <th>Action</th>

                            </tr>
                            </thead>
{{--

                            <tbody>
                            @php $i=1; @endphp
                            @foreach($payments as $payment)
                                <tr>
                                    <td>{{$i}}</td>
                                    <td>{{ $payment->invoices->patients->patient_info['full_name'] }}</td>
                                    <td>{{ $payment->invoices->invoice_code }}</td>
                                    <td>{{ $payment->receipt_no }}</td>
                                    <td>{{ date('d-M-Y',strtotime($payment->created_at)) }}</td>

                                    <td style="color: green;">{{ $payment->paid_amount }} {{Auth::user()->entities->currency}}</td>

                                    <td>

                                        <a href="{{ url('payments_print/'.$payment->id) }}"
                                           class="btn btn-inverse"
                                           target="_blank"
                                           data-toggle="tooltip" data-placement="top" title=""
                                           data-original-title="Print Payment" style="font-size: 12px; padding: 3px 8px 3px 8px;"><i class="fa fa-print"></i></a>

                                    </td>
                                </tr>

                                @php $i++; @endphp
                            @endforeach

                            </tbody>--}}
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
                ajax: '{!! route('get_datatable_payment.data') !!}',
                columns: [
                    { data: 'DT_Row_Index', name: 'DT_Row_Index' },
                    { data: 'patient_name', name: 'patient_name' },
                    { data: 'invoice_code', name: 'invoice_code' },
                    { data: 'receipt_no', name: 'receipt_no' },
                    { data: 'created_date', name: 'created_date' },
                    { data: 'paid_amount', name: 'paid_amount' },
                    { data: 'action', name: 'action',orderable: false, searchable: false},



                ]
            });

        });

    </script>
@endsection

<!--*********Page Scripts End*********-->