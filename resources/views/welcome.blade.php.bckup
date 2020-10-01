<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>DashHound || Welcome</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <link rel="stylesheet" media="screen and (min-device-width: 769px)" href="{{ asset('css/home/home-big.css')}}">
        <link rel="stylesheet" media="screen and (max-device-width: 768px)" href="{{ asset('css/home/home-small.css')}}">
    </head>
    <body>
        <div class="container">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="content">
                <span class="text1" id="headingTitle">
                    <div class="title m-b-md">
                        <img src="/storage/images/ps4Pad.png" alt="psController" height="50px" width="75px"> DashHound <img src="/storage/images/ps4Pad.png" alt="psController" height="50px" width="75px">
                    </div>
                </span>

                <div class="row">
                    <div class="d-none d-sm-none d-md-block col-md-12 col-lg-12 col-xl-12">
                        <div class="links page-links">
                            <a href="/posts">Game Posts</a>
                            <a href="#">Game Reviews</a>
                            <a href="/v/posts">Verified Publishers</a>
                            <a href="#">Official Merch</a>
                            <a href="/contact">Contact Us</a>
                        </div>
                    </div>
                </div>
                <div>
                    <p>This website is currently still in development</p>
                </div>
            </div>
        </div>
    </body>
</html>