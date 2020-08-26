<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>DashHound || @yield('title')</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <script src="https://kit.fontawesome.com/7035df6b5e.js" crossorigin="anonymous"></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/background.css') }}" rel="stylesheet">
    <link rel="canonical" href="https://getbootstrap.com/docs/4.0/examples/sticky-footer-navbar/">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md" style="background-color:#B6B8D6;">
            <div class="container">
                <div class="navContent">
                    <a class="navbar-brand" href="{{ url('/') }}">
                       DashHound
                    </a>
                    <a class="navbar-brand" href="{{ url('/posts') }}">
                       Community Posts
                    </a>
                    <a class="navbar-brand" href="{{ url('/v/posts') }}">
                       Official Publishers
                    </a>
                </div>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <i class="fas fa-bars"></i>
                </button>

                <div class="collapse navbar-collapse navbar-light" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a href="/profile/{{Auth::user()->id}}" class="dropdown-item">Profile</a>
                                    <a href="/p/create" class="dropdown-item">Create Post</a>
                                    @can('post-verified-create')
                                    <a href="/v/create" class="dropdown-item">Create Verified Post</a>
                                    @endcan
                                    @can('manage-users')
                                        <a href="{{ route('admin.users.index')}}" class="dropdown-item">User Management</a>
                                    @endcan
                                    <a href="{{ route('home')}}" class="dropdown-item">Search Users</a>
                                    <hr>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            <div class="container">
                @include('partials.alerts')
                @yield('content')
            </div>
        </main>
    </div>
    <div>
        <div class="container">
            <div class="fixed-bottom">
                <footer class="py-2 bg-secondary">
                        @include('includes.footer')
                </footer>
            </div>
        </div>
    </div>
</body>
</html>
