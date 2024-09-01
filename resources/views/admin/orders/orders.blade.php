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
                        @if($status == 'pending')
                            <i class="fa fa-paper-plane"></i>
                        @elseif($status == 'completed')
                            <i class="fa fa-check"></i>
                        @else
                            <i class="fa fa-times"></i>
                        @endif
                    </div>
                    <div class="page-title">
                        <h5>{{$status}} Orders</h5>
                        <h6 class="sub-heading">Welcome to {{\App\Helpers\Constants::PROJECT_NAME}} Admin Dashboard</h6>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div class="main-content">
        <!-- Row start -->
        <div class="row gutters">
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
                        <th>SN</th>
                        <th>Customer Details</th>
                        <th>Product Detail</th>
                        <th>Quantity</th>
                        <th>Action</th>
                    </tr>
                    </thead>

                    <tbody>
                    @if(isset($orders) && $orders->count() > 0)
                        @php $sn = !isset($_GET['page']) || $_GET['page'] == 1 ? 0 : $_GET['page'] * 10 - 10; @endphp
                        @foreach($orders as $datum)
                            @php $sn ++; @endphp
                            <tr id="{{$datum->id}}">
                                <td>{{$sn}}</td>
                                <td>
                                    <span style="display: block"><strong>Name: </strong>{{$datum->name}}</span>
                                    <span style="display: block"><strong>Email: </strong>{{$datum->email}}</span>
                                    <span style="display: block"><strong>Mobile: </strong>{{$datum->mobile}}</span>
                                </td>

                                <td>
                                    <span style="display: block"><strong>Category: </strong>{{\App\Model\ProductCategory::find($datum->category_id)->category_title}}</span>
                                    <span style="display: block"><strong>Product: </strong>{{\App\Model\Product::find($datum->product_id)->name}}</span>
                                </td>
                                <td class="status-td">{{$datum->quantity}}</td>
                                <td class="action-td">
                                    @if($status == 'completed')
                                        <span><strong><em>Order Completed</em></strong></span>
                                    @elseif($status == 'cancelled')
                                        <span><strong><em>Order Cancelled</em></strong></span>
                                    @else
                                        <select data-id="{{$datum->id}}" name="change-order-status" class="form-control change-order-status">
                                            <option value="">Change Order Status</option>
                                            <option value="completed">Completed</option>
                                            <option value="cancelled">Cancelled</option>
                                        </select>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="4">{{$orders->links()}}</td>
                        </tr>
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
        $('.change-order-status').on('change', function () {
           if($(this).val() === '')
           {
               return false;
           }else{
               var orderId = $(this).data('id');
               window.location = baseurl+'/admin/orders/'+$(this).val()+'/status/'+orderId;
           }
        });
    </script>
@stop