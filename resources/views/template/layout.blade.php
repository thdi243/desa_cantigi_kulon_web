<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>@yield('title', config('app.name'))</title>

        <link rel="shortcut icon" href="{{ asset('images/favicon/logo_desa.png') }}" type="image/png">
        <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
        <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/solid.css">

        {{-- AOS --}}
        <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />

        {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
        @php
            $isProduction = app()->environment('production');
            $manifestPath = public_path('build/manifest.json');
        @endphp

        @if ($isProduction && file_exists($manifestPath))
            @php
                $manifest = json_decode(file_get_contents($manifestPath), true);
            @endphp
            <link rel="stylesheet" href="{{ asset('build/' . $manifest['resources/css/app.css']['file']) }}">
            <script type="module" src="{{ asset('build/' . $manifest['resources/js/app.js']['file']) }}"></script>
        @else
            @viteReactRefresh
            @vite(['resources/js/app.js', 'resources/css/app.css'])
        @endif

        @yield('style')
    </head>

    <body class="bg-[#FFFDF7]">
        @if (!isset($noNavbar) || $noNavbar !== true)
            @include('template.navbar')
        @endif

        @yield('content')

        @if (!isset($noFooter) || $noFooter !== true)
            @include('template.footer')
        @endif

        @yield('script')

        {{-- AOS --}}
        <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
        <script>
            AOS.init();
        </script>
    </body>

</html>
