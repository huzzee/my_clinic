@extends('layouts.mainHome')



@section('content')
    <!-- Start content -->
    <div class="content">
        <div class="container">


            <div class="row">
                <div class="col-xs-12">
                    <div class="page-title-box">

                        <h4 class="page-title">Manage Employee</h4>

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

                        <button class="modal_select btn btn-icon waves-effect waves-light btn-danger m-b-5" data-toggle="modal" data-target="#full-width-modal-create">Add Employee</button>


                        <div id="full-width-modal-create" class="modal fade" role="dialog" aria-labelledby="full-width-modalLabel-create" aria-hidden="true" style="display: none;">
                            <div class="modal-dialog modal-full">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                        <h4 class="modal-title" id="full-width-modalLabel-create">Add Employee</h4>
                                    </div>
                                    <form action="{{ route('employee.store') }}" method="post" enctype="multipart/form-data">

                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-1"></div>
                                                <div class="col-md-10">

                                                    <div class="p-20" style="clear: both;">


                                                        <input type="hidden" name="role_id" value="4" />

                                                        <div class="form-group row">
                                                            <label for="first_name" class="col-sm-3">First Name<span class="text-danger">*</span></label>
                                                            <div class="col-sm-9">
                                                                <input type="text" name="first_name" parsley-trigger="change"
                                                                       placeholder="Enter First Name" value="{{ old('first_name') }}" autocomplete="off" class="form-control"/>

                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label for="last_name" class="col-sm-3">Last Name<span class="text-danger">*</span></label>
                                                            <div class="col-sm-9">
                                                                <input type="text" name="last_name" parsley-trigger="change"
                                                                       placeholder="Enter Last Name" value="{{ old('last_name') }}" autocomplete="off" class="form-control"/>

                                                            </div>
                                                        </div>



                                                        <div class="form-group row">
                                                            <label for="last_name" class="col-sm-3">Email Address<span class="text-danger">*</span></label>
                                                            <div class="col-sm-9">

                                                                <input type="email" name="email" parsley-trigger="change"
                                                                       placeholder="Enter Email" autocomplete="off" class="form-control"/>

                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label for="last_name" class="col-sm-3">Password<span class="text-danger">*</span></label>
                                                            <div class="col-sm-9">

                                                                <input type="email" name="email-fake" style="display: none">
                                                                <input type="password" name="password-fake" style="display: none">

                                                                <input type="text" name="password" parsley-trigger="change"
                                                                       placeholder="Enter Password" autocomplete="off" class="form-control"/>

                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label for="item_image" class="col-sm-3">Profile Image</label>
                                                            <div class="col-sm-9">
                                                                <input type="file" class="filestyle" data-placeholder="Not Important" name="profile_image" data-buttonname="btn-inverse">
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label for="reason" class="col-sm-3">Address<span class="text-danger">*</span></label>
                                                            <div class="col-sm-9">
                                                                <textarea name="address" id="textarea" class="form-control" maxlength="500" rows="5" placeholder="Address" value="{{ old('reason') }}"></textarea>
                                                            </div>
                                                        </div>


                                                        <div class="form-group row">
                                                            <label for="status" class="col-sm-3">Gender<span class="text-danger">*</span></label>
                                                            <div class="col-sm-9">
                                                                <div class="radio radio-info radio-inline">
                                                                    <input type="radio" id="inlineRadio1" name="gender" value="0">
                                                                    <label for="inlineRadio1"> Male </label>
                                                                </div>
                                                                <div class="radio radio-pink radio-inline">
                                                                    <input type="radio" id="inlineRadio2" name="gender" value="1">
                                                                    <label for="inlineRadio2"> Female </label>
                                                                </div>

                                                                <div class="radio radio-purple radio-inline">
                                                                    <input type="radio" id="inlineRadio3" name="gender" value="2">
                                                                    <label for="inlineRadio3"> Others </label>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label for="contact_no" class="col-sm-3">Contact No<span class="text-danger">*</span></label>
                                                            <div class="col-sm-9">
                                                                <input type="number" name="contact_no" parsley-trigger="change"
                                                                       placeholder="Enter Contact No" value="{{ old('contact_no') }}" autocomplete="off" class="form-control"/>

                                                            </div>
                                                        </div>



                                                    </div>
                                                </div>
                                                <div class="col-md-1"></div>

                                            </div>
                                        </div>


                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cancel</button>
                                            {{ csrf_field() }}


                                            <button type="submit" class="btn btn-inverse waves-effect" style="float: right;margin-left: 1%;">Add Employee</button>


                                        </div>
                                    </form>
                                </div><!-- /.modal-content -->
                            </div><!-- /.modal-dialog -->
                        </div><!-- /.modal -->

                        <hr>


                        <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive">
                            <thead>
                            <tr>
                                <th width="2%">Sr.No</th>
                                <th width="2%">Image</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th width="15%">Designation</th>

                                <th width="8%">Gender</th>

                                <th width="10%">Status</th>

                                <th width="15%">Action</th>

                            </tr>
                            </thead>


                            <tbody>
                            @php $i=1;@endphp
                            @foreach($employees as $employee)
                                <tr>
                                    <td>{{ $i }}</td>
                                    <td><img src="{{ asset('uploads/'.$employee->users->profile_image.'?v='.\Carbon\Carbon::now()) }}" alt="{{ $employee->users->profile_image }}" style="height: 50px; width: 50px;"></td>
                                    <td>{{ $employee->users['name'] }}</td>
                                    <td>{{ $employee->users->email }}</td>
                                    <td>{{ $employee->users->roles->role_name }}</td>

                                    @if($employee->employee_info['gender'] == 0)
                                        <td>Male</td>
                                    @elseif($employee->employee_info['gender'] == 1)
                                        <td>Female</td>
                                    @else
                                        <td>Other</td>
                                    @endif



                                    @if($employee->users->status == 1)
                                        <td>Activate</td>
                                    @else
                                        <td>Deactivate</td>
                                    @endif

                                    <td>

                                    <button class="btn btn-icon waves-effect waves-light btn-teal m-b-5" data-toggle="modal" data-target="#full-width-modal-show{{$employee->id}}"><i class="fa fa-eye"></i></button>


                                    @if(Auth::user()->id == $employee->user_id || Auth::user()->role_id == 2)

                                            <button class="btn btn-icon waves-effect waves-light btn-info m-b-5 edit_patient_modal" data-patientId="{{$employee->id}}" data-toggle="modal" data-target="#full-width-modal-edit{{$employee->id}}"><i class="fa fa-edit"></i></button>
                                        @if(Auth::user()->role_id == 2)
                                        <button class="btn btn-icon waves-effect waves-light btn-danger m-b-5" data-toggle="modal" data-target="#con-close-modal{{$employee->id}}"><i class="fa fa-remove"></i></button>
                                        @endif
                                    @endif
                                    </td>
                                </tr>

                                <div id="con-close-modal{{$employee->id}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                <h4 class="modal-title">Warning!</h4>
                                            </div>
                                            <div class="modal-body">

                                                Are You Sure.You want to Delete This User.
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal" style="float: right;">Close</button>

                                                @if(Auth::user()->role_id == 2)

                                                    @if($employee->users->status == 0)
                                                        <form action="{{ url('employeeactivate/'.$employee->id) }}" method="post">
                                                            {{ csrf_field() }}

                                                            <button type="submit" name="flag" value="1" class="btn btn-success waves-effect" style="float: right;margin-right: 2%;">Activate it</button>

                                                        </form>
                                                    @elseif($employee->users->status == 1)
                                                        <form action="{{ url('employeeactivate/'.$employee->id) }}" method="post">
                                                            {{ csrf_field() }}

                                                            <button type="submit" name="flag" value="0"  class="btn btn-danger waves-effect" style="float: right;margin-right: 2%;">Deactivate it</button>

                                                        </form>

                                                    @endif
                                                @endif

                                                <form action="{{ url('employee/'.$employee->id) }}" method="post">
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
                        @foreach($employees as $employee)
                            {{--start edit modal--}}

                            <div id="full-width-modal-edit{{$employee->id}}"  class="modal fade" role="dialog" aria-labelledby="full-width-modalLabel-create" aria-hidden="true" style="display: none;">
                                <div class="modal-dialog modal-full">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                            <h4 class="modal-title" id="full-width-modalLabel-create">Edit Employee</h4>
                                        </div>
                                        {!! Form::model($employee, ['method' => 'PATCH','url' => ['employee', $employee->id], 'files'=>true]) !!}


                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-1"></div>
                                                <div class="col-md-10">

                                                    <div class="p-20" style="clear: both;">

                                                        <input type="hidden" name="role_id" value="4" />

                                                        <div class="form-group row">
                                                            <label for="first_name" class="col-sm-3">First Name<span class="text-danger">*</span></label>
                                                            <div class="col-sm-9">
                                                                {!! Form::text('employee_info[first_name]' , null ,['class' => 'form-control','parsley-trigger' => 'change']) !!}

                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label for="last_name" class="col-sm-3">Last Name<span class="text-danger">*</span></label>
                                                            <div class="col-sm-9">
                                                                {!! Form::text('employee_info[last_name]' , null ,['class' => 'form-control','parsley-trigger' => 'change']) !!}
                                                            </div>
                                                        </div>



                                                        <div class="form-group row">
                                                            <label for="last_name" class="col-sm-3">Email Address<span class="text-danger">*</span></label>
                                                            <div class="col-sm-9">
                                                                {!! Form::email('users[email]' , null ,['class' => 'form-control','parsley-trigger' => 'change']) !!}

                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label for="last_name" class="col-sm-3">Password</label>
                                                            <div class="col-sm-9">

                                                                {!! Form::text('password',null,['class' => 'form-control','autocomplete' => 'false','placeholder' => 'Change Password if needed']) !!}

                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label for="item_image" class="col-sm-3">Profile Image</label>
                                                            <div class="col-sm-9">
                                                                <input type="file" class="filestyle" data-placeholder="Not Important" name="profile_image" data-buttonname="btn-inverse">
                                                                <span>Change image if needed</span>
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label for="reason" class="col-sm-3">Address<span class="text-danger">*</span></label>
                                                            <div class="col-sm-9">
                                                                {!!Form::textarea('employee_info[address]',null ,['class' => 'form-control','maxlength' => '225','rows' => '5', 'id' => 'textarea'])!!}
                                                            </div>
                                                        </div>


                                                        <div class="form-group row">
                                                            <label for="status" class="col-sm-3">Gender<span class="text-danger">*</span></label>
                                                            <div class="col-sm-9">
                                                                <div class="radio radio-info radio-inline">
                                                                    {!! Form::radio('employee_info[gender]', 0,['id' => 'inlineRadio1']) !!}
                                                                    <label for="inlineRadio1"> Male </label>
                                                                </div>
                                                                <div class="radio radio-pink radio-inline">
                                                                    {!! Form::radio('employee_info[gender]', 1,['id' => 'inlineRadio1']) !!}
                                                                    <label for="inlineRadio2"> Female </label>
                                                                </div>

                                                                <div class="radio radio-purple radio-inline">
                                                                    {!! Form::radio('employee_info[gender]', 2,['id' => 'inlineRadio1']) !!}
                                                                    <label for="inlineRadio3"> Others </label>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="form-group row">
                                                            <label for="contact_no" class="col-sm-3">Contact No<span class="text-danger">*</span></label>
                                                            <div class="col-sm-9">
                                                                {!! Form::number('employee_info[contact_no]' , null ,['class' => 'form-control','parsley-trigger' => 'change']) !!}
                                                            </div>
                                                        </div>



                                                    </div>

                                                </div>
                                                <div class="col-md-1"></div>

                                            </div>
                                        </div>


                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cancel</button>
                                            {{ csrf_field() }}


                                            <button type="submit" class="btn btn-inverse waves-effect" style="float: right;margin-left: 1%;">Update Employee</button>


                                        </div>
                                        </form>
                                    </div><!-- /.modal-content -->
                                </div><!-- /.modal-dialog -->
                            </div><!-- /.modal -->

                            {{--end edit modal--}}

                            {{--start show modal--}}

                            <div id="full-width-modal-show{{$employee->id}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="full-width-modalLabel" aria-hidden="true" style="display: none;">
                                <div class="modal-dialog" style="width:45%;">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                            <h4 class="modal-title" id="full-width-modalLabel">Patient Profile</h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-lg-12 col-md-12">
                                                    <div class="text-center card-box">
                                                        <div class="member-card">
                                                            <div class="thumb-xl member-thumb m-b-10 center-block">
                                                                <img src="{{ asset('uploads/'.$employee->users->profile_image) }}" class="img-circle img-thumbnail" alt="profile-image">
                                                                <i class="mdi mdi-star-circle member-star text-success" title="verified user"></i>
                                                            </div>

                                                            <div class="">

                                                                <p class="text-muted">{{ $employee->users->roles->role_name }}</p>
                                                            </div>
                                                            <div class="box-header">

                                                                @if(Auth::user()->role_id == 2)

                                                                    @if($employee->users->status == 0)
                                                                        <form action="{{ url('employeeactivate/'.$employee->id) }}" method="post">
                                                                            {{ csrf_field() }}

                                                                            <button type="submit" name="flag" value="1" class="btn btn-success waves-effect">Activate it</button>

                                                                        </form>
                                                                    @elseif($employee->users->status == 1)
                                                                        <form action="{{ url('employeeactivate/'.$employee->id) }}" method="post">
                                                                            {{ csrf_field() }}

                                                                            <button type="submit" name="flag" value="0"  class="btn btn-danger waves-effect">Deactivate it</button>

                                                                        </form>

                                                                    @endif
                                                                @endif
                                                            </div>
                                                            <hr>

                                                            <div class="text-left">
                                                                <p class="text-muted font-13"><strong>Full Name :</strong> <span class="m-l-15">{{ $employee->users['name'] }}</span></p>

                                                                <p class="text-muted font-13"><strong>Gender :</strong><span class="m-l-15">
                                                    @if($employee->employee_info['gender'] == 0)
                                                                            Male
                                                                        @elseif($employee->employee_info['gender'] == 1)
                                                                            Female
                                                                        @else
                                                                            Others
                                                                        @endif
                                                </span></p>

                                                                <p class="text-muted font-13"><strong>Email :</strong> <span class="m-l-15">
                                                    {{ $employee->users->email }}</span></p>

                                                                <p class="text-muted font-13"><strong>Status :</strong>
                                                                    <span class="m-l-15">
                                                    @if($employee->users->status == 1)
                                                                            Activate
                                                                        @elseif($employee->users->status == 0)
                                                                            Deactivate

                                                                        @endif
                                                </span></p>
                                                                <p class="text-muted font-13"><strong>Designation Name :</strong> <span class="m-l-15">{{ $employee->users->roles->role_name }}</span></p>
                                                                <p class="text-muted font-13"><strong>Contact No :</strong> <span class="m-l-15">{{ $employee->employee_info['contact_no'] }}</span></p>
                                                                <p class="text-muted font-13"><strong>Address :</strong> <span class="m-l-15">{{ $employee->employee_info['address'] }}</span></p>

                                                            </div>



                                                        </div>

                                                    </div> <!-- end card-box -->

                                                </div> <!-- end col -->


                                                <!-- end col -->

                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>

                                        </div>
                                    </div><!-- /.modal-content -->
                                </div><!-- /.modal-dialog -->
                            </div><!-- /.modal -->
                            {{--end show modal--}}
                        @endforeach


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