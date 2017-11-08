<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
        <meta name="author" content="Coderthemes">

        <!-- App favicon -->
        <link rel="shortcut icon" href="{{asset('logo/fav.png')}}" type="image/x-icon">
        <link rel="icon" href="{{asset('logo/fav.png')}}" type="image/x-icon">
        <!-- App title -->
        <title>Klenic</title>

        <!-- App css -->
        <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/css/core.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/css/components.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/css/icons.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/css/pages.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/css/menu.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/css/responsive.css') }}" rel="stylesheet" type="text/css" />
		

        <!-- HTML5 Shiv and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->

        <script src="{{ asset('assets/js/modernizr.min.js') }}"></script>

    </head>


    <body class="bg-transparent" style="background-color: whitesmoke !important;">

        <!-- HOME -->
        <section>
            <div class="container-alt" >
                <div class="row">
                    <div class="col-sm-12">

                        <div class="wrapper-page">

                            <div class="m-t-40 account-pages">
                                <div class="text-center account-logo-box" style="background-color: #3c4655">
                                    <h2 class="text-uppercase">
                                        <a href="javascript:void(0);" class="text-success">
                                            <span><img src="{{ asset('logo/klinic.png') }}" alt="" width="30%"></span>
                                        </a>
                                    </h2>
                                    <!--<h4 class="text-uppercase font-bold m-b-0">Sign In</h4>-->
                                </div>
                                <div class="account-content" style="background-color: white !important;">
                                    <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                                        {{ csrf_field() }}
                                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                            <div class="col-xs-12">
                                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                                @if ($errors->has('email'))
                                                    <span style="color:red;">
                                                        <strong>{{ $errors->first('email') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                            <div class="col-xs-12">
                                                <input id="password" type="password" class="form-control" name="password" required>

                                                @if ($errors->has('password'))
                                                    <span style="color:red;">
                                                        <strong>{{ $errors->first('password') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group ">
                                            <div class="col-xs-12">
                                                <div class="checkbox checkbox-success">
                                                    <input id="checkbox-signup" type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                                    <label for="checkbox-signup">
                                                        Remember me
                                                    </label>
                                                </div>

                                            </div>
                                        </div>

                                        
                                        <div class="form-group account-btn text-center m-t-10">
                                            <div class="col-xs-12">
                                                <button class="btn w-md btn-bordered btn-info waves-effect waves-light" type="submit">Log In</button>
                                            </div>
                                        </div>

                                    </form>

                                    <div class="clearfix"></div>

                                </div>
                            </div>
                            <!-- end card-box-->


                                

                        </div>
                        <!-- end wrapper -->

                    </div>
                </div>
            </div>
          </section>
          <!-- END HOME -->

        <script>
            var resizefunc = [];
        </script>

        <!-- jQuery  -->
        <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
        <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('assets/js/detect.js') }}"></script>
        <script src="{{ asset('assets/js/fastclick.js') }}"></script>
        <script src="{{ asset('assets/js/jquery.blockUI.js') }}"></script>
        <script src="{{ asset('assets/js/waves.js') }}"></script>
        <script src="{{ asset('assets/js/jquery.slimscroll.js') }}"></script>
        <script src="{{ asset('assets/js/jquery.scrollTo.min.js') }}"></script>
       

        <!-- App js -->
        <script src="{{ asset('assets/js/jquery.core.js') }}"></script>
        <script src="{{ asset('assets/js/jquery.app.js') }}"></script>

    </body>
</html>