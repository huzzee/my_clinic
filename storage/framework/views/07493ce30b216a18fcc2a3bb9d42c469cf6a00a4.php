<?php $__env->startSection('content'); ?>
    <!-- Start content -->
    <div class="content">
        <div class="container">


            <div class="row">
                <div class="col-xs-12">
                    <div class="page-title-box">

                        <h4 class="page-title">Manage Admins</h4>

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

                        <button class="modal_select btn btn-icon waves-effect waves-light btn-danger m-b-5" data-toggle="modal" data-target="#full-width-modal-create">Add Admin</button>

                        <div id="full-width-modal-create"  class="modal fade" role="dialog" aria-labelledby="full-width-modalLabel-create" aria-hidden="true" style="display: none;">
                            <div class="modal-dialog modal-full">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                        <h4 class="modal-title" id="full-width-modalLabel-create">Add Admin</h4>
                                    </div>
                                    <form action="<?php echo e(route('admins.store')); ?>" method="post" enctype="multipart/form-data">

                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-1"></div>
                                                <div class="col-md-10">

                                                    <div class="p-20" style="clear: both;">


                                                        <div class="row">
                                                            <div class="col-sm-4">
                                                                <div class="form-group">
                                                                    <label for="full_name" class="control-label">Full Name<span class="text-danger">*</span></label>

                                                                    <input type="text" name="full_name" parsley-trigger="change"
                                                                           placeholder="Enter Full Name" value="<?php echo e(old('full_name')); ?>" autocomplete="off" class="form-control input-sm"/>

                                                                </div>
                                                            </div>


                                                            <div class="col-sm-4">
                                                                <div class="form-group">
                                                                    <label for="full_name" class="control-label">Email Address<span class="text-danger">*</span></label>

                                                                    <input type="email" name="email" parsley-trigger="change"
                                                                           placeholder="Enter Email" value="<?php echo e(old('email')); ?>" autocomplete="off" class="form-control input-sm"/>

                                                                </div>
                                                            </div>

                                                            <div class="col-sm-4">
                                                                <div class="form-group">
                                                                    <label for="full_name" class="control-label">Password<span class="text-danger">*</span></label>
                                                                    <input type="email" name="email-fake" style="display: none">
                                                                    <input type="password" name="password-fake" style="display: none">
                                                                    <input type="password" name="password" parsley-trigger="change"
                                                                           placeholder="Enter Password" autocomplete="off" class="form-control input-sm"/>

                                                                </div>
                                                            </div>


                                                            <div class="col-sm-4">
                                                                <div class="form-group">
                                                                    <label for="full_name" class="control-label">Gender<span class="text-danger">*</span></label>
                                                                    <div>
                                                                        <div class="radio radio-info radio-inline">
                                                                            <input type="radio" id="inlineRadio1" name="gender" value="0">
                                                                            <label for="inlineRadio1"> Male </label>
                                                                        </div>
                                                                        <div class="radio radio-pink radio-inline">
                                                                            <input type="radio" id="inlineRadio2" name="gender" value="1">
                                                                            <label for="inlineRadio2"> Female </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-sm-4">
                                                                <div class="form-group">
                                                                    <label for="full_name" class="control-label">Clinic Name<span class="text-danger">*</span></label>
                                                                    <input type="text" name="entity_name" parsley-trigger="change"
                                                                           placeholder="Enter Clinic Name" value="<?php echo e(old('entity_name')); ?>" autocomplete="off" class="form-control input-sm"/>

                                                                    <input type="hidden" name="role_id" value="2" />
                                                                </div>
                                                            </div>

                                                            <div class="col-sm-4">
                                                                <div class="form-group">
                                                                    <label for="website" class="control-label">Website</label>
                                                                    <input type="text" name="website" parsley-trigger="change"
                                                                           placeholder="Enter Website" value="<?php echo e(old('website')); ?>" autocomplete="off" class="form-control input-sm"/>


                                                                </div>
                                                            </div>

                                                            <div class="col-sm-4">
                                                                <div class="form-group">
                                                                    <label for="full_name" class="control-label">Country<span class="text-danger">*</span></label>
                                                                    <select class="form-control select2" name="country" id="country">
                                                                        <option disabled selected>Select Country</option>
                                                                        <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                            <option value="<?php echo e($country->name); ?>"><?php echo e($country->name); ?></option>
                                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <div class="form-group">
                                                                    <label for="full_name" class="control-label">State<span class="text-danger">*</span></label>
                                                                    <select class="form-control select2" name="state" id="state">
                                                                        <option disabled selected>Select State</option>

                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="col-sm-4">
                                                                <div class="form-group">
                                                                    <label for="full_name" class="control-label">City<span class="text-danger">*</span></label>
                                                                    <select class="form-control select2" name="city" id="city">
                                                                        <option disabled selected>Select City</option>

                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="col-sm-4">
                                                                <div class="form-group">
                                                                    <label for="contact_no" class="control-label">Contact No<span class="text-danger">*</span></label>

                                                                    <input type="text" name="contact_no" parsley-trigger="change"
                                                                           placeholder="Enter Contact" value="<?php echo e(old('contact_no')); ?>" autocomplete="off" class="form-control input-sm"/>

                                                                </div>
                                                            </div>

                                                            <div class="col-sm-4">
                                                                <div class="form-group">
                                                                    <label for="contact_no" class="control-label">Currency<span class="text-danger">*</span></label>
                                                                    <select class="form-control select2" name="currency">
                                                                        <option selected disabled>Select Currency</option>
                                                                        <?php $__currentLoopData = $currencies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $currency): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                            <option value="<?php echo e($currency->currencyCode); ?>"><?php echo e($currency->currencyCode); ?>(<?php echo e($currency->countryName); ?>)</option>
                                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                                                    </select>
                                                                </div>
                                                            </div>


                                                            <div class="col-sm-4">
                                                                <div class="form-group">
                                                                    <label for="full_name" class="control-label">Profile Image</label>
                                                                    <input type="file" data-input="false" class="filestyle input-sm" data-placeholder="Not Important" name="profile_image">
                                                                </div>
                                                            </div>

                                                            <div class="col-sm-8">
                                                                <div class="form-group">
                                                                    <label for="full_name" class="control-label">Address<span class="text-danger">*</span></label>
                                                                    <textarea name="address" id="textarea" class="form-control" maxlength="500" rows="3" placeholder="Address" value="<?php echo e(old('reason')); ?>"></textarea>
                                                                </div>
                                                            </div>

                                                            <div class="col-sm-4">
                                                                <div class="form-group">
                                                                    <label for="full_name" class="control-label">Active<span class="text-danger">*</span></label>
                                                                    <div>
                                                                        <input type="checkbox" id="switch3" name="status" switch="bool" checked/>
                                                                        <label for="switch3" data-on-label="Yes"
                                                                               data-off-label="No"></label>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>

                                                    </div>

                                                </div>
                                                <div class="col-md-1"></div>

                                            </div>
                                        </div>


                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cancel</button>
                                            <?php echo e(csrf_field()); ?>



                                            <button type="submit" class="btn btn-inverse waves-effect" style="float: right;margin-left: 1%;">Add Admin</button>


                                        </div>
                                    </form>
                                </div><!-- /.modal-content -->
                            </div><!-- /.modal-dialog -->
                        </div><!-- /.modal -->

                        <hr>


                        <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive">
                            <thead>
                            <tr>
                                <th width="2%">Sr.No</th>
                                <th width="2%">Image</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th width="15%">Clinic Name</th>

                                <th width="8%">Gender</th>

                                <th width="10%">Status</th>

                                <th width="15%">Action</th>

                            </tr>
                            </thead>


                            <tbody>
                            <?php $i=1;?>
                            <?php $__currentLoopData = $admins; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $admin): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($i); ?></td>
                                    <td><img src="<?php echo e(asset('uploads/'.$admin->users->profile_image)); ?>" alt="<?php echo e($admin->users->profile_image); ?>" style="height: 50px; width: 50px;"></td>
                                    <td><?php echo e($admin->admin_info['full_name']); ?></td>
                                    <td><?php echo e($admin->users->email); ?></td>
                                    <td><?php echo e($admin->users->entities->entity_name); ?></td>

                                    <?php if($admin->admin_info['gender'] == 0): ?>
                                        <td>Male</td>
                                    <?php elseif($admin->admin_info['gender'] == 1): ?>
                                        <td>Female</td>
                                    <?php else: ?>
                                        <td>Other</td>
                                    <?php endif; ?>



                                    <?php if($admin->users->entities->status == 1): ?>
                                        <td>Activate</td>
                                    <?php else: ?>
                                        <td>Deactivate</td>
                                    <?php endif; ?>

                                    <td>

                                        <a href="<?php echo e(url('admins/'.$admin->id)); ?>" class="btn btn-icon waves-effect waves-light btn-teal m-b-5" style="">
                                            <i class="fa fa-eye"></i>
                                        </a>

                                        <button class="btn btn-icon waves-effect waves-light btn-info m-b-5 edit_patient_modal" data-patientId="<?php echo e($admin->id); ?>" data-toggle="modal" data-target="#full-width-modal-edit<?php echo e($admin->id); ?>"><i class="fa fa-edit"></i></button>

                                    </td>
                                </tr>


                                <?php $i++; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                        <?php $__currentLoopData = $admins; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $admin): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            
                            <div id="full-width-modal-edit<?php echo e($admin->id); ?>"  class="modal fade" role="dialog" aria-labelledby="full-width-modalLabel-create" aria-hidden="true" style="display: none;">
                                <div class="modal-dialog modal-full">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                            <h4 class="modal-title" id="full-width-modalLabel-create">Edit Admin</h4>
                                        </div>
                                        <?php echo Form::model($admin, ['method' => 'PATCH','url' => ['admins', $admin->id], 'files'=>true]); ?>



                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-1"></div>
                                                <div class="col-md-10">

                                                    <div class="p-20" style="clear: both;">


                                                        <div class="row">
                                                            <div class="col-sm-4">
                                                                <div class="form-group">
                                                                    <label for="full_name" class="control-label">Full Name<span class="text-danger">*</span></label>
                                                                    <?php echo Form::text('admin_info[full_name]' , null ,['class' => 'form-control input-sm','parsley-trigger' => 'change']); ?>


                                                                </div>
                                                            </div>


                                                            <div class="col-sm-4">
                                                                <div class="form-group">
                                                                    <label for="full_name" class="control-label">Email Address<span class="text-danger">*</span></label>

                                                                    <?php echo Form::email('email' , $admin->users->email ,['class' => 'form-control input-sm','parsley-trigger' => 'change']); ?>


                                                                </div>
                                                            </div>

                                                            <div class="col-sm-4">
                                                                <div class="form-group">
                                                                    <label for="full_name" class="control-label">Password<span class="text-danger">*</span></label>
                                                                    <input type="email" name="email-fake" style="display: none">
                                                                    <input type="password" name="password-fake" style="display: none">
                                                                    <input type="password" name="password" parsley-trigger="change"
                                                                           placeholder="Change Password If needed" autocomplete="off" class="form-control input-sm"/>

                                                                </div>
                                                            </div>


                                                            <div class="col-sm-4">
                                                                <div class="form-group">
                                                                    <label for="full_name" class="control-label">Gender<span class="text-danger">*</span></label>
                                                                    <div>
                                                                        <div class="radio radio-info radio-inline">
                                                                            <?php echo Form::radio('admin_info[gender]', 0,['id' => 'inlineRadio1']); ?>

                                                                            <label for="inlineRadio1"> Male </label>
                                                                        </div>
                                                                        <div class="radio radio-pink radio-inline">
                                                                            <?php echo Form::radio('admin_info[gender]', 1,['id' => 'inlineRadio2']); ?>

                                                                            <label for="inlineRadio2"> Female </label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-sm-4">
                                                                <div class="form-group">
                                                                    <label for="full_name" class="control-label">Clinic Name<span class="text-danger">*</span></label>
                                                                    <?php echo Form::text('users[entities][entity_name]' , null ,['class' => 'form-control input-sm','parsley-trigger' => 'change']); ?>


                                                                    <input type="hidden" name="role_id" value="2" />
                                                                </div>
                                                            </div>

                                                            <div class="col-sm-4">
                                                                <div class="form-group">
                                                                    <label for="website" class="control-label">Website</label>
                                                                    <?php echo Form::text('admin_info[website]' , null ,['class' => 'form-control input-sm','parsley-trigger' => 'change']); ?>


                                                                </div>
                                                            </div>

                                                            <div class="col-sm-4">
                                                                <div class="form-group">
                                                                    <label for="full_name" class="control-label">Country<span class="text-danger">*</span></label>
                                                                    <?php echo Form::select('admin_info[country]',$edit_countries,null ,['class' => 'form-control select2 country2','id' => 'country'.$admin->id,'data-patientId' => $admin->id]); ?>


                                                                </div>
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <div class="form-group">
                                                                    <label for="full_name" class="control-label">State<span class="text-danger">*</span></label>
                                                                    <select class="form-control select2 state2" name="state" id="<?php echo e('state'.$admin->id); ?>" data-patientId="<?php echo e($admin->id); ?>">
                                                                        <option value="<?php echo e($admin->admin_info['state']); ?>" selected><?php echo e($admin->admin_info['state']); ?></option>

                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="col-sm-4">
                                                                <div class="form-group">
                                                                    <label for="full_name" class="control-label">City<span class="text-danger">*</span></label>
                                                                    <select class="form-control select2 city2" name="city" id="<?php echo e('city'.$admin->id); ?>">
                                                                        <option value="<?php echo e($admin->admin_info['city']); ?>" selected><?php echo e($admin->admin_info['city']); ?></option>

                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="col-sm-4">
                                                                <div class="form-group">
                                                                    <label for="contact_no" class="control-label">Contact No<span class="text-danger">*</span></label>

                                                                    <?php echo Form::text('admin_info[contact_no]' , null ,['class' => 'form-control input-sm','parsley-trigger' => 'change']); ?>

                                                                </div>

                                                            </div>

                                                            <div class="col-sm-4">
                                                                <div class="form-group">
                                                                    <label for="contact_no" class="control-label">Currency<span class="text-danger">*</span></label>
                                                                    <?php echo Form::select('users[entities][currency]',$edit_currencies,null ,['class' => 'form-control select2']); ?>


                                                                </div>
                                                            </div>


                                                            <div class="col-sm-4">
                                                                <div class="form-group">
                                                                    <label for="full_name" class="control-label">Profile Image</label>
                                                                    <input type="file" data-input="false" class="filestyle input-sm" data-placeholder="Not Important" name="profile_image">
                                                                </div>
                                                            </div>

                                                            <div class="col-sm-8">
                                                                <div class="form-group">
                                                                    <label for="full_name" class="control-label">Address<span class="text-danger">*</span></label>
                                                                    <?php echo Form::textarea('admin_info[address]',null ,['class' => 'form-control','maxlength' => '225','rows' => '3', 'id' => 'textarea']); ?>

                                                                </div>
                                                            </div>


                                                        </div>

                                                    </div>

                                                </div>
                                                <div class="col-md-1"></div>

                                            </div>
                                        </div>


                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cancel</button>
                                            <?php echo e(csrf_field()); ?>



                                            <button type="submit" class="btn btn-inverse waves-effect" style="float: right;margin-left: 1%;">Update Admin</button>


                                        </div>
                                        </form>
                                    </div><!-- /.modal-content -->
                                </div><!-- /.modal-dialog -->
                            </div><!-- /.modal -->


                            
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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