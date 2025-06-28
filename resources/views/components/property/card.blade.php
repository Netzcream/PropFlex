<div class="relative">
    {{-- Favorito arriba del card --}}
    @auth
        @can('gestionar favoritos')
            <livewire:toggle-favorite-button :property="$property" top="top-6" right="right-6" />
        @endcan
    @endauth
    <a href="{{ route('properties.show', ['property' => $property->slug]) }}" wire:navigate
        class="bg-white rounded-xl shadow p-4 flex flex-col">
        <div class="relative mb-3">
            <img src="{{ $property->getFirstMediaUrl('photos', 'thumb') ?: asset('img/placeholder.jpg') }}"
                alt="{{ $property->title }}" class="rounded-lg w-full h-72 object-cover object-center">



            <div class="absolute top-2 left-2 flex gap-x-2 flex-wrap">

                @if (in_array($property->id, session('recently_viewed', [])))
                    <span class="px-2 py-1 bg-blue-700/80 text-white rounded text-xs font-semibold shadow">
                        Visto Recientemente
                    </span>
                @endif
                @if ($property->is_featured)
                    <span class="px-2 py-1 bg-blue-700/80 text-white rounded text-xs font-semibold shadow">
                        Destacada
                    </span>
                @endif
            </div>
        </div>
        <div class="flex-1">

            <div class="flex gap-x-2 mb-1">

                <span class="px-2 py-0.5 rounded text-xs font-semibold shadow bg-gray-400 text-white">

                    @if ($property->propertyType?->icon)
                        <i class="-ms-1 fa-solid fa-fw {{ $property->propertyType?->icon }}"></i>
                    @endif
                    {{ ucfirst($property->propertyType) }} {{-- Ej: Departamento, PH, Casa --}}
                </span>
                <span class="px-2 py-0.5 rounded text-xs font-semibold shadow bg-gray-400 text-white">
                    @if ($property->propertyOperationType?->icon)
                        <i class="-ms-1 fa-solid fa-fw {{ $property->propertyOperationType?->icon }}"></i>
                    @endif
                    {{ ucfirst($property->propertyOperationType) }} {{-- Ej: Venta, Alquiler --}}
                </span>

            </div>
            <h3 class="font-semibold text-lg text-gray-800">{{ $property->title }}</h3>
            <p class="text-sm text-gray-500 mb-1">{{ $property->rooms }} amb • {{ $property->surface }}m²</p>
            <p class="text-sm text-gray-600 mb-2">
                {{ $property->neighborhood?->name ?? '' }}, {{ $property->city?->name ?? '' }}
            </p>
        </div>
        <div class="flex items-center justify-between">
            <span class="text-blue-700 font-bold text-lg">
                ${{ number_format($property->price, 0, ',', '.') }} {{ $property->currency }}
            </span>

        </div>
    </a>
</div>
