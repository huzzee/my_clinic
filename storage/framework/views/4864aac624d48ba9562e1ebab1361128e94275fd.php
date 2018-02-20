<?php $__env->startSection('content'); ?>
    <!-- Start content -->
    <div class="content">
        <div class="container">


            <div class="row">
                <div class="col-xs-12">
                    <div class="page-title-box">

                        <h4 class="page-title">Manage Payments</h4>

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
                                <th width="1%">Sr.No</th>
                                <th width="14%">Patient Name</th>
                                <th>Invoice No</th>

                                <th>Receipt No</th>
                                <th>Payment Date</th>
                                <th>Paid Amount</th>
                                <th>Action</th>

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
                ajax: '<?php echo route('get_datatable_payment.data'); ?>',
                columns: [
                    { data: 'DT_Row_Index', name: 'DT_Row_Index' },
                    { data: 'patient_name', name: 'patient_name' },
                    { data: 'invoice_code', name: 'invoice_code' },
                    { data: 'receipt_no', name: 'receipt_no' },
                    { data: 'created_date', name: 'created_date' },
                    { data: 'paid_amount', name: 'paid_amount' },
                    { data: 'action', name: 'action',orderable: false, searchable: false},



                ]
            });

        });

    </script>
<?php $__env->stopSection(); ?>

<!--*********Page Scripts End*********-->
<?php echo $__env->make('layouts.mainHome', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>