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
                        <i class="icon-user-add"></i>
                    </div>
                    <div class="page-title">
                        <h5>Customers</h5>
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
                        <th>Name</th>
                        <th>Email</th>
                        <th>Mobile</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>

                    <tbody>
                    @if(isset($customers) && $customers->count() > 0)
                        @php $sn = !isset($_GET['page']) || $_GET['page'] == 1 ? 0 : $_GET['page'] * 10 - 10; @endphp
                        @foreach($customers as $datum)
                            @php $sn ++; @endphp
                            <tr id="{{$datum->id}}">
                                <td>{{$sn}}</td>
                                <td>{{$datum->name}}</td>
                                <td>{{$datum->email}}</td>
                                <td>{{$datum->mobile}}</td>
                                <td class="status-td">{{$datum->status}}</td>
                                <td class="action-td">
                                    <a href="#" class="table-content-delete change-status"
                                       data-id="{{$datum->id}}" data-cs="{{$datum->status}}" data-toggle="tooltip"
                                       data-placement="top"
                                       title="Change Status">
                                        <i class="icon-file-play"></i>Change Status
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="6">{{$customers->links()}}</td>
                        </tr>
                    @else
                        <tr>
                            <td colspan="6" class="text-center">No Any Data Found !</td>
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
            var cs = $(this).data('cs');
            if(cs === 'inactive')
            {
                alertify.alert('User have not activated the account yet.');
                return false;
            }
            var id = $(this).data('id');
            alertify.confirm("Are you sure ?",
                function () {
                    $.ajax({
                        url: baseurl + '/admin/customers/'+id+'/status',
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