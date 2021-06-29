<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title','Bugtrack')</title>

    <!-- Icons -->
    <!-- <link rel="icon" href="{{ asset('/images/logo-sm-m.png') }}" type="image/x-icon"> -->
    <script src="https://kit.fontawesome.com/e74b9436ab.js" crossorigin="anonymous"></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
    <div id="app" class="container-fluid">

        <div>

            {{-- side navigation --}}
            @include('layouts.side-nav')

            <div id="main" class="p-0">

                {{-- top navbar --}}
                @include('layouts.top-nav')

                {{-- content --}}
                <main class="py-4 px-3">
                    @yield('content')
                </main>  

            </div>
            
        </div>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
</body>
</html>
