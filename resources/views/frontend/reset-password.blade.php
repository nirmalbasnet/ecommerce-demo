@extends('frontend.layout.master')

@section('title')
    Reset Password
@stop
@section('styles')
    <style>
        div.login-screen{
            margin-bottom: 50px;
        }
    </style>
@stop

@section('main-section')
    <div class="login-screen">
        <div class="login-wrapper">
            @if(\Illuminate\Support\Facades\Session::has('message'))
                <div class="alert alert-success">
                    <p><strong>{{\Illuminate\Support\Facades\Session::get('message')}}</strong></p>
                </div>
            @endif
            <form id="reset-password" action="{{url('lost-password/reset')}}"  method="post">
                {{ csrf_field() }}
                <div class="login-container">
                    <div class="login-box">
                        <a href="{{url('/')}}" class="login-logo">
                            <img src="{{url('images/logo1.png')}}" alt="cdc nepal">
                        </a>
                        <div class="form-group">
                            <input class="form-control" value="{{old('new_password')}}" placeholder="Enter new password" name="new_password" id="new_password" aria-label="new_password" aria-describedby="new_password" type="password"><br>
                            @if($errors->has('new_password'))
                                <span class="help-block">
                                    <strong>{{$errors->first('new_password')}}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <input class="form-control" value="{{old('confirm_password')}}" placeholder="Confirm new password" name="confirm_password" id="confirm_password" aria-label="confirm_password" aria-describedby="confirm_password" type="password"><br>
                            @if($errors->has('confirm_password'))
                                <span class="help-block">
                                    <strong>{{$errors->first('confirm_password')}}</strong>
                                </span>
                            @endif
                        </div>

                        <input type="hidden" name="user_id" value="{{$user->id}}">
                        <div class="actions clearfix">
                            <button type="submit" class="btn kankai-btn">Submit</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
@stop