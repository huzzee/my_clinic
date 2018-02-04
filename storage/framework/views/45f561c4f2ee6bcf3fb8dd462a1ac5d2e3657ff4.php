<?php $__env->startSection('content'); ?>
    <!-- Start content -->
    <div class="content">
        <div class="container">


            <div class="row">
                <div class="col-xs-12">
                    <div class="page-title-box">

                        <h4 class="page-title">Edit Doctor</h4>

                        <div class="clearfix"></div>

                    </div>
                </div>
            </div>
            <!-- end row -->



            <div class="row">
                <div class="col-md-12">
                    <div class="card-box">

                        <?php echo Form::model($doctor, ['method' => 'PATCH','url' => ['doctors', $doctor->id], 'files'=>true, 'id' => 'basic-form']); ?>


                            <?php echo e(csrf_field()); ?>



                            <a class="btn btn-purple" href="<?php echo e(url('doctors')); ?>">Manage Doctors</a>
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
                            <hr>
                            <div>
                                <h3>General Info</h3>
                                <section>
                                    <div class="form-group clearfix">
                                        <label for="first_Name" class="col-lg-2 control-label">First Name<span class="text-danger">*</span></label>
                                        <div class="col-lg-10">

                                            <?php echo Form::text('doctor_info[first_name]' , null ,['class' => 'form-control','parsley-trigger' => 'change']); ?>

                                        </div>
                                    </div>
                                    <div class="form-group clearfix">
                                        <label for="last_name" class="col-lg-2 control-label">Last Name<span class="text-danger">*</span></label>
                                        <div class="col-lg-10">
                                            <?php echo Form::text('doctor_info[last_name]' , null ,['class' => 'form-control','parsley-trigger' => 'change']); ?>

                                        </div>
                                    </div>

                                    <div class="form-group clearfix">
                                        <label for="reason" class="col-lg-2 control-label">Address<span class="text-danger">*</span></label>
                                        <div class="col-lg-10">
                                            <?php echo Form::textarea('doctor_info[address]',null ,['class' => 'form-control','maxlength' => '225','rows' => '5', 'id' => 'textarea']); ?>

                                        </div>
                                    </div>

                                    <div class="form-group clearfix">
                                        <label for="date_of_birth" class="col-lg-2 control-label">Date Of Birth<span class="text-danger">*</span></label>
                                        <div class="col-lg-10">

                                            <?php echo Form::text('doctor_info[date_of_birth]' , null ,['class' => 'form-control','id' => 'datepicker-autoclose','placeholder' => 'mm/dd/yyyy']); ?>


                                        </div>
                                    </div>

                                    <div class="form-group clearfix">
                                        <label for="contact_no" class="col-lg-2 control-label">Contact No<span class="text-danger">*</span></label>
                                        <div class="col-lg-10">
                                            <?php echo Form::number('doctor_info[contact_no]' , null ,['class' => 'form-control','parsley-trigger' => 'change']); ?>


                                        </div>
                                    </div>


                                    <div class="form-group clearfix">
                                        <label for="status" class="col-lg-2 control-label">Gender<span class="text-danger">*</span></label>
                                        <div class="col-lg-10">
                                            <div class="radio radio-info radio-inline">
                                                <?php echo Form::radio('doctor_info[gender]', 0,['id' => 'inlineRadio1']); ?>

                                                <label for="inlineRadio1"> Male </label>
                                            </div>
                                            <div class="radio radio-pink radio-inline">
                                                <?php echo Form::radio('doctor_info[gender]', 1,['id' => 'inlineRadio1']); ?>

                                                <label for="inlineRadio2"> Female </label>
                                            </div>

                                            <div class="radio radio-purple radio-inline">
                                                <?php echo Form::radio('doctor_info[gender]', 2,['id' => 'inlineRadio1']); ?>

                                                <label for="inlineRadio3"> Others </label>
                                            </div>
                                        </div>
                                    </div>



                                </section>
                                <h3>Account Info</h3>
                                <section>
                                    <div class="form-group clearfix">
                                        <label for="last_name" class="col-lg-2">Email Address<span class="text-danger">*</span></label>
                                        <div class="col-lg-10">

                                            <?php echo Form::email('users[email]' , null ,['class' => 'form-control','parsley-trigger' => 'change']); ?>


                                        </div>
                                    </div>

                                    <div class="form-group clearfix">
                                        <label for="last_name" class="col-lg-2">Password</label>
                                        <div class="col-lg-10">
                                            <?php echo Form::text('password',null,['class' => 'form-control','autocomplete' => 'false','placeholder' => 'Change Password if needed']); ?>

                                        </div>
                                    </div>

                                    <div class="form-group clearfix">
                                        <label for="item_image" class="col-lg-2">Profile Image</label>
                                        <div class="col-lg-10">

                                            <input type="file" class="filestyle" data-input="false" name="profile_image">
                                            <span>Change image if needed</span>

                                        </div>
                                    </div>

                                </section>

                                <h3>Doctor Details</h3>
                                <section>

                                    <div class="form-group clearfix">
                                        <label for="doctor_department" class="col-lg-2">Department<span class="text-danger">*</span></label>
                                        <div class="col-lg-10">
                                            <?php echo Form::text('doctor_info[department]' , null ,['class' => 'form-control','parsley-trigger' => 'change']); ?>


                                        </div>
                                    </div>

                                    <div class="form-group clearfix">
                                        <label for="biography" class="col-lg-2 control-label">Short Biography</label>
                                        <div class="col-lg-10">
                                            <?php echo Form::textarea('doctor_info[short_biography]' , null ,['class' => 'form-control','maxlength' => '225','rows' => '6', 'id' => 'textarea']); ?>

                                        </div>
                                    </div>

                                    <div class="form-group clearfix">
                                        <label for="blood_group" class="col-lg-2 control-label">Blood group<span class="text-danger">*</span></label>
                                        <div class="col-lg-10">
                                            <?php echo Form::select('doctor_info[blood_group]',['A+'=>'A+', 'A-'=>'A-', 'B+'=>'B+', 'B-'=>'B-',
                                            'O+'=>'O+', 'O-'=>'O-', 'AB+'=>'AB+', 'AB-'=>'AB-'],null ,['class' => 'form-control select2']); ?>


                                        </div>
                                    </div>

                                    <div class="form-group clearfix">
                                        <label for="specialist" class="col-lg-2">Specialist<span class="text-danger">*</span></label>
                                        <div class="col-lg-10">
                                            <?php echo Form::text('doctor_info[specialist]' , null ,['class' => 'form-control','parsley-trigger' => 'change']); ?>

                                        </div>
                                    </div>

                                    <div class="form-group clearfix">
                                        <label for="qualification" class="col-lg-2 control-label">Qualification</label>
                                        <div class="col-lg-10">
                                            <?php echo Form::textarea('doctor_info[qualification]' , null ,['class' => 'form-control','maxlength' => '225','rows' => '6', 'id' => 'textarea']); ?>

                                        </div>
                                    </div>

                                </section>
                            </div>
                        </form>

                    </div>
                </div>
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