@extends('user.masterother')
@section('pageContent')
    <!-- Start banner Area -->
    <section class="banner-area relative">
        <div class="overlay overlay-bg"></div>
        <div class="container box_1170">
            <div class="row d-flex align-items-center justify-content-center">
                <div class="about-content col-lg-12">
                    <h1 class="text-white">Login</h1>
                    <p class="text-white link-nav"><a href="{{route('home')}}">Home </a> <span class="lnr lnr-arrow-right"></span>Login</p>
                </div>
            </div>
        </div>
    </section>
    <!-- End banner Area -->
    <section class="contact-page-area section-gap">
        <div class="container box_1170">
            <div class="row">
                <div class="col-lg-4 d-flex flex-column address-wrap">
                    <div class="single-contact-address d-flex flex-row">
                        <img src="{{asset('assets/images/icons/login-lock-icon.png')}}" width="200">

                    </div>

                </div>
                <div class="col-lg-8">
                    <form class="form-area" id="myForm" method="post" class="contact-form text-right">
                        <div class="row">
                            <div class="col-lg-6 form-group">
                                <input name="userName" id="userName" placeholder="Enter your username" class="common-input mb-20 form-control" type="text">
                                <input name="userEmail" id="userEmail" placeholder="Enter your email" class="common-input mb-20 form-control" type="text">
                            </div>
                            <div class="col-lg-12 ">
                                <div class="alert-msg">
                                    <p><a href="{{route('signup')}}" style="color: #8147FF">Don't have Account? Signup</a> </p>
                                </div>
                                <button class="genric-btn primary circle text-uppercase" >Login</button>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- End contact-page Area -->

@endsection
