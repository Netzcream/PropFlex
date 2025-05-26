@extends('layouts.public')

@section('title', 'Propiedades en venta y alquiler')

@section('content')

    <!-- Buscador/Filtros -->
    <section class="bg-white rounded-2xl shadow p-4 mb-8">
        <form method="GET" class="flex flex-col md:flex-row items-stretch gap-3">
            <input type="text" name="q" value="{{ request('q') }}" placeholder="Buscar por ubicación, barrio, etc."
                class="flex-1 px-4 py-2 rounded-lg border border-gray-300 focus:outline-blue-500" />


            <select name="city" class="px-3 py-2 rounded-lg border border-gray-300 focus:outline-blue-500">
                <option value="">Todas las ciudades</option>
                @foreach ($cities as $city)
                    <option value="{{ $city->uuid }}" @selected(request('city') == $city->uuid)>
                        {{ $city->name }}
                    </option>
                @endforeach
            </select>

            <select name="type" class="px-3 py-2 rounded-lg border border-gray-300 focus:outline-blue-500">
                <option value="">Cualquier tipo</option>
                @foreach ($types as $type)
                    <option value="{{ $type->uuid }}" @selected(request('type') == $type->uuid)>
                        {{ $type->name }}
                    </option>
                @endforeach
            </select>

            <select name="operation" class="px-3 py-2 rounded-lg border border-gray-300 focus:outline-blue-500">
                <option value="">Cualquier operación</option>
                @foreach ($operations as $operation)
                    <option value="{{ $operation->uuid }}" @selected(request('operation') == $operation->uuid)>
                        {{ $operation->name }}
                    </option>
                @endforeach
            </select>

            <input type="number" name="min" value="{{ request('min') }}" placeholder="Mín. $"
                class="w-32 px-3 py-2 rounded-lg border border-gray-300 focus:outline-blue-500" />
            <input type="number" name="max" value="{{ request('max') }}" placeholder="Máx. $"
                class="w-32 px-3 py-2 rounded-lg border border-gray-300 focus:outline-blue-500" />

            <button type="submit"
                class="px-5 py-2 rounded-lg bg-blue-700 text-white font-semibold hover:bg-blue-800 transition">
                Filtrar
            </button>
        </form>
    </section>

    <!-- Listado de Propiedades -->
    <section>
        <div class="flex items-center justify-between mb-4">

            <h2 class="text-2xl font-semibold text-blue-800">
                {{ $onlyRecent ? 'Propiedades vistas recientemente' : 'Propiedades disponibles' }}
            </h2>


            <span class="text-gray-600 text-sm">{{ $properties->total() }} resultados</span>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
            @forelse($properties as $property)
                <x-property.card :property="$property" :recentMap="$recentMap" />
            @empty
                <div class="col-span-3 text-gray-500 p-8 text-center">No se encontraron propiedades con esos filtros.</div>
            @endforelse
        </div>
    </section>

    <!-- Paginación -->
    <div class="w-full mt-10">
        {{ $properties->withQueryString()->links('pagination::tailwind') }}
    </div>
@endsection
