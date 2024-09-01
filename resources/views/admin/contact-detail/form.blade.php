@extends('admin.layout.master')

@section('styles')
    <style>
    </style>
@stop


@section('main-body')
    <!-- BEGIN .main-heading -->
    <header class="main-heading">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-8 col-lg-8 col-md-8 col-sm-8">
                    <div class="page-icon">
                        <i class="icon-comment"></i>
                    </div>
                    <div class="page-title">
                        <h5>{{isset($dataToEdit) ? 'Edit' : 'Create'}} Testimony</h5>
                        <h6 class="sub-heading">Welcome to {{\App\Helpers\Constants::PROJECT_NAME}} Admin Dashboard</h6>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- END: .main-heading -->
    <!-- BEGIN .main-content -->
    <div class="main-content">
        <!-- Row start -->
        <div class="row gutters form-wrapper">
            <div class=" col-md-12 col-sm-12">
                <div class="card">
                    <div class="card-header artist-header" style="margin-left: 10px;">
                        <a href="{{url('admin/contact-details')}}">Go Back</a>
                    </div>
                    <div class="card-body">
                        <div class="artist-form">
                            @if(\Illuminate\Support\Facades\Session::has('message'))
                                <div class="alert alert-success responseMessage">
                                    <p>{{\Illuminate\Support\Facades\Session::get('message')}}</p>
                                    <i class="fa fa-times closeResponseMessage"></i>
                                </div>
                            @endif
                            <form action="{{url('admin/contact-details/submit')}}"
                                  class="form"
                                  role="form" autocomplete="off" id="create-form"
                                  method="post" enctype="multipart/form-data">
                                {{csrf_field()}}
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label form-control-label">Phone
                                        <span class="req">*</span>
                                    </label>
                                    <div class="col-lg-9">
                                        <input type="text" name="phone"
                                               value="{{old('phone', @$contactDetail->phone)}}"
                                               id="phone" class="form-control">
                                        @if($errors->has('phone'))
                                            <span class="help-block phone">
                                                <strong>
                                                    {{$errors->first('phone')}}
                                                </strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label form-control-label">Email
                                        <span class="req">*</span>
                                    </label>
                                    <div class="col-lg-9">
                                        <input type="text" name="email"
                                               value="{{old('email', @$contactDetail->email)}}"
                                               id="email" class="form-control">
                                        @if($errors->has('email'))
                                            <span class="help-block email">
                                                <strong>
                                                    {{$errors->first('email')}}
                                                </strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label form-control-label">Address
                                        <span class="req">*</span>
                                    </label>
                                    <div class="col-lg-9">
                                        <input type="text" name="address"
                                               value="{{old('address', @$contactDetail->address)}}"
                                               id="address" class="form-control">
                                        @if($errors->has('address'))
                                            <span class="help-block address">
                                                <strong>
                                                    {{$errors->first('address')}}
                                                </strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label form-control-label"></label>
                                    <div class="col-lg-9">
                                        <button type="submit" class="btn btn-primary">{{isset($contactDetail) ? 'Update' : 'Create'}}</button>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Row end -->

    </div>
    <!-- END: .main-content -->
@stop

@section('scripts')
    <script>
    </script>
@stop