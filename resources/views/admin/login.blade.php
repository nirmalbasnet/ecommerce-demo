<!DOCTYPE html>
<html>
<head>
    <title>{{\App\Helpers\Constants::PROJECT_NAME}} | Admin Dashboard</title>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- favicon start   -->
    <link rel="shortcut icon" href="{{asset('images/favicon.png')}}"/>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">

    <link rel="stylesheet" type="text/css" href="{{asset('admin-asset/css/login.css')}}">

    <!-- Google fonts -->

    <link href="https://fonts.googleapis.com/css?family=Lato:400,400i,700,700i,900,900i" rel="stylesheet">

    <style>
        h6.showError, .validation-error {
            font-weight: 600;
            color: maroon;
        }
    </style>
</head>
<body>
<div class="login-screen">
    <div class="login-wrapper">
        <form name="checkin-form" onsubmit="return validateId()" action="{{url('admin/login/validate')}}"
              method="post">
            {{csrf_field()}}
            <div class="login-container">
                <div class="login-box">
                    <a href="{{url('admin')}}" class="login-logo">
                        <img src="{{asset('images/logo1.png')}}" alt="logo" class="w-100">
                    </a>
                    @if(\Illuminate\Support\Facades\Session::has('message'))
                        <p class="validation-error text-center"><i class="fa fa-ban"></i> {{\Illuminate\Support\Facades\Session::get('message')}}</p>
                    @endif
                    <div class="form-group">
                        <input type="text" placeholder="email" name="email" id="focusedInput"
                               value="{{ old('email') }}" class="form-control"/>
                        @if ($errors->has('email'))
                            <span class="help-block has-error" style="color: darkred; text-align: left;">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" placeholder="password" name="password"
                               id="focusedInput" value="{{ old('password') }}"/>
                        @if ($errors->has('password'))
                            <span class="help-block" style="color: darkred; text-align: left;">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                        @endif
                    </div>
                    <div class="form-group text-right">
                        <button type="submit" class="btn" style="background: #222222;">Login</button>
                    </div>
                    <div class="error clearfix">
                        <h6 class="showError"></h6>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<script src="{{asset('js/jquery.js')}}"></script>
<script src="{{asset('js/bootstrap.min.js')}}"></script>
<script>
    function validateId() {
        if ($('input[name=email]').val() == '') {
            $('div.error').show();
            $('h6.showError').html('Please enter your email');
            return false;
        } else if ($('input[name=password]').val() == '') {
            $('div.error').show();
            $('h6.showError').html('Please enter your password !');
            return false;
        } else {
            $('div.error').hide();
            return true;
        }
    }
</script>
</body>
</html>
