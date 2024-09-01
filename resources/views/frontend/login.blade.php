@extends('frontend.layout.master')

@section('title')
    Login
@stop
@section('styles')
    <style>
        div.dynamic-part{
            background-image:url({{asset('images/login-bg-cover.jpg')}});
            width: 100%;
            background-position: center center;
            background-repeat: no-repeat;
            background-size: cover;
            margin-left: 0;
            margin-right: 0;
            padding-bottom: 100px;
            padding-top: 100px;
        }
    </style>
@stop

@section('main-section')
    <div class="login-bg">
        <div class="login-screen">
            <div class="login-wrapper">
                @if(\Session::has('email-changed-message'))
                    <div class="alert alert-success">
                        <p class="text-center">{{\Session::get('email-changed-message')}}</p>
                    </div>
                @endif
                <form action="{{url('login/validation')}}" id="loginForm" method="post">
                    {{csrf_field()}}
                    <div class="login-container">
                        <div class="login-box">
                            <a href="{{url('/')}}" class="login-logo">
                                <img src="{{url('images/logo1.png')}}" alt="kankai logo" class="img img-responsive">
                            </a>
                            {{--<div class="social-login">--}}
                                {{--<div class="login-icon google-login" data-provider="google"--}}
                                     {{--data-oauthserver="https://accounts.google.com/o/oauth2/auth"--}}
                                     {{--data-oauthversion="2.0">--}}
                                    {{--<a href="{{url('login/google')}}">--}}
                                        {{--<img src="{{url('images/gmail-login.png')}}" class="img img-responsive">--}}
                                    {{--</a>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                            {{--<div class="or"></div>--}}
                            @if(\Session::has('message'))
                                <div class="alert alert-success">
                                    <i class="fa fa-times pull-right closeMessage"></i>
                                    <p class="text-center">{{\Session::get('message')}}</p>
                                </div>
                            @endif
                            @if(\Session::has('password-changed-message'))
                                <div class="alert alert-success">
                                    <i class="fa fa-times pull-right closeMessage"></i>
                                    <p class="text-center">{{\Session::get('password-changed-message')}}</p>
                                </div>
                            @endif
                            @if(\Session::has('verified-email'))
                                <div class="alert alert-success">
                                    <i class="fa fa-times pull-right closeMessage"></i>
                                    <p class="text-center">{{\Session::get('verified-email')}}</p>
                                </div>
                            @endif
                            @if(\Session::has('resend-email-message'))
                                <div class="alert alert-success">
                                    <i class="fa fa-times pull-right closeMessage"></i>
                                    <p class="text-center">{{\Session::get('resend-email-message')}}</p>
                                </div>
                            @endif
                            @if(\Session::has('return-message'))
                                <div class="alert alert-success">
                                    <i class="fa fa-times pull-right closeMessage"></i>
                                    <p class="text-center">{{\Session::get('return-message')}}</p>
                                </div>
                            @endif
                            @if(Session::has('error'))
                                <h6 class="text-center error" style="color: darkred; font-size: 15px;"><i
                                            class="fa fa-warning"></i> {{ Session::get('error') }}</h6>
                            @endif
                            @if(Session::has('unverified-email'))
                                <h6 class="text-center error" style="color: darkred; font-size: smaller"><i
                                            class="fa fa-warning"></i> {{ Session::get('unverified-email') }}</h6>
                            @endif
                            @if(Session::has('unverified-mobile'))
                                <h6 class="text-center error" style="color: darkred; font-size: smaller"><i
                                            class="fa fa-warning"></i> {{ Session::get('unverified-mobile') }}</h6>
                            @endif
                            <div class="form-group">
                                <input class="form-control" id="email" placeholder="Email" name="email"
                                       value="{{old('email')}}" aria-label="email" onfocus="removeError();" aria-describedby="email" type="text">
                                <span class="email-error error help-block"></span>
                            </div>
                            <div class="form-group">
                                <input class="form-control" id="password" placeholder="Password" name="password"
                                       aria-label="Password" onfocus="removeError();" aria-describedby="password"
                                       type="password" value="{{old('password')}}">
                                <span class="password-error error help-block"></span>
                            </div>
                            <div class="actions clearfix">
                                <a href="{{url('lost-password')}}">Forgot password?</a>
                                <button type="submit" class="btn kankai-btn">Login</button>
                            </div>
                            @if(Session::has('unverified-email'))
                                <div>
                                    <button type="button" class="btn btn-info btn-lg" data-toggle="modal"
                                            data-target="#myModal">Resend Activation Link
                                    </button>
                                    <label type="text" value="Resend Activation link" data-toggle="modal"
                                           data-target="#add-contacts-to-group">
                                    </label>
                                </div>
                            @endif
                            <div class="already">
                                <span>Don't have an Account ?</span>
                                <a href="{{url('sign-up')}}" class="additional-link">
                                    Signup Now
                                </a>
                            </div>
                        </div>
                    </div>
                    @if(isset($_GET['return-url']))
                        <input type="hidden" name="return_url" value="{{$_GET['return-url']}}">
                    @endif
                </form>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><span class="title">Resend Activation Link</span></h4>
                </div>
                <div class="modal-body">
                    <form class="form" role="form" autocomplete="off" action="{{url('resend/activation/link')}}"
                          method="get">
                        {{csrf_field()}}
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label email">Email <span
                                        class="req">*</span></label>
                            <div class="col-lg-9">
                                <input class="form-control" type="email" name="email" id="resend-email" value=""
                                       placeholder="Enter Your Email" required>
                                <span class="title-error error help-block"></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-lg-3 col-form-label form-control-label"></label>
                            <div class="col-lg-9">
                                <button type="submit" class="btn btn-primary subModalBtn">Send</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>
@stop

@section('scripts')
    <script>
        $('#loginForm').on('submit', function (e) {
            $('.error').html('');
            if ($('#email').val() == '') {
                e.preventDefault();
                $('.email-error').html('<strong>Please enter your  username.</strong>');
            }
            if ($('#password').val() == '') {
                e.preventDefault();
                $('.password-error').html('<strong>Please enter your  password.</strong>');
            }
        });
        $('.closeMessage').on('click', function (e) {
            $('.alert').hide();
        });

        function removeError() {
            $('.error').html('');
        }
    </script>
@stop