<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://kit.fontawesome.com/8000afe723.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Proxima+Nova" rel="stylesheet" />
    <link href="{{ asset('css/main.css') }}" rel="stylesheet" />
    {{-- @vite(['resources/sass/app.scss', 'resources/js/app.js']) --}}
    @stack('styles')
</head>

<body>

    <div class="navbar mobile-nav">
        <div class="mobile-menu">
            <div class="menu-icon"><i class="fa fa-bars"></i></div>
            <div class="mobile-menu-items">
                <div class="menu-items active">
                    <a href="#">Home</a>
                </div>
                <div class="menu-items">
                    <a href="#">Project</a>
                </div>
                <div class="menu-items">
                    <a href="#">Settings</a>
                </div>
                <div class="menu-items">
                    <a href="#">Statistics</a>
                </div>
            </div>
        </div>
        <div class="logo">
            <img src="{{ asset('images/logo.png') }}" alt="logo" />
        </div>
        <div class="menu">
            <div class="menu-items active">
                <a href="#">Home</a>
            </div>
            <div class="menu-items">
                <a href="#">Project</a>
            </div>
            <div class="menu-items">
                <a href="#">Settings</a>
            </div>
            <div class="menu-items">
                <a href="#">Statistics</a>
                {{--<a href="#" onclick="document.getElementById('logout').submit()">Logout</a>--}}
                {{--<form action="{{route('logout')}}" method="post" id="logout">@csrf</form>--}}
            </div>
        </div>
        <div class="user-avatar">
            <div class="avatar">
                <img src="{{asset('images/user.png')}}" alt="avatar" />
            </div>
            <p>HELLO ROK</p>
        </div>
    </div>

    @yield('content')

    @stack('scripts')
</body>

</html>
