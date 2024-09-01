<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{url('/')}}"><img src="{{asset('images/logo.png')}}" alt="logo"></a>
            {{--<a class="navbar-brand" href="{{url('/')}}">Brand Name</a>--}}
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
            <ul class="nav navbar-nav">
                <li class="{{\Illuminate\Support\Facades\Request::is('/') ? 'active' : ''}}"><a href="{{url('/')}}"><i
                                class="fa fa-home"></i> Home</a></li>
                <li class="dropdown {{\Illuminate\Support\Facades\Request::is('category/*') ? 'active' : ''}}">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">Categories <span
                                class="caret"></span></a>
                    <ul class="dropdown-menu {{\Illuminate\Support\Facades\Request::is('category/*') ? 'dropdown-menu-active' : ''}}">
                        @if(\App\Model\ProductCategory::where('category_status', 'active')->count() > 0)
                            @foreach(\App\Model\ProductCategory::where('category_status', 'active')->orderBy('category_title', 'ASC')->get() as $cat)
                                @if($cat->product->count() > 0)
                                    <li><a href="{{url('category/'.$cat->slug)}}"
                                           class="{{isset($category) && $category->slug == $cat->slug ? 'active' : ''}}">{{ucwords($cat->category_title)}}</a>
                                    </li>
                                @endif
                            @endforeach
                        @endif
                    </ul>
                </li>

                <li class="{{\Illuminate\Support\Facades\Request::is('about-us') ? 'active' : ''}}"><a
                            href="{{url('about-us')}}">About</a></li>
                <li class="{{\Illuminate\Support\Facades\Request::is('contact-us') ? 'active' : ''}}"><a
                            href="{{url('contact-us')}}">Contact</a></li>
                <li class="{{\Illuminate\Support\Facades\Request::is('terms-&-conditions') ? 'active' : ''}}"><a
                            href="{{url('terms-&-conditions')}}">Terms & Conditions</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                @if(\Illuminate\Support\Facades\Auth::guest())
                    <li class="{{\Illuminate\Support\Facades\Request::is('sign-up') ? 'active' : ''}}"><a
                                href="{{url('sign-up')}}"><span class="glyphicon glyphicon-user"></span> Sign Up</a>
                    </li>
                    <li class="{{\Illuminate\Support\Facades\Request::is('login') ? 'active' : ''}}"><a
                                href="{{url('login')}}"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
                @else
                    <li class="dropdown {{\Illuminate\Support\Facades\Request::is('profile') ? 'active' : ''}}">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="glyphicon glyphicon-user"></span> My Profile <span
                                    class="caret"></span></a>
                        <ul class="dropdown-menu {{\Illuminate\Support\Facades\Request::is('profile') ? 'dropdown-menu-active' : ''}}">
                            <li><a href="{{url('profile')}}"
                                   class="{{\Illuminate\Support\Facades\Request::is('profile') ? 'active' : ''}}">Account</a>
                            </li>

                            <li><a href="{{url('logout')}}"
                                   class="">Logout</a>
                            </li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>