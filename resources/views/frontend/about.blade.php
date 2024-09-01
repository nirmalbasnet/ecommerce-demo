@extends('frontend.layout.master')

@section('title')
    About Us
@stop

@section('styles')
    <link rel="stylesheet" href="{{asset('css/animate.css')}}">
    <link rel="stylesheet" href="{{asset('css/about-us.css')}}">
    <style>
        div.dynamic-part {
            padding-top: 0;
        }
    </style>
@stop

@section('main-section')
    <div class="container-fluid about-page  wow fadeIn animated" data-wow-duration="500ms" data-wow-delay="300ms"
         style="visibility: visible; animation-duration: 500ms; animation-delay: 300ms; animation-name: fadeIn;">
        <div class="image-aboutus-banner" style="margin-top:70px; background: linear-gradient(rgba(0,0,0,.7), rgba(0,0,0,.7)), url({{asset('images/about-us/'.$aboutUs->image)}});">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="lg-text">About Us</h1>
                        <p class="image-aboutus-para">Quality, service, dedication & client satisfaction is our motto.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container paddingTB60  wow fadeIn animated" data-wow-duration="500ms" data-wow-delay="300ms"
         style="visibility: visible; animation-duration: 500ms; animation-delay: 300ms; animation-name: fadeIn;">
        <div class="row">

            <!-- Blog Post Content Column -->
            <div class="col-lg-12">

                <hr>

                <p style="text-align: center;">
                    {!! $aboutUs->description !!}
                </p>

                <hr>


            </div>

        </div>
    </div>
@stop