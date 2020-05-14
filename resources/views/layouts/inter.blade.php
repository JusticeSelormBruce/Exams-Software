<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Mon School') }}</title>

    <!-- Styles -->
    <link href="{{ asset('aerial/assets/css/main.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @yield('style')
</head>
<body class="loading">
    <div id="wrapper">
        <div id="bg"></div>
        <div id="overlay"></div>
        <div id="main">

            <!-- Header -->
            <header id="header">
                <h1>Real Innovation</h1>
                <p>Automated &nbsp;&bull;&nbsp; Easy to use &nbsp;&bull;&nbsp; User friendly</p>
                <div>
                    <br>
                    @yield('content')
                </div>
                <nav>
                    <ul>
                        <li><a href="#" class="icon fa-twitter"><span class="label">Twitter</span></a></li>
                        <li><a href="#" class="icon fa-facebook"><span class="label">Facebook</span></a></li>
                        <li><a href="#" class="icon fa-dribbble"><span class="label">Dribbble</span></a></li>
                        <li><a href="#" class="icon fa-github"><span class="label">Github</span></a></li>
                        <li><a href="#" class="icon fa-envelope-o"><span class="label">Email</span></a></li>
                    </ul>
                </nav>
            </header>

            <!-- Footer -->
            <footer id="footer">
                <span class="copyright">&copy; 2018: <a href="http://html5up.net">Cyber Creation</a>.</span>
            </footer>

        </div>
    </div>
    <script src="{{ asset('js/app.js') }}"></script>
    <script>
        window.onload = function() { document.body.className = ''; }
        window.ontouchmove = function() { return false; }
        window.onorientationchange = function() { document.body.scrollTop = 0; }
    </script>
</body>

</html>
