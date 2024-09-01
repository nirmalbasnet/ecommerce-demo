@extends('frontend.layout.master')

@section('title')
    Home
@stop
@section('styles')
    <link rel="stylesheet" href="{{asset('css/owl-carousel.css')}}">
    <link rel="stylesheet" href="{{asset('css/animate.css')}}">
    <style>
        a.oc {
            text-decoration: none;
            display: inline-block;
            padding: 8px 16px;
        }

        a.oc:hover {
            background-color: #4CAF50;
            color: #fff;
        }

        a.ocp {
            background-color: #f1f1f1;
            color: black;
            margin-right: 2px;
        }

        a.ocn {
            background-color: #f1f1f1;
            color: black;
            margin-left: 2px;
        }

        div.owl-nav {
            text-align: center;
            margin-top: 20px;
        }
    </style>
@stop

@section('main-section')
    <div class="home container-fluid">
        <div class="home-banner" style="background: url({{asset('images/bg.jpg')}});">
            <div class="card">
                <div class="row">
                    <div class="col-md-3" style="margin: 0; padding: 0;">
                        <div class="side-banner-left">
                            <div class="op">
                                <i class="fa fa-align-right"></i>
                                <h1>Our Products</h1>
                            </div>
                            <ul>
                                @if(isset($cats) && $cats->count() > 0)
                                    @foreach($cats as $cat)
                                        @if($cat->product->count() > 0)
                                            <li><a href="{{url('category/'.$cat->slug)}}">{{$cat->category_title}}</a>
                                            </li>
                                        @endif
                                    @endforeach
                                @endif
                            </ul>
                        </div>
                    </div>

                    @if(isset($banners) && $banners->count() > 0)
                        <div class="col-md-9">
                            <div class="home-slider">
                                <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                    <!-- Indicators -->
                                    <ol class="carousel-indicators">
                                        @php $dataSliderCount = 0; @endphp
                                        @foreach($banners as $banner)
                                            <li data-target="#myCarousel" data-slide-to="{{$dataSliderCount}}"
                                                class="{{$dataSliderCount == 0 ? 'active' : ''}}"></li>
                                            @php $dataSliderCount += 1; @endphp
                                        @endforeach
                                    </ol>

                                    <!-- Wrapper for slides -->
                                    <div class="carousel-inner">
                                        @php $itemSliderCount = 0; @endphp
                                        @foreach($banners as $banner)
                                            <div class="item {{$itemSliderCount == 0 ? 'active' : ''}}">
                                                <img class="img-responsive"
                                                     src="{{asset('images/home-banner/'.$banner->banner)}}"
                                                     alt="Los Angeles">
                                            </div>
                                            @php $itemSliderCount += 1; @endphp
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="home-categories container">
        @if(isset($categories) && $categories->count() > 0)
            @foreach($categories as $category)
                @php $cpro = $category->product()->where('status', 'active')->orderByRaw('RAND()')->take(6)->get(); @endphp
                @if($cpro->count() > 0)
                    <div class="ic">
                        <div class="category-title wow fadeIn animated" data-wow-duration="500ms" data-wow-delay="300ms"
                             style="visibility: visible; animation-duration: 500ms; animation-delay: 300ms; animation-name: fadeIn;">
                            <h1 style="text-transform: uppercase;">{{$category->category_title}}</h1>

                            <div class="span-bar">
                                <span class="hr-bar"></span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3 col-sm-3 category-image-col odd wow fadeInLeft animated"
                                 data-wow-duration="500ms"
                                 data-wow-delay="300ms"
                                 style="visibility: visible; animation-duration: 500ms; animation-delay: 300ms; animation-name: fadeInLeft;">
                                <div class="category-image"
                                     style="background: url({{asset('images/product-category/'.$category->category_image)}});background-position: center center;background-size: cover;background-repeat: no-repeat;">
                                    <a class="bg-img-title" href="{{url('category/'.$category->slug)}}"><h3>Explore
                                            All</h3></a>
                                </div>
                            </div>

                            <div class="col-md-9 col-sm-9 category-products-col odd wow fadeInRight animated"
                                 data-wow-duration="500ms" data-wow-delay="300ms"
                                 style="visibility: visible; animation-duration: 500ms; animation-delay: 300ms; animation-name: fadeInRight;">
                                <div class="category-products">
                                    @php $icCount = 1; @endphp
                                    @foreach($cpro as $item)
                                        <div class="col-md-4 col-sm-6 ip row-{{$icCount < 4 ? '1' : '2'}} {{$icCount == 5 || $icCount == 6 ? 'hide-child' : ''}}">
                                            <div class="product-title">
                                                <a href="{{url('category/'.$category->slug.'/'.$item->slug)}}">
                                                    <h3>{{$item->name}}</h3></a>
                                            </div>

                                            <div class="product-image">
                                                <a href="{{url('category/'.$category->slug.'/'.$item->slug)}}"><img
                                                            class="img-responsive"
                                                            src="{{asset('images/products/'.$item->image)}}"
                                                            alt="product-image"></a>
                                            </div>
                                        </div>
                                        @php $icCount += 1; @endphp
                                    @endforeach
                                </div>
                            </div>
                        </div>

                    </div>
                @endif
            @endforeach
        @endif
    </div>

    @if(isset($topProducts) && $topProducts->count() > 0)
        <div class="home-top-products container">
            <div class="home-top-products-title wow fadeIn animated" data-wow-duration="500ms" data-wow-delay="300ms"
                 style="visibility: visible; animation-duration: 500ms; animation-delay: 300ms; animation-name: fadeIn;">
                <h1>Top Products</h1>
                <div class="span-bar">
                    <span class="hr-bar"></span>
                </div>
            </div>

            <div class="clearfix"></div>

            <div class="top-product-list wow fadeIn animated" data-wow-duration="500ms" data-wow-delay="300ms"
                 style="visibility: visible; animation-duration: 500ms; animation-delay: 300ms; animation-name: fadeIn;">
                <div class="product-list-inner">
                    <div class="product-list-wrapper">
                        <ul class="product-list-ul">
                            @foreach($topProducts as $topProduct)
                                <li>
                                    <div class="product-thumbnail">
                                        <a href="{{url('category/'.\App\Model\ProductCategory::find($topProduct->category_id)->slug).'/'.$topProduct->slug}}">
                                            @if($topProduct->has_offer == 'yes')
                                                <div class="special-offer">
                                                    <img src="{{asset('images/products/special-offer.png')}}"
                                                         alt="special-offer"
                                                         class="img img-responsive">
                                                </div>
                                            @endif
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

                                    <div class="product-list-footer">
                                        <div class="product-list-price">
                                            @if($topProduct->has_offer == 'yes')
                                                <span class="original-price old-price">Price Rs. {{$topProduct->price}}
                                                    /-</span>
                                                <span class="offer-price">Price Rs. {{$topProduct->offer_price}}
                                                    /-</span>
                                            @else
                                                <span class="original-price">Price Rs. {{$topProduct->price}}
                                                    /-</span>
                                            @endif
                                        </div>
                                        <a href="{{url('category/'.\App\Model\ProductCategory::find($topProduct->category_id)->slug).'/'.$topProduct->slug}}"
                                           class="order-now">Order Now</a>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if(isset($testimonies) && $testimonies->count() > 0)
        <div class="testimony container-fluid" style="background:url({{asset('images/bg-attachment.png')}});">
            <p>What Our Clients Say</p>
            <div class="gradient-div">
                <p class="gradient"></p>
            </div>
            <span>Don't just take it from us, let our customers do the talking !</span>
            <div class="owl-carousel owl-theme">
                @foreach($testimonies as $testimony)
                    <div class="item">
                        <div class="item-image">
                            <div class="client-image">
                                <img src="{{asset('images/testimony/'.$testimony->image)}}" alt="client-image">
                            </div>
                        </div>

                        <div class="desc-parent">
                            <div class="item-desc">
                                <h3>{{$testimony->name}}</h3>
                                <p style="text-align: justify">
                                    {!! $testimony->description !!}
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
@stop

@section('scripts')
    <script src="{{asset('js/owl-carousel.js')}}"></script>
    <script src="{{asset('js/wow.min.js')}}"></script>

    <script>
        new WOW().init();

        $(document).ready(function () {
            $('.owl-carousel').owlCarousel({
                lazyLoad: true,
                items: 3,
                loop: true,
                nav: true,
                smartSpeed: 900,
                navText: ["<a href='javascript:void(0)' class='previous oc ocp'><i class='fa fa-angle-left'></i></a>", "<a href='javascript:void(0)' class='next oc ocn'><i class='fa fa-angle-right'></i></a>"],
                responsive: {
                    0: {
                        items: 1,
                    }, 400: {
                        items: 2,
                    }, 900: {
                        items: 3,
                    }
                }
            });
        });
    </script>
@stop