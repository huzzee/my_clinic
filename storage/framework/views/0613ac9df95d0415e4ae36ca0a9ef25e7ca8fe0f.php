<?php $__env->startSection('content'); ?>
    <!-- Start content -->
    <div class="content">
        <div class="container">


            <div class="row">
                <div class="col-xs-12">
                    <div class="page-title-box">

                        <h4 class="page-title">Edit Employee</h4>

                        <div class="clearfix"></div>

                    </div>
                </div>
            </div>
            <!-- end row -->

            <div class="row">
                <?php echo Form::model($employee, ['method' => 'PATCH','url' => ['employee', $employee->id], 'files'=>true]); ?>


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

                    <div class="col-xs-12">
                        <div class="card-box">


                            <div class="row">
                                <div class="col-sm-12 col-xs-12 col-md-12">


                                    <a class="btn btn-purple" href="<?php echo e(url('employee')); ?>">Manage Employee</a>

                                    <hr>


                                    <div class="p-20" style="clear: both;">

                                        <input type="hidden" name="role_id" value="4" />

                                        <div class="form-group row">
                                            <label for="first_name" class="col-sm-3">First Name<span class="text-danger">*</span></label>
                                            <div class="col-sm-9">
                                                <?php echo Form::text('employee_info[first_name]' , null ,['class' => 'form-control','parsley-trigger' => 'change']); ?>


                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="last_name" class="col-sm-3">Last Name<span class="text-danger">*</span></label>
                                            <div class="col-sm-9">
                                                <?php echo Form::text('employee_info[last_name]' , null ,['class' => 'form-control','parsley-trigger' => 'change']); ?>

                                            </div>
                                        </div>



                                        <div class="form-group row">
                                            <label for="last_name" class="col-sm-3">Email Address<span class="text-danger">*</span></label>
                                            <div class="col-sm-9">
                                                <?php echo Form::email('users[email]' , null ,['class' => 'form-control','parsley-trigger' => 'change']); ?>


                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="last_name" class="col-sm-3">Password</label>
                                            <div class="col-sm-9">

                                                <?php echo Form::text('password',null,['class' => 'form-control','autocomplete' => 'false','placeholder' => 'Change Password if needed']); ?>


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
                                                <?php echo Form::textarea('employee_info[address]',null ,['class' => 'form-control','maxlength' => '225','rows' => '5', 'id' => 'textarea']); ?>

                                            </div>
                                        </div>


                                        <div class="form-group row">
                                            <label for="status" class="col-sm-3">Gender<span class="text-danger">*</span></label>
                                            <div class="col-sm-9">
                                                <div class="radio radio-info radio-inline">
                                                    <?php echo Form::radio('employee_info[gender]', 0,['id' => 'inlineRadio1']); ?>

                                                    <label for="inlineRadio1"> Male </label>
                                                </div>
                                                <div class="radio radio-pink radio-inline">
                                                    <?php echo Form::radio('employee_info[gender]', 1,['id' => 'inlineRadio1']); ?>

                                                    <label for="inlineRadio2"> Female </label>
                                                </div>

                                                <div class="radio radio-purple radio-inline">
                                                    <?php echo Form::radio('employee_info[gender]', 2,['id' => 'inlineRadio1']); ?>

                                                    <label for="inlineRadio3"> Others </label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="contact_no" class="col-sm-3">Contact No<span class="text-danger">*</span></label>
                                            <div class="col-sm-9">
                                                <?php echo Form::number('employee_info[contact_no]' , null ,['class' => 'form-control','parsley-trigger' => 'change']); ?>

                                            </div>
                                        </div>




                                        <div class="form-group row">
                                            <div class="col-sm-3"></div>
                                            <div class="col-sm-9">
                                                <button type="submit" class="btn btn-inverse">Update Employee</button>
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

    <script src="<?php echo e(asset('assets/pages/jquery.form-advanced.init.js')); ?>"></script>


<?php $__env->stopSection(); ?>

<!--*********Page Scripts End*********-->
<?php echo $__env->make('layouts.mainHome', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>