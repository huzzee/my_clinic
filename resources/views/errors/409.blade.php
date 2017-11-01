

@extends('layouts.errorMain')



@section('content')
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
                           href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form2').submit();"> Return back</a>
                        <form id="logout-form2" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </section>

@endsection

