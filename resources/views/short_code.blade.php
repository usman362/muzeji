@extends('layouts.auth.app')

@section('content')
    <div class="login-container">
        <div class="login-box">
            <h1>Short Code</h1>
            <p>
                Please enter short code to view POI
            </p>
            <form method="POST" action="{{ route('poi.short_code_view') }}">
                @csrf
                <input type="text" placeholder="Short Code" class="@error('short_code') is-invalid @enderror" name="short_code"
                    value="{{ old('short_code') }}" required autocomplete="off" autofocus />
                <input type="submit" value="Submit" />
            </form>
        </div>
    </div>
@endsection
