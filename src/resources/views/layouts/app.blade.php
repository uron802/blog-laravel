<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/main.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
</head>
<body>
    <div class='container'>
        <header class='hero'>
            <div class='hero-body'>
                    <div class='container'>
                        <h1 class='title'>
                        <a href='{{ route("article") }}'>
                            {{ config('app.name', 'Laravel') }}
                        </a>
                        </h1>
                    </div>
            </div>
        </header>
        <section id="wrapper" class='columns'>
            <nav class='column'>
                @include('layouts.sidebar')
            </nav>
            <main class='column'>
                @yield('content')
            </main>
        </section>
    </div>
    <footer class='footer'></footer>
@yield('script')
</body>
</html>
