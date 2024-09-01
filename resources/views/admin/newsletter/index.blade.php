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
                        <i class="icon-email"></i>
                    </div>
                    <div class="page-title">
                        <h5>Newsletter Subscribers</h5>
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
                        <th>Email</th>
                        <th>Verified</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>

                    <tbody>
                    @if(isset($data) && $data->count() > 0)
                        @php $sn = !isset($_GET['page']) || $_GET['page'] == 1 ? 0 : $_GET['page'] * 10 - 10; @endphp
                        @foreach($data as $datum)
                            @php $sn ++; @endphp
                            <tr id="{{$datum->id}}">
                                <td>{{$sn}}</td>
                                <td>{{$datum->email}}</td>
                                <td class="status-td">{{$datum->verified}}</td>
                                <td class="status-td">{{$datum->status == 'yes' ? 'active' : 'inactive'}}</td>
                                <td class="action-td">
                                    <a href="#" class="table-content-delete change-status"
                                       data-id="{{$datum->id}}" data-toggle="tooltip"
                                       data-placement="top"
                                       title="{{$datum->status == 'yes' ? 'Deactivate Subscriber' : 'Activate Subscriber'}}">
                                        <i class="icon-file-play"></i>{{$datum->status == 'yes' ? 'Deactivate Subscriber' : 'Activate Subscriber'}}
                                    </a>

                                    <a href="#" class="table-content-delete delete-subscriber"
                                       data-id="{{$datum->id}}" data-toggle="tooltip"
                                       data-placement="top"
                                       title="Delete">
                                        <i class="icon-delete2"></i>Delete
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="5">{{$data->links()}}</td>
                        </tr>
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
                        url: baseurl + '/admin/newsletter-subscribers/'+id+'/status',
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


        $('.delete-subscriber').on('click', function (e) {
            e.preventDefault();
            var id = $(this).data('id');
            alertify.confirm("Are you sure ?",
                function () {
                    $.ajax({
                        url: baseurl + '/admin/newsletter-subscribers/'+id+'/delete',
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