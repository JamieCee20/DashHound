<!DOCTYPE html>
<html>
<head>
    <title>Contact Us</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/contact.css') }}">
</head>
<body>
    <nav class="navbar navbar-expand-md" id="header-nav" style="background-color:#B6B8D6;color: white;">
        <div class="container">
            <div class="navContent">
                <a class="navbar-brand" href="{{ url('/') }}">
                   DashHound
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

                            <div class="dropdown-menu dropdown-menu-right bg-dark contact-color" aria-labelledby="navbarDropdown">
                                <a href="/profile/{{Auth::user()->id}}" class="dropdown-item">Profile</a>
                                @can('manage-users')
                                    <a href="{{ route('admin.users.index')}}" class="dropdown-item">Admin Dashboard</a>
                                @endcan
                                <a href="{{ route('post.index') }}" class="dropdown-item">Community Posts</a>
                                <a href="{{ route('vpost.index') }}" class="dropdown-item">Official Content</a>
                                <hr style="background-color: white;">
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
    <section>
        <div class="content">
            <h2>Do you have a concern?</h2><br><br>
            <h3>What to do if you have any concerns when browsing DashHound</h3>
            <p>If you have any concerns you may use the built in ticket system to raise a query. Make sure to include a title, a short description detailing your concern and any evidence if you are able to provide any.</p>
            <a href="{{ route('tickets.index') }}" disabled>Create a ticket</a>
        </div>
    </section>
    <section>
        <div class="content">
            <h2>How do I create a post?</h2><br><br>
            <h3>The steps below will detail how to create a post and successfully upload it</h3>
            <p>
                To successfully create a post you must first be a member of our community. If you are not then you must first register for a new account.<br>
                Next step once logged in is to click the dropdown menu on the right hand side of the screen and select create a post.<br>
                From there, you are prompted with a form to fill in with your post details including an image, fill out this form fully.<br>
                Finally, click upload and your post will be live. Your post can be found in the posts section or found on your profile.<br><br>
                Click login below to begin the process
            </p>
            <a href="{{ route('login')}}">Login</a>
        </div>
    </section>
    <section>
        <div class="content">
            <h2>What is a published post?</h2><br><br>
            <h3>Have you ever wondered what is meant by published post? Well here you can find out!</h3>
            <p>
                A published post is like any other post, except the contents of that post are specific to official game publishers such as EA, Bethesda and Activision. The official published post section allows such companies to share new screenshots regarding up and coming games.<br><br>
                This section creates hype among the community. Getting users excited about featurettes that are due to come out soon and also allows the companies to see interaction likes from users that view the post. We like to think this helps users to see such spoilers or trailers as soon as they are released.
            </p>
            <a href="{{route('vpost.index')}}">View Section</a>
        </div>
    </section>
    <section>
        <div class="content">
            <h2>How do I report a comment/post on the Forum?</h2><br><br>
            <h3>If you see something on the forum that you feel isn't appropriate, this is what to do.</h3>
            <p>
                Before reporting a post, make sure that the content you are reporting matches a deemed inappropriate topic from the list below.<br>
                # Racial Slurs<br>
                # Mean or abusive behaviour<br>
                # Leaking of personal data of any kind<br>
                # No Spamming i.e. advertising or referral links to other services<br>
                # No Discussions of software piracy, hacking or illegal material<br><br>
                If you see a post or comment that goes against these terms then please report it by creating a <a href="{{ route('tickets.index') }}">ticket</a> and provide a reason and/or evidence as to why this post breaks our rules and a member of the staff team will respond to your query and deal with the content reported as soon as possible.
            </p>
        </div>
    </section>
    <section>
        <div class="content">
            <h2>My Profile has been temporarily banned, what does this mean?</h2><br><br>
            <h3>If your profile is currently restricted then there will be a reason why.</h3>
            <p>
                If you feel like your profile has been incorrectly banned then please contact us via ticket and we can either resolve the issue or explain as to why your profile was banned.<br>
                In most cases, profiles being banned come to those who break any community rules and guidelines and we feel the appropriate punishment is to temporarily ban their account for a certain duration of time. In rare cases or from repeated offenses, we may permanently ban the user from posting again.
            </p>
        </div>
    </section>
    <section>
        <div class="content">
            <h2>Is it possible to view new changes to DashHound?</h2><br><br>
            <h3>Are you eager to know what has been changed to DashHound?</h3>
            <p>
                Well great news! We post all our change logs to our website. Each changelog will be posted with a date of release and a list of all changes and fixes, maybe in the future an additional newsletter can be sent with changelog information to those who sign up to the email.
            </p>
            <a href="#">Change Logs [Coming Soon]</a>
        </div>
    </section>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    <script src="{{ asset('js/scroll-out.js') }}"></script>
    <script>
        ScrollOut({
            targets: 'h2, h3, p, a'
        })
    </script>
</body>
</html>
