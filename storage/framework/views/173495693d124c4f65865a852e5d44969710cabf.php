<?php $__env->startSection('content'); ?>
    <!-- Start content -->
    <div class="content">
        <div class="container">


            <div class="row">
                <div class="col-xs-12">
                    <div class="page-title-box">

                        <h4 class="page-title">Manage Drugs</h4>

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
                        <div class="alert alert-icon alert-info alert-dismissible fade in" role="alert">
                            <button type="button" class="close" data-dismiss="alert"
                                    aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <i class="mdi mdi-information"></i>
                            <strong>Heads up!</strong> Red Background drugs stock low.
                        </div>
                    <div class="card-box table-responsive">

                        <a class="btn btn-danger" href="<?php echo e(url('drugs/create')); ?>">Create Drugs</a>

                        <hr>


                        <table id="datatable_laravel" class="table table-striped table-bordered dt-responsive">
                            <thead>
                                <tr>

                                    <th width="5%">Sr.No</th>
                                    <th width="15%">Name</th>
                                    <th>Type</th>
                                    <th>Dosage</th>
                                    <th>Retail Price</th>
                                    <th>Current Qnt</th>
                                    <th>Used Qnt</th>
                                    <th>status</th>


                                    <th width="15%">Action</th>

                                </tr>
                            </thead>
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

        $(function() {

            $('#datatable_laravel').DataTable({
                processing: false,
                serverSide: false,
                ajax: '<?php echo route('get_datatable_drug.data'); ?>',
                columns: [
                    { data: 'DT_Row_Index', name: 'DT_Row_Index' },
                    { data: 'medicine_info.drug_name', name: 'medicine_info.drug_name' },
                    { data: 'medicine_info.drug_type', name: 'medicine_info.drug_type' },
                    { data: 'dosage_amount', name: 'dosage_amount' },
                    { data: 'retail_price', name: 'retail_price' },
                    { data: 'medicine_info.current_qnt', name: 'medicine_info.current_qnt' },
                    { data: 'medicine_info.used_qnt', name: 'medicine_info.used_qnt' },
                    { data: 'status', name: 'status' },
                    {data: 'action', name: 'action', orderable: false, searchable: false}

                ]
            });

        });

    </script>
<?php $__env->stopSection(); ?>

<!--*********Page Scripts End*********-->
<?php echo $__env->make('layouts.mainHome', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>