<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>BBWJadeVegas - @yield('titulo')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link rel="shortcut icon" href="{{asset('img/logos/isoFondoBlanco.png')}}" type="image/x-icon">

    @stack('styles')
    @stack('scripts')

    @vite('resources/css/app.css')
</head>

<style>
    @font-face {
        font-family: 'Designer';
        src: url('{{ asset('fonts/Designer.otf') }}');
    }
    @font-face {
        font-family: 'AlteRegular';
        src: url('{{ asset('fonts/AlteHaasGroteskRegular.ttf') }}');
    }
</style>

<body class="bg-gray-950 text-white">

    <header class="bg-zinc-950 flex justify-center items-center py-1">
        <a href="/" class="w-60">
            <img class="w-full" src="{{ asset('img/logos/logoPrincipalBlanco.png') }}" alt="Logo bbwlovejadevegas">
        </a>
    </header>

    <main class="mb-5">
        
        <div class="flex">
            <div class="md:w-3/12 bg-zinc-950 py-5 hidden md:block">
                <nav>
                    <div class="px-5">
                        <p class="text-xl uppercase border-b border-solid inline">Main</p>
                        <div class="flex flex-col pb-5">
                            <a class="transition duration-300 p-2 hover:bg-zinc-900 rounded-sm" href="/">Home</a>
                            <a class="transition duration-300 p-2 hover:bg-zinc-900 rounded-sm" href="/categories">Categories</a>
                            <a class="transition duration-300 p-2 hover:bg-zinc-900 rounded-sm" href="/memberships">Memberships</a>
                        </div>
                        <p class="text-xl uppercase border-b border-solid inline-block pt-5">Content upload</p>
                        <div class="flex flex-col">
                            <a class="transition duration-300 p-2 hover:bg-zinc-900 rounded-sm" href="{{route('dashboard.index')}}">Dashboard</a>
                            <a class="transition duration-300 p-2 hover:bg-zinc-900 rounded-sm" href="{{route('dashboard.users.index')}}">Users</a>
                            <a class="transition duration-300 p-2 hover:bg-zinc-900 rounded-sm" href="{{route('dashboard.videos.index')}}">Videos</a>
                            <a class="transition duration-300 p-2 hover:bg-zinc-900 rounded-sm" href="{{route('dashboard.categories.index')}}">Categories</a>
                            <a class="transition duration-300 p-2 hover:bg-zinc-900 rounded-sm" href="{{route('dashboard.memberships.index')}}">Memberships</a>
                        </div>
                    </div>
                </nav>
            </div>
            <div class="md:w-9/12">
                <h1 class="text-4xl uppercase my-5 tracking-wide">@yield('titulo')</h1>
                @yield('contenido')
            </div>
        </div>

    </main>

    <footer>
        <p class="bg-zinc-950 p-4 uppercase text-center font-bold">BbwLoveJadeVegas - ALL RIGHTS RESERVED &copy; {{ now()->year }} </p>
    </footer>

</body>

</html>