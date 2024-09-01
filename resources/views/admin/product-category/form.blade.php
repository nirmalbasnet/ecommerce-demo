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
                        <i class="icon-format_indent_increase"></i>
                    </div>
                    <div class="page-title">
                        <h5>{{isset($dataToEdit) ? 'Edit' : 'Create'}} Product Category</h5>
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
                        <a href="{{url('admin/product-category')}}">Go Back</a>
                    </div>
                    <div class="card-body">
                        <div class="artist-form">
                            <form action="{{isset($dataToEdit) ? url('admin/product-category/'.$dataToEdit->id.'/update') : url('admin/product-category/submit')}}"
                                  class="form"
                                  role="form" autocomplete="off" id="create-form"
                                  method="post" enctype="multipart/form-data">
                                {{csrf_field()}}
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label form-control-label">Category Title
                                        <span class="req">*</span>
                                    </label>
                                    <div class="col-lg-9">
                                        <input type="text" name="category_title"
                                               value="{{old('category_title', @$dataToEdit->category_title)}}"
                                               id="category_title" class="form-control">
                                        @if($errors->has('category_title'))
                                            <span class="help-block category_title">
                                                <strong>
                                                    {{$errors->first('category_title')}}
                                                </strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                @if(isset($dataToEdit))
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label form-control-label">Existing Category Image
                                        </label>
                                        <div class="col-lg-9">
                                            <img src="{{asset('images/product-category/thumbs/'.$dataToEdit->category_image)}}" alt="category image">
                                        </div>
                                    </div>
                                @endif

                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label form-control-label">Category Image
                                        <span class="req">*</span>
                                        <span class="form-note">
                                            Max Size {{\App\Helpers\Constants::CATEGORY_IMAGE_SIZE_IN_BIT / (1024*1024)}}
                                            MB | Minimum Dimension {{\App\Helpers\Constants::CATEGORY_IMAGE_WIDTH}}
                                            x {{\App\Helpers\Constants::CATEGORY_IMAGE_HEIGHT}} pixel
                                        </span>
                                    </label>
                                    <div class="col-lg-9">
                                        <input type="file" name="category_image" id="category_image"
                                               class="form-control">
                                        @if($errors->has('category_image'))
                                            <span class="help-block category_image">
                                                <strong>
                                                    {{$errors->first('category_image')}}
                                                </strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label form-control-label"></label>
                                    <div class="col-lg-9">
                                        <button type="submit" class="btn btn-primary">{{isset($dataToEdit) ? 'Update' : 'Create'}}</button>
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