@extends('layouts.auth.app')
@section('content')
    <div class="login-container">
        <div class="login-box">
            <h1>{{ __('Reset Password') }}</h1>
            <p>
                Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam.
            </p>
            <form method="POST" action="{{ route('password.update') }}">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">
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
                <input type="password" placeholder="{{ __('Confirm Password') }}" class="@error('password_confirmation') is-invalid @enderror"
                    name="password_confirmation" required autocomplete="current-password" />
                @error('password_confirmation')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <input type="submit" value="{{ __('Reset Password') }}" />
            </form>
        </div>
    </div>
@endsection
