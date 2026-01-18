<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="shortcut icon" type="image/x-icon" href="{{ URL::asset('favicon.ico') }}">
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <!-- Material icons -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    @stack('custom-css')
    @livewireStyles
</head>
<body>
    <div id="app">
        <div class="container">
            <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom">
                <a class="d-flex align-items-center col-md-3 mb-2 mb-md-0 text-dark text-decoration-none" href="{{ url('/') }}">
                    <svg width="40px" height="40px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M20.5949 4.45999C21.5421 4.71353 22.2865 5.45785 22.54 6.40501C22.9982 8.12002 23 11.7004 23 11.7004C23 11.7004 23 15.2807 22.54 16.9957C22.2865 17.9429 21.5421 18.6872 20.5949 18.9407C18.88 19.4007 12 19.4007 12 19.4007C12 19.4007 5.12002 19.4007 3.405 18.9407C2.45785 18.6872 1.71353 17.9429 1.45999 16.9957C1 15.2807 1 11.7004 1 11.7004C1 11.7004 1 8.12002 1.45999 6.40501C1.71353 5.45785 2.45785 4.71353 3.405 4.45999C5.12002 4 12 4 12 4C12 4 18.88 4 20.5949 4.45999ZM15.5134 11.7007L9.79788 15.0003V8.40101L15.5134 11.7007Z" fill="#000000"/>
                    </svg>
                </a>
                <div class="d-flex col-md-5 text-start">
                    {{-- search --}}
                    <form action="/search" method="GET" class="w-100">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search" aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary border" type="submit">
                                    <i class="material-symbols-outlined">search</i>
                                </button>
                            </div>
                        </div>
                    </form>
                    {{-- search --}}
                </div>
                <div class="d-flex align-items-center">
                    @guest
                        <ul class="nav justify-content-center mb-md-0">
                            @if (Route::has('login'))
                                <li><a class="nav-link px-2 link-dark" href="{{ route('login') }}">{{ __('Login') }}</a></li>
                            @endif

                            @if (Route::has('register'))
                                <li>
                                    <a class="nav-link px-2 link-dark" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        </ul>
                    @else
                        <a href="{{ route('video.create', ['channel' => Auth::user()->channel]) }}" title="Add video" class="btn">
                            <i class="material-symbols-outlined">video_call</i>
                        </a>
                        <div class="flex-shrink-0 dropdown">
                            <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle" id="dropdownUser2" data-bs-toggle="dropdown" aria-expanded="false">
                                @include('partials.channel-image', ['size' => 'small'])
                            </a>
                            <ul class="dropdown-menu text-small shadow" aria-labelledby="dropdownUser2" style="z-index: 1000">
                                <li>
                                    <a class="dropdown-item" href="{{ route('channel.index', ['channel' => Auth::user()->channel]) }}">
                                        {{ __('My channel') }}
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('channel.view', ['channel' => Auth::user()->channel]) }}">
                                        {{ __('My videos') }}
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('channel.edit', ['channel' => Auth::user()->channel]) }}">
                                        {{ __('Edit channel') }}
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </div>
                    @endguest
                </div>
            </header>
        </div>

        <main class="p-3">
            @yield('content')
        </main>
    </div>
    @stack('custom-js')
    @livewireScripts
</body>
</html>
