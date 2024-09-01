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
                        <i class="icon-share3"></i>
                    </div>
                    <div class="page-title">
                        <h5>{{isset($socialMedia) ? 'Edit' : 'Create'}} Social Media Links</h5>
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
                        <a href="{{url('admin/social-media-links')}}">Go Back</a>
                    </div>
                    <div class="card-body">
                        <div class="artist-form">
                            @if(\Illuminate\Support\Facades\Session::has('message'))
                                <div class="alert alert-success responseMessage">
                                    <p>{{\Illuminate\Support\Facades\Session::get('message')}}</p>
                                    <i class="fa fa-times closeResponseMessage"></i>
                                </div>
                            @endif
                            <form action="{{url('admin/social-media-links/submit')}}"
                                  class="form"
                                  role="form" autocomplete="off" id="create-form"
                                  method="post" enctype="multipart/form-data">
                                {{csrf_field()}}
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label form-control-label">Facebook
                                        <span class="req">*</span>
                                    </label>
                                    <div class="col-lg-9">
                                        <input type="text" name="facebook"
                                               value="{{old('facebook', @$socialMedia->facebook)}}"
                                               id="facebook" class="form-control">
                                        @if($errors->has('facebook'))
                                            <span class="help-block facebook">
                                                <strong>
                                                    {{$errors->first('facebook')}}
                                                </strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label form-control-label">Twitter
                                        
                                    </label>
                                    <div class="col-lg-9">
                                        <input type="text" name="twitter"
                                               value="{{old('twitter', @$socialMedia->twitter)}}"
                                               id="twitter" class="form-control">
                                        @if($errors->has('twitter'))
                                            <span class="help-block twitter">
                                                <strong>
                                                    {{$errors->first('twitter')}}
                                                </strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label form-control-label">Instagram
                                        <span class="req">*</span>
                                    </label>
                                    <div class="col-lg-9">
                                        <input type="text" name="instagram"
                                               value="{{old('instagram', @$socialMedia->instagram)}}"
                                               id="instagram" class="form-control">
                                        @if($errors->has('instagram'))
                                            <span class="help-block instagram">
                                                <strong>
                                                    {{$errors->first('instagram')}}
                                                </strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label form-control-label"></label>
                                    <div class="col-lg-9">
                                        <button type="submit" class="btn btn-primary">{{isset($socialMedia) ? 'Update' : 'Create'}}</button>
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