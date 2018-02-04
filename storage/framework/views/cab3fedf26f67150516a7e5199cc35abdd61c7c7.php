<?php $__env->startSection('content'); ?>
    <!-- Start content -->
    <div class="content">
        <div class="container">


            <div class="row">
                <div class="col-xs-12">
                    <div class="page-title-box">

                        <h4 class="page-title">Manage Medical Records</h4>

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
                        <button class="btn btn-danger waves-effect waves-light" data-toggle="modal"
                                data-target="#con-close-modal">
                            Add Medical Record
                        </button>

                        <a class="btn btn-info" href="<?php echo e(url('deleted_medical_records')); ?>">Deleted Records</a>


                        

                        <div id="con-close-modal" class="modal fade" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">

                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                            <h4 class="modal-title">Add Record</h4>
                                        </div>
                                        <form action="<?php echo e(url('medical_edit')); ?>" method="post">
                                        <div class="modal-body">


                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="pats" class="control-label">Select Patient<span class="text-danger">*</span></label>
                                                        <select class="form-control select2" name="patient_id">
                                                            <option selected disabled="disabled">Select Patient</option>

                                                            <?php $__currentLoopData = $patients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $patient): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <option value="<?php echo e($patient->id); ?>"><?php echo e($patient->patient_info['full_name']); ?>(<?php echo e($patient->patient_code); ?>)</option>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="pats" class="control-label">Select Doctor<span class="text-danger">*</span></label>
                                                        <select class="form-control select2" name="doctor_id">
                                                            <option selected disabled="disabled">Select Doctor</option>

                                                            <?php $__currentLoopData = $doctors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $doctor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <option value="<?php echo e($doctor->id); ?>"><?php echo e($doctor->users['name']); ?></option>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                                        </select>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                        <div class="modal-footer">
                                            <?php echo e(csrf_field()); ?>


                                            <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-inverse waves-effect waves-light">Add Record</button>
                                        </div>
                                        </form>
                                    </div>
                                </div>

                        </div><!-- /.modal -->

                        <hr>


                        <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive">
                            <thead>
                            <tr>
                                <th width="2%">Sr.No</th>

                                <th>Patient Name</th>
                                <th width="12%">Patient Code</th>
                                <th>Doctor Name</th>
                                <th>Created At</th>

                                <th width="15%">Action</th>

                            </tr>
                            </thead>


                            <tbody>
                            <?php $i=1;?>
                            <?php $__currentLoopData = $records; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $record): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($i); ?></td>

                                    <td><?php echo e($record->patients->patient_info['full_name']); ?></td>
                                    <td style="color: #017ebc; font-weight: bold"><?php echo e($record->patients['patient_code']); ?></td>
                                    <td><?php echo e($record->user_informations->doctor_info['first_name']); ?> <?php echo e($record->user_informations->doctor_info['last_name']); ?></td>
                                    <td><?php echo e(date('d-M-Y',strtotime($record->created_at))); ?></td>

                                    <td>

                                        <button class="btn btn-icon waves-effect waves-light btn-teal m-b-5" data-toggle="modal" data-target="#full-width-modal-show<?php echo e($record->id); ?>"><i class="fa fa-eye"></i></button>

                                        <?php if(Auth::user()->role_id == 2): ?>
                                        <button class="btn btn-icon waves-effect waves-light btn-danger m-b-5" data-toggle="modal" data-target="#con-close-modal<?php echo e($record->id); ?>"><i class="fa fa-remove"></i></button>
                                        <?php endif; ?>
                                    </td>
                                </tr>

                                <div id="con-close-modal<?php echo e($record->id); ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                <h4 class="modal-title">Warning!</h4>
                                            </div>
                                            <div class="modal-body">

                                                Are You Sure.You want to delete This Record.
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default waves-effect" data-dismiss="modal" style="float: right;">Close</button>

                                                <form action="<?php echo e(url('medical_records/'.$record->id)); ?>" method="post">
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
                        <?php $__currentLoopData = $records; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $record): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            

                            <div id="full-width-modal-show<?php echo e($record->id); ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="full-width-modalLabel" aria-hidden="true" style="display: none;">
                                <div class="modal-dialog" style="width: 70%;">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                            <h4 class="modal-title" id="full-width-modalLabel">Medical Record</h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="text-center card-box">
                                                        <div class="member-card">

                                                            <div class="row">
                                                                <div class="col-md-4">
                                                                    <div class="form-group" align="left">
                                                                        <label for="pats" class="control-label">Patient Name</label>
                                                                        <input type="text" readonly class="form-control input-sm" value="<?php echo e($record->patients->patient_info['full_name']); ?>">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group" align="left">
                                                                        <label for="pats" class="control-label">Patient Code</label>
                                                                        <input type="text" readonly class="form-control input-sm" value="<?php echo e($record->patients->patient_code); ?>">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group" align="left">
                                                                        <label for="pats" class="control-label">Doctor Name</label>
                                                                        <input type="text" readonly class="form-control input-sm" value="<?php echo e($record->user_informations->doctor_info['first_name']); ?> <?php echo e($record->user_informations->doctor_info['last_name']); ?>">
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-12">
                                                                    <div class="form-group" align="left">
                                                                        <label for="pats" class="control-label">Diagnose</label>
                                                                        <input type="text" readonly class="form-control input-sm" value="<?php echo e($record->diagnose); ?>">
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-12">
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