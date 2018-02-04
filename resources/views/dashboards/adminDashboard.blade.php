@extends('layouts.mainHome')

@section('content')
    <div class="content">

        <div class="container">

            <div class="row" style="height: 10px;s"></div>
            <div class="row">

                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card-box widget-box-two widget-two-primary">
                        <i class="fa fa-wheelchair widget-two-icon"></i>
                        <div class="wigdet-two-content">
                            <p class="m-0 text-uppercase font-600 font-secondary text-overflow" title="Statistics">Total Patients<br>Registered</p>
                            <h2><span data-plugin="counterup">6352</span><small><i class="mdi mdi-arrow-up text-success"></i></small></h2>


                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card-box widget-box-two widget-two-warning">
                        <i class="fa fa-wheelchair widget-two-icon"></i>
                        <div class="wigdet-two-content">
                            <p class="m-0 text-uppercase font-600 font-secondary text-overflow" title="Statistics">Patients Registered<br>This Month</p>
                            <h2><span data-plugin="counterup">6352</span><small><i class="mdi mdi-arrow-up text-success"></i></small></h2>


                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card-box widget-box-two widget-two-danger">
                        <i class="fa fa-dollar widget-two-icon"></i>
                        <div class="wigdet-two-content">
                            <p class="m-0 text-uppercase font-600 font-secondary text-overflow" title="Statistics">Total Income Of<br>This Month</p>
                            <h2><span data-plugin="counterup">6352</span><small><i class="mdi mdi-arrow-up text-success"></i></small></h2>

                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card-box widget-box-two widget-two-success">
                        <i class="fa fa-dollar widget-two-icon"></i>
                        <div class="wigdet-two-content">
                            <p class="m-0 text-uppercase font-600 font-secondary text-overflow" title="Statistics">Total Income Of<br>This Month</p>
                            <h2><span data-plugin="counterup">6352</span><small><i class="mdi mdi-arrow-up text-success"></i></small></h2>

                        </div>
                    </div>
                </div>


            </div>
            <div class="row">

                <div class="col-lg-8 col-md-12">
                    <div class="row">
                        <div class="col-lg-12 m-b-20">
                            <canvas id="bar-chart-grouped" width="800" height="400"
                                    style="border-top: 1px solid lightgrey;
                                    border-bottom: 1px solid lightgrey;
                                    border-right: 1px solid lightgrey;
                                    -webkit-border-radius: 5px;-moz-border-radius: 5px;border-radius: 5px;"></canvas>
                        </div>

                        <div class="col-lg-12 col-md-12 m-b-20">
                            <canvas id="bar-chart-grouped2" width="800" height="400"
                                    style="border-top: 1px solid lightgrey;
                                    border-bottom: 1px solid lightgrey;
                                    border-right: 1px solid lightgrey;
                                    -webkit-border-radius: 5px;-moz-border-radius: 5px;border-radius: 5px;"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12">
                    <div class="row">
                        <div class="col-lg-12 col-md-4 col-sm-6">
                            <div class="card-box widget-box-one">
                                <i class="fa fa-calendar widget-one-icon"></i>
                                <div class="wigdet-one-content">
                                    <p class="m-0 text-uppercase font-600 font-secondary text-overflow" title="User Today">Appointment Today</p>
                                    <h2>895 <small><i class="mdi mdi-arrow-up text-info"></i></small></h2>

                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12 col-md-4 col-sm-6">
                            <div class="card-box widget-box-one">
                                <i class="fa fa-stethoscope widget-one-icon"></i>
                                <div class="wigdet-one-content">
                                    <p class="m-0 text-uppercase font-600 font-secondary text-overflow" title="User Today">Patient Checked Today</p>
                                    <h2>895 <small><i class="mdi mdi-arrow-up text-info"></i></small></h2>

                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12 col-md-4 col-sm-6">
                            <div class="card-box widget-box-one">
                                <i class="fa fa-user-plus widget-one-icon"></i>
                                <div class="wigdet-one-content">
                                    <p class="m-0 text-uppercase font-600 font-secondary text-overflow" title="User Today">Patient Registered Today</p>
                                    <h2>895 <small><i class="mdi mdi-arrow-up text-info"></i></small></h2>

                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12 col-md-4 col-sm-6">
                            <div class="card-box widget-box-one">
                                <i class="fa fa-medkit widget-one-icon"></i>
                                <div class="wigdet-one-content">
                                    <p class="m-0 text-uppercase font-600 font-secondary text-overflow" title="User Today">Drug in Low Quantity</p>
                                    <h2>895 <small><i class="mdi mdi-arrow-down text-danger"></i></small></h2>

                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12 col-md-4 col-sm-12">
                            <div class="card-box widget-box-one">
                                <i class="fa fa-users widget-one-icon"></i>
                                <div class="wigdet-one-content">
                                    <p class="m-0 text-uppercase font-600 font-secondary text-overflow" title="User Today">Total Clinic Staff</p>
                                    <h2>895 <small><i class="mdi mdi-arrow-up text-info"></i></small></h2>

                                </div>
                            </div>
                        </div>


                    </div>

                </div>
            </div>





        </div> <!-- container -->

    </div> <!-- content -->
@endsection
@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
    <script>
        new Chart(document.getElementById("bar-chart-grouped"), {
            type: 'bar',
            data: {
                labels: ["Jan", "Feb", "Mar", "Apr","May","Jun","Jul","Aug","Sep",
                    "Oct","Nov","Dec"],
                datasets: [
                    {
                        label: "Patients",
                        backgroundColor: "#53ece6",
                        data: [133,221,783,700]
                    }
                ]
            },
            options: {
                title: {
                    display: true,
                    text: 'Total Patients Checked This Year:'
                }
            }
        });

        new Chart(document.getElementById("bar-chart-grouped2"), {
            type: 'bar',
            data: {
                labels: ["Jan", "Feb", "Mar", "Apr","May","Jun","Jul","Aug","Sep",
                    "Oct","Nov","Dec"],
                datasets: [
                    {
                        label: "Male",
                        backgroundColor: "#3e95cd",
                        data: [133,221,783,2478]
                    }

                ]
            },
            options: {
                title: {
                    display: true,
                    text: 'Patients Register this month'
                }
            }
        });

    </script>
    <script src="{{asset('assets/plugins/waypoints/jquery.waypoints.min.js')}}"></script>
    <script src="{{asset('assets/plugins/counterup/jquery.counterup.min.js')}}"></script>

    <!-- Flot chart js -->

    <script src="{{asset('assets/pages/jquery.dashboard_2.js')}}"></script>

@endsection
