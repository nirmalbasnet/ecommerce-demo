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
                        <i class="icon-format_indent_increase"></i>
                    </div>
                    <div class="page-title">
                        <h5>Product Category</h5>
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
                <a href="{{url('admin/product-category/create')}}">Add New Product Category</a>
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
                        <th>Category Name</th>
                        <th>Category Status</th>
                        <th>Category Image</th>
                        <th>Action</th>
                    </tr>
                    </thead>

                    <tbody>
                    @if(isset($productCategories) && $productCategories->count() > 0)
                        @foreach($productCategories as $datum)
                            <tr id="{{$datum->id}}">
                                <td>{{$datum->category_title}}</td>
                                <td class="status-td">{{$datum->category_status}}</td>
                                <td><img src="{{asset('images/product-category/thumbs/'.$datum->category_image)}}" alt="category image"></td>
                                <td class="action-td">
                                    <a href="{{url('admin/product-category/'.$datum->id.'/edit')}}" class="table-content-edit"
                                       data-id="{{$datum->id}}" data-toggle="tooltip"
                                       data-placement="top"
                                       title="Edit Product Category">
                                        <i class="icon-edit"></i>Edit
                                    </a>

                                    <a href="#" class="table-content-delete change-status"
                                       data-id="{{$datum->id}}" data-toggle="tooltip"
                                       data-placement="top"
                                       title="{{$datum->category_status == 'active' ? 'Deactivate Category' : 'Activate Category'}}">
                                        <i class="icon-file-play"></i>{{$datum->category_status == 'active' ? 'Deactivate Category' : 'Activate Category'}}
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
                            <td colspan="4" class="text-center">No Any Data Found !</td>
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
                        url: baseurl + '/admin/product-category/'+id+'/status',
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
            var id = $(this).data('id');
            alertify.confirm("Are you sure ?",
                function () {
                    $.ajax({
                        url: baseurl + '/admin/product-category/'+id+'/delete',
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