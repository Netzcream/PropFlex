<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">

<head>
    @include('partials.head')
</head>

<body class="min-h-screen bg-white dark:bg-zinc-800">
    <flux:sidebar sticky stashable class="border-e border-zinc-200 bg-zinc-50 dark:border-zinc-700 dark:bg-zinc-900">
        <flux:sidebar.toggle class="lg:hidden" icon="x-mark" />

        <a href="{{ route('dashboard') }}" class="me-5 flex items-center space-x-2 rtl:space-x-reverse" wire:navigate>
            <x-app-logo />
        </a>

        <flux:navlist variant="outline">
            <flux:navlist.group :heading="__('Plataforma')" class="grid">
                <flux:navlist.item icon="home" :href="route('dashboard')" :current="request()->routeIs('dashboard')"
                    wire:navigate>{{ __('Dashboard') }}
                </flux:navlist.item>
            </flux:navlist.group>
        </flux:navlist>
        <flux:navlist variant="outline">
            @canany(['gestionar propiedades', 'gestionar contactos', 'gestionar usuarios'])

                <flux:navlist.group :heading="__('Gestión')">
                    @can('gestionar propiedades')
                        <flux:navlist.item icon="home-modern" :href="route('dashboard.properties.index')"
                            :current="request()->routeIs('properties.*')" wire:navigate>
                            {{ __('Propiedades') }}
                        </flux:navlist.item>
                    @endcan
                    @can('gestionar contactos')
                        <flux:navlist.item icon="envelope" :href="route('dashboard.contacts.index')"
                            :current="request()->routeIs('contacts.*')" wire:navigate>
                            {{ __('Contactos') }}
                        </flux:navlist.item>
                    @endcan
                    @can('gestionar usuarios')
                        <flux:navlist.item icon="users" :href="route('dashboard.users.index')"
                            :current="request()->routeIs('users.*')" wire:navigate>
                            {{ __('Usuarios') }}
                        </flux:navlist.item>
                    @endcan
                </flux:navlist.group>
            @endcanany

            @canany(['gestionar recursos'])
                <flux:navlist.group :heading="__('Catálogos')">
                    @can('gestionar recursos')
                        <flux:navlist.item icon="star" :href="route('dashboard.property-features.index')"
                            :current="request()->routeIs('property-features.*')" wire:navigate>
                            {{ __('Características') }}
                        </flux:navlist.item>
                    @endcan
                    @can('gestionar recursos')
                        <flux:navlist.item icon="building" :href="route('dashboard.property-types.index')"
                            :current="request()->routeIs('property-types.*')" wire:navigate>
                            {{ __('Tipos de propiedad') }}

                        </flux:navlist.item>
                    @endcan

                    @can('gestionar recursos')
                        <flux:navlist.item icon="map" :href="route('dashboard.provinces.index')"
                            :current="request()->routeIs('dashboard.provinces.*')" wire:navigate>
                            {{ __('Provincias') }}
                        </flux:navlist.item>
                    @endcan
                    @can('gestionar recursos')
                        <flux:navlist.item icon="map" :href="route('dashboard.cities.index')"
                            :current="request()->routeIs('dashboard.cities.*')" wire:navigate>
                            {{ __('Ciudades') }}
                        </flux:navlist.item>
                    @endcan
                    @can('gestionar recursos')
                        <flux:navlist.item icon="map" :href="route('dashboard.neighborhoods.index')"
                            :current="request()->routeIs('dashboard.neighborhoods.*')" wire:navigate>
                            {{ __('Barrios') }}
                        </flux:navlist.item>
                    @endcan
                </flux:navlist.group>
            @endcanany

        </flux:navlist>



        <flux:spacer />


        <!-- Desktop User Menu -->
        <flux:dropdown position="bottom" align="start">
            <flux:profile :name="auth()->user()->name" :initials="auth()->user()->initials()"
                icon-trailing="chevrons-up-down" />

            <flux:menu class="w-[220px]">
                <flux:menu.radio.group>
                    <div class="p-0 text-sm font-normal">
                        <div class="flex items-center gap-2 px-1 py-1.5 text-start text-sm">
                            <span class="relative flex h-8 w-8 shrink-0 overflow-hidden rounded-lg">
                                <span
                                    class="flex h-full w-full items-center justify-center rounded-lg bg-neutral-200 text-black dark:bg-neutral-700 dark:text-white">
                                    {{ auth()->user()->initials() }}
                                </span>
                            </span>

                            <div class="grid flex-1 text-start text-sm leading-tight">
                                <span class="truncate font-semibold">{{ auth()->user()->name }}</span>
                                <span class="truncate text-xs">{{ auth()->user()->email }}</span>
                            </div>
                        </div>
                    </div>
                </flux:menu.radio.group>

                <flux:menu.separator />

                <flux:menu.radio.group>
                    <flux:menu.item :href="route('settings.profile')" icon="cog" wire:navigate>
                        {{ __('Configuración') }}</flux:menu.item>
                </flux:menu.radio.group>

                <flux:menu.separator />

                <form method="POST" action="{{ route('logout') }}" class="w-full">
                    @csrf
                    <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle" class="w-full">
                        {{ __('Desconectar') }}
                    </flux:menu.item>
                </form>
            </flux:menu>
        </flux:dropdown>
    </flux:sidebar>

    <!-- Mobile User Menu -->
    <flux:header class="lg:hidden">
        <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left" />

        <flux:spacer />

        <flux:dropdown position="top" align="end">
            <flux:profile :initials="auth()->user()->initials()" icon-trailing="chevron-down" />

            <flux:menu>
                <flux:menu.radio.group>
                    <div class="p-0 text-sm font-normal">
                        <div class="flex items-center gap-2 px-1 py-1.5 text-start text-sm">
                            <span class="relative flex h-8 w-8 shrink-0 overflow-hidden rounded-lg">
                                <span
                                    class="flex h-full w-full items-center justify-center rounded-lg bg-neutral-200 text-black dark:bg-neutral-700 dark:text-white">
                                    {{ auth()->user()->initials() }}
                                </span>
                            </span>

                            <div class="grid flex-1 text-start text-sm leading-tight">
                                <span class="truncate font-semibold">{{ auth()->user()->name }}</span>
                                <span class="truncate text-xs">{{ auth()->user()->email }}</span>
                            </div>
                        </div>
                    </div>
                </flux:menu.radio.group>

                <flux:menu.separator />

                <flux:menu.radio.group>
                    <flux:menu.item :href="route('settings.profile')" icon="cog" wire:navigate>
                        {{ __('Settings') }}</flux:menu.item>
                </flux:menu.radio.group>

                <flux:menu.separator />

                <form method="POST" action="{{ route('logout') }}" class="w-full">
                    @csrf
                    <flux:menu.item as="button" type="submit" icon="arrow-right-start-on-rectangle" class="w-full">
                        {{ __('Log Out') }}
                    </flux:menu.item>
                </form>
            </flux:menu>
        </flux:dropdown>
    </flux:header>

    {{ $slot }}

    @fluxScripts
</body>

</html>
