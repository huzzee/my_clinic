<?php $__env->startSection('content'); ?>
    <!-- Start content -->
    <div class="content">
        <div class="container">


            <div class="row">
                <div class="col-xs-12">
                    <div class="page-title-box">

                        <h4 class="page-title">Manage Clinics</h4>

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

                        <a class="btn btn-danger" href="<?php echo e(url('admins/create')); ?>">Create Admins</a>

                        <hr>


                        <table id="datatable-buttons" class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th width="2%">Sr.No</th>

                                <th width="15%">Clinic Name</th>

                                <th width="15%">Admin Name</th>

                                <th width="8%">Status</th>

                                <th width="8%">Action</th>

                            </tr>
                            </thead>


                            <tbody>
                            <?php $i=1;?>
                            <?php $__currentLoopData = $clinics; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $clinic): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                <td><?php echo e($i); ?></td>
                                <td><?php echo e($clinic->entity_name); ?></td>
                                <td><?php echo e($clinic->users[0]->name); ?></td>

                                <?php if($clinic->status == 1): ?>
                                    <td>Activate</td>
                                <?php else: ?>
                                    <td>Deactivate</td>
                                <?php endif; ?>
                                <td>
                                    <a href="<?php echo e(url('clinics/'.$clinic->id)); ?>" class="btn btn-icon waves-effect waves-light btn-teal m-b-5" style="">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                </td>

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