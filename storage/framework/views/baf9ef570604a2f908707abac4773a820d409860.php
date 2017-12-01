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
                            <div class="panel panel-default">
                                <!-- <div class="panel-heading">
                                    <h4>Invoice</h4>
                                </div> -->

                                <div class="panel-body">
                                    <div class="clearfix">
                                        <div class="pull-left">
                                            <h3><img src="<?php echo e(asset('logo/klinic.png')); ?>" alt="" height="44"><?php echo e(Auth::user()->entities->entity_name); ?></h3>
                                        </div>
                                        <div class="pull-right">
                                            <h4>Invoice # <br>
                                                <strong><?php echo e($payment->invoices->invoice_code); ?></strong>
                                            </h4>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-12">

                                            <div class="pull-left m-t-30">

                                                <p><strong>Patient Name: </strong> <?php echo e($payment->invoices->patients->patient_info['full_name']); ?></p>
                                                <p><strong>Patient Code: </strong> <?php echo e($payment->invoices->patients->patient_code); ?></p>
                                                <?php $age = date('Y', strtotime(Carbon\Carbon::now())) - date('Y', strtotime($payment->invoices->patients->patient_info['date_of_birth'])); ?>
                                                <p><strong>Age: </strong> <?php echo e($age); ?></p>

                                                <p><strong>Gender: </strong>
                                                    <?php if($payment->invoices->patients->patient_info['gender'] == 0): ?>
                                                        Male
                                                    <?php elseif($payment->invoices->patients->patient_info['gender'] == 1): ?>
                                                        Female
                                                    <?php elseif($payment->invoices->patients->patient_info['gender'] == 2): ?>
                                                        Other
                                                    <?php endif; ?></p>
                                                <p><strong>Payment Date: </strong> <?php echo e(date('d-M-Y', strtotime($payment->created_at))); ?></p>

                                            </div>
                                            <div class="pull-right m-t-30">
                                                <p><strong>Doctor Name: </strong>  <?php echo e($payment->user_informations->users['name']); ?></p>
                                                <p><strong>Department: </strong><?php echo e($payment->user_informations->doctor_info['department']); ?></p>
                                                <p><strong>Billing Date: </strong>  <?php echo e(date('d-M-Y', strtotime($payment->invoices->created_at))); ?></p>
                                                <p><strong>Receipt No: </strong>  <?php echo e($payment->receipt_no); ?></p>
                                            </div>
                                        </div><!-- end col -->
                                    </div>
                                    <!-- end row -->

                                    <div class="m-h-50"></div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="table-responsive">
                                                <table class="table m-t-30">
                                                    <thead>
                                                    <tr>
                                                        <th width="1%">#</th>
                                                        <th width="15%" style="text-align: center">Item Name</th>
                                                        <th>Quantity</th>
                                                        <th>Price</th>
                                                        <th>Sub Total</th>
                                                        <th>Discount</th>
                                                        <th width="15%">Discount Remark</th>
                                                        <th>Gst</th>
                                                        <th>Line Total</th>

                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php $i=1; ?>
                                                    <?php $__currentLoopData = $payment->prescriptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pres): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <tr>
                                                            <td><?php echo e($i); ?></td>
                                                            <td><?php echo e($pres['drug_name']); ?></td>
                                                            <td><?php echo e($pres['drug_qnt']); ?></td>
                                                            <td><?php echo e($pres['price']); ?></td>
                                                            <td><?php echo e($pres['sub_total']); ?></td>
                                                            <td><?php echo e($pres['discount']); ?> %</td>
                                                            <td><?php echo e($pres['remark']); ?></td>
                                                            <td><?php echo e($pres['gst']); ?> %</td>
                                                            <td><?php echo e($pres['line_total']); ?></td>
                                                        </tr>
                                                        <?php $i++; ?>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>

                                        <div class="row">
                                            <div class="col-md-6">

                                            </div>

                                            <div class="col-md-6">

                                                <div class="form-group row">
                                                    <label for="grand_total" class="col-sm-4">Paid</label>
                                                    <div class="col-sm-8 input-group">

                                                        <input type="text" class="form-control"
                                                               value="<?php echo e($payment->paid_amount); ?>"
                                                               name="paid"
                                                               readonly>
                                                        <span class="input-group-addon">
                                                                <?php echo e(Auth::user()->entities->currency); ?></span>

                                                    </div>
                                                </div>


                                            </div>


                                        </div>


                                </div>
                            </div>

                        </div> <!-- end col -->

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