<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <!-- Fontawesome icons -->

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css"
          integrity="sha384-vp86vTRFVJgpjF9jiIGPEEqYqlDwgyBgEF109VFjmqGmIY/Y4HV4d3Gp2irVfcrp" crossorigin="anonymous">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
</head>
<body>
<div id="top-panel" class="flex">
    @if (Route::has('login'))
        @auth
            <span>{{auth()->user()->name}}</span>
            <form class="ml-5" method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="text-sm text-gray-700" type="submit">{{__('auth.logout')}}</button>
            </form>
        @else
            <a href="{{ route('login') }}" class="text-sm text-gray-700">{{__('auth.login')}}</a>
            @if (Route::has('register'))
                <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700">{{__('auth.register')}}</a>
            @endif
        @endauth

    @endif
    <a class="ml-5" href="{{route('locale.change')}}">
        <img src="https://www.countryflags.io/{{$language==='lt'?'gb':($language==='en'?'lt':'gb')}}/flat/32.png">
    </a>
</div>
<div id="app" class="font-sans text-gray-900 antialiased">
    {{ $slot }}
</div>
</body>
</html>
