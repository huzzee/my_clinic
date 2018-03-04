<div class="topbar">

                <!-- LOGO -->
                <div class="topbar-left">
                    <a href="javascript:void(0);" class="logo"><span><img src="<?php echo e(asset('logo/klinic.png')); ?>" style="height: 70%;" alt=""></span><i><img src="<?php echo e(asset('logo/klinic.png')); ?>" style="height: 30px;" alt=""></i></a>
                    <!-- Image logo -->
                    <!--<a href="index.html" class="logo">-->
                        <!--<span>-->
                            <!--<img src="assets/images/logo.png" alt="" height="30">-->
                        <!--</span>-->
                        <!--<i>-->
                            <!--<img src="assets/images/logo_sm.png" alt="" height="28">-->
                        <!--</i>-->
                    <!--</a>-->

                </div>

                <!-- Button mobile view to collapse sidebar menu -->
                <div class="navbar navbar-default" role="navigation">
                    <div class="container">

                        <!-- Navbar-left -->
                        <ul class="nav navbar-nav navbar-left">
                            <li>
                                <button class="button-menu-mobile open-left waves-effect">
                                    <i class="mdi mdi-menu"></i>
                                </button>
                            </li>
                            
                        </ul>

                        <!-- Right(Notification) -->
                        <ul class="nav navbar-nav navbar-right">
                            <div id="app"></div>
                            <li>
                                <a href="#" class="right-menu-item dropdown-toggle" data-toggle="dropdown">
                                    <i class="mdi mdi-bell"></i>
                                    <span class="badge up bg-success">4</span>
                                </a>


                                <ul class="dropdown-menu dropdown-menu-right arrow-dropdown-menu arrow-menu-right dropdown-lg user-list notify-list">
                                    <li>
                                        <h5>Notifications</h5>
                                    </li>
                                    <li>
                                        <a href="#" class="user-list-item">
                                            <div class="icon bg-info">
                                                <i class="mdi mdi-account"></i>
                                            </div>
                                            <div class="user-desc">
                                                <span class="name">New Signup</span>
                                                <span class="time">5 hours ago</span>
                                            </div>
                                        </a>
                                    </li>

                                </ul>
                            </li>
                            

                           

                            <li class="dropdown user-box">
                                <a href="" class="dropdown-toggle waves-effect user-link" data-toggle="dropdown" aria-expanded="true">
                                    <img src="<?php echo e(asset('uploads/'.Auth::user()->profile_image.'?v='.\Carbon\Carbon::now())); ?>" alt="user-img" class="img-circle user-img">
                                </a>

                                <ul class="dropdown-menu dropdown-menu-right arrow-dropdown-menu arrow-menu-right user-list notify-list">
                                    <li>
                                        <h5>Hi, <?php echo e(Auth::user()->name); ?> </h5>
                                    </li>
                                    <?php if(Auth::user()->role_id == 1): ?>
                                        <li><a href="javascript:void(0)"><i class="ti-user m-r-5"></i> Profile</a></li>
                                    <?php elseif(Auth::user()->role_id == 2): ?>
                                        <li><a href="<?php echo e(url('admins/'.Auth::user()->user_informations->id)); ?>"><i class="ti-user m-r-5"></i> Profile</a></li>
                                    <?php elseif(Auth::user()->role_id == 3): ?>
                                        <li><a href="<?php echo e(url('doctors/'.Auth::user()->user_informations->id)); ?>"><i class="ti-user m-r-5"></i> Profile</a></li>
                                    <?php elseif(Auth::user()->role_id == 4): ?>
                                        <li><a href="<?php echo e(url('employee/'.Auth::user()->user_informations->id.'/edit')); ?>"><i class="ti-user m-r-5"></i> Profile</a></li>
                                    <?php endif; ?>

                                    <li><li><a href="<?php echo e(route('logout')); ?>"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            <i class="ti-power-off m-r-5"></i>
                                            Logout
                                        </a>

                                        <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                                            <?php echo e(csrf_field()); ?>

                                        </form>
                                    </li></li>
                                </ul>
                            </li>

                        </ul> <!-- end navbar-right -->

                    </div><!-- end container -->
                </div><!-- end navbar -->
            </div>