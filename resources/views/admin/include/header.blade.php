<style>
    @import url('https://fonts.googleapis.com/css?family=Lobster');

    .admin-initials {
        background: #cd2e33;
        color: #fff;
        font-weight: bolder;
        border-radius: 5px;
        font-size: 24px;
        width: 65px;
        height: 40px;
        font-family: 'Lobster';
        display: -webkit-flex;
        display: flex;
        -webkit-align-items: center;
        align-items: center;
        -webkit-justify-content: center;
        justify-content: center;
        margin-right: 5px;
    }

    .header-actions > li > a.user-settings {
        display: -webkit-flex;
        display: flex;
        -webkit-align-items: center;
        align-items: center;
        -webkit-justify-content: space-between;
        justify-content: space-between;
    }
</style>
<header class="app-header">
    <div class="container-fluid">
        <div class="row gutters">
            <div class="col-xl-5 col-lg-5 col-md-5 col-sm-3 col-4">
                <a class="mini-nav-btn" href="#" id="app-side-mini-toggler">
                    <i class="icon-menu5"></i>
                </a>
                <a href="#app-side" data-toggle="onoffcanvas" class="onoffcanvas-toggler" aria-expanded="true">
                    <i class="icon-chevron-thin-left"></i>
                </a>
            </div>
            <div class="col-xl-2 col-lg-2 col-md-2 col-sm-6 col-4">
                <a href="{{url('admin/dashboard')}}" class="logo">
                    <img src="{{asset('images/logo1.png')}}" alt="{{\App\Helpers\Constants::PROJECT_NAME}} Admin Dashboard">
                </a>
            </div>
            <div class="col-xl-5 col-lg-5 col-md-5 col-sm-3 col-4">
                <ul class="header-actions">

                    <li class="dropdown">
                        <a href="#" id="userSettings" class="user-settings" data-toggle="dropdown" aria-haspopup="true">
                            <span class="admin-initials">{{\Auth::guard('admin')->user()->name[0]}}</span>
                            <span class="user-name">{{\Auth::guard('admin')->user()->name}}</span>
                            <i class="icon-chevron-small-down"></i>
                        </a>
                        <div class="dropdown-menu lg dropdown-menu-right" aria-labelledby="userSettings">
                            <div class="logout-btn">
                                <a href="{{url('admin/logout')}}" class="btn btn-primary">Logout</a>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</header>
<script>
</script>
