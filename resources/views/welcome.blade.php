<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Bugtrack') }}</title>

    <!-- Icons -->
    <link rel="icon" href="{{ asset('/images/logo-sm.svg') }}" type="image/x-icon">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,400;0,500;0,600;1,400&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">

        <main>
            <div class="container">
                <div class="login">
                    <img src="{{ asset('/images/logo-vertical.svg') }}" alt="" width="200px">
                    <h3>Project & Issue Management</h3>
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/home') }}">
                                <button type="button" class="btn btn-submit">
                                    HOME
                                </button>
                            </a>
                            
                        @else
                            <a href="{{ route('login') }}">
                                <button type="button" class="btn btn-submit">
                                    LOGIN
                                </button>
                            </a>
                        @endauth
                    @endif
                </div>
            </div>
        </main>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
</body>
</html>
