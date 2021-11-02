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

    <!-- Style -->
    <style>
        *{
            box-sizing: border-box;
        }
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            height: 100vh;
            width: 100%;
            margin: 0;
            padding: 0;
        }
        img {
            margin-bottom: 50px;
            width: 300px;
        }
        .btn{
            padding: 0.6rem 1.3rem;
            height: 45px;
            letter-spacing: 0.05rem;
            line-height: 0;
            font-weight: 500;
            min-width: 140px;
            border-radius: 17px;
            background-color: #62ba0a;
            color: white;
            text-transform: uppercase;
            border: none;
        }
        .btn:hover{
            cursor: pointer;
            background-color: #6ad103;
        }
    </style>
</head>

<body>
        <img src="{{ asset('/images/logo-vertical.svg') }}" alt="">
        @if (Route::has('login'))
            @auth
                <a href="{{ url('/home') }}">
                    <button type="button" class="btn">
                        HOME
                    </button>
                </a>
                
            @else
                <a href="{{ route('login') }}">
                    <button type="button" class="btn">
                        LOGIN
                    </button>
                </a>
            @endauth
        @endif
</body>
</html>
