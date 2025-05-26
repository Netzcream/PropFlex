<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('partials.head')
    </head>
    <body class="min-h-screen bg-gray-50 antialiased">
        <header class="py-8 flex justify-center bg-gray-50">
            <a href="{{ route('home') }}">
                {{-- Si tenés logo, usalo, si no, podés usar x-app-logo-icon --}}
                <x-app-logo-icon class="h-24 w-24 fill-current text-blue-700" />

                <span class="sr-only">{{ config('app.name', 'PropFlex') }}</span>
            </a>
        </header>

        <main class="flex flex-col items-center justify-start min-h-[60vh] py-8">
            <section class="w-full max-w-md bg-white rounded-2xl shadow p-8">
                {{ $slot }}
            </section>
        </main>

        <footer class="py-6 text-center text-gray-400 text-xs bg-transparent">
            &copy; {{ date('Y') }} {{ config('app.name', 'PropFlex') }} - Proyecto Inmobiliario
        </footer>

        @fluxScripts
    </body>
</html>
