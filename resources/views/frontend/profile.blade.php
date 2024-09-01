@extends('frontend.layout.master')

@section('title')
    My Profile
@stop
@section('styles')
    <style>
        .my-account-div {
            min-height: 300px;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 0 100px;
        }

        span.my-account {
            font-size: 30px;
            font-weight: 500;
            color: #d72027;
            border-bottom: 1px solid #d72027;
            padding-bottom: 10px;
            display: inline-block;
            margin: 0 0 25px 0;
        }

        div.buttons {
            margin-top: 15px;
        }

        .edit-account, .payment-history, .logout, .change-password {
            background: #DD1F26 !important;
            color: #fff !important;
            border: 1px solid #DD1F26;
            padding: 15px 25px;
            font-size: 15px;
            font-weight: 700;
        }

        span.error {
            font-weight: 600;
            color: maroon;
        }

        div.main-container{
            min-height: 350px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
    </style>
@stop

@section('main-section')
    <div class="container main-container profile-container">
        <div class="row">
            @if(\Illuminate\Support\Facades\Session::has('message'))
                <div class="alert alert-success responseMessage">
                    <p>{{\Illuminate\Support\Facades\Session::get('message')}}</p>
                    <i class="fa fa-times closeResponseMessage"></i>
                </div>
            @endif
            <div class="col-md-6">
                <span class="my-account">My Profile</span><br>
                <span>Name: {{$user->name}}</span><br>
                <span>Email: {{$user->email}}</span><br>
                <span>Mobile: {{$user->mobile}}</span><br><br>
                <div class="buttons">
                    <button class="edit-account">Edit My Account</button>
                    <button class="change-password">Change Password</button>
                </div>
            </div>

            <div class="col-md-6">
                <form style="display: {{isset($errors) && ($errors->has('name') || $errors->has('email')) ? 'block' : 'none'}};"
                      class="edit" method="post"
                      action="{{url('profile/'.\Illuminate\Support\Facades\Auth::id().'/update')}}" id="editForm">
                    <p style="margin-bottom: 15px;">Note: Changing email needs verification. You will get logged
                        out.</p>
                    {{csrf_field()}}
                    <div class="form-group ">
                        <input value="{{old('name', $user->name)}}" type="text" name="name" id="name"
                               class="form-control"
                               placeholder="Full Name">
                        <span class="name-error help-block"></span>
                        @if($errors->has('name'))
                            <span class="error">{{$errors->first('name')}}</span>
                        @endif
                    </div>

                    <div class="form-group ">
                        <input value="{{old('email', $user->email)}}" type="text" name="email" id="email"
                               class="form-control"
                               placeholder="Email">
                        <span class="email-error help-block"></span>
                        @if($errors->has('email'))
                            <span class="error">{{$errors->first('email')}}</span>
                        @endif
                    </div>

                    <div class="form-group ">
                        <input value="{{old('mobile', $user->mobile)}}" type="text" name="mobile" id="mobile-number"
                               class="form-control"
                               placeholder="Mobile">
                        <span class="mobile-error help-block"></span>
                        @if($errors->has('mobile'))
                            <span class="error">{{$errors->first('mobile')}}</span>
                        @endif
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn kankai-btn">Update</button>
                    </div>
                </form>

                <form style="display: {{isset($errors) && ($errors->has('current_password') || $errors->has('new_password') || $errors->has('confirm_password')) ? 'block' : 'none'}};"
                      class="change" method="post"
                      action="{{url('profile/'.\Illuminate\Support\Facades\Auth::id().'/change-password')}}" id="changePassForm">
                    {{csrf_field()}}
                    <div class="form-group ">
                        <input value="{{old('current_password')}}" autocomplete="off" type="password"
                               name="current_password" id="current_password"
                               class="form-control" placeholder="Current Password">
                        <span class="current_password help-block"></span>
                        @if($errors->has('current_password'))
                            <span class="error">{{$errors->first('current_password')}}</span>
                        @endif
                    </div>
                    <div class="form-group ">
                        <input value="{{old('new_password', $user->new_password)}}" autocomplete="off"
                               type="password" name="new_password" id="new_password"
                               class="form-control" placeholder="New Password">
                        <span class="new_password help-block"></span>
                        @if($errors->has('new_password'))
                            <span class="error">{{$errors->first('new_password')}}</span>
                        @endif
                    </div>
                    <div class="form-group ">
                        <input value="{{old('confirm_password', $user->confirm_password)}}" type="password"
                               name="confirm_password" id="confirm_password" class="form-control"
                               placeholder="Confirm Password">
                        <span class="confirm_password help-block"></span>
                        @if($errors->has('confirm_password'))
                            <span class="error">{{$errors->first('confirm_password')}}</span>
                        @endif
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn kankai-btn">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop

@section('scripts')
    <script>
        $('button.edit-account').on('click', function () {
            $('form#editForm').slideToggle('slow');
            $('form#changePassForm').hide();
        });

        $('button.change-password').on('click', function () {
            $('form#changePassForm').slideToggle('slow');
            $('form#editForm').hide();
        });

        var phoneArrayFirstThreeCharacter = ['980', '981', '982', '984', '985', '986', '97', '96'];
        var phoneArrayFirstTwoCharacter = ['97', '96'];
        $('#editForm').on('submit', function(e){
            if ($('#name').val() == '') {
                e.preventDefault();
                $('.name-error').html('<strong>This field is required.</strong>');
            }else{
                $('.name-error').html('');
            }

            if ($('#email').val() == '') {
                e.preventDefault();
                $('.email-error').html('<strong>This field is required.</strong>');
            } else {
                var sEmail = $('#email').val();
                var filter = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
                if (filter.test(sEmail)) {
                    $('.email-error').html('');
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
                    }else{
                        $('.mobile-error').html('');
                    }
                }
            }
        });

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

        $('#changePassForm').on('submit', function (e) {
            if ($('#current_password').val() == '') {
                e.preventDefault();
                $('.current_password').html('<strong>Enter your current password.</strong>');
            }else{
                $('.current_password').html('');
            }

            if ($('#new_password').val() == '') {
                e.preventDefault();
                $('.new_password').html('<strong>Enter new password.</strong>');
            }else{
                if($('#new_password').val().length < 6)
                {
                    e.preventDefault();
                    $('.new_password').html('<strong>Password must be at least 6 characters long.</strong>');
                }else{
                    $('.new_password').html('');
                }
            }

            if ($('#confirm_password').val() == '') {
                e.preventDefault();
                $('.confirm_password').html('<strong>Confirm your password.</strong>');
            }else{
                $('.confirm_password').html('');
            }

            if($('#new_password').val() !== '' && $('#confirm_password').val() !== '')
            {
                if($('#new_password').val() !== $('#confirm_password').val())
                {
                    e.preventDefault();
                    $('.confirm_password').html('<strong>Password & confirm password did not match.</strong>');
                }else{
                    $('.confirm_password').html('');
                }
            }
        });
    </script>
@stop

