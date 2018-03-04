<?php $__env->startSection('content'); ?>
    <!-- Start content -->
    <div class="content">
        <div class="container">


            <div class="row">
                <div class="col-xs-12">
                    <div class="page-title-box">

                        <h4 class="page-title">Manage Prescriptions</h4>

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

                        <table id="datatable_laravel" class="table table-striped table-bordered dt-responsive">
                            <thead>
                            <tr>
                                <th width="5%">Sr.No</th>
                                <th>Patient Name</th>
                                <th>Doctor Name</th>
                                <th>Queue Code</th>
                                <th width="40%">Prescriptions</th>
                                <th width="15%">Action</th>

                            </tr>
                            </thead>


                            <tbody>
                            <?php $i=1; ?>
                            <?php $__currentLoopData = $prescriptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $prescription): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($i); ?></td>
                                    <td><?php echo e($prescription->patients->patient_info['full_name']); ?></td>
                                    <td><?php echo e($prescription->user_informations->users->name); ?></td>
                                    <td><?php echo e($prescription->queues->queue_code); ?></td>
                                    <td>
                                        <?php $__currentLoopData = $prescription->prescriptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $items): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php echo e($items['drug_name']); ?>/
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </td>
                                    <td>
                                        

                                        <a href="<?php echo e(url('prescriptions/'.$prescription->id)); ?>"
                                           class="btn btn-icon waves-effect waves-light btn-inverse m-b-5"
                                            target="_blank">
                                            <i class="fa fa-print"></i>
                                        </a>

                                        <a href="<?php echo e(url('invoices/'.$prescription->id.'/edit')); ?>"
                                           class="btn btn-icon waves-effect waves-light btn-warning m-b-5">
                                            <i class="fa fa-plus"></i>
                                        </a>

                                        <button data-toggle="modal" data-target="#full-width-modal<?php echo e($prescription->id); ?>" class="btn btn-icon btn-teal waves-effect waves-light m-b-5"><i class="fa fa-list"></i></button>

                                        <div id="full-width-modal<?php echo e($prescription->id); ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="full-width-modalLabel" aria-hidden="true" style="display: none;">
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
                                                                <th width="14%">Invoice Code</th>

                                                                <th width="14%">Date & Time</th>
                                                                <th width="10%">Total Bill Amount</th>
                                                                <th width="10%">Paid Amount</th>
                                                                <th width="5%">Action</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php $p=1; ?>

                                                                <?php $__currentLoopData = $prescription->invoices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $invoice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <tr>
                                                                        <td><?php echo e($p); ?></td>
                                                                        <td><?php echo e($invoice->invoice_code); ?></td>
                                                                        <td><?php echo e(date('d-M-Y g:i a',strtotime($invoice->created_at))); ?></td>
                                                                        <td><?php echo e($invoice->grand_total); ?></td>
                                                                        <td><?php echo e($invoice->paid); ?></td>
                                                                        <td>
                                                                            <a href="<?php echo e(url('invoices/'.$invoice->id)); ?>" class="btn btn-info"><i class="fa fa-eye"></i></a>
                                                                        </td>
                                                                    </tr>

                                                                <?php $p++ ?>

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
                <div class="col-sm-12">
                    <?php echo e($prescriptions->links()); ?>

                </div>
            </div>

        </div> <!-- container -->

    </div> <!-- content -->

<?php $__env->stopSection(); ?>

<!--*********Page Scripts Here*********-->

<?php $__env->startSection('scripts'); ?>

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