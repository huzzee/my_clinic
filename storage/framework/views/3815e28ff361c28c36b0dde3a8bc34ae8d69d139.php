<?php $__env->startSection('content'); ?>
    <!-- Start content -->
    <div class="content">
        <div class="container">


            <div class="row">
                <div class="col-xs-12">
                    <div class="page-title-box">
                        <h4 class="page-title">Patient Profile </h4>

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
                    <div class="card-box">
                        <div class="row">
                            <div class="col-lg-12 col-md-12">
                                <div class="box-header">

                                    <a href="<?php echo e(url('patients')); ?>"
                                       class="btn btn-icon waves-effect waves-light btn-info m-b-5">
                                        Manage Patient

                                    </a>

                                    <a href="<?php echo e(url('patients/'.$patient->id.'/edit')); ?>" class="btn btn-primary waves-effect m-b-5 waves-light">Edit Profile</a>


                                    <a href="<?php echo e(url('medical_records/'.$patient->id.'/edit')); ?>" style="float: right;" class="btn btn-danger waves-effect waves-light">Add Medical Record</a>



                                </div>
                                <hr>
                                <div class="box-header">
                                    <ul class="nav nav-tabs navtab-bg nav-justified">
                                        <li class="active">
                                            <a href="#general" data-toggle="tab" aria-expanded="false">
                                                <span class="visible-xs"><i class="fa fa-home"></i></span>
                                                <span class="hidden-xs">Patient Info</span>
                                            </a>
                                        </li>
                                        <li class="">
                                            <a href="#drug" data-toggle="tab" aria-expanded="false">
                                                <span class="visible-xs"><i class="fa fa-medkit"></i></span>
                                                <span class="hidden-xs">Drug Allergy</span>
                                            </a>
                                        </li>
                                        <li class="">
                                            <a href="#record" data-toggle="tab" aria-expanded="false">
                                                <span class="visible-xs"><i class="fa fa-pencil-square"></i></span>
                                                <span class="hidden-xs">Medical Records</span>
                                            </a>
                                        </li>


                                    </ul>
                                </div>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="general">
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


                                    <div class="tab-pane" id="drug">
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
                                                                <?php $i=1; ?>
                                                                <?php $__currentLoopData = $patient->drug_allergy; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $drug): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <tr style="height: 40px;">

                                                                    <td><?php echo e($i); ?></td>
                                                                    <td><?php echo e($drug['drug_name']); ?></td>
                                                                    <td><?php echo e($drug['drug_comment']); ?></td>

                                                                </tr>
                                                                    <?php  $i++ ?>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            </tbody>
                                                        </table>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="tab-pane" id="record">
                                        <div class="text-center card-box">
                                            <div class="member-card">
                                                <?php if($medical_records == null): ?>
                                                    <h5 align="center">No Record</h5>
                                                <?php endif; ?>
                                                <?php $ib=1; ?>
                                                <?php $__currentLoopData = $medical_records; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $record): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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
                                                                                                    <?php for($i=0; $i < sizeof($temp['answers']); $i++): ?>
                                                                                                    <div class="col-sm-3">
                                                                                                        <input type="text" class="form-control"
                                                                                                               value="<?php echo e($temp['answers'][$i]); ?>" readonly>

                                                                                                    </div>
                                                                                                    <?php endfor; ?>
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

                                <!-- end card-box -->

                            </div> <!-- end col -->


                            <!-- end col -->

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