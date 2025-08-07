@extends('layouts.front')

@section('content')
<!-- Normal Breadcrumb Begin -->
<section class="normal-breadcrumb set-bg" data-setbg="{{asset('fronted/images/normal-breadcrumb.jpg')}}">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="normal__breadcrumb__text">
                    <h2>Sign Up</h2>
                    <p>Welcome to the official Anime blog.</p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Normal Breadcrumb End -->

<!-- Signup Section Begin -->
<section class="signup spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="login__form">
                    <h3>Sign Up</h3>

                    {{-- Show all errors at the top (optional) --}}
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('register') }}" method="POST">
                        @csrf

                        <div class="input__item">
                            <input type="text" name="name" placeholder="Name" value="{{ old('name') }}" required autofocus>
                            <span class="icon_profile"></span>
                            @error('name')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="input__item">
                            <input type="email" name="email" placeholder="Email address" value="{{ old('email') }}" required>
                            <span class="icon_mail"></span>
                            @error('email')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="input__item">
                            <input type="password" name="password" placeholder="Password" required autocomplete="new-password">
                            <span class="icon_lock"></span>
                            @error('password')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="input__item">
                            <input type="password" name="password_confirmation" placeholder="Confirm Password" required>
                            <span class="icon_lock"></span>
                            {{-- No error needed here unless you manually validate `password_confirmation` --}}
                        </div>

                        <button type="submit" class="site-btn">Register Now</button>
                    </form>

                    <h5>Already have an account? <a href="{{ url('/login') }}">Log In!</a></h5>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Signup Section End -->
@endsection
