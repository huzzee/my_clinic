<?php $__env->startSection('content'); ?>
    <!-- Start content -->
    <div class="content">
        <div class="container">


            <div class="row">
                <div class="col-xs-12">
                    <div class="page-title-box">
                        <h4 class="page-title">Add Invoice & Prescription</h4>

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
                            <div class="col-lg-6 col-md-6">
                                <div class="text-center card-box">
                                    <div class="member-card">

                                        <h4>Patient Information</h4>
                                        <hr>
                                        <div class="text-left">
                                            <p class="text-muted font-13"><strong>Full Name :</strong> <span class="m-l-15">
                                                    <?php echo e($queue->patients->patient_info['full_name']); ?></span></p>

                                            <p class="text-muted font-13"><strong>Patient Code :</strong><span class="m-l-15">
                                                <?php echo e($queue->patients->patient_code); ?></span></p>

                                            <p class="text-muted font-13"><strong>Age :</strong> <span class="m-l-15">
                                                    <?php $age = date('Y', strtotime(Carbon\Carbon::now())) - date('Y', strtotime($queue->patients->patient_info['date_of_birth'])); ?>
                                                    <?php echo e($age); ?></span></p>

                                            <p class="text-muted font-13"><strong>Gender :</strong>
                                                <span class="m-l-15">
                                                    <?php if($queue->patients->patient_info['gender'] == 0): ?>
                                                        Male
                                                    <?php elseif($queue->patients->patient_info['gender'] == 1): ?>
                                                        Female
                                                    <?php elseif($queue->patients->patient_info['gender'] == 2): ?>
                                                        Other

                                                    <?php endif; ?>
                                                </span></p>

                                            <p class="text-muted font-13"><strong>Drug Allergy :</strong><span class="m-l-15">
                                                <?php $__currentLoopData = $queue->patients->drug_allergy; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $allergy): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php echo e($allergy); ?>,
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></span></p>

                                        </div>

                                    </div>
                                </div> <!-- end card-box -->
                            </div> <!-- end col -->
                            <div class="col-lg-6 col-md-6" >
                                <div class="text-center card-box" style="min-height: 270px">
                                    <div class="member-card">

                                        <h4>Doctor Information</h4>
                                        <hr>
                                        <div class="text-left">
                                            <p class="text-muted font-13"><strong>Full Name :</strong> <span class="m-l-15">
                                                    <?php echo e($queue->user_informations->users['name']); ?></span></p>

                                            <p class="text-muted font-13"><strong>Department :</strong><span class="m-l-15">
                                                <?php echo e($queue->user_informations->doctor_info['department']); ?></span></p>



                                        </div>


                                    </div>
                                </div> <!-- end card-box -->
                            </div> <!-- end col -->


                            <div class="col-lg-12 col-md-12">
                                <div class="text-center card-box">
                                    <div class="member-card">
                                        <div class="row">

                                            <button class="btn btn-primary waves-effect waves-light" data-toggle="modal"
                                                    data-target="#con-close-modalmed">
                                                <i class="fa fa-plus"></i>
                                                Add Medicine
                                            </button>

                                            <button class="btn btn-success waves-effect waves-light" data-toggle="modal"
                                                    data-target="#con-close-modalservice">
                                                <i class="fa fa-plus"></i>
                                                Add Service
                                            </button>



                                            <div id="con-close-modalmed" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">

                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                            <h4 class="modal-title">Add Medicine</h4>
                                                        </div>
                                                        <div class="modal-body">


                                                            <div class="row" id="hide_press">
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label for="pats" class="control-label" style="float:left;">Prescription<span class="text-danger">*</span></label>
                                                                        <select class="form-control select2" id="presc">
                                                                            <option selected="selected">Prescription</option>
                                                                            <option value="1">New Prescription</option>


                                                                        </select>
                                                                    </div>
                                                                </div>

                                                            </div>

                                                            <div class="row" id="show_press" style="display: none;">
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label for="pats" class="control-label"  style="float:left;">Select Medicines<span class="text-danger">*</span></label>
                                                                        <select class="form-control select2" id="drug_pres">
                                                                            <option value="0">Select Medicines</option>

                                                                            <?php $__currentLoopData = $medicines; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $medicine): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                                <option value="<?php echo e($medicine->id); ?>"><?php echo e($medicine->medicine_info['drug_name']); ?></option>
                                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label for="current_qnt" class="control-label"  style="float:left;">Current Quantity<span class="text-danger">*</span></label>
                                                                        <input type="text" class="form-control" value="" readonly="true" id="current_qnt">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="pats" class="control-label"  style="float:left;">Stock Unit<span class="text-danger">*</span></label>
                                                                        <input type="text" class="form-control" value="" readonly="true" id="stock_unit">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="pats" class="control-label"  style="float:left;">Quantity<span class="text-danger">*</span></label>
                                                                        <input type="number" class="form-control" placeholder="Enter Quantity" id="medicine_qnt">
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="pats" class="control-label"  style="float:left;">Dosage Unit<span class="text-danger">*</span></label>
                                                                        <input type="text" class="form-control" value="" readonly="true" id="dosage_unit">
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="pats" class="control-label"  style="float:left;">Dosage Quantity<span class="text-danger">*</span></label>
                                                                        <input type="number" class="form-control" placeholder="Enter Dose" id="dosage_qnt">
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="pats" class="control-label"  style="float:left;">Price</label>
                                                                        <input type="text" class="form-control" readonly id="price_med">
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="pats" class="control-label"  style="float:left;">Gst In %</label>
                                                                        <input type="text" class="form-control" id="gst">

                                                                    </div>
                                                                </div>

                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="pats" class="control-label"  style="float:left;">Discount in %</label>
                                                                        <input type="number" class="form-control" value="0" placeholder="Enter Discount in %" id="discount">

                                                                    </div>
                                                                </div>

                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label for="pats" class="control-label"  style="float:left;">Discount Remarks</label>
                                                                        <input type="text" class="form-control" placeholder="Enter Discount Remarks" id="remark">
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-8">
                                                                    <div class="form-group">
                                                                        <label for="pats" class="control-label"  style="float:left;">Instruction<span class="text-danger">*</span></label>
                                                                        <textarea id="textarea" class="instruction form-control" maxlength="500" rows="5" placeholder="Instruction"></textarea>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label for="pats" class="control-label"  style="float:left;">Days<span class="text-danger">*</span></label>
                                                                        <input type="number" class="form-control" placeholder="Enter Days" id="days">
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                        <div class="modal-footer" id="pres_foot" style="display: none;">
                                                            <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                                                            <a href="#" class="btn btn-inverse waves-effect waves-light" id="add_pres_here">Add Medicine</a>
                                                        </div>


                                                    </div>
                                                </div>

                                            </div><!-- /.modal -->

                                            <div id="con-close-modalservice" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">

                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                            <h4 class="modal-title">Add Services</h4>
                                                        </div>
                                                        <div class="modal-body">

                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <label for="pats" class="control-label" style="float:left;">Select Services<span class="text-danger">*</span></label>
                                                                        <select class="form-control select2" id="service_pres">
                                                                            <option selected="selected" value="0">Select Services</option>
                                                                            <option value="1">Our Clinic Services</option>
                                                                            <option value="2">Other Clinic Services</option>

                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div id="hide_our" style="display: none;">
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="form-group">
                                                                            <label for="pats" class="control-label" style="float:left;">Category<span class="text-danger">*</span></label>
                                                                            <select class="form-control select2" id="category_pres">
                                                                                <option selected="selected" value="0">Select Category</option>

                                                                                <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                                    <option value="<?php echo e($category->id); ?>"><?php echo e($category->category_name); ?></option>
                                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                                                            </select>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for="pats" class="control-label" style="float:left;">Test/Service<span class="text-danger">*</span></label>
                                                                            <select class="form-control select2" id="serve_press">
                                                                                <option selected="selected" value="0">Select Test/Service</option>

                                                                            </select>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for="pats" class="control-label"  style="float:left;">Price</label>
                                                                            <input type="text" class="form-control" readonly id="service_price">

                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            </div>

                                                            <div id="hide_other" style="display: none;">
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="form-group">
                                                                            <label for="pats" class="control-label"  style="float:left;">Enter Service Name<span class="text-danger">*</span></label>
                                                                            <input type="text" class="form-control" id="service_name" placeholder="Service Name">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-12">
                                                                        <div class="form-group">
                                                                            <label for="pats" class="control-label"  style="float:left;">Enter Service Detail</label>
                                                                            <textarea id="textarea" class="detail_service form-control" maxlength="500" rows="5" placeholder="Detail"></textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <div class="modal-footer" id="cat_foot" style="display: none;">
                                                            <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                                                            <a href="#" class="btn btn-inverse waves-effect waves-light" id="add_service_here">Add Service</a>
                                                        </div>


                                                    </div>
                                                </div>

                                            </div><!-- /.modal -->
                                        </div>
                                        <div class="row" style="height: 20px;"></div>
                                        <form id="invoicing" action="<?php echo e(url('invoices')); ?>" method="post">
                                            <?php echo e(csrf_field()); ?>

                                            <input type="hidden" name="patient_id" value="<?php echo e($queue->patients->id); ?>">
                                            <input type="hidden" name="doctor_id" value="<?php echo e($queue->user_informations->id); ?>">
                                            <input type="hidden" name="queue_id" value="<?php echo e($queue->id); ?>">
                                            <div class="row" style="min-height: 300px;">

                                                <table class="table table-striped m-0">
                                                    <thead>
                                                    <tr>

                                                        <th width="15%" style="text-align: center">Item Name</th>
                                                        <th>Quantity</th>
                                                        <th>Price</th>
                                                        <th>Sub Total</th>
                                                        <th>Discount</th>
                                                        <th width="15%">Discount Remark</th>
                                                        <th>Gst</th>
                                                        <th>Line Total</th>
                                                        <th>Action</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody id="insert_medicine">

                                                    </tbody>
                                                </table>

                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-sm-5 m-t-40">
                                                    <div class="form-group">
                                                        <label for="comment" class="form-label">Invoice Comment</label>
                                                        <textarea id="textarea" name="invoice_comment" class="Invoice form-control" maxlength="500" rows="5" placeholder="Invoice Comment"></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-sm-1"></div>

                                                <div class="col-sm-6">
                                                    <div class="form-group row">
                                                        <label for="net_total" class="col-sm-4" style="float: left;">Net Total</label>
                                                        <div class="input-group col-sm-8">
                                                            <input type="text" class="form-control" value="0" readonly id="net_total" name="net_total">
                                                            <span class="input-group-addon"><?php echo e(Auth::user()->entities->currency); ?></span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="total_discount" class="col-sm-4" style="float: left;">Discount</label>
                                                        <div class="input-group col-sm-8">
                                                            <input type="text" class="form-control" value="0" readonly id="total_discount" name="total_discount">
                                                            <span class="input-group-addon"><?php echo e(Auth::user()->entities->currency); ?></span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="after_discount" class="col-sm-4" style="float: left;">Amount After Discount</label>
                                                        <div class="input-group col-sm-8">
                                                            <input type="text" class="form-control" value="0" readonly id="after_discount" name="after_discount">
                                                            <span class="input-group-addon"><?php echo e(Auth::user()->entities->currency); ?></span>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="total_gst" class="col-sm-4" style="float: left;">Add Gst</label>
                                                        <div class="input-group col-sm-8">
                                                            <input type="text" class="form-control" value="0" readonly id="total_gst" name="total_gst">
                                                            <span class="input-group-addon"><?php echo e(Auth::user()->entities->currency); ?></span>
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label for="grand_total" class="col-sm-4" style="float: left;">Grand Total</label>
                                                        <div class="input-group col-sm-8">
                                                            <input type="text" class="form-control" value="0" readonly id="grand_total" name="grand_total">
                                                            <span class="input-group-addon"><?php echo e(Auth::user()->entities->currency); ?></span>
                                                        </div>
                                                    </div>


                                                </div>
                                            </div>
                                            <div class="row" style="height: 50px;"></div>
                                            <div class="row">

                                                <button type="submit" name="payment" value="0" class="btn btn-inverse waves-effect waves-light m-b-5">Add Invoice</button>

                                                <button type="submit" name="payment" value="1" class="btn btn-success waves-effect waves-light m-b-5">Add Invoice & Payment</button>

                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
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