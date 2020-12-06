<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </head>
    <body class="welcome-body">
        <div class="welcome-header">
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
        </div>

        <div class="first-content">
            <img src="{{asset( '/img/top2.png' )}}" alt="first-image">
        </div>

        <div class="second-content">
            <div class="second-content-item">
                <img class="second-content-image" src="{{asset( '/img/question.png' )}}" alt="question">
                <p class="second-content-text">あああああああああああああああああああああああああ</p>
            </div>
            <div class="second-content-item">
                <img class="second-content-image" src="{{asset( '/img/solution.png' )}}" alt="team">
                <p class="second-content-text">あああああああああああああああああああああああああ</p>
            </div>
        </div>
    </body>
</html>
