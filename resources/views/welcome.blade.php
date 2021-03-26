<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>DashHound || Welcome</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=IBM+Plex+Sans:400,600" rel="stylesheet">

        <!-- Styles -->
        <link rel="stylesheet" href="css/hover-effect.css">
        <link rel="stylesheet" href="css/style.css">

        <!-- Scripts -->
        <script src="https://unpkg.com/animejs@3.0.1/lib/anime.min.js"></script>
        <script src="https://unpkg.com/scrollreveal@4.0.0/dist/scrollreveal.min.js"></script>
    </head>
    <body class="is-boxed has-animations">
        <div class="body-wrap">
            <header class="site-header">
                <div class="container">
                    <div class="site-header-inner">
                        <div class="brand header-brand">
                            <h1 class="m-0">
                                <a href="#">
                                    <img class="header-logo-image" src="storage/images/dashhound.png" alt="Logo" height="25px" width="25px">
                                </a>
                            </h1>
                        </div>
                        <div class="flex-center position-ref full-height nav-login-buttons" style="z-index: 5;">
                            @if (Route::has('login'))
                                @auth
                                    <a class="loginHover" style="text-decoration: none; color: white; font-weight: bold;" href="{{ url('/home') }}">Home</a>
                                @else
                                    <a class="loginHover mx-2" style="text-decoration: none; color: white; font-weight: bold;" href="{{ route('login') }}">Login</a>
                                    @if (Route::has('register'))
                                        <a class="loginHover mx-2" style="text-decoration: none; color: white; font-weight: bold;" href="{{ route('register') }}">Register</a>
                                    @endif
                                @endauth
                            @endif
                        </div>
                    </div>
                </div>
            </header>
    
            <main>
                <section class="hero">
                    <div class="container">
                        <div class="hero-inner">
                            <div class="hero-copy">
                                <h1 class="hero-title mt-0">DashHound</h1>
                                <p class="hero-paragraph">A creative platform designed for gamers to share their experiences and collaborate with their thoughts and feelings of all things games.</p>
                                <div class="hero-cta"><a class="button" style="background: #B6B8D6;" href="{{ route('post.index')}}">View Posts</a><a class="button" href="{{ route('forum.index') }}">Browse the Forums</a></div>
                            </div>
                            <div class="hero-figure anime-element">
                                <svg class="placeholder" width="528" height="396" viewBox="0 0 528 396">
                                    <rect width="528" height="396" style="fill:transparent;" />
                                </svg>
                                <div class="hero-figure-box hero-figure-box-01" data-rotation="45deg"></div>
                                <div class="hero-figure-box hero-figure-box-02" data-rotation="-45deg"></div>
                                <div class="hero-figure-box hero-figure-box-03" data-rotation="0deg"></div>
                                <div class="hero-figure-box hero-figure-box-04" data-rotation="-135deg"></div>
                                <div class="hero-figure-box hero-figure-box-05"></div>
                                <div class="hero-figure-box hero-figure-box-06"></div>
                                <div class="hero-figure-box hero-figure-box-07"></div>
                                <div class="hero-figure-box hero-figure-box-08" data-rotation="-22deg"></div>
                                <div class="hero-figure-box hero-figure-box-09" data-rotation="-52deg"></div>
                                <div class="hero-figure-box hero-figure-box-10" data-rotation="-50deg"></div>
                            </div>
                        </div>
                    </div>
                </section>
    
                <section class="features section">
                    <div class="container">
                        <div class="features-inner section-inner has-bottom-divider">
                            <div class="features-wrap">
                                <div class="feature text-center is-revealing">
                                    <div class="feature-inner">
                                        <div class="feature-icon hover-effect">
                                            <a href="{{route('post.index')}}"><img src="storage/images/feature-icon-01.svg" alt="Feature 01"></a>
                                        </div>
                                        <h4 class="feature-title mt-24"><a href="{{ route('post.index') }}" style="color: white; text-decoration: none;">Posts</a></h4>
                                        <p class="text-sm mb-0">With Thousans of daily users, our post section is filled with a wide range of screenshots and images of fellow users' experiences.</p>
                                    </div>
                                </div>
                                <div class="feature text-center is-revealing">
                                    <div class="feature-inner">
                                        <div class="feature-icon hover-effect">
                                            <a href="{{route('vpost.index')}}"><img src="storage/images/feature-icon-02.svg" alt="Feature 02"></a>
                                        </div>
                                        <h4 class="feature-title mt-24"><a href="{{route('vpost.index')}}" style="color: white; text-decoration: none;">Published Posts</a></h4>
                                        <p class="text-sm mb-0">In a modern day for gaming. Our published section shows content coming directly from official companies themselves, allowing you to browse images from up and coming games.</p>
                                    </div>
                                </div>
                                <div class="feature text-center is-revealing">
                                    <div class="feature-inner">
                                        <div class="feature-icon hover-effect">
                                            <a href="{{route('forum.index')}}"><img src="storage/images/feature-icon-03.svg" alt="Feature 03"></a>
                                        </div>
                                        <h4 class="feature-title mt-24"><a href="{{ route('forum.index') }}" style="color: white; text-decoration: none;">Forums</a></h4>
                                        <p class="text-sm mb-0">The pride of DashHound is our community forums. Join fellow members to engage is discussion about your favourite games and make some new friends along the way.</p>
                                    </div>
                                </div>
                                <div class="feature text-center is-revealing">
                                    <div class="feature-inner">
                                        <div class="feature-icon hover-effect">
                                            <a href="{{ route('tickets.index') }}"><img src="storage/images/feature-icon-04.svg" alt="Feature 04"></a>
                                        </div>
                                        <h4 class="feature-title mt-24"><a href="{{ route('tickets.index') }}" style="color: white; text-decoration: none;">Support Tickets</a></h4>
                                        <p class="text-sm mb-0">Browsing a system such as DashHound can provide challenging from time to time. The appearing bugs, unexpected and unkind guests, it all needs a system to manage. That's why we have a support ticketing system where you can raise your concerns.</p>
                                    </div>
                                </div>
                                <div class="feature text-center is-revealing">
                                    <div class="feature-inner">
                                        <div class="feature-icon hover-effect">
                                            @if (Auth::user())
                                                <a href="{{ route('profiles.show', Auth::user()->id )}}"><img src="storage/images/feature-icon-05.svg" alt="Feature 05"></a>
                                            @else 
                                                <a href="#"><img src="storage/images/feature-icon-05.svg" alt="Feature 05"></a>    
                                            @endif
                                        </div>
                                        @if (Auth::user())
                                            <h4 class="feature-title mt-24"><a href="{{ route('profiles.show', Auth::user()->id )}}" style="color: white; text-decoration: none;">Personal Profiles</a></h4>
                                        @else
                                            <h4 class="feature-title mt-24">Personal Profiles</h4>
                                        @endif
                                        <p class="text-sm mb-0">Natural to a forum is the ability to have your own profile. DashHound allows you to create a profile to the way you like it, customising your profile picture, a bio/description about yourself and also the ability to privatise your profile from other users.</p>
                                    </div>
                                </div>
                                {{-- <div class="feature text-center is-revealing">
                                    <div class="feature-inner">
                                        <div class="feature-icon">
                                            <img src="storage/images/feature-icon-06.svg" alt="Feature 06">
                                        </div>
                                        <h4 class="feature-title mt-24">Coming Soon</h4>
                                        <p class="text-sm mb-0">Fermentum posuere urna nec tincidunt praesent semper feugiat nibh. A arcu cursus vitae congue mauris. Nam at lectus urna duis convallis. Mauris rhoncus aenean vel elit scelerisque mauris.</p>
                                    </div>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </section>
    
                {{-- <section class="pricing section">
                    <div class="container-sm">
                        <div class="pricing-inner section-inner">
                            <div class="pricing-header text-center">
                                <h2 class="section-title mt-0">Are you a member?</h2>
                                <p class="section-paragraph mb-0">If you are already a registered member of DashHound then you are free to login below.</p>
                            </div>
                            <div class="pricing-tables-wrap">
                                <div class="pricing-table">
                                    <div class="pricing-table-inner is-revealing">
                                        <div class="pricing-table-main">
                                            <div class="pricing-table-header pb-24">
                                                <div class="pricing-table-price">Login Department</div>
                                            </div>
                                            @if (Route::has('login'))
                                                <ul class="pricing-table-features list-reset text-xs">
                                                    @auth
                                                    <li>
                                                        <a style="text-decoration: none; color: white; font-weight: bold;" href="{{ url('/home') }}">Home</a>
                                                    </li>
                                                    @else
                                                    <li>
                                                        <a style="text-decoration: none; color: white; font-weight: bold;" href="{{ route('login') }}">Login</a>
                                                    </li>
                                                        @if (Route::has('register'))
                                                            <li>
                                                                <a style="text-decoration: none; color: white; font-weight: bold;" href="{{ route('register') }}">Register</a>
                                                            </li>
                                                        @endif
                                                    @endauth
                                                </ul>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section> --}}
            </main>
    
            <footer class="site-footer">
                <div class="container">
                    <div class="site-footer-inner">
                        <div class="brand footer-brand">
                            <a href="#">
                                <img class="header-logo-image" src="storage/images/logo.svg" alt="Logo">
                            </a>
                        </div>
                        <ul class="footer-links list-reset">
                            <li>
                                <a href="/contact">Contact</a>
                            </li>
                            <li>
                                <a href="/posts">Posts</a>
                            </li>
                            <li>
                                <a href="/v/posts">Published Posts</a>
                            </li>
                        </ul>
                        <ul class="footer-social-links list-reset">
                            <li>
                                <a href="#">
                                    <span class="screen-reader-text">Facebook</span>
                                    <svg width="16" height="16" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M6.023 16L6 9H3V6h3V4c0-2.7 1.672-4 4.08-4 1.153 0 2.144.086 2.433.124v2.821h-1.67c-1.31 0-1.563.623-1.563 1.536V6H13l-1 3H9.28v7H6.023z" fill="#0270D7"/>
                                    </svg>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="screen-reader-text">Twitter</span>
                                    <svg width="16" height="16" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M16 3c-.6.3-1.2.4-1.9.5.7-.4 1.2-1 1.4-1.8-.6.4-1.3.6-2.1.8-.6-.6-1.5-1-2.4-1-1.7 0-3.2 1.5-3.2 3.3 0 .3 0 .5.1.7-2.7-.1-5.2-1.4-6.8-3.4-.3.5-.4 1-.4 1.7 0 1.1.6 2.1 1.5 2.7-.5 0-1-.2-1.5-.4C.7 7.7 1.8 9 3.3 9.3c-.3.1-.6.1-.9.1-.2 0-.4 0-.6-.1.4 1.3 1.6 2.3 3.1 2.3-1.1.9-2.5 1.4-4.1 1.4H0c1.5.9 3.2 1.5 5 1.5 6 0 9.3-5 9.3-9.3v-.4C15 4.3 15.6 3.7 16 3z" fill="#0270D7"/>
                                    </svg>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="screen-reader-text">Google</span>
                                    <svg width="16" height="16" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M7.9 7v2.4H12c-.2 1-1.2 3-4 3-2.4 0-4.3-2-4.3-4.4 0-2.4 2-4.4 4.3-4.4 1.4 0 2.3.6 2.8 1.1l1.9-1.8C11.5 1.7 9.9 1 8 1 4.1 1 1 4.1 1 8s3.1 7 7 7c4 0 6.7-2.8 6.7-6.8 0-.5 0-.8-.1-1.2H7.9z" fill="#0270D7"/>
                                    </svg>
                                </a>
                            </li>
                        </ul>
                        <div class="footer-copyright">&copy; 2020 DashHound, all rights reserved. Template by Solid</div>
                    </div>
                </div>
            </footer>
        </div>
    
        <script src="js/main.min.js"></script>
    </body>
</html>