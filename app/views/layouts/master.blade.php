<!Doctype html>
<html lang="en">
    <head>
        <meta name="csrf-token" content="{{{ csrf_token() }}}}" charset="utf-8">
        <link rel="stylesheet" href="/sass/bootsass.css">
        <title>@yield('title')</title>

    </head>
    <body>
        {{-- universal navbar --}}
        <div class="navbar-wrapper">
            <div class="container">
            <nav class="navbar navbar-inverse navbar-static-top">
                <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">Bare Bones Events</a>
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    <ul class="nav navbar-nav">
                    <li class="active"><a href="#">Home</a></li>
                    <li><a href="#browse">Browse Events</a></li>
                    <li><a href="#about">About</a></li>
                    <li><a href="#contact">Contact</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Account <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                        <li><a href="#">Login</a></li>
                        <li><a href="#">Create Account</a></li>
                        <li><a href="#">Logout</a></li>
                        <li role="separator" class="divider"></li>
                        <li class="dropdown-header">Nav header</li>
                        <li><a href="#">Manage</a></li>
                        <li><a href="#">Create Event</a></li>
                        </ul>
                    </li>
                    </ul>
                </div>
                </div>
            </nav>
            </div>
        </div>

        @yield('content')


        <script src="/bower/assets/vendor/jquery/dist/jquery.min.js"></script>
        <script src="/bower/assets/vendor/bootstrap-sass/assets/javascripts/bootstrap.min.js"></script>
        <script src="/bower/assets/vendor/angular/angular.min.js"></script>
        @yield('script')
    </body>
</html>