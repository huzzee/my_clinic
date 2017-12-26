<?php $__env->startSection('content'); ?>
    <div class="content">

        <div class="container">


            <div class="row">
                <div class="col-xs-12">
                    <div class="page-title-box">
                        <h4 class="page-title">Dashboard</h4>

                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <!-- end row -->

            <div class="row">
                <div class="col-md-12 m-t-20">
                    <canvas id="bar-chart-grouped" width="800" height="250"></canvas>
                </div>
            </div>



        </div> <!-- container -->

    </div> <!-- content -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
    <script>
        new Chart(document.getElementById("bar-chart-grouped"), {
            type: 'bar',
            data: {
                labels: ["January", "February", "March", "April","May","June","July","August","September",
                    "October","November","December"],
                datasets: [
                    {
                        label: "Male",
                        backgroundColor: "#3e95cd",
                        data: [133,221,783,2478]
                    }, {
                        label: "Female",
                        backgroundColor: "#ee4b82",
                        data: [408,547,675,734]
                    }
                ]
            },
            options: {
                title: {
                    display: true,
                    text: 'Patients Checked this month'
                }
            }
        });
    </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.mainHome', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>