<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
    <meta name="author" content="Coderthemes">

    <!-- App favicon -->
    <link rel="shortcut icon" href="<?php echo e(asset('assets/images/favicon.ico')); ?>">
    <!-- App title -->
    <title>Klenic</title>



    
    <link href="<?php echo e(asset('assets/plugins/jquery.filer/css/jquery.filer.css')); ?>" rel="stylesheet" />

    <!-- Custom box -->
    <link href="<?php echo e(asset('assets/plugins/custombox/css/custombox.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('assets/plugins/summernote/summernote.css')); ?>" rel="stylesheet" />
    <link rel="stylesheet" href="<?php echo e(asset('assets/plugins/tooltipster/tooltipster.bundle.min.css')); ?>">

    <!-- form css-->
    <link href="<?php echo e(asset('assets/plugins/bootstrap-tagsinput/css/bootstrap-tagsinput.css')); ?>" rel="stylesheet" />
    <link href="<?php echo e(asset('assets/plugins/multiselect/css/multi-select.css')); ?>"  rel="stylesheet" type="text/css" />
    <link href="<?php echo e(asset('assets/plugins/select2/css/select2.min.css')); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo e(asset('assets/plugins/bootstrap-select/css/bootstrap-select.min.css')); ?>" rel="stylesheet" />
    <link href="<?php echo e(asset('assets/plugins/bootstrap-touchspin/css/jquery.bootstrap-touchspin.min.css')); ?>" rel="stylesheet" />
    <link href="<?php echo e(asset('assets/plugins/timepicker/bootstrap-timepicker.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('assets/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('assets/plugins/clockpicker/css/bootstrap-clockpicker.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('assets/plugins/bootstrap-daterangepicker/daterangepicker.css')); ?>" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('assets/plugins/jquery.steps/css/jquery.steps.css')); ?>" />
    <!-- Datatables -->

    <link rel="stylesheet" href="<?php echo e(asset('assets/plugins/magnific-popup/css/magnific-popup.css')); ?>" />
    <link rel="stylesheet" href="<?php echo e(asset('assets/plugins/jquery-datatables-editable/datatables.css')); ?>" />

    <link href="<?php echo e(asset('assets/plugins/datatables/jquery.dataTables.min.css')); ?>" rel="stylesheet" type="text/css"/>
    <link href="<?php echo e(asset('assets/plugins/datatables/buttons.bootstrap.min.css')); ?>" rel="stylesheet" type="text/css"/>
    <link href="<?php echo e(asset('assets/plugins/datatables/fixedHeader.bootstrap.min.css')); ?>" rel="stylesheet" type="text/css"/>
    <link href="<?php echo e(asset('assets/plugins/datatables/responsive.bootstrap.min.css')); ?>" rel="stylesheet" type="text/css"/>
    <link href="<?php echo e(asset('assets/plugins/datatables/scroller.bootstrap.min.css')); ?>" rel="stylesheet" type="text/css"/>
    <link href="<?php echo e(asset('assets/plugins/datatables/dataTables.colVis.css')); ?>" rel="stylesheet" type="text/css"/>
    <link href="<?php echo e(asset('assets/plugins/datatables/dataTables.bootstrap.min.css')); ?>" rel="stylesheet" type="text/css"/>
    <link href="<?php echo e(asset('assets/plugins/datatables/fixedColumns.dataTables.min.css')); ?>" rel="stylesheet" type="text/css"/>
    <!-- App css -->
    <link href="<?php echo e(asset('assets/css/bootstrap.min.css')); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo e(asset('assets/css/core.css')); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo e(asset('assets/css/components.css')); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo e(asset('assets/css/icons.css')); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo e(asset('assets/css/pages.css')); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo e(asset('assets/css/menu.css')); ?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo e(asset('assets/css/responsive.css')); ?>" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="<?php echo e(asset('assets/plugins/switchery/switchery.min.css')); ?>">





    <!-- HTML5 Shiv and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>


    <![endif]-->

    <script src="<?php echo e(asset('assets/js/modernizr.min.js')); ?>"></script>

</head>

<style>

    @media  print {
        @page  { margin-bottom: 0; }

    }

</style>
<body class="fixed-left" onload="window.print()">
<input type="hidden" value="<?php echo e(url('/')); ?>" id="baseUrl">

<!-- Begin page -->
<div id="wrapper">

    <!-- Top Bar Start -->

    <!-- Left Sidebar End -->



    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->


    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="card-box">
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <div class="text-center card-box">
                                <div class="member-card">

                                    <h4><?php echo e(Auth::user()->entities->entity_name); ?></h4>
                                    <hr>
                                    <div class="text-left">
                                        <p class="text-muted font-13"><strong>Full Name :</strong> <span class="m-l-15">
                                            <?php echo e($prescription->patients->patient_info['full_name']); ?></span></p>

                                        <p class="text-muted font-13"><strong>Patient Code :</strong><span class="m-l-15">
                                        <?php echo e($prescription->patients->patient_code); ?></span></p>

                                        <p class="text-muted font-13"><strong>Age :</strong> <span class="m-l-15">
                                            <?php $age = date('Y', strtotime(Carbon\Carbon::now())) - date('Y', strtotime($prescription->patients->patient_info['date_of_birth'])); ?>
                                                <?php echo e($age); ?></span></p>

                                        <p class="text-muted font-13"><strong>Gender :</strong>
                                            <span class="m-l-15">
                                            <?php if($prescription->patients->patient_info['gender'] == 0): ?>
                                                    Male
                                                <?php elseif($prescription->patients->patient_info['gender'] == 1): ?>
                                                    Female
                                                <?php elseif($prescription->patients->patient_info['gender'] == 2): ?>
                                                    Other

                                                <?php endif; ?>
                                        </span></p>

                                        <p class="text-muted font-13"><strong>Queue Code :</strong> <span class="m-l-15">
                                            <?php echo e($prescription->queues->queue_code); ?></span></p>

                                        <p class="text-muted font-13"><strong>Doctor Name :</strong> <span class="m-l-15">
                                            <?php echo e($prescription->user_informations->users['name']); ?></span></p>

                                        <p class="text-muted font-13"><strong>Department :</strong><span class="m-l-15">
                                        <?php echo e($prescription->user_informations->doctor_info['department']); ?></span></p>



                                    </div>


                                </div>
                            </div> <!-- end card-box -->
                        </div> <!-- end col -->


                        <div class="col-lg-12 col-md-12">
                            <div class="text-center card-box">
                                <div class="member-card">

                                        <div class="row" >

                                            <table class="table table-striped m-0">
                                                <thead>
                                                <tr>

                                                    <th width="15%" style="text-align: center">Item Name</th>
                                                    <th style="text-align: center">Quantity</th>
                                                    <th style="text-align: center">Dosage</th>
                                                    <th style="text-align: center">Days</th>
                                                    <th style="text-align: center">Instruction</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $__currentLoopData = $prescription->prescriptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $items): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <tr>
                                                            <td><?php echo e($items['drug_name']); ?></td>
                                                            <td><?php echo e($items['drug_qnt']); ?></td>
                                                            <td><?php echo e($items['dosage_qnt']); ?></td>
                                                            <td><?php echo e($items['days']); ?></td>
                                                            <td><?php echo e($items['instruction']); ?></td>

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
        </div>
    </div>







    <!-- ============================================================== -->
    <!-- End Right content here -->
    <!-- ============================================================== -->


    <!-- Right Sidebar -->

    <!-- /Right-bar -->

</div>
<!-- END wrapper -->



<script>
    var resizefunc = [];
</script>

<!-- jQuery  -->
<script src="<?php echo e(asset('assets/js/jquery.min.js')); ?>"></script>
<script src="<?php echo e(asset('js/jquery.jqscribble.js')); ?>"></script>
<script src="<?php echo e(asset('js/jqscribble.extrabrushes.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/bootstrap.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/detect.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/fastclick.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/jquery.blockUI.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/waves.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/jquery.slimscroll.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/jquery.scrollTo.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/plugins/switchery/switchery.min.js')); ?>"></script>

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

<!-- App js -->
<script src="<?php echo e(asset('assets/js/jquery.core.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/jquery.app.js')); ?>"></script>
<script src="<?php echo e(asset('js/custom.js')); ?>"></script>

</body>
</html>