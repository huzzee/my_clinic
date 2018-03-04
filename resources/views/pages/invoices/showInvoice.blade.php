@extends('layouts.mainHome')



@section('content')
    <!-- Start content -->
    <div class="content">
        <div class="container">


            <div class="row">
                <div class="col-xs-12">
                    <div class="page-title-box">
                        <h4 class="page-title">Show Invoice</h4>

                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <!-- end row -->

            <div class="row">
                <div class="col-sm-12">
                    <div class="hidden-print">
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
                        @if(session()->has('message2'))
                            <div class="alert alert-warning">
                                {{ session()->get('message2') }}
                            </div>
                        @endif
                    </div>
                    <div class="card-box">
                        <div class="row">
                            <div class="col-lg-12 col-md-12">
                                <div class="panel panel-default">
                                    <!-- <div class="panel-heading">
                                        <h4>Invoice</h4>
                                    </div> -->
                                    <div class="panel-body">
                                        <div class="clearfix">
                                            <div class="pull-left">
                                                <h3><img src="{{ asset('logo/klinic.png') }}" alt="" height="44">{{Auth::user()->entities->entity_name}}</h3>
                                            </div>
                                            <div class="pull-right">
                                                <h4>Invoice # <br>
                                                    <strong>{{ $invoice->invoice_code }}</strong>
                                                </h4>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-md-12">

                                                <div class="pull-left m-t-30">

                                                    <p><strong>Patient Name: </strong> {{ $invoice->patients->patient_info['full_name'] }}</p>
                                                    <p><strong>Patient Code: </strong> {{ $invoice->patients->patient_code }}</p>
                                                    @php $age = date('Y', strtotime(Carbon\Carbon::now())) - date('Y', strtotime($invoice->patients->patient_info['date_of_birth'])); @endphp
                                                    <p><strong>Age: </strong> {{ $age }}</p>

                                                    <p><strong>Gender: </strong>
                                                        @if($invoice->patients->patient_info['gender'] == 0)
                                                            Male
                                                        @elseif($invoice->patients->patient_info['gender'] == 1)
                                                            Female
                                                        @elseif($invoice->patients->patient_info['gender'] == 2)
                                                            Other
                                                        @endif</p>

                                                </div>
                                                <div class="pull-right m-t-30">
                                                    <p><strong>Queue Code: </strong>  {{ $invoice->prescriptions->queues->queue_code }}</p>
                                                    <p><strong>Created By: </strong>  {{ $invoice->user_informations->users['name'] }}</p>
                                                    <p><strong>Role: </strong>{{ $invoice->user_informations->users->roles->role_name }}</p>
                                                    <p><strong>Created At: </strong>  {{ date('d-M-Y', strtotime($invoice->created_at)) }}</p>

                                                </div>
                                            </div><!-- end col -->
                                        </div>
                                        <!-- end row -->

                                        <div class="m-h-50"></div>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="table-responsive">
                                                    <table class="table m-t-30">
                                                        <thead>
                                                        <tr>
                                                            <th width="1%">#</th>
                                                            <th width="15%" style="text-align: center">Item Name</th>
                                                            <th>Quantity</th>
                                                            <th>Price</th>
                                                            <th>Sub Total</th>
                                                            <th>Discount</th>
                                                            <th width="15%">Discount Remark</th>
                                                            <th>Gst</th>
                                                            <th>Line Total</th>

                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @php $i=1; @endphp
                                                        @foreach($invoice->prescription_item as $pres)
                                                            <tr>
                                                                <td>{{$i}}</td>
                                                                <td>{{ $pres['drug_name'] }}</td>
                                                                <td>{{ $pres['drug_qnt'] }}</td>
                                                                <td>{{ $pres['price'] }}</td>
                                                                <td>{{ $pres['sub_total'] }}</td>
                                                                <td>{{ $pres['discount'] }} %</td>
                                                                <td>{{ $pres['remark'] }}</td>
                                                                <td>{{ $pres['gst'] }} %</td>
                                                                <td>{{ $pres['line_total'] }}</td>
                                                            </tr>
                                                        @php $i++; @endphp
                                                        @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-md-6 col-sm-6 col-xs-6">
                                                <div class="clearfix m-t-40">
                                                    <h5 class="small text-inverse font-600">INVOICE COMMENT</h5>

                                                    <small>
                                                        {{ $invoice->invoice_comment }}
                                                    </small>
                                                </div>
                                                <div class="hidden-print">

                                                @if($invoice->paid < $invoice->grand_total)
                                                    <hr>
                                                    <div class="alert alert-icon alert-danger alert-dismissible fade in" role="alert">
                                                        <button type="button" class="close" data-dismiss="alert"
                                                                aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                        <i class="mdi mdi-alert"></i>
                                                        <strong>Heads up!</strong> Payment is not Complete.
                                                    </div>
                                                @elseif($invoice->paid == $invoice->grand_total)
                                                    <hr>
                                                    <div class="alert alert-icon alert-success alert-dismissible fade in" role="alert">
                                                        <button type="button" class="close" data-dismiss="alert"
                                                                aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                        <i class="mdi mdi-checkbox-marked"></i>
                                                        <strong>Good !</strong> Payment is Completed.
                                                    </div>
                                                @endif
                                                </div>
                                            </div>
                                            <div class="col-md-3 col-sm-6 col-xs-6 col-md-offset-3">
                                                <p class="text-right"><b>Net Total: </b> {{ $invoice->net_total }} {{ Auth::user()->entities->currency }}</p>
                                                <p class="text-right"><b>Discount: </b>{{ $invoice->total_discount }} {{ Auth::user()->entities->currency }}</p>
                                                <p class="text-right"><b>Amount After Discount: </b>{{ $invoice->after_discount }} {{ Auth::user()->entities->currency }}</p>
                                                <p class="text-right"><b>Gst: </b>{{ $invoice->total_gst }} {{ Auth::user()->entities->currency }}</p>

                                                <hr>
                                                <h4 class="text-right"><b>Grand Total: </b>{{ $invoice->grand_total }} {{ Auth::user()->entities->currency }}</h4>
                                                <h4 class="text-right"><b>Paid: </b>{{ $invoice->paid }} {{ Auth::user()->entities->currency }}</h4>

                                                @if($invoice->paid < $invoice->grand_total)
                                                    <h4 class="text-right"><b>Balance: </b> <span style="color: red;">{{ $invoice->balance }} {{ Auth::user()->entities->currency }}</span> </h4>
                                                @elseif($invoice->paid == $invoice->grand_total)
                                                    <h4 class="text-right"><b>Balance: </b> <span style="color: green;">{{ $invoice->balance }} {{ Auth::user()->entities->currency }}</span> </h4>
                                                @endif
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="hidden-print">
                                            <div class="pull-right">
                                                <a href="javascript:window.print()" class="btn btn-inverse waves-effect waves-light"><i class="fa fa-print"></i></a>
                                                @if($invoice->paid < $invoice->grand_total)
                                                    <a href="{{ url('payments/'.$invoice->id) }}" class="btn btn-teal waves-effect waves-light">Add Payment</a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div> <!-- end col -->

                        </div>
                    </div>
                </div>
            </div>
            <!-- End row -->



        </div> <!-- container -->

    </div>

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
@endsection

<!--*********Page Scripts End*********-->