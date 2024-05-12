@extends('layouts.auth.app')

@section('content')
    <div class="login-container">
        <div class="login-box">
            <h1>Login</h1>
            <p>
                Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam.
            </p>
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <input type="email" placeholder="email" class="@error('email') is-invalid @enderror" name="email"
                    value="{{ old('email') }}" required autocomplete="email" autofocus />
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <input type="password" placeholder="********" class="@error('password') is-invalid @enderror"
                    name="password" required autocomplete="current-password" />
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <input type="submit" value="Login" />
                <div class="text-center remember-me-checkbox">
                    <input type="checkbox" value="rememberMe" name="remember" id="remember"
                        {{ old('remember') ? 'checked' : '' }} />
                    <label for="rememberMe" class="mb-3">Remember Me</label>
                </div>
            </form>
            @if (Route::has('password.request'))
                <div class="text-center">
                    <a href="{{ route('password.request') }}">Forgot pass?</a>
                </div>
            @endif
        </div>
    </div>
@endsection
