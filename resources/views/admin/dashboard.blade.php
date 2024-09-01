@extends('admin.layout.master')

@section('styles')
    <style>
        div.card{
            height: 150px;
            display: flex;
            justify-content: center;
            align-items: center;
        }
    </style>
@stop

@section('main-body')
    <header class="main-heading">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-8 col-lg-8 col-md-8 col-sm-8">
                    <div class="page-icon">
                        <i class="icon-dashboard"></i>
                    </div>
                    <div class="page-title">
                        <h5>Dashboard</h5>
                        <h6 class="sub-heading">Welcome to {{\App\Helpers\Constants::PROJECT_NAME}} Admin Dashboard</h6>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div class="main-content">
        <!-- Row start -->
        <div class="row gutters">
            {{--<div class=" col-md-4 col-sm-4">--}}
                {{--<div class="card">--}}
                    {{--<h4><i class="icon-supervisor_account"></i> <span--}}
                                {{--style="color: red;">{{\App\Model\InterestedModelFormSubmit::count()}}</span> Registered--}}
                        {{--Users</h4>--}}
                    {{--<div class="card-footer">--}}
                        {{--<a href="{{url('admin/registered-users')}}">VIEW <i class="fa fa-arrow-right"></i></a>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}

            {{--<div class=" col-md-4 col-sm-4">--}}
                {{--<div class="card">--}}
                    {{--<h4><i class="icon-movie_creation"></i> <span--}}
                                {{--style="color: red;">{{\App\Model\MediaCoverage::count()}}</span> Media Coverage</h4>--}}
                    {{--<div class="card-footer">--}}
                        {{--<a href="{{url('admin/media-coverage')}}">VIEW <i class="fa fa-arrow-right"></i></a>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}

            <div class=" col-md-4 col-sm-4">

            </div>
        </div>
    </div>
@stop