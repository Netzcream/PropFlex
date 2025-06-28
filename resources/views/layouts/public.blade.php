{{-- resources/views/layouts/public.blade.php --}}
<!DOCTYPE html>
<html lang="es">

<head>
    <title>@yield('title', 'PropFlex')</title>


    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" href="/favicon.ico" sizes="any">
    <link rel="icon" href="/favicon.svg" type="image/svg+xml">
    <link rel="apple-touch-icon" href="/apple-touch-icon.png">

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])


    @stack('head')
    @stack('styles')
</head>

<body class="bg-gray-50 min-h-screen flex flex-col">

    <!-- Header / Navbar -->
    <header class="bg-white shadow">
        <div class="container mx-auto px-4 py-3 flex justify-between items-center">
            <a href="{{ route('home') }}" class="text-2xl font-bold text-blue-700" wire:navigate>PropFlex</a>
            <nav>
                <ul class="flex gap-4">
                    <li>
                        <a href="{{ route('home') }}" class="text-gray-700 hover:text-blue-600 transition"
                            wire:navigate>Inicio</a>
                    </li>
                    <li>
                        <a href="{{ route('properties.index') }}" class="text-gray-700 hover:text-blue-600 transition"
                            wire:navigate>Propiedades</a>
                    </li>
                    <li>
                        <a href="{{ route('about') }}" class="text-gray-700 hover:text-blue-600 transition"
                            wire:navigate>Quienes somos</a>
                    </li>
                    <li>
                        <a href="{{ route('contact') }}" class="text-gray-700 hover:text-blue-600 transition"
                            wire:navigate>Contacto</a>
                    </li>

                    @auth
                        {{-- Si el usuario está logueado --}}
                        @php
                            $user = Auth::user();
                        @endphp

                        @if ($user->hasRole('admin') || $user->hasRole('agente'))
                            <li>
                                <a href="{{ route('dashboard') }}" class="text-gray-700 hover:text-blue-600 transition"
                                    wire:navigate>Panel</a>
                            </li>
                        @endif

                        {{-- Menú de usuario con nombre y logout --}}
                        <li class="relative group">
                            <button
                                class="flex items-center gap-2 text-gray-700 hover:text-blue-600 transition focus:outline-none">
                                <span class="">{{ $user->name }}</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                            <ul
                                class="absolute right-0 mt-2 w-36 bg-white border rounded shadow-lg opacity-0 group-hover:opacity-100 group-focus:opacity-100 transition-opacity z-50">
                                <li>
                                    <a href="{{ route('profile') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100"
                                        wire:navigate>Mi perfil</a>
                                </li>
                                <li>
                                    <a href="{{ route('properties.index', ['favorites' => true]) }}"
                                        class="block px-4 py-2 text-gray-700 hover:bg-gray-100" wire:navigate>Favoritos</a>
                                </li>

                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit"
                                            class="w-full text-left px-4 py-2 text-red-700 hover:bg-gray-100">Cerrar
                                            sesión</button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @else
                        <li>
                            <a href="{{ route('login') }}" class="text-gray-700 hover:text-blue-600 transition"
                                wire:navigate>Ingresar</a>
                        </li>
                    @endauth

                </ul>
            </nav>
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-1 container mx-auto px-4 py-8">
        @yield('content')
    </main>

    <!-- Footer -->
<footer class="bg-gray-900 text-gray-400 mt-16 pt-12 pb-6">
    <div class="max-w-6xl mx-auto px-4 grid md:grid-cols-3 gap-8 text-sm">

        <!-- Columna 1: Marca -->
        <div>
            <h2 class="text-white text-xl font-semibold mb-2">PropFlex</h2>
            <p class="text-gray-400">
                Proyecto inmobiliario con base en Buenos Aires. Acompañamos personas en la compra, venta y alquiler de propiedades.
            </p>
        </div>

        <!-- Columna 2: Navegación -->
        <div>
            <h3 class="text-white text-sm font-bold mb-2">Navegación</h3>
            <ul class="space-y-1">
                <li><a href="{{ route('home') }}" class="hover:text-white">Inicio</a></li>
                <li><a href="{{ route('properties.index') }}" class="hover:text-white">Propiedades</a></li>
                <li><a href="{{ route('about') }}" class="hover:text-white">Quiénes somos</a></li>
                <li><a href="{{ route('contact') }}" class="hover:text-white">Contacto</a></li>
            </ul>
        </div>

        <!-- Columna 3: Legal / contacto -->
        <div>
            <h3 class="text-white text-sm font-bold mb-2">Contacto</h3>
            <p>Email: <a href="mailto:info@propflex.com" class="hover:text-white">info@propflex.com</a></p>
            <p>Tel: <a href="tel:+541100000000" class="hover:text-white">+54 11 0000 0000</a></p>
            <p class="mt-2">Buenos Aires, Argentina</p>
        </div>
    </div>

    <div class="border-t border-gray-700 mt-10 pt-4 text-center text-xs text-gray-500">
        &copy; {{ date('Y') }} PropFlex — Todos los derechos reservados.
    </div>
</footer>


    @stack('scripts')
</body>

</html>
