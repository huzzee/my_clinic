<div class="sidebar-inner slimscrollleft">

    <!--- Sidemenu -->
    <div id="sidebar-menu">
        <ul>
            <li class="menu-title">Navigation</li>

            <li class="has_sub">
                <a href="<?php echo e(url('/')); ?>" class="waves-effect">
                    <i style="color: #39e7e0" class="mdi mdi-view-dashboard"></i>
                    <span style="color: lightgrey;"> Dashboard </span>
                </a>

            </li>


            <?php $__currentLoopData = callMenus(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menus): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($menus->menus->parent_menu_id == ''): ?>
                    <li class="has_sub">
                        <?php if($menus->menus->menu_slug == ''): ?>
                            <a href="javascript:void(0);" class="waves-effect">
                                <i style="color: #39e7e0" class="<?php echo e($menus->menus->menu_icon); ?>"></i>
                                <span style="color: lightgrey;"> <?php echo e($menus->menus->menu_name); ?> </span>
                            </a>

                            <ul class="list-unstyled">
                                <?php $__currentLoopData = callMenus(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $submenus): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($submenus->menus->parent_menu_id == $menus->menus->id): ?>
                                        <li>
                                            <a href="<?php echo e(url($submenus->menus->menu_slug)); ?>"><?php echo e($submenus->menus->menu_name); ?></a>
                                        </li>
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        <?php else: ?>
                            <a href="<?php echo e(url($menus->menus->menu_slug)); ?>" class="waves-effect">
                                <i style="color: #39e7e0;" class="<?php echo e($menus->menus->menu_icon); ?>"></i>
                                <span style="color: lightgrey;"> <?php echo e($menus->menus->menu_name); ?> </span>
                            </a>
                        <?php endif; ?>




                    </li>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <!-- <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-invert-colors"></i> <span> User Interface </span> <span class="menu-arrow"></span></a>
                                <ul class="list-unstyled">
                                    <li><a href="ui-buttons.html">Buttons</a></li>
                                    <li><a href="ui-typography.html">Typography</a></li>
                                    <li><a href="ui-panels.html">Panel</a></li>
                                    <li><a href="ui-portlets.html">Portlets</a></li>
                                    <li><a href="ui-modals.html">Modals</a></li>
                                    <li><a href="ui-checkbox-radio.html">Checkboxs-Radios</a></li>
                                    <li><a href="ui-tabs.html">Tabs</a></li>
                                    <li><a href="ui-progressbars.html">Progress Bars</a></li>
                                    <li><a href="ui-notifications.html">Notification</a></li>
                                    <li><a href="ui-alerts.html">Alerts</a>
                                    <li><a href="ui-carousel.html">Carousel</a>
                                    <li><a href="ui-video.html">Video</a>
                                    <li><a href="ui-tooltips-popovers.html">Tooltips & Popovers</a></li>
                                    <li><a href="ui-images.html">Images</a></li>
                                    <li><a href="ui-bootstrap.html">Bootstrap UI</a></li>
                                    <li><a href="ui-grid.html">Grid</a></li>
                                </ul>
                            </li>

                            <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-layers"></i><span> Admin UI </span> <span class="menu-arrow"></span></a>
                                <ul class="list-unstyled">
                                    <li><a href="admin-sweet-alert.html">Sweet Alert</a></li>
                                    <li><a href="admin-widgets.html">Widgets</a></li>
                                    <li><a href="admin-nestable.html">Nestable List</a></li>
                                    <li><a href="admin-rangeslider.html">Range Slider</a></li>
                                    <li><a href="admin-ratings.html">Ratings</a></li>
                                    <li><a href="admin-animation.html">Animation</a></li>
                                </ul>
                            </li>

                            <li>
                                <a href="calendar.html" class="waves-effect"><i class="mdi mdi-calendar"></i><span> Calendar </span></a>
                            </li>

                            <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-email"></i><span> Email </span> <span class="menu-arrow"></span></a>
                                <ul class="list-unstyled">
                                    <li><a href="email-inbox.html"> Inbox</a></li>
                                    <li><a href="email-read.html"> Read Mail</a></li>
                                    <li><a href="email-compose.html"> Compose Mail</a></li>
                                </ul>
                            </li>

                            <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-heart-outline"></i><span> Icons </span> <span class="menu-arrow"></span></a>
                                <ul class="list-unstyled">
                                    <li><a href="icons-glyphicons.html">Glyphicons</a></li>
                                    <li><a href="icons-colored.html">Colored Icons</a></li>
                                    <li><a href="icons-materialdesign.html">Material Design</a></li>
                                    <li><a href="icons-ionicons.html">Ion Icons</a></li>
                                    <li><a href="icons-fontawesome.html">Font awesome</a></li>
                                    <li><a href="icons-themifyicon.html">Themify Icons</a></li>
                                    <li><a href="icons-typicons.html">Typicons</a></li>
                                </ul>
                            </li>

                            <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-diamond"></i><span class="label label-info pull-right">New</span> <span> Forms </span></a>
                                <ul class="list-unstyled">
                                    <li><a href="form-elements.html">Form Elements</a></li>
                                    <li><a href="form-advanced.html">Form Advanced</a></li>
                                    <li><a href="form-validation.html">Form Validation</a></li>
                                    <li><a href="form-pickers.html">Form Pickers</a></li>
                                    <li><a href="form-wizard.html">Form Wizard</a></li>
                                    <li><a href="form-mask.html">Form Masks</a></li>
                                    <li><a href="form-summernote.html">Summernote</a></li>
                                    <li><a href="form-wysiwig.html">Wysiwig Editors</a></li>
                                    <li><a href="form-uploads.html">Multiple File Upload</a></li>
                                </ul>
                            </li>

                            <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-format-list-bulleted"></i> <span> Tables </span> <span class="menu-arrow"></span></a>
                                <ul class="list-unstyled">
                                	<li><a href="tables-basic.html">Basic Tables</a></li>
                                    <li><a href="tables-layouts.html">Tables Layouts</a></li>
                                    <li><a href="tables-datatable.html">Data Table</a></li>
                                    <li><a href="tables-responsive.html">Responsive Table</a></li>
                                    <li><a href="tables-tablesaw.html">Tablesaw Table</a></li>
                                    <li><a href="tables-editable.html">Editable Table</a></li>
                                </ul>
                            </li>

                            <li class="menu-title">Extra</li>

                            <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-chart-arc"></i><span> Charts </span> <span class="menu-arrow"></span></a>
                                <ul class="list-unstyled">
                                    <li><a href="chart-flot.html">Flot Chart</a></li>
                                    <li><a href="chart-morris.html">Morris Chart</a></li>
                                    <li><a href="chart-google.html">Google Chart</a></li>
                                    <li><a href="chart-chartist.html">Chartist Charts</a></li>
                                    <li><a href="chart-chartjs.html">Chartjs Chart</a></li>
                                    <li><a href="chart-c3.html">C3 Chart</a></li>
                                    <li><a href="chart-sparkline.html">Sparkline Chart</a></li>
                                    <li><a href="chart-knob.html">Jquery Knob</a></li>
                                </ul>
                            </li>

                            <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-map"></i> <span> Maps </span> <span class="menu-arrow"></span></a>
                                <ul class="list-unstyled">
                                	<li><a href="maps-google.html">Google Maps</a></li>
                                    <li><a href="maps-vector.html">Vector Maps</a></li>
                                    <li><a href="maps-mapael.html">Mapael Maps</a></li>
                                </ul>
                            </li>

                            <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-google-pages"></i><span> Pages </span> <span class="menu-arrow"></span></a>
                                <ul class="list-unstyled">
                                    <li><a href="page-starter.html">Starter Page</a></li>
                                    <li><a href="page-login.html">Login</a></li>
                                    <li><a href="page-register.html">Register</a></li>
                                    <li><a href="page-logout.html">Logout</a></li>
                                    <li><a href="page-recoverpw.html">Recover Password</a></li>
                                    <li><a href="page-lock-screen.html">Lock Screen</a></li>
                                    <li><a href="page-confirm-mail.html">Confirm Mail</a></li>
                                    <li><a href="page-404.html">Error 404</a></li>
                                    <li><a href="page-404-alt.html">Error 404-alt</a></li>
                                    <li><a href="page-500.html">Error 500</a></li>
                                </ul>
                            </li>

                            <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-gift"></i><span> Extras </span> <span class="menu-arrow"></span></a>
                                <ul class="list-unstyled">
                                    <li><a href="extras-profile.html">Profile</a></li>
                                    <li><a href="extras-sitemap.html">Sitemap</a></li>
                                    <li><a href="extras-about.html">About Us</a></li>
                                    <li><a href="extras-contact.html">Contact</a></li>
                                    <li><a href="extras-members.html">Members</a></li>
                                    <li><a href="extras-timeline.html">Timeline</a></li>
                                    <li><a href="extras-invoice.html">Invoice</a></li>
                                    <li><a href="extras-search-result.html">Search Result</a></li>
                                    <li><a href="extras-emailtemplate.html">Email Template</a></li>
                                    <li><a href="extras-maintenance.html">Maintenance</a></li>
                                    <li><a href="extras-coming-soon.html">Coming Soon</a></li>
                                    <li><a href="extras-faq.html">FAQ</a></li>
                                    <li><a href="extras-gallery.html">Gallery</a></li>
                                    <li><a href="extras-pricing.html">Pricing</a></li>
                                </ul>
                            </li>

                            <li class="menu-title">More</li>

                            <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-comment-text-outline"></i><span> Blog </span> <span class="menu-arrow"></span></a>
                                <ul class="list-unstyled">
                                    <li><a href="blogs-dashboard.html">Dashboard</a></li>
                                    <li><a href="blogs-blog-list.html">Blog List</a></li>
                                    <li><a href="blogs-blog-column.html">Blog Column</a></li>
                                    <li><a href="blogs-blog-post.html">Blog Post</a></li>
                                    <li><a href="blogs-blog-add.html">Add Blog</a></li>
                                </ul>
                            </li>

                            <li class="has_sub">
                                <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-home-map-marker"></i><span> Real Estate </span> <span class="menu-arrow"></span></a>
                                <ul class="list-unstyled">
                                    <li><a href="real-estate-dashboard.html">Dashboard</a></li>
                                    <li><a href="real-estate-list.html">Property List</a></li>
                                    <li><a href="real-estate-column.html">Property Column</a></li>
                                    <li><a href="real-estate-detail.html">Property Detail</a></li>
                                    <li><a href="real-estate-agents.html">Agents</a></li>
                                    <li><a href="real-estate-profile.html">Agent Details</a></li>
                                    <li><a href="real-estate-add.html">Add Property</a></li>
                                </ul>
                            </li> -->

        </ul>
    </div>


</div>