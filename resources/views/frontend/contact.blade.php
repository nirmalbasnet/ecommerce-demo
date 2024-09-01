@extends('frontend.layout.master')

@section('title')
    Leave Feedback
@stop

@section('styles')
    <link rel="stylesheet" href="{{asset('css/animate.css')}}">
    <link rel="stylesheet" href="{{asset('css/contact-page.css')}}">
    <style>
        .contact-page {
            padding-top: 50px;
            padding-bottom: 50px;
        }

        .card-header {
            padding: 9px;
            font-size: 18px;
        }

        .card-body {
            padding: 20px;
            border: 1px solid #ccc;
        }

        .bg-primary {
            background: #38535d;
        }

        .btn-primary {
            color: #fff;
            background-color: #38535d;
            border-color: #38535d;
        }
    </style>
@stop

@section('main-section')
    <div class="container contact-page">
        <div class="row">
            <div class="col-md-8 col-sm-8">
                <div class="card">
                    <div class="card-header bg-primary text-white"><i class="fa fa-envelope"></i> Contact us.
                    </div>
                    <div class="card-body">
                        @if(\Illuminate\Support\Facades\Session::has('message'))
                            <div class="alert alert-success responseMessage">
                                <p>{{\Illuminate\Support\Facades\Session::get('message')}}</p>
                                <i class="fa fa-times closeResponseMessage"></i>
                            </div>
                        @endif
                        <form method="post" action="{{url('contact-us')}}">
                            {{csrf_field()}}
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" name="name" class="form-control" id="name"
                                       aria-describedby="emailHelp" placeholder="Enter name" value="{{old('name')}}">
                                @if($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{$errors->first('name')}}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="email">Email address</label>
                                <input type="text" name="email" class="form-control" id="email" aria-describedby="emailHelp"
                                       placeholder="Enter email" value="{{old('email')}}">
                                <small id="emailHelp" class="form-text text-muted">We'll never share your email with
                                    anyone else.
                                </small>
                                @if($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{$errors->first('email')}}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="message">Message</label>
                                <textarea name="message" class="form-control" id="message" rows="6">{{old('message')}}</textarea>
                                @if($errors->has('message'))
                                    <span class="help-block">
                                        <strong>{{$errors->first('message')}}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="mx-auto">
                                <button type="submit" class="btn btn-primary text-right">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-4">
                <div class="card bg-light mb-3">
                    <div class="card-header bg-success text-white text-uppercase"><i class="fa fa-home"></i> Address
                    </div>
                    <div class="card-body">
                        @if(isset($contactDetail) && $contactDetail->address != null)
                            <p>{{$contactDetail->address}}</p>@endif
                        <p>Nepal</p>
                        <p>Email
                            : {{isset($contactDetail) && $contactDetail->email != null ? $contactDetail->email : 'Not Available'}}</p>
                        <p>
                            Tel. {{isset($contactDetail) && $contactDetail->phone != null ? $contactDetail->phone : 'Not Available'}}</p>

                    </div>

                </div>
            </div>
        </div>
    </div>
@stop