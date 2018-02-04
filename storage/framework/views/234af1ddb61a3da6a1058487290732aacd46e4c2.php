<?php $__env->startSection('content'); ?>
    <!-- Start content -->
    <div class="content">
        <div class="container">


            <div class="row">
                <div class="col-xs-12">
                    <div class="page-title-box">
                        <h4 class="page-title">Add Payment</h4>

                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <!-- end row -->

            <div class="row">
                <div class="col-sm-12">
                    <?php if(count($errors) > 0): ?>
                        <div class="alert alert-danger">
                            <ul>
                                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li><?php echo e($error); ?></li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </div>
                    <?php endif; ?>

                    <?php if(session()->has('message')): ?>
                        <div class="alert alert-success">
                            <?php echo e(session()->get('message')); ?>

                        </div>
                    <?php endif; ?>
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
                                                    <strong><?php echo e($invoice->invoice_code); ?></strong>
                                                </h4>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-md-12">

                                                <div class="pull-left m-t-30">

                                                    <p><strong>Patient Name: </strong> <?php echo e($invoice->patients->patient_info['full_name']); ?></p>
                                                    <p><strong>Patient Code: </strong> <?php echo e($invoice->patients->patient_code); ?></p>
                                                    <?php $age = date('Y', strtotime(Carbon\Carbon::now())) - date('Y', strtotime($invoice->patients->patient_info['date_of_birth'])); ?>
                                                    <p><strong>Age: </strong> <?php echo e($age); ?></p>

                                                    <p><strong>Gender: </strong>
                                                        <?php if($invoice->patients->patient_info['gender'] == 0): ?>
                                                            Male
                                                        <?php elseif($invoice->patients->patient_info['gender'] == 1): ?>
                                                            Female
                                                        <?php elseif($invoice->patients->patient_info['gender'] == 2): ?>
                                                            Other
                                                        <?php endif; ?></p>

                                                </div>
                                                <div class="pull-right m-t-30">
                                                    <p><strong>Doctor Name: </strong>  <?php echo e($invoice->user_informations->users['name']); ?></p>
                                                    <p><strong>Department: </strong><?php echo e($invoice->user_informations->doctor_info['department']); ?></p>
                                                    <p><strong>Created At: </strong>  <?php echo e(date('d-M-Y', strtotime($invoice->created_at))); ?></p>
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
                                                        <?php $__currentLoopData = $invoice->prescriptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pres): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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
                                        <form action="<?php echo e(url('payments')); ?>" method="post">
                                            <?php echo e(csrf_field()); ?>

                                            <input type="hidden" name="invoice_id" value="<?php echo e($invoice->id); ?>">
                                            <input type="hidden" name="doctor_id" value="<?php echo e($invoice->user_informations->id); ?>">
                                            <div class="row">
                                                <div class="col-md-6">

                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label for="grand_total" class="col-sm-4">Total Amount</label>
                                                        <div class="col-sm-8 input-group">

                                                            <input type="text" class="form-control"
                                                                   value="<?php echo e($invoice->grand_total); ?>"
                                                                   name="grand_total"
                                                                    readonly>
                                                            <span class="input-group-addon">
                                                                <?php echo e(Auth::user()->entities->currency); ?></span>

                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label for="grand_total" class="col-sm-4">Paid</label>
                                                        <div class="col-sm-8 input-group">

                                                            <input type="text" class="form-control"
                                                                   value="<?php echo e($invoice->paid); ?>"
                                                                   name="paid"
                                                                   readonly>
                                                            <span class="input-group-addon">
                                                                <?php echo e(Auth::user()->entities->currency); ?></span>

                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="grand_total" class="col-sm-4">Balance</label>
                                                        <div class="col-sm-8 input-group">

                                                            <input type="text" class="form-control"
                                                                   value="<?php echo e($invoice->balance); ?>"
                                                                   name="blnc"
                                                                   readonly>
                                                            <span class="input-group-addon">
                                                                <?php echo e(Auth::user()->entities->currency); ?></span>

                                                        </div>
                                                    </div>
                                                    <?php if($invoice->paid < $invoice->grand_total): ?>
                                                    <div class="form-group row">
                                                        <label for="grand_total" class="col-sm-4">Payment</label>
                                                        <div class="col-sm-8 input-group">

                                                            <input type="text" class="form-control"
                                                                   name="payment_cash"
                                                            >
                                                            <span class="input-group-addon">
                                                                <?php echo e(Auth::user()->entities->currency); ?></span>

                                                        </div>
                                                    </div>

                                                    <hr>
                                                    <div class="form-group row">
                                                        <div class="col-sm-9"></div>
                                                        <div class="col-sm-3">
                                                            <button type="submit" class="btn btn-inverse">Add Payment</button>
                                                        </div>
                                                    </div>
                                                    <?php endif; ?>
                                                </div>


                                            </div>
                                        </form>

                                    </div>
                                </div>

                            </div> <!-- end col -->

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
<?php $__env->stopSection(); ?>

<!--*********Page Scripts End*********-->
<?php echo $__env->make('layouts.mainHome', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>