<?php $__env->startSection('content'); ?>
    <!-- Start content -->
    <div class="content">
        <div class="container">


            <div class="row">
                <div class="col-xs-12">
                    <div class="page-title-box">
                        <h4 class="page-title">Drug Profile</h4>

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
                            <div class="col-lg-12 col-md-12">
                                <div class="box-header" style="float: left; width: 100%;">

                                    <a href="<?php echo e(url('drugs')); ?>"
                                       class="btn btn-icon waves-effect waves-light btn-info m-b-5">
                                        Manage drugs

                                    </a>

                                    <a href="<?php echo e(url('drugs/'.$drug->id.'/edit')); ?>"
                                       class="btn btn-icon waves-effect waves-light btn-purple m-b-5">
                                        Edit drug

                                    </a>

                                    <button class="btn btn-inverse waves-effect waves-light" data-toggle="modal"
                                            style="float:right;" data-target="#con-close-modal">
                                        Adjust Drug Stock

                                    </button>

                                    

                                    <div id="con-close-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                        <form action="<?php echo e(url('updateStock',$drug->id)); ?>" method="post" enctype="multipart/form-data">
                                            <?php echo e(csrf_field()); ?>

                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                    <h4 class="modal-title">Adjust Drug Stock</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="field-1" class="control-label">Quantity<span class="text-danger">*</span></label>
                                                                <input type="number" name="qnt" class="form-control" id="field-1" placeholder="Quantity" required>
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="field-3" class="control-label">Expiry Date<span class="text-danger">*</span></label>
                                                                <input type="text" class="form-control"
                                                                       name="expiry_date" placeholder="mm/dd/yyyy" id="datepicker-autoclose" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label for="field-4" class="control-label">Adjustment</label><br>
                                                                <div class="radio radio-success radio-inline">
                                                                    <input type="radio" id="inlineRadio1" name="adjust" value="0">
                                                                    <label for="inlineRadio1"> Increase(+) </label>
                                                                </div>
                                                                <div class="radio radio-danger radio-inline">
                                                                    <input type="radio" id="inlineRadio2" name="adjust" value="1">
                                                                    <label for="inlineRadio2"> Decrease(-) </label>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-inverse waves-effect waves-light">Update Stock</button>
                                                </div>
                                            </div>
                                        </div>
                                        </form>
                                    </div><!-- /.modal -->



                                    


                                    <a href="javascript:void(0);"
                                       onclick="window.print();"

                                       class="btn btn-icon waves-effect waves-light btn-inverse m-b-5">
                                        <i class="fa fa-print"></i>

                                    </a>


                                </div>

                                <div class="text-center card-box" style="clear: both;">
                                    <div class="member-card">

                                        <div class="row">
                                            <div class="col-sm-6">
                                                <table border="1" width="100%" cellspacing="10px">

                                                    <tr style="height: 40px;">
                                                       <td width="40%" style="background-color: whitesmoke; font-weight: bold;">Drug Name</td>
                                                        <td><?php echo e($drug->medicine_info['drug_name']); ?></td>
                                                    </tr>
                                                    <tr style="height: 40px;">
                                                        <td width="40%" style="background-color: whitesmoke; font-weight: bold;">Drug Type</td>
                                                        <td><?php echo e($drug->medicine_info['drug_type']); ?></td>
                                                    </tr>
                                                    <tr style="height: 40px;">
                                                        <td width="40%" style="background-color: whitesmoke; font-weight: bold;">Dosage</td>
                                                        <td> <?php echo e($drug->medicine_info['dosage_amount']); ?>.<?php echo e($drug->medicine_info['dosage_unit']); ?></td>
                                                    </tr>
                                                    <tr style="height: 40px;">
                                                        <td width="40%" style="background-color: whitesmoke; font-weight: bold;">Generic Name</td>
                                                        <td><?php echo e($drug->medicine_info['generic']); ?></td>
                                                    </tr>
                                                    <tr style="height: 40px;">
                                                        <td width="40%" style="background-color: whitesmoke; font-weight: bold;">Company Name</td>
                                                        <td><?php echo e($drug->medicine_info['company']); ?></td>
                                                    </tr>
                                                    <tr style="height: 40px;">
                                                        <td width="40%" style="background-color: whitesmoke; font-weight: bold;">Status</td>

                                                        <?php if($drug->medicine_info['status'] == 1): ?>
                                                            <td>Active</td>
                                                        <?php else: ?>
                                                            <td>Inactive</td>
                                                        <?php endif; ?>

                                                    </tr>
                                                    <tr style="height: 40px;">
                                                        <td width="40%" style="background-color: whitesmoke; font-weight: bold;">Purchase Price</td>
                                                        <td><?php echo e($drug->medicine_info['purchase_price']); ?></td>
                                                    </tr>
                                                    <tr style="height: 40px;">
                                                        <td width="40%" style="background-color: whitesmoke; font-weight: bold;">Purchase gst</td>
                                                        <td><?php echo e($drug->medicine_info['purchase_gst']); ?> %</td>
                                                    </tr>
                                                    <tr style="height: 40px;">
                                                        <td width="40%" style="background-color: whitesmoke; font-weight: bold;">Expiry Date</td>
                                                        <?php if($drug->medicine_info['expiry_date'] !== null): ?>
                                                        <td><?php echo e(date('m-d-Y',strtotime($drug->medicine_info['expiry_date']))); ?></td>
                                                        <?php else: ?>
                                                        <td>Not Set</td>
                                                        <?php endif; ?>
                                                    </tr>

                                                </table>
                                            </div>
                                            <div class="col-sm-6">
                                                <table border="1" width="100%" cellspacing="10px">


                                                    <tr style="height: 40px;">
                                                        <td width="40%" style="background-color: whitesmoke; font-weight: bold;">Retail Price</td>
                                                        <td> <?php echo e($drug->medicine_info['retail_price']); ?></td>
                                                    </tr>
                                                    <tr style="height: 40px;">
                                                        <td width="40%" style="background-color: whitesmoke; font-weight: bold;">Retail gst</td>
                                                        <td><?php echo e($drug->medicine_info['retail_gst']); ?> %</td>
                                                    </tr>
                                                    <tr style="height: 40px;">
                                                        <td width="40%" style="background-color: whitesmoke; font-weight: bold;">Stock Unit</td>
                                                        <td><?php echo e($drug->medicine_info['stock_unit']); ?></td>
                                                    </tr>
                                                    <tr style="height: 40px;">
                                                        <td width="40%" style="background-color: whitesmoke; font-weight: bold;">Bought Quantity</td>
                                                        <td><?php echo e($drug->medicine_info['bought_qnt']); ?></td>
                                                    </tr>
                                                    <tr style="height: 40px;">
                                                        <td width="40%" style="background-color: whitesmoke; font-weight: bold;">Current Quantity</td>
                                                        <td><?php echo e($drug->medicine_info['current_qnt']); ?></td>
                                                    </tr>
                                                    <tr style="height: 40px;">
                                                        <td width="40%" style="background-color: whitesmoke; font-weight: bold;">Used Quantity</td>
                                                        <td><?php echo e($drug->medicine_info['used_qnt']); ?></td>

                                                    </tr>
                                                    <tr style="height: 40px;">
                                                        <td width="40%" style="background-color: whitesmoke; font-weight: bold;">Warning Quantity</td>
                                                        <td><?php echo e($drug->medicine_info['min_qnt']); ?></td>
                                                    </tr>

                                                    <tr style="height: 40px;">
                                                        <td width="40%" style="background-color: whitesmoke; font-weight: bold;">Created Date</td>
                                                        <td><?php echo e(date('m-d-Y',strtotime($drug->created_at))); ?></td>
                                                    </tr>


                                                </table>
                                            </div>
                                        </div>

                                    </div>
                                </div><!-- end card-box -->

                            </div> <!-- end col -->


                            <!-- end col -->

                        </div>
                    </div>
                </div>
            </div>
            <!-- End row -->

            <div class="row">
                <div class="col-sm-12">
                    <?php if(session()->has('message')): ?>
                        <div class="alert alert-success">
                            <?php echo e(session()->get('message')); ?>

                        </div>
                    <?php endif; ?>
                    <div class="card-box table-responsive">
                        <h4 class="m-t-0 header-title"><b>Adjustment List</b></h4>


                        <table id="datatable-responsive"
                               class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0"
                               width="100%">
                            <thead>
                            <tr>
                                <th width="5%">Sr.No</th>
                                <th>Adjust By</th>
                                <th width="10%">Adjust Type</th>
                                <th>Adjust Quantity</th>
                                <th>Adjustment Date</th>


                            </tr>
                            </thead>


                            <tbody>
                            <?php $i=1; ?>
                            <?php $__currentLoopData = $drug->adjustments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $adjust): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($i); ?></td>
                                    <td><?php echo e($adjust->users->name); ?> (<?php echo e($adjust->users->roles->role_name); ?>)</td>
                                    <td>
                                        <?php if($adjust->adjust == 0): ?>
                                            Increase
                                        <?php else: ?>
                                            Decrease
                                        <?php endif; ?>
                                    </td>
                                    <td><?php echo e($adjust->bought_qnt); ?></td>
                                    <td><?php echo e(date('H:i/d-M-Y',strtotime($adjust->created_at))); ?></td>

                                </tr>


                                <?php $i++; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div> <!-- container -->

    </div>

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

    <script src="<?php echo e(asset('assets/plugins/datatables/jquery.dataTables.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/plugins/datatables/dataTables.bootstrap.js')); ?>"></script>


    <script src="<?php echo e(asset('assets/plugins/datatables/dataTables.responsive.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/plugins/datatables/responsive.bootstrap.min.js')); ?>"></script>

    <!-- init -->
    <script src="<?php echo e(asset('assets/pages/jquery.datatables.init.js')); ?>"></script>


    <script type="text/javascript">
        $(document).ready(function () {
            $('#datatable').dataTable();
            $('#datatable-keytable').DataTable({keys: true});
            $('#datatable-responsive').DataTable();
            $('#datatable-colvid').DataTable({
                "dom": 'C<"clear">lfrtip',
                "colVis": {
                    "buttonText": "Change columns"
                }
            });
            $('#datatable-scroller').DataTable({
                ajax: "../plugins/datatables/json/scroller-demo.json",
                deferRender: true,
                scrollY: 380,
                scrollCollapse: true,
                scroller: true
            });
            var table = $('#datatable-fixed-header').DataTable({fixedHeader: true});
            var table = $('#datatable-fixed-col').DataTable({
                scrollY: "300px",
                scrollX: true,
                scrollCollapse: true,
                paging: false,
                fixedColumns: {
                    leftColumns: 1,
                    rightColumns: 1
                }
            });
        });
        TableManageButtons.init();

    </script>
<?php $__env->stopSection(); ?>

<!--*********Page Scripts End*********-->
<?php echo $__env->make('layouts.mainHome', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>