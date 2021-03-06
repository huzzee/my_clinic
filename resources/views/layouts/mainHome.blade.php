<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
        <meta name="author" content="Coderthemes">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta http-equiv='cache-control' content='no-cache'>
        <meta http-equiv='expires' content='0'>
        <meta http-equiv='pragma' content='no-cache'>

        <!-- App favicon -->
        <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">
        <!-- App title -->
        <title>Klenic</title>


        {{--<link href="{{ asset('assets/plugins/c3/c3.min.css') }}" rel="stylesheet" type="text/css"  />--}}

        {{--drawing pad--}}
        <link href="{{ asset('assets/plugins/jquery.filer/css/jquery.filer.css') }}" rel="stylesheet" />

        <!-- Custom box -->
        <link href="{{ asset('assets/plugins/custombox/css/custombox.min.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/plugins/summernote/summernote.css') }}" rel="stylesheet" />
        <link rel="stylesheet" href="{{ asset('assets/plugins/tooltipster/tooltipster.bundle.min.css') }}">
        <link href="{{ asset('js/jQuery-autoComplete-master/jquery.auto-complete.css') }}" rel="stylesheet" />

        <!-- form css-->
        <link href="{{ asset('assets/plugins/bootstrap-tagsinput/css/bootstrap-tagsinput.css') }}" rel="stylesheet" />
        <link href="{{ asset('assets/plugins/multiselect/css/multi-select.css') }}"  rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/plugins/bootstrap-select/css/bootstrap-select.min.css') }}" rel="stylesheet" />
        <link href="{{ asset('assets/plugins/bootstrap-touchspin/css/jquery.bootstrap-touchspin.min.css') }}" rel="stylesheet" />
        <link href="{{ asset('assets/plugins/timepicker/bootstrap-timepicker.min.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/plugins/clockpicker/css/bootstrap-clockpicker.min.css') }}" rel="stylesheet">
        <link href="{{ asset('assets/plugins/bootstrap-daterangepicker/daterangepicker.css') }}" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/plugins/jquery.steps/css/jquery.steps.css') }}" />
        <!-- Datatables -->

        <link rel="stylesheet" href="{{ asset('assets/plugins/magnific-popup/css/magnific-popup.css') }}" />
        <link rel="stylesheet" href="{{ asset('assets/plugins/jquery-datatables-editable/datatables.css') }}" />
        
        <link href="{{ asset('assets/plugins/datatables/jquery.dataTables.min.css') }}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('assets/plugins/datatables/buttons.bootstrap.min.css') }}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('assets/plugins/datatables/fixedHeader.bootstrap.min.css') }}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('assets/plugins/datatables/responsive.bootstrap.min.css') }}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('assets/plugins/datatables/scroller.bootstrap.min.css') }}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('assets/plugins/datatables/dataTables.colVis.css') }}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('assets/plugins/datatables/dataTables.bootstrap.min.css') }}" rel="stylesheet" type="text/css"/>
        <link href="{{ asset('assets/plugins/datatables/fixedColumns.dataTables.min.css') }}" rel="stylesheet" type="text/css"/>
        <!-- App css -->
        <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/css/core.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/css/components.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/css/icons.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/css/pages.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/css/menu.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/css/responsive.css') }}" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" href="{{ asset('assets/plugins/switchery/switchery.min.css') }}">

        <link rel="stylesheet" href="{{ asset('js/jquery-confirm.min.css') }}">



        <!-- HTML5 Shiv and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>


        <![endif]-->

        <script src="{{ asset('assets/js/modernizr.min.js') }}"></script>

    </head>

    <style>
        * {
            margin: 0;
            padding: 0;
        }
        body{
            width: 100%;
            height:100%;

        }



        @media print{
          body .box-header{
            display: none;
          }
            @page {
                margin:0px;
            }
        }

        .head_show span{
            font-weight: bold;
            color: black;
            font-size: 17px;
            
        }
        input:-webkit-autofill {
            -webkit-box-shadow: 0 0 0 1000px white inset !important;
        }

        .links a {
            padding-left: 10px;
            margin-left: 10px;
            border-left: 1px solid #000;
            text-decoration: none;
            color: #999;
        }
        .links a:first-child {
            padding-left: 0;
            margin-left: 0;
            border-left: none;
        }
        .links a:hover {text-decoration: underline;}
        .column-left {
            display: inline;
            float: left;
        }
        .column-right {
            display: inline;
            float: right;
        }

        .table-condensed tbody tr .disabled {
            background-color: white !important;
            color: lightgrey !important;
        }
s
    </style>
    <body class="fixed-left">

    <input type="hidden" value="{{ url('/') }}" id="baseUrl">

        <!-- Begin page -->
        <div id="wrapper">

            <!-- Top Bar Start -->
            @include('include.header')
            <!-- Top Bar End -->


            <!-- ========== Left Sidebar Start ========== -->
            <div class="left side-menu">
                @if(Auth::user()->role_id == 1 )

                    @include('include.menus')
                @else
                    @include('include.menus2')
                @endif

                    <!-- Sidebar -left -->

            </div>
            <!-- Left Sidebar End -->



            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="content-page">
                @yield('content')



            </div>
            @include('include.footer')


            <!-- ============================================================== -->
            <!-- End Right content here -->
            <!-- ============================================================== -->


            <!-- Right Sidebar -->
            
            <!-- /Right-bar -->

        </div>
        <!-- END wrapper -->


        <script src="{{ asset('js/app.js') }}"></script>
        <script>
            var resizefunc = [];
        </script>


        <!-- jQuery  -->

        {{--<script src="{{ asset('assets/js/jquery.min.js') }}"></script>--}}

        <script src="{{ asset('js/jquery.jqscribble.js') }}"></script>
        <script src="{{ asset('js/jqscribble.extrabrushes.js') }}"></script>
        
        <script src="{{ asset('assets/js/detect.js') }}"></script>
        <script src="{{ asset('assets/js/fastclick.js') }}"></script>
        <script src="{{ asset('assets/js/jquery.blockUI.js') }}"></script>
        <script src="{{ asset('assets/js/waves.js') }}"></script>
        <script src="{{ asset('assets/js/jquery.slimscroll.js') }}"></script>
        <script src="{{ asset('assets/js/jquery.scrollTo.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/switchery/switchery.min.js') }}"></script>

        @yield('scripts');

        <!-- App js -->
        <script src="{{ asset('js/jquery-confirm.min.js') }}"></script>
        <script src="{{ asset('assets/js/jquery.core.js') }}"></script>
        <script src="{{ asset('assets/js/jquery.app.js') }}"></script>

        <script src="{{ asset('js/custom.js') }}"></script>



    </body>
</html>