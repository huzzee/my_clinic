<?php $__env->startSection('content'); ?>
    <!-- Start content -->
    <div class="content">
        <div class="container">


            <div class="row">
                <div class="col-xs-12">
                    <div class="page-title-box">

                        <h4 class="page-title">Add Appointment</h4>

                        <div class="clearfix"></div>

                    </div>
                </div>
            </div>
            <!-- end row -->

            <div class="row">
                <form action="<?php echo e(route('appointments.store')); ?>" enctype="multipart/form-data" method="POST">

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


                                    <a class="btn btn-info" href="<?php echo e(url('appointments')); ?>">Manage Appointments</a>
                                    <hr>


                                    <div class="p-20" style="clear: both;">

                                        <div class="form-group row">
                                            <label for="reason" class="col-sm-2">Patient Name</label>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control"
                                                       value="<?php echo e($patient->patient_info['full_name']); ?>" readonly>
                                                <input type="hidden" name="patient_id" value="<?php echo e($patient->id); ?>">
                                            </div>

                                            <div class="col-sm-2"></div>

                                            <label for="reason" class="col-sm-2">Patient Code</label>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control"
                                                       value="<?php echo e($patient->patient_code); ?>" readonly>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="doctor_id" class="col-sm-2">Select Doctor<span class="text-danger">*</span></label>
                                            <div class="col-sm-10">
                                                <select class="form-control select2" name="doctor_id" id="app_doc_id">
                                                    <option selected disabled="disabled">Select Doctor</option>

                                                    <?php $__currentLoopData = $doctors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $doctor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($doctor->id); ?>"><?php echo e($doctor->users->name); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                                </select>

                                            </div>
                                        </div>


                                        <div class="row" id="app_date_here" style="display: none">
                                            <hr>
                                            <div class="col-sm-7">
                                                <h3 align="center">Available Schedule For Appointments</h3>
                                                <hr>
                                                <table class="table table-striped m-0">

                                                    <thead>
                                                    <tr>


                                                        <th width="25%">Avalaible Days</th>

                                                        <th width="45%">Time</th>
                                                        <th>Available Slots</th>

                                                    </tr>
                                                    </thead>
                                                    <tbody id="table_row_app">

                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="col-sm-5">
                                                <h3 align="center">Select Day</h3>
                                                <hr>

                                                <div class="input-group">
                                                    <input type="text" class="form-control" name="appointment_date" placeholder="mm/dd/yyyy" id="datepicker2"/>
                                                    <span class="input-group-addon bg-custom b-0"><i class="mdi mdi-calendar text-white"></i></span>
                                                </div><!-- input-group -->
                                                <div class="form-group row">

                                                    <div class="col-sm-12" id="time_here">

                                                    </div>

                                                </div>
                                            </div>
                                        </div>


                                        <hr>
                                        <div class="form-group row">
                                            <div class="col-sm-9"></div>
                                            <div class="col-sm-3">
                                                <button type="submit" disabled="disabled" id="problem_app" class="btn btn-teal">Add Appointment</button>
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

    <script src="<?php echo e(asset('assets/pages/jquery.form-advanced.init.js')); ?>"></script>




<?php $__env->stopSection(); ?>

<!--*********Page Scripts End*********-->
<?php echo $__env->make('layouts.mainHome', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>