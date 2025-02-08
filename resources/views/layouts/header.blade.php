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
                        <img src="{{asset('frontend/images/logo.png')}}" alt="">
                    </a>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="header__nav">
                    <nav class="header__menu mobile-menu">
                        <ul>
                            <li class="{{ request()->is('/') ? 'active' : "" }}"><a href="{{url('/')}}">Home</a></li>
                            <li class="{{ request()->is('categories') ? 'active' : "" }}"><a href="{{url('/categories')}}">Categories</span></a></li>
                            <li class="{{ request()->is('blogs') ? 'active' : "" }}"><a href="{{url('/blogs')}}">Our Blog</a></li>
                            <li class="{{ request()->is('contacts') ? 'active' : "" }}"><a href="#">Contacts</a></li>
                            <li><a href="#">More <span class="arrow_carrot-down"></span></a>
                                <ul class="dropdown">
                                    <li><a href="{{url('/details')}}">Anime Details</a></li>
                                    <li><a href="{{url('/watch')}}">Anime Watching</a></li>
                                    <li><a href="{{url('blog-details')}}">Blog Details</a></li>
                                    <li><a href="{{url('/register')}}">Sign Up</a></li>
                                    <li><a href="{{url('/login')}}">Login</a></li>
                                </ul>
                            </li>
                            
                        </ul>
                    </nav>
                </div>
            </div>
            <div class="col-lg-2">
                <div class="header__right">
                    <a href="#" class="search-switch"><span class="icon_search"></span></a>
                    <a href="./login.html"><span class="icon_profile"></span></a>
                </div>
            </div>
        </div>
        <div id="mobile-menu-wrap"></div>
    </div>
</header>
<!-- Header End -->