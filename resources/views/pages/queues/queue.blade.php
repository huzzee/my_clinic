@extends('layouts.mainHome')



@section('content')
    <!-- Start content -->
    <div class="content">
        <div class="container">


            <div class="row">
                <div class="col-xs-12">
                    <div class="page-title-box">

                        <h4 class="page-title">Manage Queue</h4>
                        <button class="btn btn-info waves-effect waves-light" data-toggle="modal"
                                data-target="#con-close-modal" style="float: right">
                            Add Patient to Queue
                        </button>

                        <div id="con-close-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">

                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                        <h4 class="modal-title">Add To Queue</h4>
                                    </div>
                                    <form action="{{ route('queues.store') }}" method="post">
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

                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="pats" class="control-label">Select Doctors<span class="text-danger">*</span></label>
                                                        <select class="form-control select2" id="doctor_id" name="doctor_id">
                                                            <option selected disabled="disabled">Select Doctors</option>

                                                            @foreach($doctors as $doctor)
                                                                <option value="{{ $doctor->id }}">{{ $doctor->users->name}}</option>
                                                            @endforeach

                                                        </select>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                                            {{ csrf_field() }}


                                            <button type="submit" class="btn btn-inverse waves-effect" style="float: left;margin-right: 2%;">Add To Queue</button>
                                        </div>
                                    </form>
                                </div>
                            </div>

                        </div><!-- /.modal -->

                        <a href="{{ url('settled_queues') }}" class="btn btn-warning m-r-5" style="float: right">Settled Queues</a>

                        <a href="{{ url('deleted_queues') }}" class="btn btn-danger m-r-5" style="float: right">Deleted Queues</a>




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
                    @foreach($queues as $queue)
                        @if(Auth::user()->role_id == 3)
                            @if($queue->user_informations->user_id == Auth::user()->id)
                            <div class="row" style="border: 1px solid black;">
                                <div class="col-md-10">
                                    <div class="row">
                                        <div class="col-md-4 m-b-5">
                                            <p><strong style="font-size: 18px; font-weight: bold;">Queue Code:&nbsp;&nbsp;&nbsp;</strong>{{ $queue->queue_code }}</p>
                                        </div>
                                        <div class="col-md-8 m-b-5">
                                            <p><strong style="font-size: 18px; font-weight: bold;">Consultant Doctor Name:&nbsp;&nbsp;&nbsp;</strong>{{ $queue->user_informations->users->name }}</p>
                                        </div>
                                    </div>
                                    <div class="row m-b-20">
                                        <div class="col-md-2" align="center">
                                            @if($queue->status == 0)
                                                <img class="m-l-10" src="{{ asset('uploads/'.$queue->patients->patient_info['profile_image']) }}"
                                                     style="width: 90px;height: 90px;
                                                        border: 5px solid #2ce1da;
                                                        border-radius: 60px">
                                            @elseif($queue->status == 1)
                                                <img class="m-l-10" src="{{ asset('uploads/'.$queue->patients->patient_info['profile_image']) }}"
                                                     style="width: 90px;height: 90px;
                                                        border: 5px solid #f9c851;
                                                        border-radius: 60px">
                                            @elseif($queue->status == 2)
                                                <img class="m-l-10" src="{{ asset('uploads/'.$queue->patients->patient_info['profile_image']) }}"
                                                     style="width: 90px;height: 90px;
                                                        border: 5px solid #ac2925;
                                                        border-radius: 60px">
                                            @endif

                                        </div>

                                        <div class="col-md-4">
                                            <div class="row m-b-5">
                                                <div class="col-md-7">
                                                    <h4 style=" margin:8px 0px 8px 0px;">{{ $queue->patients->patient_info['full_name'] }}</h4>
                                                </div>
                                                <div class="col-md-5">
                                                    @if($queue->status == 0)

                                                            <span style="font-size: 11px;"><i class="fa fa-circle" style="color: #2ce1da;"></i></span>&nbsp;
                                                            <span style="color: #2ce1da; font-size: 14px;"> Waiting</span>
                                                    @elseif($queue->status == 1)

                                                            <span style="font-size: 11px;"><i class="fa fa-circle" style="color: #f9c851;"></i></span>&nbsp;
                                                            <span style="color: #f9c851; font-size: 14px;"> Engaged</span>
                                                    @elseif($queue->status == 2)

                                                            <span style="font-size: 11px;"><i class="fa fa-circle" style="color: #ac2925;"></i></span>&nbsp;
                                                            <span style="color: #ac2925; font-size: 14px;"> Unbalanced</span>
                                                    @endif
                                                </div>

                                            </div>
                                            <div class="row">
                                                <div class="col-md-3" align="center">
                                                    <strong>
                                                        Time In <br>
                                                        {{ date('h:i',strtotime($queue->created_at)) }}
                                                    </strong>
                                                </div>
                                                <div class="col-md-4" align="center">
                                                    <strong>
                                                        Time Out <br>
                                                        -
                                                    </strong>
                                                </div>
                                                <div class="col-md-5" align="center">
                                                    <strong>Note</strong><br>
                                                    @if($queue->note == null)
                                                        <td><button style=" font-size: 14px; background: none;float: left;text-align: left;
                                                     border: none; color: #00ff00" data-toggle="modal"
                                                                    data-target="#con-close-modal{{$queue->id}}note"><i class="fa fa-edit"></i> Add Note</button></td>
                                                    @else
                                                        <td><button style=" font-size: 90%; background: none;float: left;text-align: left;
                                                     border: none; color: #00ff00" data-toggle="modal"
                                                                    data-target="#con-close-modal{{$queue->id}}note">{{$queue->note}}</button></td>


                                                    @endif
                                                    <div id="con-close-modal{{$queue->id}}note" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">

                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                    <h4 class="modal-title">Change Doctor</h4>
                                                                </div>
                                                                <form action="{{ url('queues_note') }}" method="post">
                                                                    <div class="modal-body">

                                                                        <div class="row">
                                                                            <div class="col-md-12">
                                                                                <div class="form-group">
                                                                                    <label for="pats" class="control-label">Important Note<span class="text-danger">*</span></label>
                                                                                    <input name="note" class="form-control"
                                                                                           value="{{ $queue->note }}"/>
                                                                                </div>
                                                                            </div>

                                                                        </div>
                                                                    </div>

                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                                                                        {{ csrf_field() }}

                                                                        <input type="hidden" name="que_id" value="{{ $queue->id }}">
                                                                        <button type="submit" class="btn btn-inverse waves-effect" style="float: left;margin-right: 2%;">Add Note</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>

                                                    </div><!-- /.modal -->
                                                </div>
                                            </div>

                                        </div>
                                        <div class="col-md-2" style="border-left: 2px solid lightgrey; border-right: 2px solid lightgrey;">
                                            @if($queue->bill == null)
                                                <p class="text-left"><b>Bill: </b> No Bill</p>
                                            @else
                                                <p class="text-left"><b>Bill: </b> {{ $queue->bill }} {{ Auth::user()->entities->currency }}</p>
                                            @endif

                                            @if($queue->paid == null)
                                                <p class="text-left"><b>Paid: </b> Not Yet</p>
                                            @else
                                                <p class="text-left"><b>Paid: </b> {{ $queue->paid }} {{ Auth::user()->entities->currency }}</p>
                                            @endif

                                            <p class="text-left"><b>Balance: </b> {{ $queue->bill - $queue->paid }} {{ Auth::user()->entities->currency }}</p>


                                        </div>
                                        <div class="col-md-4" align="center">

                                            @if($queue->status == 0 || $queue->status == 1)
                                                <button style="font-size: 15px; padding: 0px;border: none;
                                                        color:#2ce1da; margin-right: 10px; background-color: white; " data-toggle="modal"
                                                        data-target="#con-close-modal{{$queue->user_informations->id}}doc">
                                                    <span style="font-size: 25px;"><i class="fa fa-refresh"></i></span>
                                                    <br>
                                                    <br>

                                                    Change Doctor</button>

                                                <div id="con-close-modal{{$queue->user_informations->id}}doc" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">

                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                <h4 class="modal-title">Change Doctor</h4>
                                                            </div>
                                                            <form action="{{ url('queues_doc') }}" method="post">
                                                                <div class="modal-body">

                                                                    <div class="row">
                                                                        <div class="col-sm-12">
                                                                            <div class="form-group">
                                                                                <label for="pats" class="control-label">Select Doctors<span class="text-danger">*</span></label>
                                                                                <select class="form-control select2" id="doctor_id" name="doctor_id">
                                                                                    <option selected disabled="disabled">Select Doctors</option>

                                                                                    @foreach($doctors as $doctor)
                                                                                        <option value="{{ $doctor->id }}">{{ $doctor->users->name}}</option>
                                                                                    @endforeach

                                                                                </select>
                                                                            </div>
                                                                        </div>

                                                                    </div>
                                                                </div>

                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                                                                    {{ csrf_field() }}

                                                                    <input type="hidden" name="old_doc" value="{{ $queue->id }}">
                                                                    <button type="submit" class="btn btn-inverse waves-effect" style="float: left;margin-right: 2%;">Add To Queue</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>

                                                </div><!-- /.modal -->
                                            @endif
                                                @if($queue->status == 0 || $queue->status == 1)

                                                    <button style="font-size: 15px; padding: 0px;border: none;
                                                            color:red;background-color: white; " data-toggle="modal"
                                                            data-target="#con-close-modal{{$queue->id}}delete">
                                                        <span style="font-size: 29px;"><i class="fa fa-times"></i></span>
                                                        <br>
                                                        <br>
                                                        Delete Queue</button>

                                                    <div id="con-close-modal{{$queue->id}}delete" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                    <h4 class="modal-title">Warning!</h4>
                                                                </div>
                                                                <div class="modal-body">

                                                                    Are You Sure.You want to delete This Queue.
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal" style="float: right;">Close</button>

                                                                    <form action="{{ url('queues/'.$queue->id) }}" method="post">
                                                                        {{ csrf_field() }}
                                                                        <input type="hidden" name="_method" value="DELETE">
                                                                        <button type="submit" class="btn btn-danger waves-effect" style="float: right;margin-right: 2%;">Yes Delete it</button>

                                                                    </form>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                        </div>
                                    </div>

                                </div>
                                <div class="col-md-2">
                                    <div class="row" style="height: 30px;">

                                    </div>

                                    <div class="row" style="border-left:2px solid lightgrey; height: 105px;">
                                        <div class="col-sm-12" align="center">
                                            @if($queue->status == 0 || $queue->status == 1)
                                                <form action="{{ url('add_to_check') }}" method="post">
                                                    {{ csrf_field() }}
                                                    <input type="hidden" name="queue_id" value="{{ $queue->id }}">
                                                    <button type="submit" class="btn btn-teal m-t-30">Check Patient</button>

                                                </form>

                                            @elseif($queue->status == 2)
                                                <td><a class="btn btn-success m-t-30" href="{{ url('payments/'.$queue->invoices->id) }}">Add Payment</a></td>
                                            @elseif($queue->status == 3)
                                                <td>Payment Completed</td>
                                            @elseif($queue->status == 4)
                                                <td>Deleted</td>
                                            @endif
                                        </div>
                                    </div>

                                </div>
                            </div>
                            @endif
                        @else
                            <div class="row" style="border: 1px solid black;">
                                <div class="col-md-10">
                                    <div class="row">
                                        <div class="col-md-4 m-b-5">
                                            <p><strong style="font-size: 18px; font-weight: bold;">Queue Code:&nbsp;&nbsp;&nbsp;</strong>{{ $queue->queue_code }}</p>
                                        </div>
                                        <div class="col-md-8 m-b-5">
                                            <p><strong style="font-size: 18px; font-weight: bold;">Consultant Doctor Name:&nbsp;&nbsp;&nbsp;</strong>{{ $queue->user_informations->users->name }}</p>
                                        </div>
                                    </div>
                                    <div class="row m-b-20">
                                        <div class="col-md-2" align="center">
                                            @if($queue->status == 0)
                                                <img class="m-l-10" src="{{ asset('uploads/'.$queue->patients->patient_info['profile_image']) }}"
                                                     style="width: 90px;height: 90px;
                                                    border: 5px solid #2ce1da;
                                                    border-radius: 60px">
                                            @elseif($queue->status == 1)
                                                <img class="m-l-10" src="{{ asset('uploads/'.$queue->patients->patient_info['profile_image']) }}"
                                                     style="width: 90px;height: 90px;
                                                    border: 5px solid #f9c851;
                                                    border-radius: 60px">
                                            @elseif($queue->status == 2)
                                                <img class="m-l-10" src="{{ asset('uploads/'.$queue->patients->patient_info['profile_image']) }}"
                                                     style="width: 90px;height: 90px;
                                                    border: 5px solid #ac2925;
                                                    border-radius: 60px">
                                            @endif

                                        </div>

                                        <div class="col-md-4">
                                            <div class="row m-b-5">
                                                <div class="col-md-7">
                                                    <h4 style=" margin:8px 0px 8px 0px;">{{ $queue->patients->patient_info['full_name'] }}</h4>
                                                </div>
                                                <div class="col-md-5">
                                                    @if($queue->status == 0)

                                                        <span style="font-size: 11px;"><i class="fa fa-circle" style="color: #2ce1da;"></i></span>&nbsp;
                                                        <span style="color: #2ce1da; font-size: 14px;"> Waiting</span>
                                                    @elseif($queue->status == 1)

                                                        <span style="font-size: 11px;"><i class="fa fa-circle" style="color: #f9c851;"></i></span>&nbsp;
                                                        <span style="color: #f9c851; font-size: 14px;"> Engaged</span>
                                                    @elseif($queue->status == 2)

                                                        <span style="font-size: 11px;"><i class="fa fa-circle" style="color: #ac2925;"></i></span>&nbsp;
                                                        <span style="color: #ac2925; font-size: 14px;"> Unbalanced</span>
                                                    @endif
                                                </div>

                                            </div>
                                            <div class="row">
                                                <div class="col-md-3" align="center">
                                                    <strong>
                                                        Time In <br>
                                                        {{ date('h:i',strtotime($queue->created_at)) }}
                                                    </strong>
                                                </div>
                                                <div class="col-md-4" align="center">
                                                    <strong>
                                                        Time Out <br>
                                                        -
                                                    </strong>
                                                </div>
                                                <div class="col-md-5" align="center">
                                                    <strong>Note</strong><br>
                                                    @if($queue->note == null)
                                                        <td><button style=" font-size: 14px; background: none;float: left;text-align: left;
                                                 border: none; color: #00ff00" data-toggle="modal"
                                                                    data-target="#con-close-modal{{$queue->id}}note"><i class="fa fa-edit"></i> Add Note</button></td>
                                                    @else
                                                        <td><button style=" font-size: 90%; background: none;float: left;text-align: left;
                                                 border: none; color: #00ff00" data-toggle="modal"
                                                                    data-target="#con-close-modal{{$queue->id}}note">{{$queue->note}}</button></td>


                                                    @endif
                                                    <div id="con-close-modal{{$queue->id}}note" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">

                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                    <h4 class="modal-title">Change Doctor</h4>
                                                                </div>
                                                                <form action="{{ url('queues_note') }}" method="post">
                                                                    <div class="modal-body">

                                                                        <div class="row">
                                                                            <div class="col-md-12">
                                                                                <div class="form-group">
                                                                                    <label for="pats" class="control-label">Important Note<span class="text-danger">*</span></label>
                                                                                    <input name="note" class="form-control"
                                                                                           value="{{ $queue->note }}"/>
                                                                                </div>
                                                                            </div>

                                                                        </div>
                                                                    </div>

                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                                                                        {{ csrf_field() }}

                                                                        <input type="hidden" name="que_id" value="{{ $queue->id }}">
                                                                        <button type="submit" class="btn btn-inverse waves-effect" style="float: left;margin-right: 2%;">Add Note</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>

                                                    </div><!-- /.modal -->
                                                </div>
                                            </div>

                                        </div>
                                        <div class="col-md-2" style="border-left: 2px solid lightgrey; border-right: 2px solid lightgrey;">
                                            @if($queue->bill == null)
                                                <p class="text-left"><b>Bill: </b> No Bill</p>
                                            @else
                                                <p class="text-left"><b>Bill: </b> {{ $queue->bill }} {{ Auth::user()->entities->currency }}</p>
                                            @endif

                                            @if($queue->paid == null)
                                                <p class="text-left"><b>Paid: </b> Not Yet</p>
                                            @else
                                                <p class="text-left"><b>Paid: </b> {{ $queue->paid }} {{ Auth::user()->entities->currency }}</p>
                                            @endif

                                            <p class="text-left"><b>Balance: </b> {{ $queue->bill - $queue->paid }} {{ Auth::user()->entities->currency }}</p>


                                        </div>
                                        <div class="col-md-4" align="center">

                                            @if($queue->status == 0 || $queue->status == 1)
                                                <button style="font-size: 15px; padding: 0px;border: none;
                                                    color:#2ce1da; margin-right: 10px; background-color: white; " data-toggle="modal"
                                                        data-target="#con-close-modal{{$queue->user_informations->id}}doc">
                                                    <span style="font-size: 25px;"><i class="fa fa-refresh"></i></span>
                                                    <br>
                                                    <br>

                                                    Change Doctor</button>

                                                <div id="con-close-modal{{$queue->user_informations->id}}doc" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">

                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                <h4 class="modal-title">Change Doctor</h4>
                                                            </div>
                                                            <form action="{{ url('queues_doc') }}" method="post">
                                                                <div class="modal-body">

                                                                    <div class="row">
                                                                        <div class="col-sm-12">
                                                                            <div class="form-group">
                                                                                <label for="pats" class="control-label">Select Doctors<span class="text-danger">*</span></label>
                                                                                <select class="form-control select2" id="doctor_id" name="doctor_id">
                                                                                    <option selected disabled="disabled">Select Doctors</option>

                                                                                    @foreach($doctors as $doctor)
                                                                                        <option value="{{ $doctor->id }}">{{ $doctor->users->name}}</option>
                                                                                    @endforeach

                                                                                </select>
                                                                            </div>
                                                                        </div>

                                                                    </div>
                                                                </div>

                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                                                                    {{ csrf_field() }}

                                                                    <input type="hidden" name="old_doc" value="{{ $queue->id }}">
                                                                    <button type="submit" class="btn btn-inverse waves-effect" style="float: left;margin-right: 2%;">Add To Queue</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>

                                                </div><!-- /.modal -->
                                            @endif
                                            @if($queue->status == 0 || $queue->status == 1)

                                                <button style="font-size: 15px; padding: 0px;border: none;
                                                        color:red;background-color: white; " data-toggle="modal"
                                                        data-target="#con-close-modal{{$queue->id}}delete">
                                                    <span style="font-size: 29px;"><i class="fa fa-times"></i></span>
                                                    <br>
                                                    <br>
                                                    Delete Queue</button>

                                                <div id="con-close-modal{{$queue->id}}delete" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                <h4 class="modal-title">Warning!</h4>
                                                            </div>
                                                            <div class="modal-body">

                                                                Are You Sure.You want to delete This Queue.
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal" style="float: right;">Close</button>

                                                                <form action="{{ url('queues/'.$queue->id) }}" method="post">
                                                                    {{ csrf_field() }}
                                                                    <input type="hidden" name="_method" value="DELETE">
                                                                    <button type="submit" class="btn btn-danger waves-effect" style="float: right;margin-right: 2%;">Yes Delete it</button>

                                                                </form>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                </div>
                                <div class="col-md-2">
                                    <div class="row" style="height: 30px;">

                                    </div>

                                    <div class="row" style="border-left:2px solid lightgrey; height: 105px;">
                                        <div class="col-sm-12" align="center">
                                            @if($queue->status == 0)
                                                <p class="m-t-30">Waiting</p>
                                            @elseif($queue->status == 1)
                                                <p class="m-t-30">Engaged</p>
                                            @elseif($queue->status == 2)
                                                <a class="btn btn-success m-t-30" href="{{ url('payments/'.$queue->invoices->id) }}">Add Payment</a>
                                            @elseif($queue->status == 3)
                                                <p class="m-t-30">Payment Completed</p>
                                            @elseif($queue->status == 4)
                                                <p class="m-t-30">Deleted</p>
                                            @endif
                                        </div>
                                    </div>

                                </div>
                            </div>
                        @endif
                    @endforeach
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


@endsection

<!--*********Page Scripts End*********-->