<?php $__env->startSection('content'); ?>
    <!-- Start content -->
    <section>
        <div class="container-alt">
            <div class="row">
                <div class="col-sm-12 text-center">

                    <div class="wrapper-page">
                        <img src="assets/images/animat-search-color.gif" alt="" height="120">
                        <h2 class="text-uppercase text-info">Your account is deaciviated !</h2>
                        <p class="text-muted">It's looking like your account is deactivated by Admin. contact your Clinic Admin</p>

                        <a class="btn btn-inverse waves-effect waves-light m-t-20"
                           href="<?php echo e(route('logout')); ?>"
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form2').submit();"> Return back</a>
                        <form id="logout-form2" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                            <?php echo e(csrf_field()); ?>

                        </form>
                    </div>

                </div>
            </div>
        </div>
    </section>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.errorMain', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>