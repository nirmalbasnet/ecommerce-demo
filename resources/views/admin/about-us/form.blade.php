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
                        <i class="icon-user"></i>
                    </div>
                    <div class="page-title">
                        <h5>About Us</h5>
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
                        <a href="{{url('admin/about-us')}}">Go Back</a>
                    </div>
                    <div class="card-body">
                        <div class="artist-form">
                            @if(\Illuminate\Support\Facades\Session::has('message'))
                                <div class="alert alert-success responseMessage">
                                    <p>{{\Illuminate\Support\Facades\Session::get('message')}}</p>
                                    <i class="fa fa-times closeResponseMessage"></i>
                                </div>
                            @endif
                            <form action="{{url('admin/about-us/submit')}}" class="form"
                                  role="form" autocomplete="off" id="create-form"
                                  method="post" enctype="multipart/form-data">
                                {{csrf_field()}}
                                @if(isset($aboutUs) && $aboutUs != null)
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label form-control-label">Existing About Us
                                            Banner</label>
                                        <div class="col-lg-9">
                                            <img src="{{asset('images/about-us/thumbs/'.$aboutUs->image)}}"
                                                 alt="about us banner">
                                        </div>
                                    </div>
                                @endif

                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label form-control-label">About Us Banner
                                        @if(!isset($aboutUs) || $aboutUs == null)<span class="req">*</span>@endif
                                        <span class="form-note">
                                            Max Size {{\App\Helpers\Constants::ABOUTUS_IMAGE_SIZE_IN_BIT / (1024*1024)}}
                                            MB | Minimum Dimension {{\App\Helpers\Constants::ABOUTUS_IMAGE__WIDTH}}
                                            x {{\App\Helpers\Constants::ABOUTUS_IMAGE__HEIGHT}} pixel
                                        </span>
                                    </label>
                                    <div class="col-lg-9">
                                        <input type="file" name="image" id="image" class="form-control">
                                        @if($errors->has('image'))
                                            <span class="help-block image">
                                                <strong>
                                                    {{$errors->first('image')}}
                                                </strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label form-control-label">About Us Description
                                        <span class="req">*</span>
                                    </label>
                                    <div class="col-lg-9">
                                        <textarea name="description" id="description" class="form-control" cols="30" rows="10">
                                            {{old('description', @$aboutUs->description)}}
                                        </textarea>
                                        @if($errors->has('description'))
                                            <span class="help-block description">
                                                <strong>
                                                    {{$errors->first('description')}}
                                                </strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label form-control-label"></label>
                                    <div class="col-lg-9">
                                        <button type="submit" class="btn btn-primary">Submit</button>
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
    <script src="https://cdn.ckeditor.com/4.11.3/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('description', {
            height: 300
        });
    </script>
@stop