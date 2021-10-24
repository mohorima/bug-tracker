@extends('layouts.app')

@section('content')
<div class="container-fluid m-0 p-0">
    <div class="login">
        
            <div class="col-50 login-logo">
                <img src="{{ asset('/images/logo-vertical.svg') }}" alt="">
            </div>

            <div class="col-50 login-form">
                <h4>Welcome back</h4>
                <div class="card">
                    <div class="card-header">Login</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('login') }}" class="input-form">
                            @csrf

                            <div class="form-group">
                                <label class="col-form-label" for="email">Email</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="col-form-label" for="password">Password</label>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group forgot-pwd">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                        <label class="form-check-label" for="remember">
                                            {{ __('Remember Me') }}
                                        </label>
                                    </div>
                                    @if (Route::has('password.request'))
                                        <a class="" href="{{ route('password.request') }}">
                                            {{ __('Forgot Password?') }}
                                        </a>
                                    @endif
                            </div>

                            <div class="login-btn">
                                <button type="submit" class="btn btn-submit">
                                    LOGIN
                                </button>
                            </div>
                            
                        </form>
                    </div>
                </div>
            </div>

    </div>
</div>
@endsection
