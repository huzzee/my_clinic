@extends('layouts.mainHome')



@section('content')
    <!-- Start content -->
    <div class="content">
        <div class="container">


            <div class="row">
                <div class="col-xs-12">
                    <div class="page-title-box">

                        <h4 class="page-title">Add Medical Reccord</h4>

                        <div class="clearfix"></div>

                    </div>
                </div>
            </div>
            <!-- end row -->

            <div class="row">
                <form action="{{ route('medical_records.store') }}" id="record_submit"  enctype="multipart/form-data" method="POST">

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

                    <div class="col-md-12">
                        <div class="card-box">
                            <a class="btn btn-info" href="{{ url('medical_records') }}">Manage Medical Records</a>
                            <hr>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">

                                        <label for="patient_id" class="control-label">Patient Name<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control input-sm"
                                               value="{{ $patients->patient_info['full_name'] }}" readonly="" required>
                                        <input type="hidden" value="{{ $patients->id }}" name="patient_id">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">

                                        <label for="patient_id" class="control-label">Patient Code<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control input-sm"
                                               value="{{ $patients['patient_code'] }}" readonly required>

                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">

                                        <label for="patient_id" class="control-label">Doctor Name</label>

                                        <input type="text" class="form-control input-sm"
                                               value="{{ $doctors->users['name'] }}" readonly="" required>
                                        <input type="hidden" value="{{ $doctors->id }}" name="doctor_id">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">

                                        <label for="patient_id" class="control-label">Diagnose</label>
                                        <textarea name="diagnose" id="textarea" class="form-control" maxlength="500" rows="3" placeholder="Diagnoses" value="{{ old('diagnose') }}"></textarea>
                                    </div>
                                </div>
                            </div>


                            <hr>
                            <div id="hide_one">

                                <ul class="nav nav-tabs navtab-bg nav-justified">
                                    <li class="active">
                                        <a href="#health" data-toggle="tab" aria-expanded="false">
                                            <span class="visible-xs"><i class="fa fa-home"></i></span>
                                            <span class="hidden-xs">Health Info</span>
                                        </a>
                                    </li>
                                    <li class="">
                                        <a href="#writing" data-toggle="tab" aria-expanded="false">
                                            <span class="visible-xs"><i class="fa fa-user"></i></span>
                                            <span class="hidden-xs">Typing Note</span>
                                        </a>
                                    </li>


                                    <li class="">
                                        <a href="#drawing" id="draw_pad" data-toggle="tab" aria-expanded="false">
                                            <span class="visible-xs"><i class="fa fa-envelope-o"></i></span>
                                            <span class="hidden-xs">Drawing Pad</span>
                                        </a>
                                    </li>

                                    <li class="">
                                        <a href="#template" data-toggle="tab" aria-expanded="false">
                                            <span class="visible-xs"><i class="fa fa-envelope-o"></i></span>
                                            <span class="hidden-xs">Template</span>
                                        </a>
                                    </li>
                                    <li class="">
                                        <a href="#upload" id="uploads" data-toggle="tab" aria-expanded="false">
                                            <span class="visible-xs"><i class="fa fa-envelope-o"></i></span>
                                            <span class="hidden-xs">Upload</span>
                                        </a>
                                    </li>


                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="health">
                                        <div class="row">
                                            <div class="col-sm-12 col-xs-12 col-md-12">
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <div class="card-box">

                                                            <div class="row">
                                                                <div class="col-md-4">
                                                                    <div class="form-group">

                                                                        <label for="weight" class="control-label">Weight</label>
                                                                        <div class="input-group m-t-10">
                                                                            <input type="text" name="weight" id="example-input2-group1"
                                                                                   placeholder="Enter Weight" autocomplete="off" class="form-control weight"/>
                                                                            <span class="input-group-addon">kg</span>
                                                                        </div>



                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group">

                                                                        <label for="height" class="control-label">Height</label>
                                                                        <div class="input-group m-t-10">
                                                                            <input type="text" name="height" parsley-trigger="change"
                                                                                   placeholder="Enter Height" autocomplete="off" class="form-control height"/>
                                                                            <span class="input-group-addon">cm</span>
                                                                        </div>


                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group">

                                                                        <label for="weight" class="control-label">BSA</label>
                                                                        <div class="input-group m-t-10">
                                                                            <input type="text" name="bsa" parsley-trigger="change"
                                                                                   value="0" readonly autocomplete="off" class="form-control bsa"/>
                                                                            <span class="input-group-addon">m<span style="font-size: 10px; position: relative; top: -5px;">2</span></span>
                                                                        </div>


                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>


                                    <div class="tab-pane" id="writing">
                                        <div class="row">
                                            <div class="col-sm-12 col-xs-12 col-md-12">
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <div class="card-box">
                                                            <textarea id="elm1" name="typing_Note"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>





                                    <div class="tab-pane" id="drawing">
                                        <div class="row">
                                            <div class="col-sm-12 col-xs-12 col-md-12">
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <div class="card-box">
                                                            <div class="form-group row">
                                                                <label for="image" class="col-md-1">Images:</label>
                                                                <div class="col-md-2 m-b-5">
                                                                    <input type="file" name="image" id="image-background"><br>

                                                                </div>
                                                                <label for="image" class="col-md-1">Tempate</label>
                                                                <div class="col-md-3 m-b-5">

                                                                    <select class="form-control select2" id="my_template">
                                                                        <option selected disabled="disabled">choose Template</option>
                                                                        @foreach($drawings as $template)
                                                                            <option value="{{ $template->id }}">{{ $template->title}}</option>
                                                                        @endforeach

                                                                    </select>

                                                                </div>
                                                                <label for="image" class="col-md-3">choose a background color:</label>
                                                                <div class="col-md-1 m-b-5">

                                                                    <input type="color" id="canvas-background-color" value="#ffffff" class="form-control" data-control="hue">

                                                                </div>

                                                            </div>
                                                            <div class="form-group row">
                                                                <label for="image" class="col-md-1">Text:</label>
                                                                <div class="col-md-3 m-b-5">

                                                                    <input type="text" id="text" class="form-control" placeholder="Write your text and hit enter" />



                                                                </div>
                                                                <div class="col-md-1 m-b-5">

                                                                    <button type="button" class="btn btn-info" id="add-text"><i class="fa fa-plus"></i></button>

                                                                </div>
                                                                <label for="image" class="col-md-1">Color:</label>
                                                                <div class="col-md-1 m-b-5">

                                                                    <input type="color" id="text-color" class="form-control" data-control="hue">

                                                                </div>

                                                                <div class="col-md-2 m-b-5">
                                                                    <button type="button" id="selection" class="btn btn-primary">
                                                                        Selection Mode</button>

                                                                </div>
                                                                <div class="col-md-2 m-b-5">

                                                                    <button type="button" id="draw" class="btn btn-teal">
                                                                        Draw Mode</button>
                                                                </div>

                                                            </div>
                                                            <div class="form-group row">
                                                                <label for="image" class="col-md-1">Brush Color:</label>
                                                                <div class="col-md-1 m-b-5">
                                                                    <input type="color" id="draw-color" class="draw-color form-control" data-control="hue">

                                                                </div>
                                                                <label for="image" class="col-md-1">Brush Size:</label>
                                                                <div class="col-md-1 m-b-5">

                                                                    <input type="text" id="value" value="1" class="form-control">

                                                                </div>

                                                                <div class="col-md-4 m-b-5">
                                                                    <input type="range" id="range" min="1" max="50" value="1">

                                                                </div>
                                                                <div class="col-md-2 m-b-5">

                                                                    <button type="button" id="delete" class="btn btn-pink">
                                                                        Delete Selection</button>
                                                                </div>
                                                                <div class="col-md-2 m-b-5">

                                                                    <button type="button" id="delete-all" class="btn btn-danger">
                                                                        Delete All</button>
                                                                </div>

                                                            </div>
                                                            <div class="form-group row">
                                                                <div class="col-md-10" id="abcde">

                                                                    <canvas id="c" style="border:2px solid black;"></canvas>

                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>

                                            </div>

                                        </div>
                                    </div>

                                    <div class="tab-pane" id="template">
                                        <div class="row">
                                            <div class="col-sm-12 col-xs-12 col-md-12">
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <div class="card-box" style="min-height: 300px;">
                                                            <div class="form-group row">
                                                                <label for="doctor_id" class="col-sm-2">Template</label>
                                                                <div class="col-sm-6">
                                                                    <select class="form-control select2" id="chk_temp">
                                                                        <option selected disabled="disabled">Select Template</option>

                                                                        @foreach($templates as $template)
                                                                            <option value="{{ $template->id }}">{{ $template->title }}</option>
                                                                        @endforeach

                                                                    </select>

                                                                </div>

                                                            </div>

                                                            <div id="templating">

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>



                                        </div>
                                    </div>

                                    <div class="tab-pane" id="upload">
                                        <div class="row">
                                            <div class="col-sm-12 col-xs-12 col-md-12">
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <div class="card-box">
                                                            <div class="row">
                                                                <div class="col-md-8">
                                                                    <div class="form-group clearfix">
                                                                        <div class="col-sm-12 padding-left-0 padding-right-0">
                                                                            <input type="file" name="uploads[]" id="filer_input2"
                                                                                   multiple="multiple">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>


                                    </div>


                                </div>


                                <div class="form-group row">
                                    <div class="col-sm-5"></div>
                                    <div class="col-sm-7">
                                        <button type="submit" class="btn btn-inverse">Add Record</button>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div> <!-- end col -->
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



    <script src="{{ asset('assets/plugins/moment/moment.js') }}"></script>
    <script src="{{ asset('assets/plugins/timepicker/bootstrap-timepicker.js') }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/clockpicker/js/bootstrap-clockpicker.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap-daterangepicker/daterangepicker.js') }}"></script>

    <script src="{{ asset('assets/pages/jquery.form-pickers.init.js') }}"></script>

    <script src="{{ asset('assets/plugins/jquery.steps/js/jquery.steps.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/jquery-validation/js/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('assets/pages/jquery.wizard-init.js') }}"></script>
    <script src="{{ asset('assets/pages/jquery.form-advanced.init.js') }}"></script>


    <script src="{{ asset('assets/plugins/tinymce/tinymce.min.js') }}"></script>

    <script src="{{ asset('assets/plugins/jquery.filer/js/jquery.filer.min.js') }}"></script>

    <script src="{{ asset('assets/pages/jquery.fileuploads.init.js') }}"></script>



    <script src="{{ asset('src/js/fabric-1.6.3.min.js') }}"></script>
    <script src="{{ asset('src/js/jquery.ezdz.min.js') }}"></script>
    <script src="{{ asset('src/js/jquery.minicolors-2.1.2.min.js') }}"></script>
    <script src="{{ asset('src/js/lity.min.js') }}"></script>
    <script src="{{ asset('src/js/draweditor.js') }}"></script>








    <script type="text/javascript">
        $(document).ready(function () {
            if($("#elm1").length > 0){
                tinymce.init({
                    selector: "textarea#elm1",
                    theme: "modern",
                    height:300,
                    plugins: [
                        "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
                        "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                        "save table contextmenu directionality emoticons template paste textcolor"
                    ],
                    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | print preview media fullpage | forecolor backcolor emoticons",
                    style_formats: [
                        {title: 'Bold text', inline: 'b'},
                        {title: 'Red text', inline: 'span', styles: {color: '#ff0000'}},
                        {title: 'Red header', block: 'h1', styles: {color: '#ff0000'}},
                        {title: 'Example 1', inline: 'span', classes: 'example1'},
                        {title: 'Example 2', inline: 'span', classes: 'example2'},
                        {title: 'Table styles'},
                        {title: 'Table row 1', selector: 'tr', classes: 'tablerow1'}
                    ]
                });
            }
        });
    </script>
@endsection

<!--*********Page Scripts End*********-->