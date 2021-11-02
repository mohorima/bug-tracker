@extends('layouts.app')

@section('content')
    <div class="welcome">
        <img src="{{ asset('/images/logo-vertical.svg') }}" alt="">
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
@endsection
