<?php $__env->startSection('content'); ?>
    <!-- Start content -->
    <div class="content">
        <div class="container">


            <div class="row">
                <div class="col-xs-12">
                    <div class="page-title-box">
                        <h4 class="page-title">Doctor Profile</h4>

                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <!-- end row -->

            <div class="row">
                <div class="col-sm-12">
                    <?php if(session()->has('message')): ?>
                        <div class="alert alert-success">
                            <?php echo e(session()->get('message')); ?>

                        </div>
                    <?php endif; ?>
                    <div class="card-box">
                        <div class="row">
                            <div class="col-lg-5 col-md-5">
                                <div class="text-center card-box">
                                    <div class="member-card">
                                        <div class="thumb-xl member-thumb m-b-10 center-block">
                                            <img src="<?php echo e(asset('uploads/'.$doctor->users->profile_image)); ?>" class="img-circle img-thumbnail" alt="profile-image">
                                            <i class="mdi mdi-star-circle member-star text-success" title="verified user"></i>
                                        </div>

                                        <div class="">
                                            <h4 class="m-b-5"><?php echo e($doctor->user['name']); ?></h4>
                                            <p class="text-muted">DOCTOR</p>
                                        </div>
                                        <div class="box-header">
                                            <a href="<?php echo e(url('doctors/'.$doctor->id.'/edit')); ?>" class="btn btn-info btn-sm w-sm waves-effect m-t-10 waves-light">Edit Profile</a>
                                            <?php if($doctor->users->status == 0): ?>
                                                <button type="button" class="btn btn-success btn-sm w-sm waves-effect m-t-10 waves-light" data-toggle="modal" data-target="#con-close-modalactive">Activate</button>
                                            <?php elseif($doctor->users->status == 1): ?>
                                                <button type="button" class="btn btn-danger btn-sm w-sm waves-effect m-t-10 waves-light" data-toggle="modal" data-target="#con-close-modaldeactive">Deactivate</button>
                                            <?php endif; ?>
                                        </div>
                                        
                                        <div id="con-close-modalactive" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                        <h4 class="modal-title">Warning!</h4>
                                                    </div>
                                                    <div class="modal-body">

                                                        Are You Sure.You want to Activate This User.
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default waves-effect" data-dismiss="modal" style="float: right;">Close</button>

                                                        <form action="<?php echo e(url('doctoractive/'.$doctor->id)); ?>" method="post">
                                                            <?php echo e(csrf_field()); ?>


                                                            <button type="submit" class="btn btn-success waves-effect" style="float: right;margin-right: 2%;">Yes Activate it</button>

                                                        </form>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div id="con-close-modaldeactive" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                        <h4 class="modal-title">Warning!</h4>
                                                    </div>
                                                    <div class="modal-body">

                                                        Are You Sure.You want to Deactivate This User.
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default waves-effect" data-dismiss="modal" style="float: right;">Close</button>

                                                        <form action="<?php echo e(url('doctors/'.$doctor->id)); ?>" method="post">
                                                            <?php echo e(csrf_field()); ?>

                                                            <input type="hidden" name="_method" value="DELETE">
                                                            <button type="submit" class="btn btn-danger waves-effect" style="float: right;margin-right: 2%;">Yes Deactivate it</button>

                                                        </form>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <hr/>
                                        
                                        <div class="text-left">
                                            <p class="text-muted font-13"><strong>Full Name :</strong> <span class="m-l-15">Dr.<?php echo e($doctor->users['name']); ?></span></p>

                                            <p class="text-muted font-13"><strong>Gender :</strong><span class="m-l-15">
                                                    <?php if($doctor->doctor_info['gender'] == 0): ?>
                                                        Male
                                                    <?php elseif($doctor->doctor_info['gender'] == 1): ?>
                                                        Female
                                                    <?php else: ?>
                                                        Others
                                                    <?php endif; ?>
                                                </span></p>

                                            <p class="text-muted font-13"><strong>Email :</strong> <span class="m-l-15">
                                                    <?php echo e($doctor->users->email); ?></span></p>

                                            <p class="text-muted font-13"><strong>Status :</strong>
                                                <span class="m-l-15">
                                                    <?php if($doctor->users->status == 1): ?>
                                                        Activate
                                                    <?php elseif($doctor->users->status == 0): ?>
                                                        Deactivate

                                                    <?php endif; ?>
                                                </span></p>

                                            <p class="text-muted font-13"><strong>Contact NO :</strong> <span class="m-l-15">
                                                    <?php echo e($doctor->doctor_info['contact_no']); ?></span></p>


                                            <p class="text-muted font-13"><strong>Date Of Birth :</strong> <span class="m-l-15">
                                                    <?php echo e($doctor->doctor_info['date_of_birth']); ?></span></p>

                                            <p class="text-muted font-13"><strong>Address :</strong> <span class="m-l-15">
                                                    <?php echo e($doctor->doctor_info['address']); ?></span></p>
                                        </div>



                                    </div>

                                </div> <!-- end card-box -->

                            </div> <!-- end col -->

                            <div class="col-md-7 col-lg-7">



                                <div class="box-header">

                                    <a href="javascript:void(0);"
                                       onclick="window.print();"
                                       class="btn btn-icon waves-effect waves-light btn-inverse m-b-5" style="float: right">
                                        <i class="fa fa-print"></i>

                                    </a>


                                </div>

                                <div class="row">

                                    <div class="col-lg-6 col-md-6">
                                        <div class="card-box widget-box-two widget-two-primary">
                                            <i class="mdi mdi-heart-pulse widget-two-icon"></i>
                                            <div class="wigdet-two-content">
                                                <p class="m-0 text-uppercase font-600 font-secondary text-overflow" title="Statistics">Total Patient checked</p>
                                                <h2><span data-plugin="counterup">2</span> <small><i class="mdi mdi-arrow-up text-success"></i></small></h2>

                                            </div>
                                        </div>
                                    </div><!-- end col -->

                                </div> <!-- end row -->

                                <hr/>

                                <div class="row">
                                    <div class="col-md-8 col-sm-6">

                                        <div class=" p-t-10">

                                            <p><b>Department Name</b></p>

                                            <p class="text-muted font-13 m-b-0"><?php echo e($doctor->doctor_info['department']); ?>

                                            </p>
                                        </div>
                                        <div class=" p-t-10">

                                            <p><b>Specialist</b></p>

                                            <p class="text-muted font-13 m-b-0"><?php echo e($doctor->doctor_info['specialist']); ?>

                                            </p>
                                        </div>

                                        <div class=" p-t-10">

                                            <p><b>Blood group</b></p>

                                            <p class="text-muted font-13 m-b-0"><?php echo e($doctor->doctor_info['blood_group']); ?>

                                            </p>
                                        </div>

                                        <div class=" p-t-10">

                                            <p><b>Short Biography</b></p>

                                            <p class="text-muted font-13 m-b-0"><?php echo e($doctor->doctor_info['short_biography']); ?>

                                            </p>
                                        </div>

                                        <div class=" p-t-10">

                                            <p><b>Qualification</b></p>

                                            <p class="text-muted font-13 m-b-0"><?php echo e($doctor->doctor_info['qualification']); ?>

                                            </p>
                                        </div>



                                    </div> <!-- end col -->


                                </div> <!-- end row -->




                            </div>
                            <!-- end col -->

                        </div>
                    </div>
                </div>
            </div>
            <!-- End row -->



        </div> <!-- container -->

    </div>

<?php $__env->stopSection(); ?>

<!--*********Page Scripts Here*********-->

<?php $__env->startSection('scripts'); ?>
    <script src="<?php echo e(asset('assets/plugins/waypoints/jquery.waypoints.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/plugins/counterup/jquery.counterup.min.js')); ?>"></script>

    <!-- Flot chart js -->
    <script src="<?php echo e(asset('assets/plugins/flot-chart/jquery.flot.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/plugins/flot-chart/jquery.flot.time.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/plugins/flot-chart/jquery.flot.tooltip.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/plugins/flot-chart/jquery.flot.resize.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/plugins/flot-chart/jquery.flot.pie.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/plugins/flot-chart/jquery.flot.selection.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/plugins/flot-chart/jquery.flot.crosshair.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/pages/jquery.dashboard_2.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<!--*********Page Scripts End*********-->
<?php echo $__env->make('layouts.mainHome', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>