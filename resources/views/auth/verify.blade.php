@extends('layouts.auth.app')
@section('content')
    <div class="login-container">
        @if (session('resent'))
            <div class="alert alert-success" role="alert">
                {{ __('A fresh verification link has been sent to your email address.') }}
            </div>
        @endif
        <div class="login-box">
            <h1>{{ __('Reset Password') }}</h1>
            <p>
                {{ __('Before proceeding, please check your email for a verification link.') }}
                {{ __('If you did not receive the email') }},
            </p>
            <form method="POST" action="{{ route('verification.resend') }}">
                @csrf
                <input type="submit" value="{{ __('click here to request another') }}" />
            </form>
        </div>
    </div>
@endsection
