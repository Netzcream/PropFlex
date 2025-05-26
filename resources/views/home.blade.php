@extends('layouts.public')

@section('title', 'Inicio')

@section('content')

    @livewire('property-search')

    @if ($featured->isNotEmpty())
        <section class="mb-10">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-2xl font-semibold text-blue-800">Propiedades Destacadas</h2>
                <a href="{{ route('properties.index') }}" class="text-blue-600 hover:underline" wire:navigate>Ver todas</a>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                @foreach ($featured as $property)
                    <x-property.card :property="$property" />
                @endforeach


            </div>
        </section>

    @endif

    @if ($recent->isNotEmpty())
        <section>
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-2xl font-semibold text-blue-800">Vistas Recientes</h2>
                <a href="{{ route('properties.index', ['is_recent' => 1]) }}" class="text-blue-600 hover:underline"  wire:navigate>
                    Ver todas
                </a>
            </div>
            <div class="flex flex-wrap gap-4">
                @foreach ($recent as $property)
                    <x-property.mini-card :property="$property" />
                @endforeach
            </div>
        </section>
    @endif








@endsection
