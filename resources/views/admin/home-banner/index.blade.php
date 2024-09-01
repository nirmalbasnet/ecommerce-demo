@extends('admin.layout.master')

@section('styles')
    <style>
        div.card {
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
                        <i class="icon-folder-images"></i>
                    </div>
                    <div class="page-title">
                        <h5>Home Banner</h5>
                        <h6 class="sub-heading">Welcome to {{\App\Helpers\Constants::PROJECT_NAME}} Admin Dashboard</h6>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div class="main-content">
        <!-- Row start -->
        <div class="row gutters">
            <div class="card-header artist-header">
                <a href="{{url('admin/home-banner/create')}}">Add New Banner</a>
            </div>
            <div class="table-responsive">
                @if(\Illuminate\Support\Facades\Session::has('message'))
                    <div class="alert alert-success responseMessage">
                        <p>{{\Illuminate\Support\Facades\Session::get('message')}}</p>
                        <i class="fa fa-times closeResponseMessage"></i>
                    </div>
                @endif
                <table class="table m-0 table-bordered common-table">
                    <thead>
                    <tr>
                        <th>Banner</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>

                    <tbody>
                    @if(isset($banners) && $banners->count() > 0)
                        @foreach($banners as $datum)
                            <tr id="{{$datum->id}}">
                                <td><img src="{{asset('images/home-banner/thumbs/'.$datum->banner)}}" alt="banner"></td>
                                <td class="status-td">{{$datum->status}}</td>
                                <td class="action-td">
                                    <a href="#" class="table-content-delete change-status"
                                       data-id="{{$datum->id}}" data-toggle="tooltip"
                                       data-placement="top"
                                       title="{{$datum->status == 'active' ? 'Deactivate Banner' : 'Activate Banner'}}">
                                        <i class="icon-file-play"></i>{{$datum->status == 'active' ? 'Deactivate Banner' : 'Activate Banner'}}
                                    </a>

                                    <a href="#" class="table-content-delete delete-banner"
                                       data-id="{{$datum->id}}" data-toggle="tooltip"
                                       data-placement="top"
                                       title="Delete">
                                        <i class="icon-delete2"></i>Delete
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="3" class="text-center">No Any Data Found !</td>
                        </tr>
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop

@section('scripts')
    <script>
        $('.change-status').on('click', function (e) {
            e.preventDefault();
            var bid = $(this).data('id');
            alertify.confirm("Are you sure ?",
                function () {
                    $.ajax({
                        url: baseurl + '/admin/home-banner/'+bid+'/status',
                        type: 'get',
                        success: function (data) {
                            window.location.reload();
                        }, error: function (data) {
                            alertify.alert('Oops ! something went wrong. Please try again.')
                        }
                    });
                },
                function () {

                });
        });


        $('.delete-banner').on('click', function (e) {
            e.preventDefault();
            var bid = $(this).data('id');
            alertify.confirm("Are you sure ?",
                function () {
                    $.ajax({
                        url: baseurl + '/admin/home-banner/'+bid+'/delete',
                        type: 'get',
                        success: function (data) {
                            window.location.reload();
                        }, error: function (data) {
                            alertify.alert('Oops ! something went wrong. Please try again.')
                        }
                    });
                },
                function () {

                });
        });
    </script>
@stop