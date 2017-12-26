<?php $__env->startSection('content'); ?>
    <!-- Start content -->
    <div class="content">
        <div class="container">


            <div class="row">
                <div class="col-xs-12">
                    <div class="page-title-box">

                        <h4 class="page-title">Manage Patients</h4>

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
                    <?php if(count($errors) > 0): ?>
                        <div class="alert alert-danger">
                            <ul>
                                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li><?php echo e($error); ?></li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </div>
                    <?php endif; ?>

                    <div class="card-box table-responsive">


                        <button class="modal_select btn btn-icon waves-effect waves-light btn-danger m-b-5" data-toggle="modal" data-target="#full-width-modal-create">Add Patient</button>
                        
                        <div id="full-width-modal-create"  class="modal fade" role="dialog" aria-labelledby="full-width-modalLabel-create" aria-hidden="true" style="display: none;">
                            <div class="modal-dialog modal-full">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                        <h4 class="modal-title" id="full-width-modalLabel-create">Add Patient</h4>
                                    </div>
                                    <form action="<?php echo e(route('patients.store')); ?>" method="post">

                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-1"></div>
                                                <div class="col-md-10">

                                                    <div class="row p-20" style="clear: both;">

                                                        <div class="col-sm-4">
                                                            <div class="form-group">
                                                                <label for="full_name" class="control-label">Full Name<span class="text-danger">*</span></label>

                                                                    <input type="text" name="full_name" parsley-trigger="change"
                                                                           placeholder="Enter Full Name" value="<?php echo e(old('full_name')); ?>" autocomplete="off" class="form-control input-sm"/>
                                                                    <input type="hidden" name="patient_code" value="<?php echo e(str_random(8)); ?>">

                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <div class="form-group">
                                                                <label for="full_name" class="control-label">Contact No<span class="text-danger">*</span></label>
                                                                <input type="number" name="contact_no" parsley-trigger="change"
                                                                       placeholder="Enter Contact No" value="<?php echo e(old('contact_no')); ?>" autocomplete="off" class="form-control input-sm"/>

                                                            </div>
                                                        </div>

                                                        <div class="col-sm-4">
                                                            <div class="form-group">
                                                                <label for="full_name" class="control-label">Email</label>
                                                                <input type="email" id="fake-email" name="fake-email" style="display: none;">
                                                                <input type="text" name="email" parsley-trigger="change"
                                                                       placeholder="Enter Email If needed" value="<?php echo e(old('email')); ?>" autocomplete="off" class="form-control input-sm"/>

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
                                                                <label for="full_name" class="control-label">Date Of Birth<span class="text-danger">*</span></label>
                                                                <input type="text" class="form-control input-sm" name="date_of_birth" placeholder="mm/dd/yyyy" id="datepicker-autoclose">

                                                            </div>
                                                        </div>

                                                        <div class="col-sm-4">
                                                            <div class="form-group">
                                                                <label for="full_name" class="control-label">Language Preference</label>
                                                                <select class="form-control select2" name="language">
                                                                    <option value="Burmese(default)" selected>Burmese(default)</option>
                                                                    <?php $__currentLoopData = $languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                        <option value="<?php echo e($language->name); ?>"><?php echo e($language->name); ?></option>
                                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-4">
                                                            <div class="form-group">
                                                                <label for="full_name" class="control-label">Country<span class="text-danger">*</span></label>
                                                                <select class="form-control select2" name="country" id="country">
                                                                    <option disabled selected>Select State</option>
                                                                    <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                        <option value="<?php echo e($country->id); ?>"><?php echo e($country->name); ?></option>
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

                                                        <div class="col-sm-5">
                                                            <div class="form-group">
                                                                <label for="full_name" class="control-label">Address</label>
                                                                <textarea name="address" id="textarea" class="form-control" maxlength="500" rows="3" placeholder="Address If needed" value="<?php echo e(old('reason')); ?>"></textarea>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-4">
                                                            <div class="form-group">
                                                                <label for="full_name" class="control-label">Upload photo/Take Photo</label>
                                                                <select class="form-control select2 upload_photo" name="upload_photo">
                                                                    <option disabled selected>Add Photo Or Take Photo</option>
                                                                    <option value="0">Upload Photo</option>
                                                                    <option value="1">Take a Photo</option>

                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-3 uploading" style="display: none;">
                                                            <div class="form-group">
                                                                <label for="full_name" class="control-label">Upload photo</label>
                                                                <input type="file" class="filestyle" data-input="false" name="profile_photo">

                                                            </div>
                                                        </div>

                                                        <div class="col-sm-12 taking_pic" style="display: none;">
                                                            <div class="row">
                                                                <div class="col-md-2"></div>
                                                                <div class="col-md-4" align="center">

                                                                    <div id = "results" style="width: 322px; height: 265px; border:1px solid; background:#ccc;">

                                                                    </div>

                                                                </div>
                                                                <div class="col-md-4" align="center">
                                                                    <div id="main_camera">

                                                                    </div>
                                                                    <button type="button" style="align-self:center; " onclick="take_snapshot()" class="btn btn-primary">take snap</button>

                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                        <hr>
                                                        <h4>Medical Profile</h4>
                                                        <hr>
                                                    <div class="row p-20" style="clear: both;">
                                                            <div class="form-group row">
                                                                <label for="blood_group" class="col-sm-3">Blood group</label>
                                                                <div class="col-sm-9">
                                                                    <select class="form-control select2" name="blood_group">
                                                                        <option selected>Select Blood Group</option>
                                                                        <option value="A+">A+</option>
                                                                        <option value="A-">A-</option>
                                                                        <option value="B+">B+</option>
                                                                        <option value="B-">B-</option>
                                                                        <option value="O+">O+</option>
                                                                        <option value="O-">O-</option>
                                                                        <option value="AB+">AB+</option>
                                                                        <option value="AB-">AB-</option>
                                                                    </select>
                                                                </div>
                                                            </div>


                                                            <div class="form-group row">
                                                                <label for="status" class="col-sm-3">Had any Surgery?</label>
                                                                <div class="col-sm-9">
                                                                    <div class="radio radio-danger radio-inline">
                                                                        <input type="radio" id="inlineRadio1" name="surgery" value="0">
                                                                        <label for="inlineRadio1"> Yes </label>
                                                                    </div>
                                                                    <div class="radio radio-success radio-inline">
                                                                        <input type="radio" id="inlineRadio2" name="surgery" value="1">
                                                                        <label for="inlineRadio2"> No </label>
                                                                    </div>

                                                                    <div class="radio radio-purple radio-inline">
                                                                        <input type="radio" id="inlineRadio3" name="surgery" value="2">
                                                                        <label for="inlineRadio3"> I Don't Know </label>
                                                                    </div>


                                                                </div>
                                                            </div>

                                                            <div class="form-group row">
                                                                <label for="status" class="col-sm-3">Had any medical illness?</label>
                                                                <div class="col-sm-9">
                                                                    <div class="radio radio-danger radio-inline">
                                                                        <input type="radio" id="inlineRadio1" name="illness" value="0">
                                                                        <label for="inlineRadio1"> Yes </label>
                                                                    </div>
                                                                    <div class="radio radio-success radio-inline">
                                                                        <input type="radio" id="inlineRadio2" name="illness" value="1">
                                                                        <label for="inlineRadio2"> No </label>
                                                                    </div>

                                                                    <div class="radio radio-purple radio-inline">
                                                                        <input type="radio" id="inlineRadio3" name="illness" value="2">
                                                                        <label for="inlineRadio3"> I Don't Know </label>
                                                                    </div>


                                                                </div>
                                                            </div>

                                                            <div class="form-group row">
                                                                <label for="status" class="col-sm-3">G6PD deficiency?</label>
                                                                <div class="col-sm-9">
                                                                    <div class="radio radio-danger radio-inline">
                                                                        <input type="radio" id="inlineRadio1" name="g6pd" value="0">
                                                                        <label for="inlineRadio1"> Yes </label>
                                                                    </div>
                                                                    <div class="radio radio-success radio-inline">
                                                                        <input type="radio" id="inlineRadio2" name="g6pd" value="1">
                                                                        <label for="inlineRadio2"> No </label>
                                                                    </div>

                                                                    <div class="radio radio-purple radio-inline">
                                                                        <input type="radio" id="inlineRadio3" name="g6pd" value="2">
                                                                        <label for="inlineRadio3"> I Don't Know </label>
                                                                    </div>


                                                                </div>
                                                            </div>

                                                            <div class="form-group row">
                                                                <label for="email" class="col-sm-3">Insurance</label>
                                                                <div class="col-sm-9">

                                                                    <input type="text" name="insurance" parsley-trigger="change"
                                                                           placeholder="Enter Insurance If needed" value="<?php echo e(old('insurance')); ?>" autocomplete="off" class="form-control"/>

                                                                </div>
                                                            </div>

                                                            <div class="form-group row">
                                                                <label for="item_image" class="col-sm-3">Attach Patient Note</label>
                                                                <div class="col-sm-9">
                                                                    <input type="file" class="filestyle" data-placeholder="Not Important" name="patient_file" data-buttonname="btn-danger">
                                                                </div>
                                                            </div>
                                                    </div>
                                                    <hr>
                                                    <h4>Drug Allergy</h4>
                                                    <hr>
                                                    <div class="row p-20" style="clear: both;">


                                                            <div class="form-group row">
                                                                <div class="col-sm-5">

                                                                    <div class="form-group row">
                                                                        <div class="col-sm-4"></div>
                                                                        <label for="full_name" class="col-sm-3">Add Drug</label>
                                                                    </div>
                                                                    <div class="form-group row">
                                                                        <div class="col-sm-12">
                                                                            <input type="text" parsley-trigger="change"
                                                                                   placeholder="Drug Name" autocomplete="off" class="form-control drug_name"/>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group row">
                                                                        <div class="col-sm-12">
                                                                            <textarea id="textarea" class="form-control drug_comment" maxlength="500" rows="5" placeholder="Comment If needed"></textarea>

                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group row">

                                                                        <div class="col-sm-4">
                                                                            <button class="btn btn-icon waves-effect waves-light btn-inverse m-b-5 add_drug" type="button">
                                                                                <i class="fa fa-plus"></i> Add Drug
                                                                            </button>
                                                                        </div>
                                                                    </div>

                                                                </div>



                                                                <div class="col-sm-7">
                                                                    <table class="table table-striped m-0">

                                                                        <thead>
                                                                        <tr>


                                                                            <th width="35%">Drug Name</th>

                                                                            <th>Comment</th>
                                                                            <th width="20%">Action</th>
                                                                        </tr>
                                                                        </thead>
                                                                        <tbody id="item_row">

                                                                        </tbody>
                                                                    </table>
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



                                            <button type="submit" class="btn btn-inverse waves-effect" style="float: right;margin-left: 1%;">Add Patient</button>


                                        </div>
                                    </form>
                                </div><!-- /.modal-content -->
                            </div><!-- /.modal-dialog -->
                        </div><!-- /.modal -->

                        
                        <hr>


                        <table id="datatable-buttons" class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th width="2%">Sr.No</th>

                                <th>Name</th>
                                <th width="12%">Patient Code</th>
                                <th width="18%">Contact No</th>


                                <th width="8%">Gender</th>

                                <th width="8%">Age</th>


                                <th width="15%">Shortcuts</th>
                                <th width="15%">Action</th>

                            </tr>
                            </thead>


                            <tbody>
                            <?php $i=1;?>
                            <?php $__currentLoopData = $patients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $patient): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($i); ?></td>

                                    <td><button
                                                data-toggle="modal" data-target="#full-width-modal-show<?php echo e($patient->id); ?>"
                                                style=" border:none;background: none;color: #017ebc"><?php echo e($patient->patient_info['full_name']); ?></button></td>
                                    <td style="font-weight: bold"><?php echo e($patient['patient_code']); ?></td>
                                    <td><?php echo e($patient->patient_info['contact_no']); ?></td>



                                    <?php if($patient->patient_info['gender'] == 0): ?>
                                        <td>Male</td>
                                    <?php elseif($patient->patient_info['gender'] == 1): ?>
                                        <td>Female</td>
                                    <?php else: ?>
                                        <td>Other</td>
                                    <?php endif; ?>
                                    <?php $age = date('Y', strtotime(Carbon\Carbon::now())) - date('Y', strtotime($patient->patient_info['date_of_birth'])); ?>
                                    <td><?php echo e($age); ?></td>
                                    <td>
                                        <form action="<?php echo e(url('invoice_add')); ?>" method="post">
                                            <?php echo e(csrf_field()); ?>

                                            <input type="hidden" name="patient_id" value="<?php echo e($patient->id); ?>">
                                            <input type="hidden" name="doctor_id" value="<?php echo e(Auth::user()->id); ?>">
                                            <button
                                                    style="margin-right:10px; font-weight: bold;float: left; font-size: 200%; background: none; border: none; color: #2b4a95"
                                                    type="submit">I</button>
                                        </form>
                                        
                                        <a href="<?php echo e(url('medical_records/'.$patient->id.'/edit')); ?>"
                                        style="font-weight: bold; font-size: 200%;color: #2b4a95"
                                           data-toggle="tooltip" data-placement="top" title=""
                                           data-original-title="Add Medical Record">M</a>
                                        &nbsp;
                                        <button
                                           style="font-weight: bold; font-size: 200%; background: none; border: none; color: #2b4a95"
                                            data-toggle="modal" data-target="#con-close-modal<?php echo e($patient->patient_code); ?>">Q</button>

                                        <a href="#"
                                           style="font-weight: bold; font-size: 200%;color: #2b4a95; margin-left: 5px;"
                                           data-toggle="tooltip" data-placement="top" title=""
                                           data-original-title="Add Appointment ">A</a>


                                        &nbsp;

                                    </td>
                                    <td>

                                        <button class="btn btn-icon waves-effect waves-light btn-teal m-b-5" data-toggle="modal" data-target="#full-width-modal-show<?php echo e($patient->id); ?>"><i class="fa fa-eye"></i></button>


                                        <a href="<?php echo e(url('patients/'.$patient->id.'/edit')); ?>" class="btn btn-icon waves-effect waves-light btn-info m-b-5" style=""><i class="fa fa-edit"></i></a>

                                        <?php if(Auth::user()->role_id == 2): ?>
                                        <button class="btn btn-icon waves-effect waves-light btn-danger m-b-5" data-toggle="modal" data-target="#con-close-modal<?php echo e($patient->id); ?>"><i class="fa fa-remove"></i></button>
                                        <?php endif; ?>

                                    </td>
                                </tr>


                                
                                <div id="con-close-modal<?php echo e($patient->id); ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                <h4 class="modal-title">Warning!</h4>
                                            </div>
                                            <div class="modal-body">

                                                Are You Sure.You want to delete This patient.
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal" style="float: right;">Close</button>

                                                <form action="<?php echo e(url('patients/'.$patient->id)); ?>" method="post">
                                                    <?php echo e(csrf_field()); ?>

                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <button type="submit" class="btn btn-danger waves-effect" style="float: right;margin-right: 2%;">Yes Delete it</button>

                                                </form>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                
                                <div id="con-close-modal<?php echo e($patient->patient_code); ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">

                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                <h4 class="modal-title">Add To Queue</h4>
                                            </div>
                                            <form action="<?php echo e(route('queues.store')); ?>" method="post">

                                            <div class="modal-body">


                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="pats" class="control-label">Select Doctor<span class="text-danger">*</span></label>
                                                            <select class="form-control select2" name="doctor_id" id="doctor_id">
                                                                <option selected disabled="disabled">Select Doctors</option>

                                                                <?php $__currentLoopData = $doctors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $doctor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                    <option value="<?php echo e($doctor->id); ?>"><?php echo e($doctor->users->name); ?></option>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                                            </select>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>


                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                                                <?php echo e(csrf_field()); ?>

                                                <input type="hidden" name="patient_id" value="<?php echo e($patient->id); ?>">

                                                <button type="submit" class="btn btn-inverse waves-effect" style="float: left;margin-right: 2%;">Add To Queue</button>


                                            </div>
                                            </form>
                                        </div>

                                    </div>

                                </div>


                                <?php $i++; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                        <?php $__currentLoopData = $patients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $patient): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            

                            <div id="full-width-modal-show<?php echo e($patient->id); ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="full-width-modalLabel" aria-hidden="true" style="display: none;">
                                <div class="modal-dialog modal-full">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                            <h4 class="modal-title" id="full-width-modalLabel">Patient Profile</h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="box-header">
                                                        <ul class="nav nav-tabs navtab-bg nav-justified">
                                                            <li class="active">
                                                                <a href="#general-<?php echo e($patient->id); ?>" data-toggle="tab" aria-expanded="false">
                                                                    <span class="visible-xs"><i class="fa fa-home"></i></span>
                                                                    <span class="hidden-xs">Patient Info</span>
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="#drug-<?php echo e($patient->id); ?>" data-toggle="tab" aria-expanded="false">
                                                                    <span class="visible-xs"><i class="fa fa-medkit"></i></span>
                                                                    <span class="hidden-xs">Drug Allergy</span>
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="#record-<?php echo e($patient->id); ?>" data-toggle="tab" aria-expanded="false">
                                                                    <span class="visible-xs"><i class="fa fa-pencil-square"></i></span>
                                                                    <span class="hidden-xs">Medical Records</span>
                                                                </a>
                                                            </li>


                                                        </ul>
                                                    </div>
                                                    <div class="tab-content">
                                                        <div class="tab-pane active" id="general-<?php echo e($patient->id); ?>">
                                                            <div class="text-center card-box">
                                                                <div class="member-card">
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <table border="1" width="100%" cellspacing="10px">

                                                                                <tr style="height: 40px;">
                                                                                    <td width="40%" style="background-color: whitesmoke; font-weight: bold;">Full Name</td>
                                                                                    <td><?php echo e($patient->patient_info['full_name']); ?></td>
                                                                                </tr>
                                                                                <tr style="height: 40px;">
                                                                                    <td width="40%" style="background-color: whitesmoke; font-weight: bold;">Patient Code</td>
                                                                                    <td style="font-weight: bold;color: #1f648b;"><?php echo e($patient->patient_code); ?></td>
                                                                                </tr>
                                                                                <tr style="height: 40px;">
                                                                                    <td width="40%" style="background-color: whitesmoke; font-weight: bold;">Contact No</td>
                                                                                    <td><?php echo e($patient->patient_info['contact_no']); ?></td>
                                                                                </tr>
                                                                                <tr style="height: 40px;">
                                                                                    <td width="40%" style="background-color: whitesmoke; font-weight: bold;">Date Of Birth</td>
                                                                                    <td><?php echo e(date('d-M-Y', strtotime($patient->patient_info['date_of_birth']))); ?></td>
                                                                                </tr>
                                                                                <tr style="height: 40px;">
                                                                                    <?php $age = date('Y', strtotime(Carbon\Carbon::now())) - date('Y', strtotime($patient->patient_info['date_of_birth'])); ?>
                                                                                    <td width="40%" style="background-color: whitesmoke; font-weight: bold;">Age</td>
                                                                                    <td><?php echo e($age); ?></td>
                                                                                </tr>
                                                                                <tr style="height: 40px;">
                                                                                    <td width="40%" style="background-color: whitesmoke; font-weight: bold;">Blood Group</td>
                                                                                    <td><?php echo e($patient->medical_info['blood_group']); ?></td>
                                                                                </tr>

                                                                                <tr style="height: 40px;">
                                                                                    <td width="40%" style="background-color: whitesmoke; font-weight: bold;">Gender</td>

                                                                                    <?php if($patient->pateint_info['gender'] == 1): ?>
                                                                                        <td>Male</td>
                                                                                    <?php else: ?>
                                                                                        <td>Female</td>
                                                                                    <?php endif; ?>

                                                                                </tr>
                                                                                <tr style="height: 40px;">
                                                                                    <td width="40%" style="background-color: whitesmoke; font-weight: bold;">Address</td>
                                                                                    <td><?php echo e($patient->patient_info['address']); ?></td>
                                                                                </tr>

                                                                                <tr style="height: 40px;">
                                                                                    <td width="40%" style="background-color: whitesmoke; font-weight: bold;">Created By</td>
                                                                                    <td><?php echo e($patient->users['name']); ?>(<?php echo e($patient->users->roles['role_name']); ?>)</td>
                                                                                </tr>

                                                                            </table>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <table border="1" width="100%" cellspacing="10px">

                                                                                <tr style="height: 40px;">
                                                                                    <td width="40%" style="background-color: whitesmoke; font-weight: bold;">Relative Contact</td>
                                                                                    <td><?php echo e($patient->patient_info['rel_contact_no']); ?></td>
                                                                                </tr>
                                                                                <tr style="height: 40px;">
                                                                                    <td width="40%" style="background-color: whitesmoke; font-weight: bold;">Martial</td>
                                                                                    <td><?php echo e($patient->patient_info['martial']); ?></td>
                                                                                </tr>
                                                                                <tr style="height: 40px;">
                                                                                    <td width="40%" style="background-color: whitesmoke; font-weight: bold;"><?php echo e($patient->patient_info['patient_identity_name']); ?></td>
                                                                                    <td><?php echo e($patient->patient_info['patient_identity_no']); ?></td>
                                                                                </tr>
                                                                                <tr style="height: 40px;">
                                                                                    <td width="40%" style="background-color: whitesmoke; font-weight: bold;">Date Of Birth</td>
                                                                                    <td><?php echo e(date('d-M-Y', strtotime($patient->patient_info['date_of_birth']))); ?></td>
                                                                                </tr>
                                                                                <tr style="height: 40px;">
                                                                                    <?php $age = date('Y', strtotime(Carbon\Carbon::now())) - date('Y', strtotime($patient->patient_info['date_of_birth'])); ?>
                                                                                    <td width="40%" style="background-color: whitesmoke; font-weight: bold;">Age</td>
                                                                                    <td><?php echo e($age); ?></td>
                                                                                </tr>
                                                                                <tr style="height: 40px;">
                                                                                    <td width="40%" style="background-color: whitesmoke; font-weight: bold;">Had an Surgery</td>
                                                                                    <td>
                                                                                        <?php if($patient->medical_info['surgery'] == 0): ?>
                                                                                            Yes
                                                                                        <?php elseif($patient->medical_info['surgery'] == 1): ?>
                                                                                            No
                                                                                        <?php else: ?>
                                                                                            I Don't Know
                                                                                        <?php endif; ?>
                                                                                    </td>
                                                                                </tr>

                                                                                <tr style="height: 40px;">
                                                                                    <td width="40%" style="background-color: whitesmoke; font-weight: bold;">Past Illness</td>
                                                                                    <td>
                                                                                        <?php if($patient->medical_info['illness'] == 0): ?>
                                                                                            Yes
                                                                                        <?php elseif($patient->medical_info['illness'] == 1): ?>
                                                                                            No
                                                                                        <?php else: ?>
                                                                                            I Don't Know
                                                                                        <?php endif; ?>
                                                                                    </td>


                                                                                </tr>
                                                                                <tr style="height: 40px;">
                                                                                    <td width="40%" style="background-color: whitesmoke; font-weight: bold;">G6PD Deficiency</td>
                                                                                    <td>
                                                                                        <?php if($patient->medical_info['g6pd'] == 0): ?>
                                                                                            Yes
                                                                                        <?php elseif($patient->medical_info['g6pd'] == 1): ?>
                                                                                            No
                                                                                        <?php else: ?>
                                                                                            I Don't Know
                                                                                        <?php endif; ?>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr style="height: 40px;">
                                                                                    <td width="40%" style="background-color: whitesmoke; font-weight: bold;">Insurance</td>
                                                                                    <td><?php echo e($patient->medical_info['insurance']); ?></td>
                                                                                </tr>



                                                                            </table>
                                                                        </div>

                                                                    </div>

                                                                </div>

                                                            </div>
                                                        </div>


                                                        <div class="tab-pane" id="drug-<?php echo e($patient->id); ?>">
                                                            <div class="text-center card-box">
                                                                <div class="member-card">
                                                                    <div class="row">
                                                                        <div class="col-md-12">

                                                                            <table class="table table-striped m-0">
                                                                                <thead>
                                                                                <tr>
                                                                                    <th width="5%" style="text-align: center">SR.No</th>
                                                                                    <th width="40%" style="text-align: center">Drug Name</th>
                                                                                    <th style="text-align: center">Drug Comment</th>
                                                                                </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                <?php $p=1; ?>
                                                                                <?php $__currentLoopData = $patient->drug_allergy; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $drug): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                                    <tr style="height: 40px;">

                                                                                        <td><?php echo e($p); ?></td>
                                                                                        <td><?php echo e($drug['drug_name']); ?></td>
                                                                                        <td><?php echo e($drug['drug_comment']); ?></td>

                                                                                    </tr>
                                                                                    <?php  $p++ ?>
                                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                                </tbody>
                                                                            </table>

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>


                                                        <div class="tab-pane" id="record-<?php echo e($patient->id); ?>">
                                                            <div class="text-center card-box">
                                                                <div class="member-card">
                                                                    <?php if($patient->medical_records == null): ?>
                                                                        <h5 align="center">No Record</h5>
                                                                    <?php endif; ?>
                                                                    <?php $ib=1; ?>
                                                                    <?php $__currentLoopData = $patient->medical_records; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $record): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                        <div class="row">
                                                                            <div class="col-md-12">
                                                                                <div class="panel panel-default" style="border: none;">
                                                                                    <a data-toggle="collapse"
                                                                                       data-parent="#accordion-test"
                                                                                       href="#collapseOne<?php echo e($record->id); ?>"
                                                                                       class="collapsed"
                                                                                    >

                                                                                        <div class="panel-heading"
                                                                                             style="background-color: whitesmoke;
                                                                                                 border: 2px solid #2b4a95 !important;border-radius: 25px;color: #2b4a95">
                                                                                            <h4 class="panel-title">
                                                                                                    <span style="float: left;color: #2b4a95;">
                                                                                                        #<?php echo e($ib); ?>

                                                                                                    </span>

                                                                                                <?php echo e(date('d-M-Y',strtotime($record->created_at))); ?>


                                                                                            </h4>
                                                                                        </div>
                                                                                    </a>
                                                                                    <div id="collapseOne<?php echo e($record->id); ?>" class="panel-collapse collapse">
                                                                                        <div class="panel-body">
                                                                                            <div class="form-group row">
                                                                                                <label for="patient_id" class="form-label col-sm-1">Doctor</label>
                                                                                                <div class="col-sm-5">
                                                                                                    <input type="text" class="form-control"
                                                                                                           value="<?php echo e($record->user_informations->doctor_info['first_name']); ?> <?php echo e($record->user_informations->doctor_info['last_name']); ?>" readonly>

                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="form-group row">
                                                                                                <label for="patient_id" class="form-label col-sm-1">Diagnoses</label>
                                                                                                <?php for($i=0; $i < sizeof($record->diagnose); $i++): ?>
                                                                                                    <div class="col-sm-2">
                                                                                                        <input type="text" class="form-control"
                                                                                                               value="<?php echo e($record->diagnose[$i]); ?>" readonly>

                                                                                                    </div>
                                                                                                <?php endfor; ?>
                                                                                            </div>



                                                                                            <hr>



                                                                                            <ul class="nav nav-tabs navtab-bg nav-justified">
                                                                                                <li class="active">
                                                                                                    <a href="#health<?php echo e($record->id); ?>" data-toggle="tab" aria-expanded="false">
                                                                                                        <span class="visible-xs"><i class="fa fa-home"></i></span>
                                                                                                        <span class="hidden-xs">Health Info</span>
                                                                                                    </a>
                                                                                                </li>
                                                                                                <li class="">
                                                                                                    <a href="#writing<?php echo e($record->id); ?>" data-toggle="tab" aria-expanded="false">
                                                                                                        <span class="visible-xs"><i class="fa fa-user"></i></span>
                                                                                                        <span class="hidden-xs">Typing Note</span>
                                                                                                    </a>
                                                                                                </li>


                                                                                                <li class="">
                                                                                                    <a href="#drawing<?php echo e($record->id); ?>" id="draw_pad" data-toggle="tab" aria-expanded="false">
                                                                                                        <span class="visible-xs"><i class="fa fa-envelope-o"></i></span>
                                                                                                        <span class="hidden-xs">Drawing Pad</span>
                                                                                                    </a>
                                                                                                </li>

                                                                                                <li class="">
                                                                                                    <a href="#template<?php echo e($record->id); ?>" data-toggle="tab" aria-expanded="false">
                                                                                                        <span class="visible-xs"><i class="fa fa-envelope-o"></i></span>
                                                                                                        <span class="hidden-xs">Template</span>
                                                                                                    </a>
                                                                                                </li>
                                                                                                <li class="">
                                                                                                    <a href="#upload<?php echo e($record->id); ?>" data-toggle="tab" aria-expanded="false">
                                                                                                        <span class="visible-xs"><i class="fa fa-envelope-o"></i></span>
                                                                                                        <span class="hidden-xs">Upload</span>
                                                                                                    </a>
                                                                                                </li>


                                                                                            </ul>
                                                                                            <div class="tab-content">
                                                                                                <div class="tab-pane active" id="health<?php echo e($record->id); ?>">
                                                                                                    <div class="row">
                                                                                                        <div class="col-sm-12 col-xs-12 col-md-12">
                                                                                                            <div class="row">
                                                                                                                <div class="col-sm-12">
                                                                                                                    <div class="card-box">
                                                                                                                        <div class="row">
                                                                                                                            <div class="col-md-4">
                                                                                                                                <div class="form-group">

                                                                                                                                    <label for="weight" class="control-label">Weight</label>
                                                                                                                                    <div class="input-group m-t-10">
                                                                                                                                        <input type="text"
                                                                                                                                               value="<?php echo e($record->health_info['weight']); ?>" readonly class="form-control"/>
                                                                                                                                        <span class="input-group-addon">kg</span>
                                                                                                                                    </div>



                                                                                                                                </div>
                                                                                                                            </div>
                                                                                                                            <div class="col-md-4">
                                                                                                                                <div class="form-group">

                                                                                                                                    <label for="height" class="control-label">Height</label>
                                                                                                                                    <div class="input-group m-t-10">
                                                                                                                                        <input type="text"
                                                                                                                                               value="<?php echo e($record->health_info['height']); ?>" readonly class="form-control"/>
                                                                                                                                        <span class="input-group-addon">cm</span>
                                                                                                                                    </div>


                                                                                                                                </div>
                                                                                                                            </div>
                                                                                                                            <div class="col-md-4">
                                                                                                                                <div class="form-group">

                                                                                                                                    <label for="weight" class="control-label">BSA</label>
                                                                                                                                    <div class="input-group m-t-10">
                                                                                                                                        <input type="text"
                                                                                                                                               value="<?php echo e($record->health_info['bsa']); ?>" readonly class="form-control"/>
                                                                                                                                        <span class="input-group-addon">m<span style="font-size: 10px; position: relative; top: -5px;">2</span></span>
                                                                                                                                    </div>


                                                                                                                                </div>
                                                                                                                            </div>
                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>

                                                                                                    </div>
                                                                                                </div>


                                                                                                <div class="tab-pane" id="writing<?php echo e($record->id); ?>">
                                                                                                    <div class="row">
                                                                                                        <div class="col-sm-12 col-xs-12 col-md-12">
                                                                                                            <div class="row">
                                                                                                                <div class="col-sm-12">
                                                                                                                    <div class="card-box">
                                                                                                                        <div class="row">
                                                                                                                            <div class="col-sm-12">
                                                                                                                                <?php echo $record->typing_Note; ?>

                                                                                                                            </div>
                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>

                                                                                                    </div>
                                                                                                </div>





                                                                                                <div class="tab-pane" id="drawing<?php echo e($record->id); ?>">
                                                                                                    <div class="row">
                                                                                                        <div class="col-sm-12 col-xs-12 col-md-12">
                                                                                                            <div class="row">
                                                                                                                <div class="col-sm-12">
                                                                                                                    <div class="card-box">
                                                                                                                        <div class="row">
                                                                                                                            <div class="col-md-12">

                                                                                                                                <img src="<?php echo e($record->image_url); ?>" style="border: 2px solid black;"/>
                                                                                                                                <br>
                                                                                                                                <a href="<?php echo e($record->image_url); ?>" download="Klinic" class="btn btn-primary">
                                                                                                                                    Download
                                                                                                                                </a>

                                                                                                                            </div>


                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                            </div>

                                                                                                        </div>

                                                                                                    </div>
                                                                                                </div>

                                                                                                <div class="tab-pane" id="template<?php echo e($record->id); ?>">
                                                                                                    <div class="row">
                                                                                                        <div class="col-sm-12 col-xs-12 col-md-12">
                                                                                                            <div class="row">
                                                                                                                <div class="col-sm-12">
                                                                                                                    <div class="card-box">
                                                                                                                        <?php $__currentLoopData = $record->template; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $temp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                                                                            <div class="form-group row">
                                                                                                                                <label for="patient_id" class="form-label col-sm-12"><span style="float: left;"><?php echo e($temp['question']); ?> ?</span></label>
                                                                                                                                <?php if(sizeof($temp['answers']) > 1): ?>
                                                                                                                                    <?php for($i=0; $i < sizeof($temp['answers']); $i++): ?>
                                                                                                                                        <div class="col-sm-3">
                                                                                                                                            <input type="text" class="form-control"
                                                                                                                                                   value="<?php echo e($temp['answers'][$i]); ?>" readonly>

                                                                                                                                        </div>
                                                                                                                                    <?php endfor; ?>
                                                                                                                                <?php else: ?>
                                                                                                                                    <div class="col-sm-3">
                                                                                                                                        <input type="text" class="form-control"
                                                                                                                                               value="<?php echo e($temp['answers']); ?>" readonly>

                                                                                                                                    </div>
                                                                                                                                <?php endif; ?>
                                                                                                                            </div>
                                                                                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>



                                                                                                    </div>
                                                                                                </div>

                                                                                                <div class="tab-pane" id="upload<?php echo e($record->id); ?>">
                                                                                                    <div class="row">
                                                                                                        <div class="col-sm-12 col-xs-12 col-md-12">
                                                                                                            <div class="row">
                                                                                                                <div class="col-sm-12">
                                                                                                                    <div class="card-box">
                                                                                                                        <div class="row">
                                                                                                                            <?php for($j=0; $j < sizeof($record->upload_file); $j++): ?>
                                                                                                                                <h5 align="left"><a href="<?php echo e(asset('uploads/'.$record->upload_file[$j])); ?>" target="_blank">Image <?php echo e($j+1); ?></a></h5>
                                                                                                                            <?php endfor; ?>
                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>

                                                                                                    </div>


                                                                                                </div>


                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <?php $ib++ ?>
                                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>




                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>

                                        </div>
                                    </div><!-- /.modal-content -->
                                </div><!-- /.modal-dialog -->
                            </div><!-- /.modal -->
                            
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>

        </div> <!-- container -->
        <input type="hidden" value="<?php echo e(url('/')); ?>" id="basepath">
    </div> <!-- content -->

<?php $__env->stopSection(); ?>

<!--*********Page Scripts Here*********-->

<?php $__env->startSection('scripts'); ?>
    <script src="<?php echo e(asset('js/webcam/webcam.js')); ?>"></script>
    <script>

        $('.upload_photo').change(function () {
            var upp_code = $(this).val();
            //alert(upp_code);
            if(upp_code == 0)
            {
                $('.uploading').css('display','block');
                $('.taking_pic').css('display','none');
            }
            else if(upp_code == 1)
            {
                Webcam.set({
                    width: 322,
                    height: 265,
                    image_format: 'jpeg',
                    jpeg_quality: 90
                });
                Webcam.attach('#main_camera');

                $('.uploading').css('display','none');
                $('.taking_pic').css('display','block');
            }
        });
    </script>

    <script>
        function take_snapshot() {

            var url = $('#basepath').val();
            //var csrf_token = $("meta[name=csrf-token]").attr('content');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            Webcam.snap( function(data_uri) {
                var html = `
                        <img src="`+data_uri+`" id="webcam_photo" width="100%" height="100%"/>
                        <input type="hidden" name="webcam_photo" value="`+data_uri+`">
                `;
                $('#results').html(html);

                //console.log(data_uri);
                /*Webcam.upload(data_uri, url+'/take_snap',function(code, text) {

                    /!*$data = JSON.parse(text);
                    $fname = url+$data['filepath']+$data['filename'];
                    $('#results').html('<img src="'+$fname+'"/>');
                    $('#picture').val($data['filepath']+$data['filename']);*!/
                    console.log(code);
                });*/
            });
        }
    </script>
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
    <script src="<?php echo e(asset('assets/plugins/tooltipster/tooltipster.bundle.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/pages/jquery.tooltipster.js')); ?>"></script>


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