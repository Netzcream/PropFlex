@extends('layouts.public')

@section('title', $property->title)

@section('content')
    <section class="bg-white rounded-2xl shadow p-6 md:p-10 max-w-4xl mx-auto">

        @php
            $gallery = $property->getMedia('photos');
        @endphp

        <div x-data="{
            images: [
                @foreach ($gallery as $media)
                { url: '{{ $media->hasGeneratedConversion('large') ? $media->getUrl('large') : $media->getUrl() }}',
                  thumb: '{{ $media->hasGeneratedConversion('thumb') ? $media->getUrl('thumb') : $media->getUrl() }}',
                  alt: 'Foto {{ $loop->iteration }} de {{ $property->title }}' }, @endforeach
            ],
            index: 0,
            open: false,
            show(idx) {
                this.index = idx;
                this.open = true;
            },
            prev() { if (this.index > 0) this.index--; },
            next() { if (this.index < this.images.length - 1) this.index++; }
        }" class="relative mb-8">
            <!-- Imagen principal -->
            <img :src="images.length && images[index].url ? images[index].url : '{{ asset('img/placeholder.png') }}'"
                :alt="images.length ? images[index].alt : 'Sin imagen'"
                class="w-full h-60 md:h-96 object-cover rounded-lg shadow mb-3 cursor-pointer"
                @click="if(images.length) open = true" />

            <!-- Galería thumbnails: grid de 6 columnas -->
            <div x-show="images.length" class="grid grid-cols-6 gap-3 w-full max-w-full pb-2 mt-2">
                <!-- Mostrar hasta 5 imágenes -->
                <template x-for="(img, idx) in images.slice(0,5)" :key="idx">
                    <img :src="img.thumb" :alt="img.alt"
                        class="w-full h-24 md:h-32 object-cover rounded-lg border cursor-pointer transition-all duration-150
                   hover:scale-105 hover:shadow-lg"
                        :class="idx === index ? 'ring-2 ring-blue-600 opacity-100' : 'opacity-70 hover:opacity-100'"
                        @click="index = idx" />
                </template>

                <!-- Sexta tarjeta: puede ser thumb normal o '+n' overlay -->
                <template x-if="images.length > 6">
                    <div class="relative w-full h-24 md:h-32 rounded-lg border overflow-hidden cursor-pointer group"
                        @click="index = 5; open = true">
                        <img :src="images[5].thumb" :alt="images[5].alt"
                            class="w-full h-full object-cover opacity-60 group-hover:opacity-80 transition" />
                        <div class="absolute inset-0 flex items-center justify-center bg-black/50">
                            <span class="text-white text-xl md:text-2xl font-bold drop-shadow-lg">
                                +<span x-text="images.length - 5"></span>
                            </span>
                        </div>
                    </div>
                </template>
                <template x-if="images.length === 6">
                    <img :src="images[5].thumb" :alt="images[5].alt"
                        class="w-full h-24 md:h-32 object-cover rounded-lg border cursor-pointer transition-all duration-150
                    hover:scale-105 hover:shadow-lg"
                        :class="5 === index ? 'ring-2 ring-blue-600 opacity-100' : 'opacity-70 hover:opacity-100'"
                        @click="index = 5" />
                </template>

                <!-- Tarjetas "vacías" si hay menos de 6, para ocupar todo el ancho -->
                <template x-for="n in Math.max(0, 6 - Math.min(images.length, 6))" :key="'empty-' + n">
                    <div class="w-full h-24 md:h-32 rounded-lg border bg-gray-100 opacity-0"></div>
                </template>
            </div>

            <!-- Lightbox/Modal -->
            <div x-show="open && images.length" x-transition
                class="fixed inset-0 bg-black bg-opacity-90 flex flex-col items-center justify-center z-50"
                @keydown.window.escape="open = false" @click.self="open = false">
                <div class="relative flex items-center w-full h-full justify-center">
                    <button x-show="index > 0" @click="prev"
                        class="absolute left-3 top-1/2 -translate-y-1/2 text-white text-4xl bg-black/30 hover:bg-black/50 rounded-full px-3 py-2"
                        title="Anterior">&larr;</button>

                    <img :src="images[index].url" :alt="images[index].alt"
                        class="max-w-full max-h-[80vh] rounded-lg shadow-lg" />

                    <button x-show="index < images.length - 1" @click="next"
                        class="absolute right-3 top-1/2 -translate-y-1/2 text-white text-4xl bg-black/30 hover:bg-black/50 rounded-full px-3 py-2"
                        title="Siguiente">&rarr;</button>

                    <button @click="open = false"
                        class="absolute top-6 right-8 text-white text-4xl font-bold hover:text-red-400"
                        title="Cerrar">&times;</button>
                </div>
                <div class="mt-2 text-white text-sm opacity-80">
                    <span x-text="(index+1) + ' / ' + images.length"></span>
                </div>
            </div>
        </div>










        {{-- Información principal --}}
        <div class="mb-6">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-2">
                <h1 class="text-2xl font-bold text-blue-800">{{ $property->title }}</h1>
                <span
                    class="bg-green-100 text-green-700 text-xs px-3 py-1 rounded-full font-semibold uppercase tracking-wide">
                    {{ $property->propertyStatus->name ?? 'Sin estado' }}
                </span>
            </div>
            <div class="text-gray-500 text-sm mt-1">
                {{ $property->neighborhood->name ?? '' }}, {{ $property->city->name ?? '' }}
            </div>
        </div>

        {{-- Precio y acción --}}
        <div class="flex items-center justify-between gap-4 mb-6">
            <div class="text-2xl text-blue-700 font-extrabold">
                ${{ number_format($property->price, 0, ',', '.') }} {{ $property->currency }}
            </div>
            <button onclick="document.getElementById('form-contacto').scrollIntoView({behavior: 'smooth'});" type="button"
                class="cursor-pointer px-4 py-2 rounded-lg bg-blue-700 text-white font-semibold hover:bg-blue-800 transition text-sm">
                Me interesa
            </button>
        </div>

        {{-- Detalles técnicos --}}
        <div class="flex flex-wrap gap-4 mb-6">
            <div class="bg-gray-100 rounded-lg px-4 py-2 text-gray-700 text-sm flex items-center gap-2">
                <span class="font-medium">Ambientes:</span> {{ $property->rooms }}
            </div>
            <div class="bg-gray-100 rounded-lg px-4 py-2 text-gray-700 text-sm flex items-center gap-2">
                <span class="font-medium">Superficie:</span> {{ $property->surface }} m²
            </div>
            <div class="bg-gray-100 rounded-lg px-4 py-2 text-gray-700 text-sm flex items-center gap-2">
                <span class="font-medium">Baños:</span> {{ $property->bathrooms }}
            </div>
            <div class="bg-gray-100 rounded-lg px-4 py-2 text-gray-700 text-sm flex items-center gap-2">
                <span class="font-medium">Cochera:</span>
                {{ $property->features->contains('code', 'GARAGE') ? 'Sí' : 'No' }}
            </div>
        </div>

        {{-- Descripción --}}
        <div class="mb-8">
            <h2 class="text-lg font-semibold text-blue-700 mb-1">Descripción</h2>
            <p class="text-gray-700">{{ $property->description }}</p>
        </div>

        {{-- Características adicionales --}}
        @if ($property->features->count())
            <div class="mb-6">
                <h3 class="text-base font-semibold text-blue-700 mb-2">Características</h3>
                <ul class="list-disc list-inside text-gray-700 space-y-1">
                    @foreach ($property->features as $feature)
                        <li>{{ $feature->name }}</li>
                    @endforeach
                </ul>
            </div>
        @endif




        <!-- Sección de planos (abajo de las fotos o en una columna al costado) -->

        @if ($property->hasMedia('plans'))
            <div x-data="{
                plans: [
                    @foreach ($property->getMedia('plans') as $plan)
            {
                url: '{{ $plan->getUrl() }}',
                thumb: '{{ $plan->hasGeneratedConversion('thumb') ? $plan->getUrl('thumb') : (Str::endsWith($plan->mime_type, 'pdf') ? asset('img/pdf-thumb.png') : $plan->getUrl()) }}',
                mime: '{{ $plan->mime_type }}',
                alt: 'Plano {{ $loop->iteration }} de {{ $property->title }}',
                name: '{{ $plan->file_name }}'
            }, @endforeach
                ],
                planIndex: 0,
                planOpen: false,
                showPlan(idx) {
                    this.planIndex = idx;
                    this.planOpen = true;
                },
                prevPlan() { if (this.planIndex > 0) this.planIndex--; },
                nextPlan() { if (this.planIndex < this.plans.length - 1) this.planIndex++; }
            }" class="mb-4">
                <h2 class="text-lg font-semibold text-blue-700 mb-2">Planos</h2>
                <div class="grid grid-cols-3 md:grid-cols-4 gap-4">
                    <template x-for="(plan, idx) in plans" :key="idx">
                        <div @click="showPlan(idx)" class="cursor-pointer relative group">
                            <img :src="plan.thumb" :alt="plan.alt"
                                class="w-full h-32 md:h-40 object-cover rounded-lg border shadow-sm group-hover:shadow-md transition" />
                            <template x-if="plan.mime.endsWith('pdf')">
                                <span
                                    class="absolute top-2 right-2 bg-red-500 text-white rounded px-2 py-1 text-xs font-bold">PDF</span>
                            </template>
                        </div>
                    </template>
                </div>
                <!-- Modal/Lightbox para planos -->
                <div x-show="planOpen && plans.length" x-transition
                    class="fixed inset-0 bg-black bg-opacity-90 flex flex-col items-center justify-center z-50"
                    @keydown.window.escape="planOpen = false" @click.self="planOpen = false">
                    <div class="relative flex items-center w-full h-full justify-center">
                        <button x-show="planIndex > 0" @click="prevPlan"
                            class="absolute left-3 top-1/2 -translate-y-1/2 text-white text-4xl bg-black/30 hover:bg-black/50 rounded-full px-3 py-2"
                            title="Anterior">&larr;</button>
                        <!-- Si es PDF, mostrás iframe o enlace, si es imagen, imagen -->
                        <template x-if="plans[planIndex].mime.endsWith('pdf')">
                            <iframe :src="plans[planIndex].url" class="w-[80vw] h-[80vh] bg-white rounded-lg shadow-lg"
                                frameborder="0"></iframe>
                        </template>
                        <template x-if="!plans[planIndex].mime.endsWith('pdf')">
                            <img :src="plans[planIndex].url" :alt="plans[planIndex].alt"
                                class="max-w-full max-h-[80vh] rounded-lg shadow-lg" />
                        </template>
                        <button x-show="planIndex < plans.length - 1" @click="nextPlan"
                            class="absolute right-3 top-1/2 -translate-y-1/2 text-white text-4xl bg-black/30 hover:bg-black/50 rounded-full px-3 py-2"
                            title="Siguiente">&rarr;</button>
                        <button @click="planOpen = false"
                            class="absolute top-6 right-8 text-white text-4xl font-bold hover:text-red-400"
                            title="Cerrar">&times;</button>
                    </div>
                    <div class="mt-2 text-white text-sm opacity-80">
                        <span x-text="plans[planIndex].name"></span>
                    </div>
                </div>
            </div>
        @endif
        @if ($property->latitude && $property->longitude)
            <div class="max-w-4xl mx-auto mt-8">
                <h2 class="text-lg font-semibold text-blue-700 mb-2">Ubicación en el mapa</h2>
                <div id="map" class="w-full rounded-xl shadow h-72"></div>

            </div>

            @push('styles')
                <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
            @endpush
            @push('scripts')
                <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
                <script>
                    function renderMap() {
                        // Limpiar el div (por si el componente ya estaba renderizado)

                        if (typeof L === 'undefined') {
                            setTimeout(renderMap, 100);
                            return;
                        }

                        if (window.myMap) {
                            window.myMap.remove();
                        }
                        var map = L.map('map').setView([{{ $property->latitude }}, {{ $property->longitude }}], 16);
                        window.myMap = map; // Guardar referencia global para limpiar después
                        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                            maxZoom: 19,
                            attribution: '© OpenStreetMap'
                        }).addTo(map);
                        L.marker([{{ $property->latitude }}, {{ $property->longitude }}])
                            .addTo(map)
                            .bindPopup(@json($property->title))
                            .openPopup();
                    }

                    document.addEventListener('DOMContentLoaded', renderMap);

                    // Livewire v3+: usar livewire:navigated, si usás v2 usar message.processed
                    window.addEventListener('livewire:navigated', renderMap);
                </script>
            @endpush
        @endif



        <div class="text-gray-500 text-sm text-right">
            {{ $property->visits()->count() ?? 0 }} {{ Str::plural('visita', $property->visits()->count() ?? 0) }}
        </div>
    </section>
    <div id="form-contacto" class="max-w-4xl mx-auto mt-10">
        @livewire('contact-property-form', ['property' => $property])
    </div>
@endsection
