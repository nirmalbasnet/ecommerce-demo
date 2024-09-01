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
                        <i class="icon-folder-images"></i>
                    </div>
                    <div class="page-title">
                        <h5>Create Home Banner</h5>
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
                        <a href="{{url('admin/home-banner')}}">Go Back</a>
                    </div>
                    <div class="card-body">
                        <div class="artist-form">
                            <form action="{{url('admin/home-banner/submit')}}" class="form"
                                  role="form" autocomplete="off" id="create-form"
                                  method="post" enctype="multipart/form-data">
                                {{csrf_field()}}
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label form-control-label">Banner
                                        <span class="req">*</span>
                                        <span class="form-note">
                                            Max Size {{\App\Helpers\Constants::HOME_BANNER_SIZE_IN_BIT / (1024*1024)}} MB | Minimum Dimension {{\App\Helpers\Constants::HOME_BANNER_WIDTH}} x {{\App\Helpers\Constants::HOME_BANNER_HEIGHT}} pixel
                                        </span>
                                    </label>
                                    <div class="col-lg-9">
                                        <input type="file" name="banner" id="banner" class="form-control">
                                        @if($errors->has('banner'))
                                            <span class="help-block banner">
                                                <strong>
                                                    {{$errors->first('banner')}}
                                                </strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label form-control-label"></label>
                                    <div class="col-lg-9">
                                        <button type="submit" class="btn btn-primary">Create</button>
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
@stop