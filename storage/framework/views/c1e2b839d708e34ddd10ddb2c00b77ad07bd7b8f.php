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
                <form action="<?php echo e(route('patients.store')); ?>" enctype="multipart/form-data" method="POST">

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
                                                        <input type="text" name="full_name" parsley-trigger="change"
                                                               placeholder="Enter Full Name" value="<?php echo e(old('full_name')); ?>" autocomplete="off" class="form-control"/>
                                                        <input type="hidden" name="patient_code" value="<?php echo e(str_random(8)); ?>">
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
                                                               placeholder="Enter Contact No" value="<?php echo e(old('contact_no')); ?>" autocomplete="off" class="form-control"/>

                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="date_of_birth" class="col-sm-3">Date Of Birth<span class="text-danger">*</span></label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" name="date_of_birth" placeholder="mm/dd/yyyy" id="datepicker-autoclose">


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
                                                        <input type="email" id="fake-email" name="fake-email" style="display: none;">
                                                        <input type="text" name="email" parsley-trigger="change"
                                                               placeholder="Enter Email If needed" value="<?php echo e(old('email')); ?>" autocomplete="off" class="form-control"/>

                                                    </div>
                                                </div>




                                                <div class="form-group row">
                                                    <label for="rel_contact_no" class="col-sm-3">Relative Contact No</label>
                                                    <div class="col-sm-9">
                                                        <input type="number" name="rel_contact_no" parsley-trigger="change"
                                                               placeholder="Enter Contact No" value="<?php echo e(old('rel_contact_no')); ?>" autocomplete="off" class="form-control"/>

                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="reason" class="col-sm-3">Address</label>
                                                    <div class="col-sm-9">
                                                        <textarea name="address" id="textarea" class="form-control" maxlength="500" rows="5" placeholder="Address If needed" value="<?php echo e(old('reason')); ?>"></textarea>
                                                    </div>
                                                </div>



                                                <div class="form-group row">
                                                    <label for="full_name" class="col-sm-3">Patient Id</label>
                                                    <div class="col-sm-2">
                                                        <select class="form-control select2" name="patient_identity_name">

                                                            <option value="NRIC">NRIC</option>
                                                            <option value="FIN">FIN</option>
                                                            <option value="Passport">Passport</option>
                                                            <option value="Foreign Id">Foreign Id</option>
                                                            <option value="Other">Other</option>

                                                        </select>
                                                    </div>
                                                    <div class="col-sm-7">
                                                        <input type="text" name="patient_identity_no" parsley-trigger="change"
                                                               placeholder="Enter Identity" value="<?php echo e(old('pateint_idntity_no')); ?>" autocomplete="off" class="form-control"/>

                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="status" class="col-sm-3">Martial Status</label>
                                                    <div class="col-sm-9">
                                                        <div class="radio radio-danger radio-inline">
                                                            <input type="radio" id="inlineRadio1" name="martial" value="Married">
                                                            <label for="inlineRadio1"> Married </label>
                                                        </div>
                                                        <div class="radio radio-success radio-inline">
                                                            <input type="radio" id="inlineRadio2" name="martial" value="Unmarried">
                                                            <label for="inlineRadio2"> Unmarried </label>
                                                        </div>

                                                        <div class="radio radio-purple radio-inline">
                                                            <input type="radio" id="inlineRadio3" name="martial" value="Divorced">
                                                            <label for="inlineRadio3"> Divorced </label>
                                                        </div>

                                                        <div class="radio radio-inverse radio-inline">
                                                            <input type="radio" id="inlineRadio3" name="martial" value="Widow">
                                                            <label for="inlineRadio3"> Widow </label>
                                                        </div>

                                                        <div class="radio radio-info radio-inline">
                                                            <input type="radio" id="inlineRadio3" name="martial" value="Other">
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
                                                        <select class="form-control select2" name="blood_group">
                                                            <option selected>Select Blood Group</option>
                                                            <option value="A+">A+</option>
                                                            <option value="A-">A-</option>
                                                            <option value="B+">B+</option>
                                                            <option value="B-">B-</option>
                                                            <option value="O+">O+</option>
                                                            <option value="O-">O-</option>
                                                            <option value="AB+">AB+</option>
                                                            <option value="AB-">AB-</option>
                                                        </select>
                                                    </div>
                                                </div>


                                                <div class="form-group row">
                                                    <label for="status" class="col-sm-3">Had any Surgery?</label>
                                                    <div class="col-sm-9">
                                                        <div class="radio radio-danger radio-inline">
                                                            <input type="radio" id="inlineRadio1" name="surgery" value="0">
                                                            <label for="inlineRadio1"> Yes </label>
                                                        </div>
                                                        <div class="radio radio-success radio-inline">
                                                            <input type="radio" id="inlineRadio2" name="surgery" value="1">
                                                            <label for="inlineRadio2"> No </label>
                                                        </div>

                                                        <div class="radio radio-purple radio-inline">
                                                            <input type="radio" id="inlineRadio3" name="surgery" value="2">
                                                            <label for="inlineRadio3"> I Don't Know </label>
                                                        </div>


                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="status" class="col-sm-3">Had any medical illness?</label>
                                                    <div class="col-sm-9">
                                                        <div class="radio radio-danger radio-inline">
                                                            <input type="radio" id="inlineRadio1" name="illness" value="0">
                                                            <label for="inlineRadio1"> Yes </label>
                                                        </div>
                                                        <div class="radio radio-success radio-inline">
                                                            <input type="radio" id="inlineRadio2" name="illness" value="1">
                                                            <label for="inlineRadio2"> No </label>
                                                        </div>

                                                        <div class="radio radio-purple radio-inline">
                                                            <input type="radio" id="inlineRadio3" name="illness" value="2">
                                                            <label for="inlineRadio3"> I Don't Know </label>
                                                        </div>


                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="status" class="col-sm-3">G6PD deficiency?</label>
                                                    <div class="col-sm-9">
                                                        <div class="radio radio-danger radio-inline">
                                                            <input type="radio" id="inlineRadio1" name="g6pd" value="0">
                                                            <label for="inlineRadio1"> Yes </label>
                                                        </div>
                                                        <div class="radio radio-success radio-inline">
                                                            <input type="radio" id="inlineRadio2" name="g6pd" value="1">
                                                            <label for="inlineRadio2"> No </label>
                                                        </div>

                                                        <div class="radio radio-purple radio-inline">
                                                            <input type="radio" id="inlineRadio3" name="g6pd" value="2">
                                                            <label for="inlineRadio3"> I Don't Know </label>
                                                        </div>


                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="email" class="col-sm-3">Insurance</label>
                                                    <div class="col-sm-9">

                                                        <input type="text" name="insurance" parsley-trigger="change"
                                                               placeholder="Enter Insurance If needed" value="<?php echo e(old('insurance')); ?>" autocomplete="off" class="form-control"/>

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
                                                                       placeholder="Drug Name" autocomplete="off" class="form-control drug_name"/>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <div class="col-sm-12">
                                                                    <textarea id="textarea" class="form-control drug_comment" maxlength="500" rows="5" placeholder="Comment If needed"></textarea>

                                                                </div>
                                                            </div>
                                                            <div class="form-group row">

                                                                <div class="col-sm-4">
                                                                    <button class="btn btn-icon waves-effect waves-light btn-inverse m-b-5 add_drug" type="button">
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
                                                            <tbody id="item_row">

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
                                    <button type="submit" class="btn btn-inverse">Add Patient</button>
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