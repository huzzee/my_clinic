<?php $__env->startSection('content'); ?>
    <!-- Start content -->
    <div class="content">
        <div class="container">
            <div class="row" style="height: 10px;">
                <?php if(count($errors) > 0): ?>
                    <div class="alert alert-danger">
                        <ul>
                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><?php echo e($error); ?></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                <?php endif; ?></div>
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-1" style="height: 50px;">

                            <img src="<?php echo e(asset('uploads/'.$patient->patient_info['profile_image'].'?v='.\Carbon\Carbon::now())); ?>"
                                 style="width: 50px; height: 50px;
                             border: 2px solid lightseagreen;
                             border-radius: 50px;
                             margin: 0;">
                            &nbsp;&nbsp;&nbsp;

                        </div>
                        <div class="col-md-4">
                            <p>
                                <strong style="color: darkslategrey"><?php echo e($patient->patient_info['full_name']); ?></strong>
                                <br/>
                                <?php if($patient->patient_info['gender'] == 0): ?>
                                    <small>MALE</small>
                                <?php else: ?>
                                    <small>FEMALE</small>
                                <?php endif; ?>

                                <?php $age = date('Y',strtotime(\Carbon\Carbon::now(get_local_time()))) - date('Y',strtotime($patient->patient_info['date_of_birth'])); ?>
                                <small><?php echo e($age); ?> Age</small>
                            </p>
                        </div>
                        <div class="col-md-5">

                            <strong style="color: darkslategrey">Email: </strong><small><?php echo e($patient->patient_info['email']); ?></small>
                            <br/>
                            <strong style="color: darkslategrey">Contact No: </strong><small><?php echo e($patient->patient_info['contact_no']); ?></small>

                        </div>
                        <div class="col-md-2">
                            <strong style="color: darkslategrey">Queue No:</strong>
                            <br/>

                            <small><?php echo e($queue->queue_code); ?></small>
                        </div>
                    </div>
                    <hr style="margin: 5px 0px 0px 0px;">

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="timeline timeline-left">
                                <article class="timeline-item alt">
                                    <div class="text-left">
                                        <div class="time-show first">
                                            <a href="javascript:void(0);" class="" style="color: black">Add Medical Record And Prescription</a>
                                        </div>
                                    </div>
                                </article>
                                <article class="timeline-item left">
                                    <div class="timeline-desk">
                                        <div class="panel" >
                                            <div class="timeline-box" style="background-color: white; border: 1px solid grey;">
                                                <span class="arrow-alt"></span>
                                                <span class="timeline-icon"
                                                      style="width: 60px !important;
                                                                height: 50px !important;
                                                                border-radius: 0px !important; background-color: white; border: 1px solid grey; color: black">
                                                    <div><?php echo e(date('d',strtotime(\Carbon\Carbon::now(get_local_time())))); ?> <br>
                                                                    <?php echo e(date('M*y',strtotime(\Carbon\Carbon::now(get_local_time())))); ?>

                                                    </div>
                                                </span>
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <h4 class="">Create Record And Prescription</h4>
                                                    </div>
                                                    <div class="col-sm-5">
                                                        <small><?php echo e(date('g:i a',strtotime(\Carbon\Carbon::now(get_local_time())))); ?> -BY  <?php echo e($queue->user_informations->users['name']); ?></small>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <select id="select_pres_record" class="selectpicker"
                                                                data-style="btn btn-teal">
                                                            <option value="0">Vital Signs</option>
                                                            <option value="1">Medical Notes</option>
                                                            <option value="2">Medical Templates</option>
                                                            <option value="3">Drawing Pad</option>
                                                            <option value="4">Prescription</option>
                                                            <option value="5">Medical Certificate</option>
                                                            <option value="6">Files</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <hr style="color: black; border: 1px solid grey; margin-top: 10px;">
                                                <div class="row">
                                                    <form action="<?php echo e(route('prescriptions.store')); ?>" method="post" id="record_submit" enctype="multipart/form-data">
                                                        <?php echo e(csrf_field()); ?>

                                                        <input type="hidden" name="patient_id" value="<?php echo e($patient->id); ?>">
                                                        <input type="hidden" name="queue_id" value="<?php echo e($queue->id); ?>">
                                                        <input type="hidden" name="doctor_id" value="<?php echo e($queue->user_informations->id); ?>">

                                                        <div class="col-sm-12" id="vital_sign_hidden">
                                                            <div class="row"><h3 style=" margin-left: 10px;">Vital Signs</h3></div>
                                                            <div class="row">
                                                                <div class="col-md-1"></div>
                                                                <div class="col-md-2 m-t-10 form-group" align="center">
                                                                    <h1><i class="fa fa-balance-scale"></i></h1>
                                                                    <h4 style="color: grey;">WEIGHT</h4>
                                                                    <br>
                                                                    <br>
                                                                    <input type="text" class="form-control" name="weight" placeholder="Enter Weight">

                                                                </div>

                                                                <div class="col-md-2 m-t-10 form-group" align="center">
                                                                    <h1>B.P</h1>
                                                                    <h4 style="color: grey;">BLOOD PRESSURE</h4>
                                                                    <br>
                                                                    <br>
                                                                    <input type="text" class="form-control" name="blood_pressure" placeholder="Enter Bp">

                                                                </div>

                                                                <div class="col-md-2 m-t-10 form-group" align="center">
                                                                    <h1><i class="fa fa-heartbeat"></i></h1>
                                                                    <h4 style="color: grey;">HEARTBEAT</h4>
                                                                    <br>
                                                                    <small>Heartbeat Per Mint</small>
                                                                    <br>
                                                                    <input type="text" class="form-control" name="heartbeat" placeholder="Enter Heartbeat">

                                                                </div>

                                                                <div class="col-md-2 m-t-10 form-group" align="center">
                                                                    <h1><i class="mdi mdi-thermometer"></i></h1>
                                                                    <h4 style="color: grey;">TEMPERATURE</h4>
                                                                    <br>
                                                                    <br>
                                                                    <input type="text" class="form-control" name="temperature" placeholder="Enter Temperature">

                                                                </div>

                                                                <div class="col-md-2 m-t-10 form-group" align="center">
                                                                    <h1><i class="fa fa-odnoklassniki"></i></h1>
                                                                    <h4 style="color: grey;">RESP.RATE</h4>
                                                                    <br>
                                                                    <small>Breaths Per Mint</small>
                                                                    <br>
                                                                    <input type="text" class="form-control" name="breaths" placeholder="Enter Breaths">

                                                                </div>
                                                                <div class="col-md-1"></div>
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-12" id="medical_note_hidden" style="display: none">

                                                            <div class="row"><h3 style="margin-bottom:20px;margin-left: 10px;">Medical Note</h3></div>

                                                            <textarea id="elm1" name="typing_Note"></textarea>

                                                        </div>

                                                        <div class="col-sm-12" id="medical_template_hidden" style="display: none">

                                                            <div class="row"><h3 style="margin-bottom:20px; margin-left: 10px;">Medical Template</h3></div>

                                                            <div class="form-group row">
                                                                <label for="doctor_id" class="col-sm-2">Template</label>
                                                                <div class="col-sm-6">
                                                                    <select class="form-control select2" id="chk_temp">
                                                                        <option selected disabled="disabled">Select Template</option>

                                                                        <?php $__currentLoopData = $templates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $template): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                            <option value="<?php echo e($template->id); ?>"><?php echo e($template->title); ?></option>
                                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                                                    </select>

                                                                </div>

                                                            </div>
                                                            <div id="templating">

                                                            </div>
                                                        </div>

                                                        <div class="col-sm-12" id="drawing_template_hidden" style="display: none">

                                                            <div class="row"><h3 style="margin-bottom:20px; margin-left: 10px;">Drawing Pad</h3></div>

                                                            <div class="form-group row">
                                                                <label for="image" class="col-md-1">Images:</label>
                                                                <div class="col-md-2 m-b-5">
                                                                    <input type="file" name="image" id="image-background"><br>

                                                                </div>
                                                                <label for="image" class="col-md-1">Tempate</label>
                                                                <div class="col-md-3 m-b-5">

                                                                    <select class="form-control select2" id="my_template">
                                                                        <option selected disabled="disabled">choose Template</option>
                                                                        <?php $__currentLoopData = $drawings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $template): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                            <option value="<?php echo e($template->id); ?>"><?php echo e($template->title); ?></option>
                                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                                                    </select>

                                                                </div>
                                                                <label for="image" class="col-md-3">choose a background color:</label>
                                                                <div class="col-md-1 m-b-5">

                                                                    <input type="color" id="canvas-background-color" value="#ffffff" class="form-control" data-control="hue">

                                                                </div>

                                                            </div>
                                                            <div class="form-group row">
                                                                <label for="image" class="col-md-1">Text:</label>
                                                                <div class="col-md-3 m-b-5">

                                                                    <input type="text" id="text" class="form-control" placeholder="Write your text and hit enter" />



                                                                </div>
                                                                <div class="col-md-1 m-b-5">

                                                                    <button type="button" class="btn btn-info" id="add-text"><i class="fa fa-plus"></i></button>

                                                                </div>
                                                                <label for="image" class="col-md-1">Color:</label>
                                                                <div class="col-md-1 m-b-5">

                                                                    <input type="color" id="text-color" class="form-control" data-control="hue">

                                                                </div>

                                                                <div class="col-md-2 m-b-5">
                                                                    <button type="button" id="selection" class="btn btn-primary">
                                                                        Selection Mode</button>

                                                                </div>
                                                                <div class="col-md-2 m-b-5">

                                                                    <button type="button" id="draw" class="btn btn-teal">
                                                                        Draw Mode</button>
                                                                </div>

                                                            </div>
                                                            <div class="form-group row">
                                                                <label for="image" class="col-md-1">Brush Color:</label>
                                                                <div class="col-md-1 m-b-5">
                                                                    <input type="color" id="draw-color" class="draw-color form-control" data-control="hue">

                                                                </div>
                                                                <label for="image" class="col-md-1">Brush Size:</label>
                                                                <div class="col-md-1 m-b-5">

                                                                    <input type="text" id="value" value="1" class="form-control">

                                                                </div>

                                                                <div class="col-md-4 m-b-5">
                                                                    <input type="range" id="range" min="1" max="50" value="1">

                                                                </div>
                                                                <div class="col-md-2 m-b-5">

                                                                    <button type="button" id="delete" class="btn btn-pink">
                                                                        Delete Selection</button>
                                                                </div>
                                                                <div class="col-md-2 m-b-5">

                                                                    <button type="button" id="delete-all" class="btn btn-danger">
                                                                        Delete All</button>
                                                                </div>

                                                            </div>
                                                            <div class="form-group row">
                                                                <div class="col-md-10" id="abcde">

                                                                    <canvas id="c" style="border:2px solid black;"></canvas>

                                                                </div>
                                                            </div>


                                                        </div>

                                                        <div class="col-sm-12" id="prescription_hidden" style="display: none">

                                                            <div class="row">
                                                                <div class="col-sm-6">
                                                                    <h3 style="margin-bottom:20px; margin-left: 10px;">Prescribe Medicines</h3>
                                                                </div>
                                                                <div class="col-sm-6" align="right">
                                                                    <button type="button" class="btn btn-pink waves-effect waves-light" data-toggle="modal"
                                                                            data-target="#con-close-modalservice">
                                                                        <i class="fa fa-plus"></i>
                                                                        Add Service/Test
                                                                    </button>
                                                                </div>

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
                                                                                        <div class="col-md-12">
                                                                                            <div class="form-group">
                                                                                                <label for="pats" class="control-label"  style="float:left;">Enter Service Detail</label>
                                                                                                <textarea id="textarea" class="detail_service form-control" maxlength="500" rows="5" placeholder="Detail"></textarea>
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
                                                                                                <textarea id="textarea" class="detail_service2 form-control" maxlength="500" rows="5" placeholder="Detail"></textarea>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>

                                                                            </div>
                                                                            <div class="modal-footer" id="cat_foot" style="display: none;">
                                                                                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                                                                                <a href="#" class="btn btn-inverse waves-effect waves-light" id="add_service_in_press">Add Service</a>
                                                                            </div>


                                                                        </div>
                                                                    </div>

                                                                </div><!-- /.modal -->

                                                            </div>
                                                            <div class="row">
                                                                <div class="col-sm-2">
                                                                    <div class="form-group">
                                                                        <label for="full_name" class="control-label">Medicine Name</label>
                                                                        <input type="text" id="drug_name_pres" class="form-control input-sm" placeholder="Medicine Name">
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-2">
                                                                    <div class="form-group">
                                                                        <label for="full_name" class="control-label">Type</label>
                                                                        <select class="form-control input-sm" id="drug_type_pres">
                                                                            <option selected value="0">Drug Type</option>

                                                                            <?php $__currentLoopData = $drugTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                                <option value="<?php echo e($type->category_name); ?>"><?php echo e($type->category_name); ?></option>
                                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-1">
                                                                    <div class="form-group">
                                                                        <label for="full_name" class="control-label">Qnt</label>
                                                                        <input type="number" id="drug_qnt_pres" class="form-control input-sm" placeholder="Quantity">
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-1">
                                                                    <div class="form-group">
                                                                        <label for="full_name" class="control-label">Dosage</label>
                                                                        <input type="number" id="drug_dosage_pres" class="form-control input-sm" placeholder="Dosage">
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-1">
                                                                    <div class="form-group">
                                                                        <label for="full_name" class="control-label">Unit</label>
                                                                        <select class="form-control input-sm" id="drug_dosage_unit_pres">
                                                                            <option selected value="0">Select Dosage Unit</option>
                                                                            <option value="Amp">Amp</option>
                                                                            <option value="Mg">Mg</option>
                                                                            <option value="Bott">Bott</option>
                                                                            <option value="Box">Box</option>
                                                                            <option value="Capes">Capes</option>
                                                                            <option value="Capsule">Capsule</option>
                                                                            <option value="cc">cc</option>
                                                                            <option value="Dose">Dose</option>
                                                                            <option value="Drop">Drop</option>
                                                                            <option value="Gms">Gms</option>
                                                                            <option value="Ink">Ink</option>
                                                                            <option value="Mls">Mls</option>
                                                                            <option value="Puffs">Puffs</option>
                                                                            <option value="Tabs">Tabs</option>
                                                                            <option value="Times">Times</option>
                                                                            <option value="Tube">Tube</option>
                                                                            <option value="Others">Others</option>

                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-1">
                                                                    <div class="form-group">
                                                                        <label for="full_name" class="control-label">Days</label>
                                                                        <input type="number" id="drug_days_pres" class="form-control input-sm" placeholder="Days">
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-3">
                                                                    <div class="form-group">
                                                                        <label for="full_name" class="control-label">Instructions</label>
                                                                        <input type="text" id="drug_inst_pres" class="form-control input-sm" placeholder="Instructions">
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-1">
                                                                    <div class="form-group">
                                                                        <button type="button" id="enter_drug_add" class="btn btn-inverse m-t-20"><i class="fa fa-plus"></i></button>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="row">
                                                                <table class="table table-striped m-0">
                                                                    <thead>
                                                                        <th>Drug Name/Test</th>
                                                                        <th>Quantity</th>
                                                                        <th>Dosage</th>
                                                                        <th>Days</th>
                                                                        <th>Instruction</th>
                                                                        <th>Action</th>
                                                                    </thead>
                                                                    <tbody id="pres_test_here">

                                                                    </tbody>
                                                                </table>
                                                            </div>

                                                        </div>

                                                        <div class="col-sm-12" id="medical_certificate_hidden" style="display: none">

                                                            <div class="row"><h3 style="margin-bottom:20px; margin-left: 10px;">Medical Certificate</h3></div>

                                                            <div class="row">
                                                                <div class="col-sm-10">
                                                                    <div class="form-group">
                                                                        <div class="checkbox checkbox-success">
                                                                            <input id="checkbox123" type="checkbox" name="check_mc">
                                                                            <label for="checkbox123">
                                                                                Check This If You want To Add Medical Certificate
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="col-sm-5">
                                                                    <div class="form-group">
                                                                        <label for="full_name" class="control-label">Date Of Visit</label>
                                                                        <div class="input-group">
                                                                            <input type="text" class="form-control input-sm" name="date_of_visit" value="<?php echo e(date('m/d/Y',strtotime(\Carbon\Carbon::now(get_local_time())))); ?>" placeholder="mm/dd/yyyy" id="datepicker-autoclose">
                                                                            <span class="input-group-addon bg-inverse b-0"><i class="mdi mdi-calendar text-white"></i></span>
                                                                        </div><!-- input-group -->

                                                                    </div>
                                                                </div>

                                                                <div class="col-sm-5">
                                                                    <div class="form-group">
                                                                        <label for="full_name" class="control-label">Date Of Issue</label>
                                                                        <div class="input-group">
                                                                            <input type="text" class="form-control input-sm" name="date_of_issue" value="<?php echo e(date('m/d/Y',strtotime(\Carbon\Carbon::now(get_local_time())))); ?>" placeholder="mm/dd/yyyy" id="datepicker-autoclose2">
                                                                            <span class="input-group-addon bg-inverse b-0"><i class="mdi mdi-calendar text-white"></i></span>
                                                                        </div><!-- input-group -->

                                                                    </div>
                                                                </div>

                                                                <div class="col-sm-5">
                                                                    <div class="form-group">
                                                                        <label for="full_name" class="control-label">Start Date</label>
                                                                        <div class="input-group">
                                                                            <input type="text" class="form-control input-sm" name="start_date" placeholder="mm/dd/yyyy" id="datepicker-autoclose3">
                                                                            <span class="input-group-addon bg-inverse b-0"><i class="mdi mdi-calendar text-white"></i></span>
                                                                        </div><!-- input-group -->

                                                                    </div>
                                                                </div>

                                                                <div class="col-sm-5">
                                                                    <div class="form-group">
                                                                        <label for="full_name" class="control-label">End Date</label>
                                                                        <div class="input-group">
                                                                            <input type="text" class="form-control input-sm" name="end_date" placeholder="mm/dd/yyyy" id="datepicker-autoclose4">
                                                                            <span class="input-group-addon bg-inverse b-0"><i class="mdi mdi-calendar text-white"></i></span>
                                                                        </div><!-- input-group -->

                                                                    </div>
                                                                </div>

                                                                <div class="col-sm-5">
                                                                    <div class="form-group">
                                                                        <label for="full_name" class="control-label">Time In</label>
                                                                        <div class="input-group">
                                                                            <input id="timepicker" type="text" name="time_in" class="form-control input-sm">
                                                                            <span class="input-group-addon bg-inverse b-0"><i class="mdi mdi-clock text-white"></i></span>
                                                                        </div><!-- input-group -->

                                                                    </div>
                                                                </div>

                                                                <div class="col-sm-5">
                                                                    <div class="form-group">
                                                                        <label for="full_name" class="control-label">Time Out</label>
                                                                        <div class="input-group">
                                                                            <input id="timepicker-2" type="text" name="time_out" class="form-control input-sm">
                                                                            <span class="input-group-addon bg-inverse b-0"><i class="mdi mdi-clock text-white"></i></span>
                                                                        </div><!-- input-group -->

                                                                    </div>
                                                                </div>

                                                                <div class="col-sm-5">
                                                                    <div class="form-group">
                                                                        <label for="full_name" class="control-label">MC Type</label>
                                                                        <select name="certificate_type" class="form-control select2">
                                                                            <option disabled="disabled" selected>Select MC Type</option>
                                                                            <option value="Medical certificate">Medical certificate</option>
                                                                        </select>

                                                                    </div>
                                                                </div>

                                                                <div class="col-sm-5">
                                                                    <div class="form-group">
                                                                        <label for="full_name" class="control-label">Description</label>
                                                                        <select name="description" class="form-control select2">
                                                                            <option disabled="disabled" selected>Select Description</option>
                                                                            <option value="Unfit For Job">Unfit For Job</option>
                                                                        </select>

                                                                    </div>
                                                                </div>

                                                                <div class="col-sm-10">
                                                                    <div class="form-group">
                                                                        <label for="full_name" class="control-label">Remarks</label>
                                                                        <textarea name="remarks" id="textarea" class="form-control" maxlength="500" rows="3" placeholder="Remarks" value="<?php echo e(old('remarks')); ?>"></textarea>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>

                                                        <div class="col-sm-12" id="files_hidden" style="display: none">

                                                            <div class="row"><h3 style="margin-bottom:20px; margin-left: 10px;">Files</h3></div>

                                                            <div class="form-group clearfix">
                                                                <div class="col-sm-12 padding-left-0 padding-right-0">
                                                                    <input type="file" name="uploads[]" id="filer_input2"
                                                                           multiple="multiple">

                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-sm-12" align="center">
                                                            <button type="submit" class="btn btn-success m-t-20" target="_blank">Save Records</button>
                                                        </div>

                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </article>
                                <article class="timeline-item alt">
                                    <div class="text-left">
                                        <div class="time-show first">
                                            <a href="javascript:void(0);" class="" style="color: black">Record History</a>
                                        </div>
                                    </div>
                                </article>
                                <?php $__currentLoopData = $prescriptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $prescription): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <article class="timeline-item left">
                                        <div class="timeline-desk">
                                            <div class="panel" >
                                                <div class="timeline-box" style="background-color: white; border: 1px solid grey;">
                                                    <span class="arrow-alt"></span>
                                                    <span class="timeline-icon"
                                                          style="width: 60px !important;
                                                                height: 50px !important;
                                                                border-radius: 0px !important; background-color: white; border: 1px solid grey; color: black">
                                                    <div><?php echo e(date('d',strtotime($prescription->created_at))); ?> <br>
                                                        <?php echo e(date('M*y',strtotime($prescription->created_at))); ?>

                                                    </div>
                                                </span>
                                                    <div class="row">
                                                        <div class="col-sm-4">
                                                            <h4 class="">Record Data</h4>
                                                        </div>
                                                        <div class="col-sm-5">
                                                            <small><?php echo e(date('g:i a',strtotime($prescription->created_at))); ?> -BY  <?php echo e($prescription->user_informations->users['name']); ?></small>
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <select class="select_pres_record2 select2"
                                                                    data-style="btn btn-teal" data-prescription_id="<?php echo e($prescription->id); ?>">
                                                                <option value="0">Vital Signs</option>
                                                                <option value="1">Medical Notes</option>
                                                                <option value="2">Medical Templates</option>
                                                                <option value="3">Drawing Pad</option>
                                                                <option value="4">Prescription</option>
                                                                <option value="5">Medical Certificate</option>
                                                                <option value="6">Files</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <hr style="color: black; border: 1px solid grey; margin-top: 10px;">
                                                    <div class="row">

                                                        <div class="col-sm-12" id="vital_sign_hidden<?php echo e($prescription->id); ?>">
                                                            <div class="row"><h3 style=" margin-left: 10px;">Vital Signs</h3></div>
                                                            <div class="row">
                                                                <div class="col-md-1"></div>
                                                                <div class="col-md-2 m-t-10 form-group" align="center">
                                                                    <h1><i class="fa fa-balance-scale"></i></h1>
                                                                    <h5 style="color: grey;">WEIGHT</h5>
                                                                    <br>
                                                                    <br>
                                                                    <h5 style="color: grey; margin: 0px;"><?php echo e($prescription->medicalRecords->health_info['weight']); ?></h5>
                                                                </div>

                                                                <div class="col-md-2 m-t-10 form-group" align="center">
                                                                    <h1>B.P</h1>
                                                                    <h5 style="color: grey;">BLOOD PRESSURE</h5>
                                                                    <br>
                                                                    <br>
                                                                    <h5 style="color: grey; margin: 0px;"><?php echo e($prescription->medicalRecords->health_info['blood_pressure']); ?></h5>
                                                                </div>

                                                                <div class="col-md-2 m-t-10 form-group" align="center">
                                                                    <h1><i class="fa fa-heartbeat"></i></h1>
                                                                    <h5 style="color: grey;">HEARTBEAT</h5>
                                                                    <br>
                                                                    <small>Heartbeat per Mint</small>
                                                                    <br>
                                                                    <h5 style="color: grey; margin: 0px;"><?php echo e($prescription->medicalRecords->health_info['heartbeat']); ?></h5>
                                                                </div>

                                                                <div class="col-md-2 m-t-10 form-group" align="center">
                                                                    <h1><i class="mdi mdi-thermometer"></i></h1>
                                                                    <h5 style="color: grey;">TEMPERATURE</h5>
                                                                    <br>
                                                                    <br>
                                                                    <h5 style="color: grey; margin: 0px;"><?php echo e($prescription->medicalRecords->health_info['temperature']); ?></h5>
                                                                </div>

                                                                <div class="col-md-2 m-t-10 form-group" align="center">
                                                                    <h1><i class="fa fa-odnoklassniki"></i></h1>
                                                                    <h5 style="color: grey;">RESP.RATE</h5>
                                                                    <br>
                                                                    <small>Breaths per Mint</small>
                                                                    <br>
                                                                    <h5 style="color: grey; margin: 0px;"><?php echo e($prescription->medicalRecords->health_info['breaths']); ?></h5>
                                                                </div>
                                                                <div class="col-md-1"></div>
                                                            </div>
                                                        </div>


                                                        <div class="col-sm-12" id="medical_note_hidden<?php echo e($prescription->id); ?>" style="display: none">

                                                            <div class="row"><h3 style="margin-bottom:20px;margin-left: 10px;">Medical Note</h3></div>

                                                            <div><?php echo $prescription->medicalRecords->typing_Note; ?></div>

                                                        </div>

                                                        <div class="col-sm-12" id="medical_template_hidden<?php echo e($prescription->id); ?>" style="display: none">

                                                            <div class="row"><h3 style="margin-bottom:20px; margin-left: 10px;">Medical Template</h3></div>

                                                            <?php $__currentLoopData = $prescription->medicalRecords->template; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $temp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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

                                                        <div class="col-sm-12" align="center" id="drawing_template_hidden<?php echo e($prescription->id); ?>" style="display: none">

                                                            <img src="<?php echo e(asset('uploads/'.$prescription->medicalRecords->image_url)); ?>" style="border: 2px solid black;"/>
                                                            <br>
                                                            <a href="<?php echo e(asset('uploads/'.$prescription->medicalRecords->image_url)); ?>" download="Klenic-<?php echo e($prescription->patients->patient_info['full_name']); ?>-<?php echo e($prescription->created_At); ?>" class="btn btn-primary">
                                                                Download
                                                            </a>

                                                        </div>

                                                        <div class="col-sm-12" id="prescription_hidden<?php echo e($prescription->id); ?>" style="display: none">

                                                            <div class="row">
                                                                <div class="col-sm-6">
                                                                    <h3 style="margin-bottom:20px; margin-left: 10px;">Prescribe Medicines</h3>
                                                                </div>

                                                            </div>

                                                            <div class="row">
                                                                <table class="table table-striped m-0">
                                                                    <thead>

                                                                    <th>Drug Name/Test</th>
                                                                    <th>Quantity</th>
                                                                    <th>Dosage</th>
                                                                    <th>Days</th>
                                                                    <th>Instruction</th>

                                                                    </thead>
                                                                    <tbody>
                                                                        <?php $__currentLoopData = $prescription->prescriptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $prescribe): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                            <tr>
                                                                                <td><?php echo e($prescribe['drug_name']); ?></td>
                                                                                <td><?php echo e($prescribe['drug_qnt']); ?></td>
                                                                                <td><?php echo e($prescribe['dosage_qnt']); ?></td>
                                                                                <td><?php echo e($prescribe['days']); ?></td>
                                                                                <td><?php echo e($prescribe['instruction']); ?></td>
                                                                            </tr>
                                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                    </tbody>
                                                                </table>
                                                            </div>

                                                        </div>

                                                        <div class="col-sm-12" id="medical_certificate_hidden<?php echo e($prescription->id); ?>" style="display: none">

                                                            <div class="row"><h3 style="margin-bottom:20px; margin-left: 10px;">Medical Certificate</h3></div>
                                                            <?php if($prescription->medicalCertificates !== null): ?>
                                                            <div class="row">

                                                                <div class="col-sm-5">
                                                                    <div class="form-group">
                                                                        <label for="full_name" class="control-label">Date Of Visit</label>
                                                                        <p><?php echo e($prescription->medicalCertificates->date_of_visit); ?></p>
                                                                    </div>
                                                                </div>

                                                                <div class="col-sm-5">
                                                                    <div class="form-group">
                                                                        <label for="full_name" class="control-label">Date Of Issue</label>
                                                                        <p><?php echo e($prescription->medicalCertificates->date_of_issue); ?></p>

                                                                    </div>
                                                                </div>

                                                                <div class="col-sm-5">
                                                                    <div class="form-group">
                                                                        <label for="full_name" class="control-label">Start Date</label>
                                                                        <p><?php echo e($prescription->medicalCertificates->start_date); ?></p>

                                                                    </div>
                                                                </div>

                                                                <div class="col-sm-5">
                                                                    <div class="form-group">
                                                                        <label for="full_name" class="control-label">End Date</label>
                                                                        <p><?php echo e($prescription->medicalCertificates->end_date); ?></p>

                                                                    </div>
                                                                </div>

                                                                <div class="col-sm-5">
                                                                    <div class="form-group">
                                                                        <label for="full_name" class="control-label">Time In</label>
                                                                        <p><?php echo e(date('g:i a',strtotime($prescription->medicalCertificates->time_in))); ?></p>
                                                                    </div>
                                                                </div>

                                                                <div class="col-sm-5">
                                                                    <div class="form-group">
                                                                        <label for="full_name" class="control-label">Time Out</label>
                                                                        <p><?php echo e(date('g:i a',strtotime($prescription->medicalCertificates->time_out))); ?></p>

                                                                    </div>
                                                                </div>

                                                                <div class="col-sm-5">
                                                                    <div class="form-group">
                                                                        <label for="full_name" class="control-label">MC Type</label>
                                                                        <p><?php echo e($prescription->medicalCertificates->certificate_type); ?></p>

                                                                    </div>
                                                                </div>

                                                                <div class="col-sm-5">
                                                                    <div class="form-group">
                                                                        <label for="full_name" class="control-label">Description</label>
                                                                        <p><?php echo e($prescription->medicalCertificates->description); ?></p>

                                                                    </div>
                                                                </div>

                                                                <div class="col-sm-10">
                                                                    <div class="form-group">
                                                                        <label for="full_name" class="control-label">Remarks</label>
                                                                        <p><?php echo e($prescription->medicalCertificates->remarks); ?></p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <?php else: ?>
                                                            <div class="row">
                                                                No Certificates
                                                            </div>
                                                            <?php endif; ?>

                                                        </div>

                                                        <div class="col-sm-12" id="files_hidden<?php echo e($prescription->id); ?>" style="display: none">

                                                                <div class="row"><h3 style="margin-bottom:20px; margin-left: 10px;">Files</h3></div>

                                                                <div class="row">
                                                                    <div class="col-sm-1"></div>
                                                                    <div class="col-sm-11">
                                                                        <?php for($j=0; $j < sizeof($prescription->medicalRecords->upload_file); $j++): ?>
                                                                            <h5 align="left"><a href="<?php echo e(asset('uploads/'.$prescription->medicalRecords->upload_file[$j])); ?>" target="_blank">Image <?php echo e($j+1); ?></a></h5>
                                                                        <?php endfor; ?>
                                                                    </div>

                                                                </div>
                                                            </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </article>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>

                    </div>
                        <div class="col-sm-12" align="center"><?php echo e($prescriptions->links()); ?></div>
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

    <script src="<?php echo e(asset('js/jQuery-autoComplete-master/jquery.auto-complete.js')); ?>"></script>


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


    <script src="<?php echo e(asset('assets/plugins/tinymce/tinymce.min.js')); ?>"></script>

    <script src="<?php echo e(asset('assets/plugins/jquery.filer/js/jquery.filer.min.js')); ?>"></script>

    <script src="<?php echo e(asset('assets/pages/jquery.fileuploads.init.js')); ?>"></script>



    <script src="<?php echo e(asset('src/js/fabric-1.6.3.min.js')); ?>"></script>
    <script src="<?php echo e(asset('src/js/jquery.ezdz.min.js')); ?>"></script>
    <script src="<?php echo e(asset('src/js/jquery.minicolors-2.1.2.min.js')); ?>"></script>
    <script src="<?php echo e(asset('src/js/lity.min.js')); ?>"></script>
    <script src="<?php echo e(asset('src/js/draweditor.js')); ?>"></script>
    <script src="<?php echo e(asset('js/medical_prescription.js')); ?>"></script>

    
    <script type="text/javascript">


        $(document).ready(function () {
            if($("#elm1").length > 0){
                tinymce.init({
                    selector: "textarea#elm1",
                    theme: "modern",
                    height:300,
                    plugins: [
                        "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
                        "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                        "save table contextmenu directionality emoticons template paste textcolor"
                    ],
                    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | print preview media fullpage | forecolor backcolor emoticons",
                    style_formats: [
                        {title: 'Bold text', inline: 'b'},
                        {title: 'Red text', inline: 'span', styles: {color: '#ff0000'}},
                        {title: 'Red header', block: 'h1', styles: {color: '#ff0000'}},
                        {title: 'Example 1', inline: 'span', classes: 'example1'},
                        {title: 'Example 2', inline: 'span', classes: 'example2'},
                        {title: 'Table styles'},
                        {title: 'Table row 1', selector: 'tr', classes: 'tablerow1'}
                    ]
                });
            }
        });

        $('#datepicker-autoclose2').datepicker({
            autoclose: true,
            todayHighlight: true
        });
        $('#datepicker-autoclose3').datepicker({
            autoclose: true,
            todayHighlight: true
        });
        $('#datepicker-autoclose4').datepicker({
            autoclose: true,
            todayHighlight: true
        });

        $('#timepicker').timepicker({
            defaultTIme: false
        });

        $('#timepicker-2').timepicker({
            defaultTIme: false
        });

    </script>
    <script src="<?php echo e(asset('js/patient_info.js')); ?>"></script>


<?php $__env->stopSection(); ?>

<!--*********Page Scripts End*********-->
<?php echo $__env->make('layouts.mainHome', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>