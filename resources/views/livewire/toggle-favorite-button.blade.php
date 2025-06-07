@props(['top' => 'top-6', 'right' => 'right-6'])
<span wire:click="toggle" type="button"
    class="absolute {{ $top }} {{ $right }} z-10 bg-white/80 hover:bg-white rounded-full px-2 py-1  shadow-md transition"
    title="Agregar a favoritos">
    <i
        class="fa{{ auth()->user()->favorites->contains('property_id', $property->id) ? 's' : 'r' }} fa-heart text-red-400 size-4"></i>
</span>
