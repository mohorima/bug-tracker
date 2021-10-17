<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title','Bugtrack')</title>

    <!-- Icons -->
    <link rel="icon" href="{{ asset('/images/logo-sm.svg') }}" type="image/x-icon">
    

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,800;1,400&display=swap" rel="stylesheet">
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
                <main class="py-3 px-3">
                    <!-- route outlet -->
                    <!-- component matched by the route will render here -->
                    <router-view></router-view>
                </main>  

            </div>
            
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://kit.fontawesome.com/e74b9436ab.js" crossorigin="anonymous"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>
</body>
</html>
