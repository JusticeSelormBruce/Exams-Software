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
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('font-awesome/css/font-awesome.css') }}" rel="stylesheet">
    <link href="{{ asset('css/animate.css') }}" rel="stylesheet">
    <style>
        body{
            background-image: url("{{ asset('bg/bg8.jpg') }}");
            background-size: cover;
        }
        #footer{
            background-color: skyblue;
            text-align: center;
            position: fixed;
            bottom: 0;
        }
    </style>
</head>
<body>
    <div id="app">
        @yield('content')
        <div id="footer">
            <br>
            <div class="row">
                <div id="first" class="col-md-3">
                    <i class="fa fa-4x fa-database"></i>
                    <h4>Database System</h4>
                    <p>This software contains a database for storing
                    exams questions and their corresponding answers.
                        Both essay-type and objectives are supported.</p>
                </div>
                <div id="second" class="col-md-3">
                    <i class="fa fa-4x fa-paper-plane"></i>
                    <h4>Automated Examination System</h4>
                    <p>This software can be used to automatically
                    select questions from the database for
                    examination. It also picks the corresponding answers
                    to the selected questions and prints on a</p>
                </div>
                <div id="third" class="col-md-3">
                    <i class="fa fa-4x fa-bolt"></i>
                    <h4>Easy to use</h4>
                    <p>This software is designed such that with
                    little or no training the user can use it</p>
                </div>
                <div id="fourth" class="col-md-3">
                    <i class="fa fa-4x fa-book"></i>
                    <h4>User friendly</h4>
                    <p>This software is user friendly because few steps
                        are involved when inputting data or using it to
                        set questions during examinations.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script>
        $('#first, #second, #third, #fourth').hover(
            function () {
                $(this).find('h4').addClass('animated shake');
                $(this).find('i').addClass('animated bounce');
            },
            function () {
                $(this).find('h4').removeClass('animated shake');
                $(this).find('i').removeClass('animated bounce');
            }
        )
    </script>
</body>
</html>
