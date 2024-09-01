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
                        <a href="{{url('admin/testimony')}}">Go Back</a>
                    </div>
                    <div class="card-body">
                        <div class="artist-form">
                            <form action="{{isset($dataToEdit) ? url('admin/testimony/'.$dataToEdit->id.'/update') : url('admin/testimony/submit')}}"
                                  class="form"
                                  role="form" autocomplete="off" id="create-form"
                                  method="post" enctype="multipart/form-data">
                                {{csrf_field()}}
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label form-control-label">Name
                                        <span class="req">*</span>
                                    </label>
                                    <div class="col-lg-9">
                                        <input type="text" name="name"
                                               value="{{old('name', @$dataToEdit->name)}}"
                                               id="name" class="form-control">
                                        @if($errors->has('name'))
                                            <span class="help-block name">
                                                <strong>
                                                    {{$errors->first('name')}}
                                                </strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label form-control-label">Description
                                        <span class="req">*</span>
                                        <span class="form-note">200 - 250 characters</span>
                                    </label>
                                    <div class="col-lg-9">
                                        <textarea onkeyup="countChar()" name="description" id="description" cols="30" rows="10" class="form-control">{{old('description', @$dataToEdit->description)}}</textarea>
                                        <span style="display: block;" class="character-count-label"><strong>Character Count: </strong><span class="character-count">0</span></span>
                                        @if($errors->has('description'))
                                            <span class="help-block description">
                                                <strong>
                                                    {{$errors->first('description')}}
                                                </strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                @if(isset($dataToEdit))
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label form-control-label">Existing Testimony Image
                                        </label>
                                        <div class="col-lg-9">
                                            <img src="{{asset('images/testimony/thumbs/'.$dataToEdit->image)}}" alt="testimony image">
                                        </div>
                                    </div>
                                @endif

                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label form-control-label">Testimony Image
                                        <span class="req">*</span>
                                        <span class="form-note">
                                            Max Size {{\App\Helpers\Constants::TESTIMONY_IMAGE_SIZE_IN_BIT / (1024*1024)}}
                                            MB | Minimum Dimension {{\App\Helpers\Constants::TESTIMONY_IMAGE_WIDTH}}
                                            x {{\App\Helpers\Constants::TESTIMONY_IMAGE_HEIGHT}} pixel
                                        </span>
                                    </label>
                                    <div class="col-lg-9">
                                        <input type="file" name="image" id="image"
                                               class="form-control">
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
        function countChar() {
            var length = $('textarea#description').val().length;
            $('span.character-count').html(length);
        };

        $(window).on('load', function(){
           var length = $('textarea#description').val().length;
           $('span.character-count').html(length);
        });
    </script>
@stop