@extends('layouts.auth.app')

@section('content')
    <div class="login-container">

        <div class="login-box">
            <h1>{{ __('Confirm Password') }}</h1>
            <p>
                {{ __('Please confirm your password before continuing.') }}
            </p>
            <form method="POST" action="{{ route('password.confirm') }}">
                @csrf
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                    name="password" required autocomplete="current-password">

                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror

                <input type="submit" value="{{ __('Confirm Password') }}" />
            </form>
            @if (Route::has('password.request'))
                            <div class="text-center">
                                <a href="{{ route('password.request') }}">Forgot pass?</a>
                            </div>
                        @endif
        </div>
    </div>
@endsection
