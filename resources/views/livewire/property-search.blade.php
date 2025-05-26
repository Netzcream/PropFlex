<!-- resources/views/livewire/property-search.blade.php -->
<section class="bg-blue-50 rounded-2xl p-6 md:p-12 mb-10 flex flex-col md:flex-row items-center justify-between gap-8">
    <div class="flex-1">
        <h1 class="text-3xl md:text-4xl font-bold text-blue-800 mb-2">Bienvenido a PropFlex</h1>
        <p class="text-lg text-blue-900 mb-6">La forma más fácil y profesional de gestionar tus propiedades
            inmobiliarias.</p>
        <!-- Buscador -->
        <form wire:submit.prevent="submit" class="flex flex-col sm:flex-row gap-3">
            <input type="text" wire:model.defer="search" placeholder="Buscar por barrio, ciudad, etc."
                class="flex-1 px-4 py-2 rounded-lg border border-gray-300 focus:outline-blue-500" />
            <select wire:model.defer="type" class="px-3 py-2 rounded-lg border border-gray-300 focus:outline-blue-500">
                <option value="">Indistito</option>
                @foreach ($types as $type)
                    <option value="{{ $type->uuid }}">{{ $type->name }}</option>
                @endforeach
            </select>
            <select wire:model.defer="city" class="px-3 py-2 rounded-lg border border-gray-300 focus:outline-blue-500">
                <option value="">Todas</option>
                @foreach ($cities as $city)
                    <option value="{{ $city->uuid }}">{{ $city->name }}</option>
                @endforeach
            </select>
            <button type="submit"
                class="px-5 py-2 rounded-lg bg-blue-700 text-white font-semibold hover:bg-blue-800 transition cursor-pointer">
                Buscar
            </button>
        </form>
    </div>


    @php
        $imgs = ['img/home/bg-1-min.png', 'img/home/bg-2-min.png', 'img/home/bg-3-min.png', 'img/home/bg-4-min.png', 'img/home/bg-5-min.png'];
        $index = array_rand($imgs);
    @endphp
    <img src="{{ $imgs[$index] }}" alt="PropFlex" class="rounded-2xl shadow-xl w-full max-w-xs md:max-w-md">
</section>
