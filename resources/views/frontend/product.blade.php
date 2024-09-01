@extends('frontend.layout.master')

@section('title')
    {{$category->category_title}} | Category
@stop

@section('metaog')
    <meta property="og:url" content="{{\Illuminate\Support\Facades\Request::fullUrl()}}"/>
    <meta property="og:type" content="article"/>
    <meta property="og:title" content="{{$product->name}}"/>
    <meta property="og:description" content="Online shopping at its best. Biggest selection of books, magazines, music, DVDs, videos, electronics, computers, software, apparel & accessories, shoes, jewelry, tools & hardware, housewares, furniture, sporting goods, beauty & personal care, broadband & dsl, gourmet food & just about anything else."/>
    <meta property="og:image" content="{{asset('images/products/'.$product->image)}}"/>
    <meta property="fb:app_id" content="2315948325123373"/>
@stop

@section('styles')
    <link rel="stylesheet" href="{{asset('css/owl-carousel.css')}}">
    <link rel="stylesheet" href="{{asset('css/animate.css')}}">
    <style>
        .home-top-products {
            margin-top: 40px;
            margin-bottom: 40px;
        }

        .top-product-list {
            margin-top: 0 !important;
        }

        div.search-form, div.dropdown-form {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-top: 10px;
        }

        div.search-form input, div.dropdown-form select {
            width: 50%;
        }

        div.search-form p, div.dropdown-form p {
            margin: 0;
            padding: 0;
        }

        div.product-detail-image {
            border: 1px solid #ccc;
            box-shadow: 4px 4px #ddd;
        }

        div.product-list-wrapper {
            margin-top: 10px;
        }

        div.product-detail-ul small {
            font-size: 20px !important;
            font-weight: 500 !important;
        }

        div.product-detail-ul ul li {
            font-size: 16px;
            margin: 15px 0;
            list-style: none;
            font-weight: 500;
        }

        div.product-detail-ul ul li strong {
            color: #dd1f26;
            margin-right: 10px;
        }

        span.place-order-now {
            text-decoration: underline;
        }

        div.product-detail-ul li form {
            padding-left: 13px;
        }

        span.help-block strong {
            font-weight: 600 !important;
            color: maroon !important;
            font-size: 13px !important;
            margin: 0 !important;
            padding: 0 !important;
        }

        span.help-block{
            margin: 0 !important;
            padding: 0 !important;
            font-size: 14px !important;
        }
    </style>
@stop

@section('main-section')
    <div class="home-top-products container" style="margin-top: 20px;">
        <div class="row">
            <div class="col-md-9 col-sm-7">
                <div class="home-top-products-title wow fadeIn animated" data-wow-duration="500ms"
                     data-wow-delay="300ms"
                     style="visibility: visible; animation-duration: 500ms; animation-delay: 300ms; animation-name: fadeIn;">
                    <h1>{{$category->category_title}} <i class="fa fa-angle-double-right"></i> {{$product->name}}</h1>
                    <div class="span-bar">
                        <span class="hr-bar"></span>
                    </div>
                </div>

                @if(\Illuminate\Support\Facades\Session::has('message'))
                    <div class="alert alert-success responseMessage">
                        <p>{{\Illuminate\Support\Facades\Session::get('message')}}</p>
                        <i class="fa fa-times closeResponseMessage"></i>
                    </div>
                @endif

                @include('frontend.include.sharer')

                <div class="top-product-list wow fadeIn animated" data-wow-duration="500ms" data-wow-delay="300ms"
                     style="visibility: visible; animation-duration: 500ms; animation-delay: 300ms; animation-name: fadeIn;">
                    <div class="product-list-inner">
                        <div class="product-list-wrapper">
                            <div class="col-md-6">
                                <div class="product-detail-image" style="position: relative;">
                                    @if($product->has_offer == 'yes')
                                        <div class="special-offer">
                                            <img src="{{asset('images/products/special-offer.png')}}"
                                                 alt="special-offer"
                                                 class="img img-responsive">
                                        </div>
                                    @endif
                                    <img src="{{asset('images/products/'.$product->image)}}" alt="product-image"
                                         class="img img-responsive">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="product-detail-ul">
                                    <small>{{$product->name}}</small>
                                    <hr>
                                    <ul>
                                        <li>
                                            @if($product->has_offer == 'no')
                                                <strong><i class="fa fa-rupee"></i></strong> Rs. {{$product->price}} /-
                                            @else
                                                <strong><i class="fa fa-rupee"></i></strong>
                                                <strike>Rs. {{$product->price}} /-</strike> &nbsp;&nbsp;&nbsp;&nbsp;
                                                Offer Price Rs. {{$product->offer_price}} /-
                                            @endif
                                        </li>
                                        <li>
                                            <strong><i class="fa fa-phone"></i></strong> Call US @ {{\App\Model\ContactDetail::first()->phone}}
                                        </li>
                                        <li>
                                            <strong><i class="fa fa-envelope"></i></strong> Mail Us @ {{\App\Model\ContactDetail::first()->email}}
                                        </li>
                                        <li style="height: 25px;">
                                            <span class="place-order-now">OR PLACE ORDER NOW</span>
                                        </li>
                                        <li>
                                            <form action="" method="post" id="order-form" class="form-horizontal">
                                                {{csrf_field()}}
                                                <div class="form-group">
                                                    {{--<label for="name">Your Name</label>--}}
                                                    <input type="text" class="form-control" id="name" name="name" value="{{old('name', @\Illuminate\Support\Facades\Auth::check() ? \Illuminate\Support\Facades\Auth::user()->name : '')}}" placeholder="Your Name">
                                                    <span class="help-block name"></span>
                                                </div>

                                                <div class="form-group">
                                                    {{--<label for="name">Your Mobile</label>--}}
                                                    <input type="text" class="form-control" id="mobile" name="mobile" value="{{old('mobile', @\Illuminate\Support\Facades\Auth::check() ? \Illuminate\Support\Facades\Auth::user()->mobile : '')}}" placeholder="Your Mobile">
                                                    <span class="help-block mobile"></span>
                                                </div>

                                                <div class="form-group">
                                                    {{--<label for="name">Your Email</label>--}}
                                                    <input type="text" class="form-control" id="email" name="email" value="{{old('email', @\Illuminate\Support\Facades\Auth::check() ? \Illuminate\Support\Facades\Auth::user()->email : '')}}" placeholder="Your Email">
                                                    <span class="help-block email"></span>
                                                </div>

                                                <div class="form-group">
                                                    {{--<label for="name">Your Email</label>--}}
                                                    <input type="text" class="form-control" id="quantity" name="quantity" value="{{old('quantity')}}" placeholder="Quantity">
                                                    <span class="help-block quantity"></span>
                                                </div>

                                                <div class="form-group">
                                                    <button class="order-now" type="submit">Place Order</button>
                                                </div>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <div class="clearfix"></div>

                            <hr>

                            @if(isset($youMayAlsoLike))
                                <div class="you-may-also-like">
                                    <div class="title">
                                        <h3 style="font-size: 18px;">You May Also Like</h3>
                                    </div>

                                    <ul class="product-list-ul">
                                        @foreach($youMayAlsoLike as $topProduct)
                                            <li>
                                                <div class="product-thumbnail">
                                                    <a href="{{url('category/'.\App\Model\ProductCategory::find($topProduct->category_id)->slug).'/'.$topProduct->slug}}">
                                                        <img class="img img-responsive"
                                                             src="{{asset('images/products/'.$topProduct->image)}}"
                                                             alt="">
                                                    </a>
                                                </div>

                                                <div class="product-list-title">
                                                    <a href="{{url('category/'.\App\Model\ProductCategory::find($topProduct->category_id)->slug).'/'.$topProduct->slug}}">
                                                        <span>{{$topProduct->name}}</span>
                                                    </a>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-sm-5 wow fadeIn animated" data-wow-duration="500ms" data-wow-delay="300ms"
                 style="visibility: visible; animation-duration: 500ms; animation-delay: 300ms; animation-name: fadeIn;">
                <div class="latest-product-title">
                    <h1 class="text-center">Latest Product</h1>
                    <h1 class="text-center responsive-title" style="display: none;">Latest</h1>
                    <div class="span-bar">
                        <span class="hr-bar"></span>
                    </div>
                </div>

                @if(isset($latestProduct) && $latestProduct->count() > 0)
                    <div class="latest-product-list">
                        <ul class="product-list-ul">
                            @foreach($latestProduct as $topProduct)
                                <li style="width: 70%; margin: 5px 15%;">
                                    <div class="product-thumbnail">
                                        <a href="{{url('category/'.\App\Model\ProductCategory::find($topProduct->category_id)->slug).'/'.$topProduct->slug}}">
                                            <img class="img img-responsive"
                                                 src="{{asset('images/products/'.$topProduct->image)}}"
                                                 alt="">
                                        </a>
                                    </div>

                                    <div class="product-list-title">
                                        <a href="{{url('category/'.\App\Model\ProductCategory::find($topProduct->category_id)->slug).'/'.$topProduct->slug}}">
                                            <span>{{$topProduct->name}}</span>
                                        </a>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        </div>
    </div>
@stop

@section('scripts')
    <script>
        $(window).on('load', function () {
            window.setInterval(function () {
                if ($('span.place-order-now').is(':visible')) {
                    $('span.place-order-now').fadeOut();
                } else {
                    $('span.place-order-now').fadeIn();
                }

                if ($('div.special-offer').is(':visible')) {
                    $('div.special-offer').fadeOut();
                } else {
                    $('div.special-offer').fadeIn();
                }
            }, 800);
        });

        var phoneArrayFirstThreeCharacter = ['980', '981', '982', '984', '985', '986', '97', '96'];
        var phoneArrayFirstTwoCharacter = ['97', '96'];
        $('#order-form').on('submit', function(e){
           if($('input#name').val() === ''){
               e.preventDefault();
               $('span.name').html('Please enter your name.');
           } else{
               $('span.name').html('');
           }

            if ($('#email').val() == '') {
                e.preventDefault();
                $('.email').html('Please enter your email id.');
            } else {
                var sEmail = $('#email').val();
                var filter = /^([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
                if (filter.test(sEmail)) {
                    $('span.email').html('');
                }
                else {
                    e.preventDefault();
                    $('span.email').html('Invalid Email.');
                }
            }

            if ($('#mobile').val() == '') {
                e.preventDefault();
                $('span.mobile').html('Please enter your mobile number.');
            }else{
                if($('#mobile').val().length != 10)
                {
                    e.preventDefault();
                    $('span.mobile').html('Invalid Mobile Number.');
                }else{
                    var firstThreeCharacters = $('#mobile').val().substr(0, 3);
                    var firstTwoCharacters = $('#mobile').val().substr(0, 2);
                    if($.inArray(firstThreeCharacters, phoneArrayFirstThreeCharacter) < 0 && $.inArray(firstTwoCharacters, phoneArrayFirstTwoCharacter) < 0)
                    {
                        e.preventDefault();
                        $('span.mobile').html('Invalid Mobile Number.');
                    }else{
                        $('span.mobile').html('');
                    }
                }
            }

            if($('input#quantity').val() === ''){
                e.preventDefault();
                $('span.quantity').html('Please enter the quantity.');
            } else{
               if($('input#quantity').val() == 0 || $('input#quantity').val()[0] == 0)
               {
                   e.preventDefault();
                   $('span.quantity').html('Invalid quantity.');
               }else{
                   $('span.quantity').html('');
               }
            }
        });

        function isNumber(evt, element) {

            var charCode = (evt.which) ? evt.which : event.keyCode

            if (
                (charCode < 48 || charCode > 57) &&
                (charCode != 8) &&
                (charCode != 199))
                return false;

            return true;
        }

        $('input#quantity').keypress(function (event) {
            return isNumber(event, this)
        });

        $('input#mobile').keypress(function (event) {
            return isNumber(event, this)
        });
    </script>
@stop