@extends('admin.layout.master')

@section('styles')
    <style>
        input[type="radio"].toggle:checked + label {
            background-image: linear-gradient(to top, #969696, #727272);
            box-shadow: inset 0 1px 6px rgba(41, 41, 41, 0.2),
            0 1px 2px rgba(0, 0, 0, 0.05);
            cursor: default;
            color: #E6E6E6;
            border-color: transparent;
            text-shadow: 0 1px 1px rgba(40, 40, 40, 0.75);
        }

        input[type="radio"].toggle + label {
            width: 5em;
            border: 1px solid #ccc;
            font-size: 12px;
        }

        input[type="radio"].toggle:checked + label.btn:hover {
            background-color: inherit;
            background-position: 0 0;
            transition: none;
        }

        input[type="radio"].toggle-left + label {
            border-top-right-radius: 0;
            border-bottom-right-radius: 0;
            margin-left: -15px;
        }

        input[type="radio"].toggle-right + label {
            border-top-left-radius: 0;
            border-bottom-left-radius: 0;
            margin-left: -22px;
        }

        input[type="radio"] {
            opacity: 0;
        }

        div.offer-price-div {
            display: none;
        }
    </style>
@stop


@section('main-body')
    <!-- BEGIN .main-heading -->
    <header class="main-heading">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-8 col-lg-8 col-md-8 col-sm-8">
                    <div class="page-icon">
                        <i class="icon-shopping-cart"></i>
                    </div>
                    <div class="page-title">
                        <h5>{{isset($dataToEdit) ? 'Edit' : 'Create'}} Product</h5>
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
                        <a href="{{url('admin/product')}}">Go Back</a>
                    </div>
                    <div class="card-body">
                        <div class="artist-form">
                            <form action="{{isset($dataToEdit) ? url('admin/product/'.$dataToEdit->id.'/update') : url('admin/product/submit')}}"
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
                                    <label class="col-lg-3 col-form-label form-control-label">Category
                                        <span class="req">*</span>
                                    </label>
                                    <div class="col-lg-9">
                                        <select name="category_id" id="category_id" class="form-control">
                                            <option value="">-- Select Category --</option>
                                            @if(isset($categories) && $categories->count() > 0)
                                                @foreach($categories as $category)
                                                    <option value="{{$category->id}}" {{old('category_id', @$dataToEdit->category_id) == $category->id ? 'selected' : ''}}>{{$category->category_title}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        @if($errors->has('category_id'))
                                            <span class="help-block category_id">
                                                <strong>
                                                    {{$errors->first('category_id')}}
                                                </strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label form-control-label">Price
                                        <span class="req">*</span>
                                    </label>
                                    <div class="col-lg-9">
                                        <input type="text" name="price"
                                               value="{{old('price', @$dataToEdit->price)}}"
                                               id="price" class="form-control">
                                        @if($errors->has('price'))
                                            <span class="help-block price">
                                                <strong>
                                                    {{$errors->first('price')}}
                                                </strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                @if(isset($dataToEdit))
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label form-control-label">Existing Product
                                            Image
                                        </label>
                                        <div class="col-lg-9">
                                            <img src="{{asset('images/products/thumbs/'.$dataToEdit->image)}}"
                                                 alt="product image">
                                        </div>
                                    </div>
                                @endif

                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label form-control-label">Product Image
                                        @if(!isset($dataToEdit))<span class="req">*</span>@endif
                                        <span class="form-note">
                                            Max Size {{\App\Helpers\Constants::PRODUCT_IMAGE_SIZE_IN_BIT / (1024*1024)}}
                                            MB | Minimum Dimension {{\App\Helpers\Constants::PRODUCT_IMAGE_WIDTH}}
                                            x {{\App\Helpers\Constants::PRODUCT_IMAGE_HEIGHT}} pixel
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
                                    <label class="col-lg-3 col-form-label form-control-label">Has Offer ?
                                        <span class="req">*</span>
                                    </label>
                                    <div class="col-lg-9">
                                        <input class="toggle toggle-left" type="radio" id="has_offer_yes"
                                               name="has_offer"
                                               value="yes" {{old('has_offer', @$dataToEdit->has_offer) == 'yes' ? 'checked' : ''}}>
                                        <label for="has_offer_yes" class="btn">YES</label>

                                        <input class="toggle toggle-right" type="radio" id="has_offer_no"
                                               name="has_offer"
                                               value="no" {{old('has_offer', @$dataToEdit->has_offer) == 'no' ? 'checked' : ''}}>
                                        <label for="has_offer_no" class="btn">NO</label>
                                        @if($errors->has('has_offer'))
                                            <span style="display: block;" class="help-block has_offer">
                                                <strong>
                                                    {{$errors->first('has_offer')}}
                                                </strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                @if((isset($errors) && $errors->count() > 0 && $errors->has('offer_price')) || old('has_offer', @$dataToEdit->has_offer) == 'yes')
                                    <div class="form-group row offer-price-div" style="display: flex;">
                                        <label class="col-lg-3 col-form-label form-control-label">Offer Price
                                            <span class="req">*</span>
                                        </label>
                                        <div class="col-lg-9">
                                            <input type="text" name="offer_price"
                                                   value="{{old('offer_price', @$dataToEdit->offer_price)}}"
                                                   id="offer_price" class="form-control">
                                            @if($errors->has('offer_price'))
                                                <span class="help-block offer_price">
                                                <strong>
                                                    {{$errors->first('offer_price')}}
                                                </strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                @else
                                    <div class="form-group row offer-price-div">
                                        <label class="col-lg-3 col-form-label form-control-label">Offer Price
                                            <span class="req">*</span>
                                        </label>
                                        <div class="col-lg-9">
                                            <input type="text" name="offer_price"
                                                   value="{{old('offer_price', @$dataToEdit->offer_price)}}"
                                                   id="offer_price" class="form-control">
                                            @if($errors->has('offer_price'))
                                                <span class="help-block offer_price">
                                                <strong>
                                                    {{$errors->first('offer_price')}}
                                                </strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                @endif

                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label form-control-label">Is Top ?
                                        <span class="req">*</span>
                                    </label>
                                    <div class="col-lg-9">
                                        <input class="toggle toggle-left" type="radio" id="is_top_yes" name="is_top"
                                               value="yes" {{old('is_top', @$dataToEdit->is_top) == 'yes' ? 'checked' : ''}}>
                                        <label for="is_top_yes" class="btn">YES</label>

                                        <input class="toggle toggle-right" type="radio" id="is_top_no" name="is_top"
                                               value="no" {{old('is_top', @$dataToEdit->is_top) == 'no' ? 'checked' : ''}}>
                                        <label for="is_top_no" class="btn">NO</label>
                                        @if($errors->has('is_top'))
                                            <span style="display: block;" class="help-block is_top">
                                                <strong>
                                                    {{$errors->first('is_top')}}
                                                </strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label form-control-label"></label>
                                    <div class="col-lg-9">
                                        <button type="submit"
                                                class="btn btn-primary">{{isset($dataToEdit) ? 'Update' : 'Create'}}</button>
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
        $('input[name=has_offer]').on('change', function () {
            if ($(this).val() === 'yes') {
                $('div.offer-price-div').delay(2500).css('display', 'flex');
            } else {
                $('div.offer-price-div').delay(2500).css('display', 'none');
                $('input[name=offer_price]').val('');
            }
        });
    </script>
@stop