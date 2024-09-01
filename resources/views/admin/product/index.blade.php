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
                        <i class="icon-shopping-cart"></i>
                    </div>
                    <div class="page-title">
                        <h5>Product</h5>
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
                <a href="{{url('admin/product/create')}}">Add New Product</a>
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
                        <th>Category</th>
                        <th>Price</th>
                        <th>Image</th>
                        <th>Status</th>
                        <th>Has Offer ?</th>
                        <th>Is Top ?</th>
                        <th>Offer Price</th>
                        <th>Action</th>
                    </tr>
                    </thead>

                    <tbody>
                    @if(isset($products) && $products->count() > 0)
                        @foreach($products as $datum)
                            <tr id="{{$datum->id}}">
                                <td>{{$datum->name}}</td>
                                <td>{{\App\Model\ProductCategory::find($datum->category_id)->category_title}}</td>
                                <td>{{$datum->price}}</td>
                                <td><img src="{{asset('images/products/thumbs/'.$datum->image)}}" alt="product image"></td>
                                <td class="status-td">{{$datum->status}}</td>
                                <td class="status-td">{{$datum->has_offer}}</td>
                                <td class="status-td">{{$datum->is_top}}</td>
                                <td>{{$datum->offer_price}}</td>
                                <td class="action-td">
                                    <a href="{{url('admin/product/'.$datum->id.'/edit')}}" class="table-content-edit"
                                       data-id="{{$datum->id}}" data-toggle="tooltip"
                                       data-placement="top"
                                       title="Edit Product">
                                        <i class="icon-edit"></i>Edit
                                    </a>

                                    <a href="#" class="table-content-delete change-status"
                                       data-id="{{$datum->id}}" data-toggle="tooltip"
                                       data-placement="top"
                                       title="{{$datum->status == 'active' ? 'Deactivate Product' : 'Activate Product'}}">
                                        <i class="icon-file-play"></i>{{$datum->status == 'active' ? 'Deactivate Product' : 'Activate Product'}}
                                    </a>

                                    <a href="#" class="table-content-delete delete-product"
                                       data-id="{{$datum->id}}" data-toggle="tooltip"
                                       data-placement="top"
                                       title="Delete">
                                        <i class="icon-delete2"></i>Delete
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="9" class="text-center">{{$products->links()}}</td>
                        </tr>
                    @else
                        <tr>
                            <td colspan="9" class="text-center">No Any Data Found !</td>
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
                        url: baseurl + '/admin/product/'+id+'/status',
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


        $('.delete-product').on('click', function (e) {
            e.preventDefault();
            var id = $(this).data('id');
            alertify.confirm("Are you sure ?",
                function () {
                    $.ajax({
                        url: baseurl + '/admin/product/'+id+'/delete',
                        type: 'get',
                        success: function (data) {
                            if(data === 'true')
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