@extends('layouts.layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                    hi
                    <p>
                       @foreach($users as $user)
                            <p>{{ $user->id }}</p>
                            <p>{{ $user->name }}</p>
                            <p>{{ $user->role->name }}</p>
                            <p>{{ $user->permissions()->contains('update_user') }}</p>
                            <p>{{ $user->permissions }}</p>
                            <hr>
                        @endforeach
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
