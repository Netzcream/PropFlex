@props([
    'label' => '',
    'type' => 'text',
    'name' => '',
    'placeholder' => '',
    'required' => false,
    'autofocus' => false,
    'autocomplete' => '',
    'id' => $name,
])

<div class="mb-4">
    @if($label)
        <label for="{{ $id }}" class="block mb-1 text-sm font-medium text-gray-700">{{ $label }}</label>
    @endif
    <input
        type="{{ $type }}"
        name="{{ $name }}"
        id="{{ $id }}"
        placeholder="{{ $placeholder }}"
        @if($required) required @endif
        @if($autofocus) autofocus @endif
        @if($autocomplete) autocomplete="{{ $autocomplete }}" @endif
        {{ $attributes->merge([
            'class' => 'block w-full rounded-lg border border-gray-300 bg-white px-4 py-2 text-gray-900 placeholder-gray-400 focus:border-blue-700 focus:ring-2 focus:ring-blue-100 transition disabled:bg-gray-100'
        ]) }}
    />
    @error($name)
        <span class="text-xs text-red-600 mt-1 block">{{ $message }}</span>
    @enderror
</div>
