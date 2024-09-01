@extends('frontend.layout.master')

@section('title')
    Sign Up
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

        div.signup-screen{
            margin-top: 30px;
        }
    </style>
@stop

@section('main-section')
    <<div class="login-bg">
        <div class="login-screen signup-screen">
            <div class="login-wrapper">
                @if(\Session::has('message'))
                    <div class="alert alert-success">
                        <p class="text-center">{{\Session::get('message')}}</p>
                    </div>
                @endif
                <form action="{{url('sign-up')}}" id="signupForm" method="post">
                    {{ csrf_field() }}
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
                            <div class="form-group">
                                <input class="form-control" id="name" name="name" value="{{old('name')}}"  placeholder="Fullname"
                                       onfocus="removeError('name-error');" aria-label="fullname" aria-describedby="fullname"
                                       type="text">
                                <span class="name-error error help-block"></span>
                                @if($errors->has('name'))
                                    <span class="help-block">
                                    <strong>
                                        {{$errors->first('name')}}
                                    </strong>
					            </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <input class="form-control" name="email" value="{{old('email')}}" id="email" placeholder="Email Id"
                                       onfocus="removeError('email-error');" aria-label="emailid" aria-describedby="emailid" type="emai">
                                <span class="email-error error help-block"></span>
                                @if($errors->has('email'))
                                    <span class="help-block">
                                    <strong>
                                        {{$errors->first('email')}}
                                    </strong>
                                </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <input class="form-control" name="mobile" id="mobile-number" placeholder="Mobile number"
                                       aria-label="mobile" value="{{old('mobile')}}" onfocus="removeError('mobile-error');" aria-describedby="mobile" type="text">
                                <span class="mobile-error error help-block"></span>
                                @if($errors->has('mobile'))
                                    <span class="help-block">
                                    <strong>
                                        {{$errors->first('mobile')}}
                                    </strong>
                                </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <input class="form-control" name="password" id="password" onfocus="removeError('password-error');"
                                       placeholder="Password"  aria-label="Password" aria-describedby="password"
                                       type="password">
                                <span class="password-error error help-block"></span>
                                @if($errors->has('password'))
                                    <span class="help-block">
                                    <strong>
                                        {{$errors->first('password')}}
                                    </strong>
                                </span>
                                @endif
                            </div>

                            <div class="form-group">
                                <input class="form-control" name="password_confirmation" id="confirm-password"
                                       onfocus="removeError('confirm-password-error');" placeholder="Confirm Password" aria-label="confirm password"
                                       aria-describedby="confirm password" type="password">
                                <span class="confirm-password-error error help-block"></span>
                                @if($errors->has('confirm_password'))
                                    <span class="help-block">
                                    <strong>
                                        {{$errors->first('confirm_password')}}
                                    </strong>
                                </span>
                                @endif
                            </div>

                            <div class="actions clearfix">
                                <button type="submit" id="button" class="btn kankai-btn">Sign Up</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop

@section('scripts')
    <script>
        function isNumber(evt, element) {

            var charCode = (evt.which) ? evt.which : event.keyCode

            if (
                (charCode < 48 || charCode > 57) &&
                (charCode != 8) &&
                (charCode != 199))
                return false;

            return true;
        }

        $('input#mobile-number').keypress(function (event) {
            return isNumber(event, this)
        });

        var phoneArrayFirstThreeCharacter = ['980', '981', '982', '984', '985', '986', '97', '96'];
        var phoneArrayFirstTwoCharacter = ['97', '96'];

        $('#signupForm').on('submit', function (e) {
            $('.error').html('');
            if ($('#name').val() == '') {
                e.preventDefault();
                $('.name-error').html('<strong>This field is required.</strong>');
            }
            if ($('#email').val() == '') {
                e.preventDefault();
                $('.email-error').html('<strong>This field is required.</strong>');
            } else {
                var sEmail = $('#email').val();
                var filter = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
                if (filter.test(sEmail)) {
                }
                else {
                    e.preventDefault();
                    $('.email-error').html('<strong>Invalid Email.</strong>');
                }
            }
            if ($('#mobile-number').val() == '') {
                e.preventDefault();
                $('.mobile-error').html('<strong>This field is required.</strong>');
            }else{
                if($('#mobile-number').val().length != 10)
                {
                    e.preventDefault();
                    $('.mobile-error').html('<strong>Invalid Mobile Number.</strong>');
                }else{
                    var firstThreeCharacters = $('#mobile-number').val().substr(0, 3);
                    var firstTwoCharacters = $('#mobile-number').val().substr(0, 2);
                    if($.inArray(firstThreeCharacters, phoneArrayFirstThreeCharacter) < 0 && $.inArray(firstTwoCharacters, phoneArrayFirstTwoCharacter) < 0)
                    {
                        e.preventDefault();
                        $('.mobile-error').html('<strong>Invalid Mobile Number.</strong>');
                    }
                }
            }

            if ($('#password').val() == '') {
                e.preventDefault();
                $('.password-error').html('<strong>This field is required.</strong>');
            }else{
                if($('#password').val().length < 6)
                {
                    e.preventDefault();
                    $('.password-error').html('<strong>Password must be at least 6 characters long.</strong>');
                }
            }

            if ($('#confirm-password').val() == '') {
                e.preventDefault();
                $('.confirm-password-error').html('<strong>This field is required.</strong>');
            }

            if($('#password').val() !== '' && $('#confirm-password').val() !== '')
            {
                if($('#password').val() !== $('#confirm-password').val())
                {
                    e.preventDefault();
                    $('.confirm-password-error').html('<strong>Password & confirm password did not match.</strong>');
                }
            }
        });

        function removeError($span) {
            $('.'+$span).html('');
        }

        $('.closeMessage').on('click',function(e){
            $('.alert').hide();
        });
    </script>
@stop