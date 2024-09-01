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
                        <i class="icon-comment"></i>
                    </div>
                    <div class="page-title">
                        <h5>Testimony</h5>
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
                <a href="{{url('admin/testimony/create')}}">Add New Testimony</a>
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
                        <th>Name</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th>Image</th>
                        <th>Action</th>
                    </tr>
                    </thead>

                    <tbody>
                    @if(isset($testimonies) && $testimonies->count() > 0)
                        @foreach($testimonies as $datum)
                            <tr id="{{$datum->id}}">
                                <td>{{$datum->name}}</td>
                                <td style="text-align: justify; padding: 0 10px;">{!! $datum->description !!}</td>
                                <td class="status-td">{{$datum->status}}</td>
                                <td><img src="{{asset('images/testimony/thumbs/'.$datum->image)}}" alt="testimony image"></td>
                                <td class="action-td">
                                    <a href="{{url('admin/testimony/'.$datum->id.'/edit')}}" class="table-content-edit"
                                       data-id="{{$datum->id}}" data-toggle="tooltip"
                                       data-placement="top"
                                       title="Edit Testimony">
                                        <i class="icon-edit"></i>Edit
                                    </a>

                                    <a href="#" class="table-content-delete change-status"
                                       data-id="{{$datum->id}}" data-toggle="tooltip"
                                       data-placement="top"
                                       title="{{$datum->status == 'active' ? 'Deactivate Testimony' : 'Activate Testimony'}}">
                                        <i class="icon-file-play"></i>{{$datum->status == 'active' ? 'Deactivate Testimony' : 'Activate Testimony'}}
                                    </a>

                                    <a href="#" class="table-content-delete delete-testimony"
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
                            <td colspan="5" class="text-center">No Any Data Found !</td>
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
            var id = $(this).data('id');
            alertify.confirm("Are you sure ?",
                function () {
                    $.ajax({
                        url: baseurl + '/admin/testimony/'+id+'/status',
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


        $('.delete-testimony').on('click', function (e) {
            e.preventDefault();
            var id = $(this).data('id');
            alertify.confirm("Are you sure ?",
                function () {
                    $.ajax({
                        url: baseurl + '/admin/testimony/'+id+'/delete',
                        type: 'get',
                        success: function (data) {
                            if(data === 'true')
                                window.location.reload();
                            else
                                alertify.alert('Oops ! cannot delete this category as it has some related products.');
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