<!-- Page Preloder -->
<div id="preloder">
    <div class="loader"></div>
</div>

<!-- Header Section Begin -->
<header class="header">
    <div class="container">
        <div class="row">
            <div class="col-lg-2">
                <div class="header__logo">
                    <a href="{{ url('/') }}">
                        <h4 class="fs-4" style="font-weight: 900;">
                            <span class="text-white">Watch</span><span class="text-danger">Wave</span>
                        </h4>
                    </a>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="header__nav">
                    <nav class="header__menu mobile-menu">
                        <ul>
                            <li class="{{ request()->is('/') ? 'active' : "" }}"><a href="{{url('/')}}">Home</a></li>
                            <li class="{{ request()->is('user/categories') ? 'active' : "" }}"><a href="{{url('user/categories')}}">Categories</span></a></li>
                            {{-- <li class="{{ request()->is('blogs') ? 'active' : "" }}"><a href="{{url('/blogs')}}">Our Blog</a></li> --}}
                            {{-- <li class="{{ request()->is('contacts') ? 'active' : "" }}"><a href="#">Contacts</a></li> --}}
                            <li><a href="#">More <span class="arrow_carrot-down"></span></a>
                                <ul class="dropdown">
                                    <li><a href="{{url('/details')}}">Anime Details</a></li>
                                    <li><a href="{{url('/watch')}}">Anime Watching</a></li>
                                    <li><a href="{{url('blog-details')}}">Blog Details</a></li>
                                </ul>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
            <div class="col-lg-2">
                <div class="header__right header__menu" style="padding: 0px">
                    <ul>
                        <li><a href="#" class="search-switch"><span class="icon_search"></span></a></li>
                        {{-- <li class="{{ request()->is('blogs') ? 'active' : "" }}"><a href="{{url('/blogs')}}">Our Blog</a></li> --}}
                        {{-- <li class="{{ request()->is('contacts') ? 'active' : "" }}"><a href="#">Contacts</a></li> --}}
                        <li><a href="#"><span class="icon_profile"></span></a></a>
                            <ul class="dropdown">
                                @auth
                                <li><a href="{{url('user/profile')}}">Profile</a></li>
                                    <li>
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">
                                                Logout
                                            </a>
                                        </form>
                                    </li>
                                @else
                                    <li><a href="{{url('/register')}}">Sign Up</a></li>
                                    <li><a href="{{url('/login')}}">Login</a></li>
                                @endauth
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div id="mobile-menu-wrap"></div>
    </div>
</header>
<!-- Header End -->