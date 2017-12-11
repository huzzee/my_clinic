<?php $__env->startSection('content'); ?>
    <!-- Start content -->
    <div class="content">
        <div class="container">


            <div class="row">
                <div class="col-xs-12">
                    <div class="page-title-box">

                        <h4 class="page-title">Manage Invoice</h4>

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


                    <div class="card-box table-responsive">

                        <?php if(Auth::user()->role_id == 3 || Auth::user()->role_id == 2): ?>
                        <button class="btn btn-danger waves-effect waves-light" data-toggle="modal"
                                data-target="#con-close-modal">
                            Add Invoice
                        </button>
                        <?php endif; ?>

                        <div id="con-close-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">

                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                        <h4 class="modal-title">Add Invoice</h4>
                                    </div>
                                    <form action="<?php echo e(url('invoice_add')); ?>" method="post">
                                        <div class="modal-body">


                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="pats" class="control-label">Select Patient<span class="text-danger">*</span></label>
                                                        <select class="form-control select2" id="patient_id" name="patient_id">
                                                            <option selected disabled="disabled">Select Patient</option>

                                                            <?php $__currentLoopData = $patients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $patient): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <option value="<?php echo e($patient->id); ?>"><?php echo e($patient->patient_info['full_name']); ?>(<?php echo e($patient->patient_code); ?>)</option>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                                        </select>
                                                    </div>
                                                </div>

                                            </div>
                                            <input type="hidden" name="doctor_id" value="<?php echo e(Auth::user()->id); ?>">
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                                            <?php echo e(csrf_field()); ?>



                                            <button type="submit" class="btn btn-inverse waves-effect" style="float: left;margin-right: 2%;">Add To Invoice</button>
                                        </div>
                                    </form>
                                </div>
                            </div>

                        </div><!-- /.modal -->

                        <hr>

                        <table id="datatable-buttons" class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th width="1%">Sr.No</th>
                                <th width="14%">Patient Name</th>
                                <th>Invoice No</th>
                                <th width="14%">Created By</th>
                                <th width="12%">Grand Total</th>
                                <th width="10%">Balance</th>
                                <th width="10%">Paid</th>
                                <th width="10%">Status</th>
                                <th width="12%">Action</th>

                            </tr>
                            </thead>


                            <tbody>
                            <?php $i=1; ?>
                            <?php $__currentLoopData = $invoices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $invoice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($i); ?></td>
                                        <td><?php echo e($invoice->patients->patient_info['full_name']); ?></td>
                                        <td><?php echo e($invoice->invoice_code); ?></td>
                                        <td><?php echo e($invoice->user_informations->users['name']); ?></td>
                                        <td><?php echo e($invoice->grand_total); ?> <?php echo e(Auth::user()->entities->currency); ?></td>
                                        <td style="color: red;"><?php echo e($invoice->balance); ?> <?php echo e(Auth::user()->entities->currency); ?></td>
                                        <td style="color: green;"><?php echo e($invoice->paid); ?> <?php echo e(Auth::user()->entities->currency); ?></td>
                                        <td>
                                            <?php if($invoice->paid < $invoice->grand_total): ?>
                                                UnPaid
                                            <?php elseif($invoice->paid == $invoice->grand_total): ?>
                                                Paid
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php if($invoice->paid < $invoice->grand_total): ?>
                                                <a href="<?php echo e(url('payments/'.$invoice->id)); ?>"
                                                   style="font-weight: bold; font-size: 140%;color: #2b4a95"
                                                   data-toggle="tooltip" data-placement="top" title=""
                                                   data-original-title="Add Payment"><i class="fa fa-dollar"></i></a>
                                            <?php elseif($invoice->paid == $invoice->grand_total): ?>
                                                <a
                                                   style="font-weight: bold; font-size: 120%;color: #2abfcc"
                                                   disabled="disabled"><i class="fa fa-dollar"></i></a>
                                            <?php endif; ?>

                                            &nbsp;

                                            <a href="<?php echo e(url('invoices/'.$invoice->id)); ?>"
                                               style="font-weight: bold; font-size: 120%;color: #2b4a95"
                                               data-toggle="tooltip" data-placement="top" title=""
                                               data-original-title="Show Invoice"><i class="fa fa-eye"></i></a>
                                                &nbsp;

                                            <?php if($invoice->paid !==  $invoice->grand_total && $invoice->user_informations->user_id == Auth::user()->id): ?>
                                            <a href="<?php echo e(url('invoices/'.$invoice->id.'/edit')); ?>"
                                                style="font-weight: bold; font-size: 120%;color: #2b4a95"
                                                data-toggle="tooltip" data-placement="top" title=""
                                                data-original-title="Edit Invoice"><i class="fa fa-pencil"></i></a>
                                            <?php else: ?>

                                            <a
                                               style="font-weight: bold; font-size: 120%;color: #2abfcc"
                                               ><i class="fa fa-pencil"></i></a>
                                            <?php endif; ?>
                                                &nbsp;

                                                &nbsp;

                                            <button
                                               style="font-weight: bold; border: none; background: none; font-size: 120%;color: #2b4a95"
                                               data-toggle="modal" data-target="#full-width-modal<?php echo e($invoice->id); ?>"><i class="fa fa-list"></i></button>

                                            <div id="full-width-modal<?php echo e($invoice->id); ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="full-width-modalLabel" aria-hidden="true" style="display: none;">
                                                <div class="modal-dialog modal-full">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                            <h4 class="modal-title" id="full-width-modalLabel">Receipts List</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <table class="table m-t-30">
                                                                <thead>
                                                                <tr>
                                                                    <th width="1%">Sr.No</th>
                                                                    <th width="14%">Patient Name</th>
                                                                    <th width="14%">Receipt No</th>
                                                                    <th width="14%">Payment Date</th>
                                                                    <th width="10%">Paid Amount</th>
                                                                    <th width="5%">Action</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                <?php $i=1; ?>
                                                                <?php $__currentLoopData = $invoice->payments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <tr>
                                                                        <td><?php echo e($i); ?></td>
                                                                        <td><?php echo e($invoice->patients->patient_info['full_name']); ?></td>

                                                                        <td><?php echo e($payment->receipt_no); ?></td>
                                                                        <td><?php echo e(date('d-M-Y',strtotime($payment->created_at))); ?></td>

                                                                        <td style="color: green;"><?php echo e($payment->paid_amount); ?> <?php echo e(Auth::user()->entities->currency); ?></td>

                                                                        <td>

                                                                            <a href="<?php echo e(url('payments_print/'.$payment->id)); ?>"
                                                                               class="btn btn-inverse"
                                                                               target="_blank"
                                                                               data-toggle="tooltip" data-placement="top" title=""
                                                                               data-original-title="Print Payment"><i class="fa fa-print"></i></a>

                                                                        </td>
                                                                    </tr>
                                                                    <?php $i++; ?>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>

                                                        </div>
                                                    </div><!-- /.modal-content -->
                                                </div><!-- /.modal-dialog -->
                                                </div><!-- /.modal -->


                                        </td>
                                    </tr>

                                <?php $i++; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            </tbody>
                        </table>
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

    <script src="<?php echo e(asset('assets/pages/jquery.form-advanced.init.js')); ?>"></script>


    <script src="<?php echo e(asset('assets/plugins/datatables/jquery.dataTables.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/plugins/datatables/dataTables.bootstrap.js')); ?>"></script>

    <script src="<?php echo e(asset('assets/plugins/datatables/dataTables.buttons.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/plugins/datatables/buttons.bootstrap.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/plugins/datatables/jszip.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/plugins/datatables/pdfmake.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/plugins/datatables/vfs_fonts.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/plugins/datatables/buttons.html5.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/plugins/datatables/buttons.print.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/plugins/datatables/dataTables.fixedHeader.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/plugins/datatables/dataTables.keyTable.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/plugins/datatables/dataTables.responsive.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/plugins/datatables/responsive.bootstrap.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/plugins/datatables/dataTables.scroller.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/plugins/datatables/dataTables.colVis.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/plugins/datatables/dataTables.fixedColumns.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/plugins/custombox/js/custombox.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/plugins/custombox/js/legacy.min.js')); ?>"></script>

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