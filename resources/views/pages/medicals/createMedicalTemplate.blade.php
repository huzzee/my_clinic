@extends('layouts.mainHome')



@section('content')
    <!-- Start content -->
    <div class="content">
        <div class="container">


            <div class="row">
                <div class="col-xs-12">
                    <div class="page-title-box">

                        <h4 class="page-title">Add Template</h4>

                        <div class="clearfix"></div>

                    </div>
                </div>
            </div>
            <!-- end row -->

            <div class="row">
                <form action="{{ route('medical_templates.store') }}" class="temp_submt" enctype="multipart/form-data" method="POST">

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
                    @if(session()->has('message'))
                        <div class="alert alert-success">
                            {{ session()->get('message') }}
                        </div>
                    @endif

                    <div class="col-xs-12">
                        <div class="card-box">


                            <div class="row">
                                <div class="col-sm-12 col-xs-12 col-md-12">


                                    <a class="btn btn-info" href="{{ url('medical_templates') }}">Manage Templates</a>
                                    <hr>


                                    <div class="p-20" style="clear: both;">

                                        <div class="form-group row">
                                            <label for="title" class="col-sm-2 control-label">Title<span class="text-danger">*</span></label>
                                            <div class="col-sm-10">
                                                <input type="text" name="title" parsley-trigger="change"
                                                       placeholder="Enter Title" value="{{ old('title') }}" autocomplete="off" class="form-control"/>

                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="template_type" class="col-sm-2">Type Of Element<span class="text-danger">*</span></label>
                                            <div class="col-sm-4">
                                                <select class="form-control select2" id="template_type" name="template_type">
                                                    <option selected disabled="disabled">Choose Type Of Element</option>

                                                    <option value="0">Short Text Field</option>
                                                    <option value="1">Paragraph Text Field</option>
                                                    <option value="2">Radio Buttons</option>
                                                    <option value="3">Check Boxes(Multiple)</option>
                                                    <option value="4">Multiple Select</option>

                                                </select>
                                            </div>
                                            <div class="col-sm-2">
                                                <button type="button" class="btn btn-icon btn-teal  m-b-5 " id="add_fields">
                                                    <i class="fa fa-plus"></i>
                                                </button>
                                            </div>

                                            <div class="col-sm-2">

                                            </div>
                                            <div class="col-sm-1">
                                                <button type="button" class="btn btn-icon btn-pink m-b-5" id="remove_box">
                                                    <i class="fa fa-undo"></i>
                                                </button>
                                            </div>
                                        </div>



                                        <div class="form-group row">

                                            <div  id="here_temp"  class="col-sm-6">

                                            </div>
                                            <div class="col-sm-1"></div>
                                            <div  id="temp_all"  class="col-sm-5"
                                                  style="pointer-events: none; border: 1px solid lightgray;">

                                            </div>


                                        </div>

                                        <hr>

                                        <div class="form-group row">
                                            <div class="col-sm-9"></div>
                                            <div class="col-sm-3">
                                                <button type="submit" class="btn btn-inverse">Create Template</button>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                            </div>

                        </div> <!-- end ard-box -->
                    </div>
                </form>
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