<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{asset('images/favicon.png')}}"/>




    <title>{{\App\Helpers\Constants::PROJECT_NAME}} Admin Dashboard</title>

    <!-- Common CSS -->
    @include('admin.include.styles')
    <style>
        .ajs-header{
            display: none !important;
        }

        div.card-header.artist-header{
            padding-left: 0;
            padding-right: 0;
        }

        span.help-block{
            font-weight: 600;
            color: maroon;
        }

        span.form-note{
            font-size: 10px;
            font-style: italic;
            display: block;
        }

        div.responseMessage{
            display: flex;
            justify-content: space-between;
            height: 50px;
            margin-top: 15px;
        }

        i.closeResponseMessage{
            cursor: pointer;
        }

        td.action-td a{
            display: block;
        }

        td.status-td{
            text-transform: uppercase;
            font-weight: 600;
        }

        i.icon-edit{
            color: #da1113 !important;
        }

        span.badge{
            color: #fff !important;
            background: #0288d1 !important;
            font-weight: 600 !important;
            border-radius: 50% !important;
        }
    </style>

    @yield('styles')
    @include('admin.include.scripts')

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<body>
<div class="loading-wrapper" style="display: none;">
    <div class="loading">
        <div class="img"></div>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
    </div>
</div>

<div class="app-wrap">
    @include('admin.include.header')
    <div class="app-container" style="min-height: calc(100vh - 60px);">
        @include('admin.include.sidebar')
        <div class="app-main">
            @yield('main-body')
        </div>
    </div>

    @include('admin.include.footer')
</div>
<script>
    var baseurl = "<?php echo \Illuminate\Support\Facades\URL::to('/') ?>";
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        }
    });
    $('.closeResponseMessage').on('click', function () {
        $('.responseMessage').remove();
    });
</script>
@yield('scripts')
</body>
</html>

