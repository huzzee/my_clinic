<?php $__env->startSection('content'); ?>
    <!-- Start content -->
    <div class="content">
        <div class="container">


            <div class="row">
                <div class="col-xs-12">
                    <div class="page-title-box">

                        <h4 class="page-title">Add Patient</h4>

                        <div class="clearfix"></div>

                    </div>
                </div>
            </div>
            <!-- end row -->

            <div class="row">

                    <?php echo Form::model($patient, ['method' => 'PATCH','url' => ['patients', $patient->id], 'files'=>true]); ?>


                    <?php echo e(csrf_field()); ?>


                    <?php if(count($errors) > 0): ?>
                        <div class="alert alert-danger">
                            <ul>
                                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li><?php echo e($error); ?></li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </div>
                    <?php endif; ?>
                    <?php if(session()->has('message')): ?>
                        <div class="alert alert-success">
                            <?php echo e(session()->get('message')); ?>

                        </div>
                    <?php endif; ?>

                    <div class="col-md-12">
                        <div class="card-box">
                            <a class="btn btn-info" href="<?php echo e(url('patients')); ?>">Manage Patients</a>
                            <hr>

                            <ul class="nav nav-tabs navtab-bg nav-justified">
                                <li class="active">
                                    <a href="#general" data-toggle="tab" aria-expanded="false">
                                        <span class="visible-xs"><i class="fa fa-home"></i></span>
                                        <span class="hidden-xs">General Info</span>
                                    </a>
                                </li>
                                <li class="">
                                    <a href="#other" data-toggle="tab" aria-expanded="false">
                                        <span class="visible-xs"><i class="fa fa-user"></i></span>
                                        <span class="hidden-xs">Other Info</span>
                                    </a>
                                </li>


                                <li class="">
                                    <a href="#queue" data-toggle="tab" aria-expanded="false">
                                        <span class="visible-xs"><i class="fa fa-envelope-o"></i></span>
                                        <span class="hidden-xs">Medical Information</span>
                                    </a>
                                </li>

                                <li class="">
                                    <a href="#allergy" data-toggle="tab" aria-expanded="false">
                                        <span class="visible-xs"><i class="fa fa-envelope-o"></i></span>
                                        <span class="hidden-xs">Drug Allergy</span>
                                    </a>
                                </li>


                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="general">
                                    <div class="row">
                                        <div class="col-sm-12 col-xs-12 col-md-12">


                                            <div class="p-20" style="clear: both;">

                                                <div class="form-group row">
                                                    <label for="full_name" class="col-sm-3">Full Name<span class="text-danger">*</span></label>
                                                    <div class="col-sm-9">
                                                        <?php echo Form::text('patient_info[full_name]' , null ,['class' => 'form-control','parsley-trigger' => 'change']); ?>

                                                    </div>
                                                </div>



                                                <div class="form-group row">
                                                    <label for="status" class="col-sm-3">Gender<span class="text-danger">*</span></label>
                                                    <div class="col-sm-9">
                                                        <div class="radio radio-info radio-inline">
                                                            <?php echo Form::radio('patient_info[gender]', 0,['id' => 'inlineRadio1']); ?>

                                                            <label for="inlineRadio1"> Male </label>
                                                        </div>
                                                        <div class="radio radio-pink radio-inline">
                                                            <?php echo Form::radio('patient_info[gender]', 1,['id' => 'inlineRadio1']); ?>

                                                            <label for="inlineRadio2"> Female </label>
                                                        </div>

                                                        <div class="radio radio-purple radio-inline">
                                                            <?php echo Form::radio('patient_info[gender]', 2,['id' => 'inlineRadio1']); ?>

                                                            <label for="inlineRadio3"> Others </label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="contact_no" class="col-sm-3">Contact No<span class="text-danger">*</span></label>
                                                    <div class="col-sm-9">
                                                        <?php echo Form::number('patient_info[contact_no]' , null ,['class' => 'form-control','parsley-trigger' => 'change']); ?>

                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="date_of_birth" class="col-sm-3">Date Of Birth<span class="text-danger">*</span></label>
                                                    <div class="col-sm-9">
                                                        <?php echo Form::text('patient_info[date_of_birth]' , null ,['class' => 'form-control','id' => 'datepicker-autoclose','placeholder' => 'mm/dd/yyyy']); ?>


                                                    </div>
                                                </div>



                                            </div>
                                        </div>

                                    </div>
                                </div>


                                <div class="tab-pane" id="other">
                                    <div class="row">
                                        <div class="col-sm-12 col-xs-12 col-md-12">

                                            <div class="alert alert-icon alert-info alert-dismissible fade in" role="alert">
                                                <button type="button" class="close" data-dismiss="alert"
                                                        aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                                <i class="mdi mdi-information"></i>
                                                <strong>Heads up!</strong> These Fields are not Mandatory! You can leave it.
                                            </div>


                                            <div class="p-20" style="clear: both;">

                                                <div class="form-group row">
                                                    <label for="email" class="col-sm-3">Email Address</label>
                                                    <div class="col-sm-9">
                                                        <?php echo Form::text('patient_info[email]' , null ,['class' => 'form-control','parsley-trigger' => 'change']); ?>


                                                    </div>
                                                </div>




                                                <div class="form-group row">
                                                    <label for="rel_contact_no" class="col-sm-3">Relative Contact No</label>
                                                    <div class="col-sm-9">
                                                        <?php echo Form::number('patient_info[rel_contact_no]' , null ,['class' => 'form-control','parsley-trigger' => 'change']); ?>

                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="reason" class="col-sm-3">Address</label>
                                                    <div class="col-sm-9">
                                                        <?php echo Form::textarea('patient_info[address]',null ,['class' => 'form-control','maxlength' => '225','rows' => '5', 'id' => 'textarea']); ?>

                                                    </div>
                                                </div>



                                                <div class="form-group row">
                                                    <label for="full_name" class="col-sm-3">Patient Id</label>
                                                    <div class="col-sm-2">
                                                        <?php echo Form::select('patient_info[patient_identity_name]',['NRIC'=>'NRIC', 'FIN'=>'FIN',
                                                        'Passport'=>'Passport', 'Foreign Id'=>'Foreign Id','Other'=>'Other'],null ,['class' => 'form-control select2']); ?>


                                                    </div>
                                                    <div class="col-sm-7">

                                                        <?php echo Form::text('patient_info[patient_identity_no]' , null ,['class' => 'form-control','parsley-trigger' => 'change']); ?>


                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="status" class="col-sm-3">Martial Status</label>
                                                    <div class="col-sm-9">
                                                        <div class="radio radio-danger radio-inline">
                                                            <?php echo Form::radio('patient_info[martial]', 'Married',['id' => 'inlineRadio1']); ?>

                                                            <label for="inlineRadio1"> Married </label>
                                                        </div>
                                                        <div class="radio radio-success radio-inline">
                                                            <?php echo Form::radio('patient_info[martial]', 'Unmarried',['id' => 'inlineRadio2']); ?>

                                                            <label for="inlineRadio2"> Unmarried </label>
                                                        </div>

                                                        <div class="radio radio-purple radio-inline">
                                                            <?php echo Form::radio('patient_info[martial]', 'Divorced',['id' => 'inlineRadio3']); ?>

                                                            <label for="inlineRadio3"> Divorced </label>
                                                        </div>

                                                        <div class="radio radio-inverse radio-inline">
                                                            <?php echo Form::radio('patient_info[martial]', 'Widow',['id' => 'inlineRadio3']); ?>

                                                            <label for="inlineRadio3"> Widow </label>
                                                        </div>

                                                        <div class="radio radio-info radio-inline">
                                                            <?php echo Form::radio('patient_info[martial]', 'Other',['id' => 'inlineRadio3']); ?>

                                                            <label for="inlineRadio3"> Other </label>
                                                        </div>
                                                    </div>
                                                </div>




                                            </div>
                                        </div>

                                    </div>
                                </div>





                                <div class="tab-pane" id="queue">
                                    <div class="row">
                                        <div class="col-sm-12 col-xs-12 col-md-12">

                                            <div class="alert alert-icon alert-info alert-dismissible fade in" role="alert">
                                                <button type="button" class="close" data-dismiss="alert"
                                                        aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                                <i class="mdi mdi-information"></i>
                                                <strong>Heads up!</strong> These Fields are not Mandatory! You can leave it.
                                            </div>


                                            <div class="p-20" style="clear: both;">

                                                <div class="form-group row">
                                                    <label for="blood_group" class="col-sm-3">Blood group</label>
                                                    <div class="col-sm-9">
                                                        <?php echo Form::select('medical_info[blood_group]',
                                                        ['A+'=>'A+', 'A-'=>'A-', 'B+'=>'B+', 'B-'=>'B-',
                                                        'O+'=>'O+', 'O-'=>'O-', 'AB+'=>'AB+', 'AB-'=>'AB-'],
                                                        null ,['class' => 'form-control select2']); ?>

                                                    </div>
                                                </div>


                                                <div class="form-group row">
                                                    <label for="status" class="col-sm-3">Had any Surgery?</label>
                                                    <div class="col-sm-9">
                                                        <div class="radio radio-danger radio-inline">
                                                            <?php echo Form::radio('medical_info[surgery]', 0,['id' => 'inlineRadio1']); ?>


                                                            <label for="inlineRadio1"> Yes </label>
                                                        </div>
                                                        <div class="radio radio-success radio-inline">
                                                            <?php echo Form::radio('medical_info[surgery]', 1,['id' => 'inlineRadio2']); ?>

                                                            <label for="inlineRadio2"> No </label>
                                                        </div>

                                                        <div class="radio radio-purple radio-inline">
                                                            <?php echo Form::radio('medical_info[surgery]', 2,['id' => 'inlineRadio3']); ?>

                                                            <label for="inlineRadio3"> I Don't Know </label>
                                                        </div>


                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="status" class="col-sm-3">Had any medical illness?</label>
                                                    <div class="col-sm-9">
                                                        <div class="radio radio-danger radio-inline">
                                                            <?php echo Form::radio('medical_info[illness]', 0,['id' => 'inlineRadio1']); ?>

                                                            <label for="inlineRadio1"> Yes </label>
                                                        </div>
                                                        <div class="radio radio-success radio-inline">
                                                            <?php echo Form::radio('medical_info[illness]', 1,['id' => 'inlineRadio2']); ?>

                                                            <label for="inlineRadio2"> No </label>
                                                        </div>

                                                        <div class="radio radio-purple radio-inline">
                                                            <?php echo Form::radio('medical_info[illness]', 2,['id' => 'inlineRadio3']); ?>

                                                            <label for="inlineRadio3"> I Don't Know </label>
                                                        </div>


                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="status" class="col-sm-3">G6PD deficiency?</label>
                                                    <div class="col-sm-9">
                                                        <div class="radio radio-danger radio-inline">
                                                            <?php echo Form::radio('medical_info[g6pd]', 0,['id' => 'inlineRadio1']); ?>

                                                            <label for="inlineRadio1"> Yes </label>
                                                        </div>
                                                        <div class="radio radio-success radio-inline">
                                                            <?php echo Form::radio('medical_info[g6pd]', 1,['id' => 'inlineRadio2']); ?>

                                                            <label for="inlineRadio2"> No </label>
                                                        </div>

                                                        <div class="radio radio-purple radio-inline">
                                                            <?php echo Form::radio('medical_info[g6pd]', 2,['id' => 'inlineRadio3']); ?>

                                                            <label for="inlineRadio3"> I Don't Know </label>
                                                        </div>


                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="email" class="col-sm-3">Insurance</label>
                                                    <div class="col-sm-9">

                                                        <?php echo Form::text('medical_info[insurance]' , null ,['class' => 'form-control','parsley-trigger' => 'change','placeholder' => 'Insurance']); ?>



                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="item_image" class="col-sm-3">Attach Patient file</label>
                                                    <div class="col-sm-9">
                                                        <input type="file" class="filestyle" data-placeholder="Not Important" name="patient_file" data-buttonname="btn-danger">
                                                    </div>
                                                </div>



                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="tab-pane" id="allergy">
                                    <div class="row">
                                        <div class="col-sm-12 col-xs-12 col-md-12">
                                            <div class="alert alert-icon alert-warning alert-dismissible fade in" role="alert">
                                                <button type="button" class="close" data-dismiss="alert"
                                                        aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                                <i class="mdi mdi-information"></i>
                                                <strong>Heads up!</strong> Add Drug Allergy If Patient have any.
                                            </div>

                                            <div class="p-20" style="clear: both;">

                                                <div class="form-group row">
                                                    <div class="col-sm-5">

                                                        <div class="form-group row">
                                                            <div class="col-sm-4"></div>
                                                            <label for="full_name" class="col-sm-3">Add Drug</label>
                                                        </div>
                                                        <div class="form-group row">
                                                            <div class="col-sm-12">
                                                                <input type="text" parsley-trigger="change"
                                                                       placeholder="Drug Name" autocomplete="off" class="form-control drug_name1"/>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <div class="col-sm-12">
                                                                <textarea id="textarea" class="form-control drug_comment1" maxlength="500" rows="5" placeholder="Comment If needed"></textarea>

                                                            </div>
                                                        </div>
                                                        <div class="form-group row">

                                                            <div class="col-sm-4">
                                                                <button class="btn btn-icon waves-effect waves-light btn-inverse m-b-5 add_drug1" type="button">
                                                                    <i class="fa fa-plus"></i> Add Drug
                                                                </button>
                                                            </div>
                                                        </div>

                                                    </div>



                                                    <div class="col-sm-7">
                                                        <table class="table table-striped m-0">

                                                            <thead>
                                                            <tr>


                                                                <th width="35%">Drug Name</th>

                                                                <th>Comment</th>
                                                                <th width="20%">Action</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody id="item_row1">
                                                                <?php $__currentLoopData = $patient->drug_allergy; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $drug): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <tr>
                                                                        <td><?php echo e($drug['drug_name']); ?><input type="hidden" name="drug_name[]" value="<?php echo e($drug['drug_name']); ?>"></td>
                                                                        <td><?php echo e($drug['drug_comment']); ?><input type="hidden" name="drug_comment[]" value="<?php echo e($drug['drug_comment']); ?>"></td>
                                                                        <td>
                                                                            <button type="button" class="btn btn-icon btn-danger m-b-5 remove_item1">
                                                                                <i class="fa fa-remove"></i>
                                                                            </button>
                                                                        </td>
                                                                    </tr>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>

                                            </div>

                                        </div>
                                    </div>


                                </div>


                            </div>
                            <hr>
                            <div class="form-group row">
                                <div class="col-sm-5"></div>
                                <div class="col-sm-7">
                                    <button type="submit" class="btn btn-inverse">Update Patient</button>
                                </div>
                            </div>
                        </div>
                    </div> <!-- end col -->
                </form>
            </div>



        </div> <!-- container -->

    </div> <!-- content -->

<?php $__env->stopSection(); ?>

<!--*********Page Scripts Here*********-->

<?php $__env->startSection('scripts'); ?>


    <script src="<?php echo e(asset('assets/plugins/bootstrap-tagsinput/js/bootstrap-tagsinput.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/plugins/multiselect/js/jquery.multi-select.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/plugins/jquery-quicksearch/jquery.quicksearch.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/plugins/select2/js/select2.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/plugins/bootstrap-select/js/bootstrap-select.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/plugins/bootstrap-filestyle/js/bootstrap-filestyle.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/plugins/bootstrap-touchspin/js/jquery.bootstrap-touchspin.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js')); ?>"></script>

    <script src="<?php echo e(asset('assets/plugins/autocomplete/jquery.mockjax.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/plugins/autocomplete/jquery.autocomplete.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/plugins/autocomplete/countries.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/pages/jquery.autocomplete.init.js')); ?>"></script>



    <script src="<?php echo e(asset('assets/plugins/moment/moment.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/plugins/timepicker/bootstrap-timepicker.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/plugins/clockpicker/js/bootstrap-clockpicker.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/plugins/bootstrap-daterangepicker/daterangepicker.js')); ?>"></script>

    <script src="<?php echo e(asset('assets/pages/jquery.form-pickers.init.js')); ?>"></script>

    <script src="<?php echo e(asset('assets/plugins/jquery.steps/js/jquery.steps.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/plugins/jquery-validation/js/jquery.validate.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/pages/jquery.wizard-init.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/pages/jquery.form-advanced.init.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<!--*********Page Scripts End*********-->
<?php echo $__env->make('layouts.mainHome', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>