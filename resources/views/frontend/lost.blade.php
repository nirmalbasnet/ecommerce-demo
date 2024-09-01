@extends('frontend.layout.master')

@section('title')
    Lost Password
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
            <form id="reset-password" action="{{url('lost-password')}}"  method="post">
                {{ csrf_field() }}
                <div class="login-container">
                    <div class="login-box">
                        <a href="{{url('/')}}" class="login-logo">
                            <img src="{{url('images/logo1.png')}}" alt="cdc nepal">
                        </a>
                        <div class="form-group">
                            <input class="form-control" value="{{old('email')}}" placeholder="Enter your email" onfocus="removeError();" name="email" id="user-email" aria-label="email" aria-describedby="email" type="email"><br>
                            @if($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{$errors->first('email')}}</strong>
                                </span>
                            @endif

                            @if(\Illuminate\Support\Facades\Session::has('message'))
                                <span class="help-block">
                                    <strong>{{\Illuminate\Support\Facades\Session::get('message')}}</strong>
                                </span>
                            @endif
                            <span class="help-block"></span>
                        </div>
                        <div class="actions clearfix">
                            <button type="submit" class="btn kankai-btn">Submit</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
@stop