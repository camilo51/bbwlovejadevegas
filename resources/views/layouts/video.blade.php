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

    <header class="bg-zinc-950 flex justify-between items-center py-1 px-5 shadow">
        <a href="/" class="w-60">
            <img class="w-full" src="{{ asset('img/logos/logoPrincipalBlanco.png') }}" alt="Logo bbwlovejadevegas">
        </a>

        <nav class="navegacion">
            <div class="flex items-center">
                <div class="space-x-1 border-r pr-4">
                    <a class="border-b border-solid border-transparent hover:border-white transition duration-300 py-2 px-4" href="/">Home</a>
                    <a class="border-b border-solid border-transparent hover:border-white transition duration-300 py-2 px-4" href="/categories">Categories</a>
                    <a class="border-b border-solid border-transparent hover:border-white transition duration-300 py-2 px-4" href="/memberships">Memberships</a>
                </div>

                @guest
                <div class="space-x-3 ml-4">
                    <a class="border-b border-solid border-transparent hover:border-white transition duration-300 py-2 px-4" href="{{route('login')}}">Login</a>
                    <a class="transition duration-300 bg-fuchsia-300 hover:bg-fuchsia-800 text-black hover:text-white py-2 px-4 font-bold rounded-sm" href="{{route('register')}}">Join Now</a>
                </div>
                @endguest


                @auth
                <div class="space-x-3 ml-4 flex">

                    @if (auth()->user()->id == '1')
                    <a 
                        class="py-2 px-4" 
                        href="{{route('dashboard.index')}}">Dashboard
                    </a>
                    @endif

                    <a 
                        class="py-2 px-4 font-bold" 
                        href="{{route('profile.index', auth()->user()->username)}}">HI: 
                            <span class="font-normal">{{auth()->user()->username}}</span>
                    </a>
                    <form action="{{route('logout')}}" method="POST">
                        @csrf
                        <button 
                            class="transition duration-300 bg-red-300 hover:bg-red-800 text-black hover:text-white py-2 px-4 font-bold rounded-sm " 
                            href="{{route('logout')}}">Log out
                        </button>
                    </form>
                </div>
                @endauth
            </div>
        </nav>
    </header>

    <main class="my-5">
        @yield('contenido')
    </main>

    <footer>
        <p class="bg-zinc-950 p-4 uppercase text-center font-bold">BbwLoveJadeVegas - ALL RIGHTS RESERVED &copy; {{ now()->year }} </p>
    </footer>

</body>

</html>