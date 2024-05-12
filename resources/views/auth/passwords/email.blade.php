@extends('layouts.auth.app')

@section('content')
    <div class="login-container">
        <div class="login-box">
            <h1>{{ __('Reset Password') }}</h1>
            <p>
                @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            </p>
            <form method="POST" action="{{ route('password.email') }}">
                @csrf
                <input type="email" placeholder="email" class="@error('email') is-invalid @enderror" name="email"
                    value="{{ old('email') }}" required autocomplete="email" autofocus />
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror

                <input type="submit" value="{{ __('Send Password Reset Link') }}" />
            </form>
        </div>
    </div>
@endsection
