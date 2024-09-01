@extends('frontend.layout.master')

@section('title')
    {{$category->category_title}} | Category
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

        div.dropdown-form select {
            width: 50%;
        }

        div.search-form input {
            width: 100%;
        }

        div.search-form form {
            width: 50%;
            display: flex;
        }

        div.search-form form button {
            margin-left: -5px;
            height: 34px;
            border-radius: 0 5px 5px 0;
            border: 1px solid #ccc;
        }

        div.search-form p, div.dropdown-form p {
            margin: 0;
            padding: 0;
        }

        .ui-autocomplete {
            z-index: 999999;
            cursor: pointer;
        }

        .autocomplete-suggestions {
            border: 1px solid #999;
            background: #FFF;
            overflow: auto;
            box-shadow: 2px 4px #888888;
            cursor: pointer;
        }

        .autocomplete-suggestion {
            padding: 2px 5px;
            white-space: nowrap;
            overflow: hidden;
            cursor: pointer;
        }

        .autocomplete-selected {
            background: #F0F0F0;
            cursor: pointer;
        }

        .autocomplete-suggestions strong {
            font-weight: normal;
            color: #3399FF;
            cursor: pointer;
        }

        .autocomplete-group {
            padding: 2px 5px;
            cursor: pointer;
        }

        .autocomplete-group strong {
            display: block;
            border-bottom: 1px solid #000;
            cursor: pointer;
        }
    </style>
@stop

@section('main-section')
    <div class="home-top-products container" style="margin-top: 20px;">
        <div class="home-top-products-title wow fadeIn animated" data-wow-duration="500ms" data-wow-delay="300ms"
             style="visibility: visible; animation-duration: 500ms; animation-delay: 300ms; animation-name: fadeIn;">
            <h1>{{$category->category_title}}</h1>
            <div class="span-bar">
                <span class="hr-bar"></span>
            </div>
        </div>

        <div class="clearfix"></div>

        <div class="top-product-list wow fadeIn animated" data-wow-duration="500ms" data-wow-delay="300ms"
             style="visibility: visible; animation-duration: 500ms; animation-delay: 300ms; animation-name: fadeIn;">
            <div class="filter-form">
                <div class="row">
                    <div class="col-md-6 col-sm-6">
                        <div class="search-form">
                            <p>Search product:</p>
                            <form action="javascript:void(0)" onsubmit="myFunction()">
                                <input value="{{isset($_GET['product']) ? $_GET['product'] : ''}}" type="text"
                                       class="form-control" placeholder="Product Name" id="autocomplete">
                                <button type="submit"><i class="fa fa-search"></i></button>
                            </form>
                        </div>
                    </div>

                    <div class="col-md-6 col-sm-6">
                        <div class="dropdown-form">
                            <p>Filter product:</p>
                            <select name="orderby" class="orderby form-control" id="orderProduct">
                                <option value="latest" {{isset($_GET['order-by']) && $_GET['order-by'] == 'latest' ? 'selected' : ''}}>
                                    Sort by latest
                                </option>
                                <option value="price" {{isset($_GET['order-by']) && $_GET['order-by'] == 'price-low-to-high' ? 'selected' : ''}}>
                                    Sort by price: low to high
                                </option>
                                <option value="price-desc" {{isset($_GET['order-by']) && $_GET['order-by'] == 'price-high-to-low' ? 'selected' : ''}}>
                                    Sort by price: high to low
                                </option>
                            </select>
                        </div>
                    </div>
                </div>

            </div>
            <div class="frontend-pagination frontend-pagination-top">
                <ul>
                    @php $lastPage = $products->lastPage(); @endphp
                    @php $page = isset($_GET['page']) ? $_GET['page'] : 1; @endphp
                    @if($page > 1)
                        @if(isset($_GET['order-by']))
                            @php $link = '?order-by='.$_GET['order-by'].'&page='.($page-1); @endphp
                        @elseif(isset($_GET['product']))
                            @php $link = '?product='.$_GET['product'].'&page='.($page-1); @endphp
                        @else
                            @php $link = '?page='.($page-1); @endphp
                        @endif
                        @php $prevUrl = $link; @endphp
                    @else
                        @php $prevUrl = 'javascript:void(0)'; @endphp
                    @endif
                    @if($page < $lastPage)
                        @if(isset($_GET['order-by']))
                            @php $link = '?order-by='.$_GET['order-by'].'&page='.($page+1); @endphp
                        @elseif(isset($_GET['product']))
                            @php $link = '?product='.$_GET['product'].'&page='.($page+1); @endphp
                        @else
                            @php $link = '?page='.($page+1); @endphp
                        @endif
                        @php $nextUrl = $link; @endphp
                    @else
                        @php $nextUrl = 'javascript:void(0)'; @endphp
                    @endif
                    <li><a href="{{$prevUrl}}"><i class="fa fa-long-arrow-left"></i></a></li>
                    @for($i = 1; $i <= $lastPage; $i++)
                        @if(isset($_GET['order-by']))
                            @php $link = '?order-by='.$_GET['order-by'].'&page='.$i; @endphp
                        @elseif(isset($_GET['product']))
                            @php $link = '?product='.$_GET['product'].'&page='.($i); @endphp
                        @else
                            @php $link = '?page='.$i; @endphp
                        @endif
                        <li class="{{$page == $i ? 'active' : ''}}"><a
                                    href="{{$page == $i ? 'javascript:void(0)' : $link}}">{{$i}}</a></li>
                    @endfor
                    <li><a href="{{$nextUrl}}"><i class="fa fa-long-arrow-right"></i></a></li>
                </ul>
            </div>
            <div class="product-list-inner">
                <div class="product-list-wrapper">
                    <ul class="product-list-ul">
                        @foreach($products as $pro)
                            <li>
                                <div class="product-thumbnail">
                                    <a href="{{url('category/'.$category->slug.'/'.$pro->slug)}}">
                                        @if($pro->has_offer == 'yes')
                                            <div class="special-offer">
                                                <img src="{{asset('images/products/special-offer.png')}}"
                                                     alt="special-offer"
                                                     class="img img-responsive">
                                            </div>
                                        @endif
                                        <img class="img img-responsive" src="{{asset('images/products/'.$pro->image)}}"
                                             alt="product image">
                                    </a>
                                </div>

                                <div class="product-list-title">
                                    <a href="{{url('category/'.$category->slug.'/'.$pro->slug)}}">
                                        <span>{{$pro->name}}</span>
                                    </a>
                                </div>

                                <div class="product-list-footer">
                                    <div class="product-list-price">
                                        @if($pro->has_offer == 'yes')
                                            <span class="original-price old-price">Price Rs. {{$pro->price}} /-</span>
                                            <span class="offer-price">Price Rs. {{$pro->offer_price}} /-</span>
                                        @else
                                            <span class="original-price">Price Rs. {{$pro->price}} /-</span>
                                        @endif
                                    </div>
                                    <a href="{{url('category/'.$category->slug.'/'.$pro->slug)}}" class="order-now">Order
                                        Now</a>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <div class="clearfix"></div>

            <div class="frontend-pagination">
                <ul>
                    @php $lastPage = $products->lastPage(); @endphp
                    @php $page = isset($_GET['page']) ? $_GET['page'] : 1; @endphp
                    @if($page > 1)
                        @if(isset($_GET['order-by']))
                            @php $link = '?order-by='.$_GET['order-by'].'&page='.($page-1); @endphp
                        @elseif(isset($_GET['product']))
                            @php $link = '?product='.$_GET['product'].'&page='.($page-1); @endphp
                        @else
                            @php $link = '?page='.($page-1); @endphp
                        @endif
                        @php $prevUrl = $link; @endphp
                    @else
                        @php $prevUrl = 'javascript:void(0)'; @endphp
                    @endif
                    @if($page < $lastPage)
                        @if(isset($_GET['order-by']))
                            @php $link = '?order-by='.$_GET['order-by'].'&page='.($page+1); @endphp
                        @elseif(isset($_GET['product']))
                            @php $link = '?product='.$_GET['product'].'&page='.($page+1); @endphp
                        @else
                            @php $link = '?page='.($page+1); @endphp
                        @endif
                        @php $nextUrl = $link; @endphp
                    @else
                        @php $nextUrl = 'javascript:void(0)'; @endphp
                    @endif
                    <li><a href="{{$prevUrl}}"><i class="fa fa-long-arrow-left"></i></a></li>
                    @for($i = 1; $i <= $lastPage; $i++)
                        @if(isset($_GET['order-by']))
                            @php $link = '?order-by='.$_GET['order-by'].'&page='.$i; @endphp
                        @elseif(isset($_GET['product']))
                            @php $link = '?product='.$_GET['product'].'&page='.($i); @endphp
                        @else
                            @php $link = '?page='.$i; @endphp
                        @endif
                        <li class="{{$page == $i ? 'active' : ''}}"><a
                                    href="{{$page == $i ? 'javascript:void(0)' : $link}}">{{$i}}</a></li>
                    @endfor
                    <li><a href="{{$nextUrl}}"><i class="fa fa-long-arrow-right"></i></a></li>
                </ul>
            </div>

        </div>
    </div>
@stop

@section('scripts')
    <script src="{{asset('js/autocomplete/dist/jquery.autocomplete.js')}}"></script>
    <script>
        $('select#orderProduct').on('change', function () {
            var selected = $(this).val();
            if (selected === 'latest') {
                window.location = baseurl + '/category/{{$category->slug}}?order-by=latest';
            }

            if (selected === 'price') {
                window.location = baseurl + '/category/{{$category->slug}}?order-by=price-low-to-high';
            }

            if (selected === 'price-desc') {
                window.location = baseurl + '/category/{{$category->slug}}?order-by=price-high-to-low';
            }
        });

        $('#autocomplete').autocomplete({
            serviceUrl: baseurl + '/category/{{$category->id}}/autocomplete',
            dataType: 'json'
        });

        function myFunction() {
            if ($('#autocomplete').val() === '') {
                window.location = baseurl + '/category/{{$category->slug}}';
            } else {
                window.location = baseurl + '/category/{{$category->slug}}?product=' + $('#autocomplete').val();
            }
        }
    </script>
@stop