<?php $__env->startSection('content'); ?>
    <!-- Start content -->
    <div class="content">
        <div class="container">


            <div class="row">
                <div class="col-xs-12">
                    <div class="page-title-box">

                        <h4 class="page-title">Drugs Type</h4>

                        <div class="clearfix"></div>

                    </div>
                </div>
            </div>
            <!-- end row -->

            <div class="row">
                <div class="col-xs-12">
                    <div class="card-box">

                        <div class="row">
                            <div class="col-sm-12 col-xs-12 col-md-12">

                                <h4 class="header-title m-t-0">Create Drug Type</h4>


                                <div class="p-20">
                                    <form action="<?php echo e(url('drugCategory')); ?>" method="POST">
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

                                        <div class="form-group row">
                                            <label for="drug_type" class="col-sm-3">Drug Type Name<span class="text-danger">*</span></label>
                                            <div class="col-sm-7">
                                                <input type="text" name="drug_type" parsley-trigger="change" required
                                                       placeholder="Enter Drug Type Name" class="form-control" id="service_name"/>
                                            </div>

                                            <div class="col-sm-2">
                                                <button class="btn btn-teal">Submit</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                            </div>

                        </div>
                        <!-- end row -->


                    </div> <!-- end ard-box -->
                </div><!-- end col-->

            </div>


            <div class="row">
                <div class="col-sm-12">
                    <?php if(session()->has('message')): ?>
                        <div class="alert alert-success">
                            <?php echo e(session()->get('message')); ?>

                        </div>
                    <?php endif; ?>
                    <div class="card-box table-responsive">
                        <h4 class="m-t-0 header-title"><b>Drug Types List</b></h4>


                        <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive">
                            <thead>
                            <tr>
                                <th width="5%">Sr.No</th>
                                <th>Drug Type Name</th>
                                <th width="20%">Status</th>
                                <th width="20%">Action</th>

                            </tr>
                            </thead>


                            <tbody>
                            <?php $i=1; ?>
                            <?php $__currentLoopData = $drugTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td style="color: teal;"><?php echo e($i); ?></td>
                                    <td style="font-size: 16px;"><?php echo e($type->category_name); ?></td>
                                    <td style="font-size: 16px;">
                                        <?php if($type->status == 1): ?>
                                            Active
                                            <?php else: ?>
                                            InActive
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <button class="btn btn-icon waves-effect waves-light btn-danger m-b-5" data-toggle="modal" data-target="#con-close-modal<?php echo e($type->id); ?>"><i class="fa fa-remove"></i></button>
                                    </td>

                                </tr>

                                <div id="con-close-modal<?php echo e($type->id); ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                <h4 class="modal-title">Warning!</h4>
                                            </div>
                                            <div class="modal-body">

                                                Are You Sure.You want to Delete it.
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal" style="float: right;">Close</button>

                                                <form action="<?php echo e(url('drugCategory/'.$type->id)); ?>" method="post">
                                                    <?php echo e(csrf_field()); ?>

                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <button type="submit" class="btn btn-danger waves-effect" style="float: right;margin-right: 2%;">Yes Delete it</button>

                                                </form>

                                            </div>
                                        </div>
                                    </div>
                                </div>
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