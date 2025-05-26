<a class="bg-white rounded-lg shadow p-2 flex items-center gap-3 w-full sm:w-72" href="{{ route('properties.show', ['property' => $property->slug]) }}"  wire:navigate>


    <img src="{{ $property->getFirstMediaUrl('photos', 'thumb') ?: asset('img/placeholder.jpg') }}"
        alt="{{ $property->title }}" class="rounded-lg w-16 h-12 object-cover">

    <div>
        <h3 class="font-medium text-gray-700 text-sm truncate w-48" title="{{ $property->title }}">{{ $property->title }}</h3>
        <p class="text-xs text-gray-500 truncate w-48" title="{{ $property->rooms }} amb • {{ $property->city?->name ?? '' }}">{{ $property->rooms }} amb • {{ $property->city?->name ?? '' }}</p>

    </div>
</a>
