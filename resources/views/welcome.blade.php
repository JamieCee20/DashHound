<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>DashHound || Welcome</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-image: url('/storage/images/home-background.jpg');
                color: #fff;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                width: 100%;
            }

            .content span, .links {
                text-transform: uppercase;
                display: block;
            }

            .text1 {
                color: white;
                font-size: 60px;
                font-weight: 700;
                letter-spacing: 8px;
                margin-bottom: 20px;
                background-image: url('/storage/images/home-background.jpg');
                position: relative;
                animation: text 3s 1;
            }

            .links > a {
                color: #fff;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            @media only screen and (min-width: 1024px) {
                @keyframes text {
                    0%{
                        color: white;
                        margin-bottom: -40px;
                    }
                    30%{
                        letter-spacing: 25px;
                        margin-bottom: -40px;
                    }
                    85%{
                        letter-spacing: 8px;
                        margin-bottom: -40px;
                    }
                }
            }

            @media only screen and (max-width: 768px) {
                body {
                    width: 100%;
                }
                #headingTitle {
                    width: 100%;
                }
                #headingTitle img {
                    visibility: hidden;
                }
                #headingLinks {
                    width: 100%;
                }
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
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

                <div class="links" id="headingLinks">
                    <a href="/posts">Game Posts</a>
                    <a href="#">Game Reviews</a>
                    <a href="/v/posts">Verified Publishers</a>
                    <a href="/contact">Contact Us</a>
                </div>
                <div>
                    <p>This website is currently still in development</p>
                </div>
            </div>
        </div>
    </body>
</html>