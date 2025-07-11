<x-data-table :pagination="$cities">

    <x-slot name="filters">
        <div class="max-w-[210px] flex-1">
            <flux:input wire:keyup.debounce.500ms="filter()" wire:model.debounce.500ms="search"
                label="{{ __('Buscar') }}" />
        </div>
        <div class="w-[250px]">
            <flux:select wire:model="province" wire:change="filter" label="{{ __('Provincia') }}">
                <flux:select.option value="">{{ __('Todas las provincias') }}</flux:select.option>
                @foreach ($provinces as $p)
                    <flux:select.option value="{{ $p->id }}">{{ $p->name }}</flux:select.option>
                @endforeach
            </flux:select>
        </div>
    </x-slot>

    <x-slot name="head">

        <th class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500 cursor-pointer"
            wire:click="sort('city_name')">
            <span class="inline-flex items-center gap-1 whitespace-nowrap cursor-pointer">
                {{ __('Nombre') }}
                @if ($sortBy === 'name')
                    {!! $sortDirection === 'asc' ? '↑' : '↓' !!}
                @endif
            </span>
        </th>
        <th class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500 cursor-pointer"
            wire:click="sort('city_code')">
            <span class="inline-flex items-center gap-1 whitespace-nowrap cursor-pointer">
                {{ __('Código') }}
                @if ($sortBy === 'code')
                    {!! $sortDirection === 'asc' ? '↑' : '↓' !!}
                @endif
            </span>
        </th>

        <th class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500 cursor-pointer"
            wire:click="sort('province_id')">
            <span class="inline-flex items-center gap-1 whitespace-nowrap cursor-pointer">
                {{ __('Provincia') }}
                @if ($sortBy === 'province')
                    {!! $sortDirection === 'asc' ? '↑' : '↓' !!}
                @endif
            </span>
        </th>



        <th class="px-6 py-3 text-end text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
            {{ __('Acciones') }}
        </th>

    </x-slot>

    @forelse ($cities as $row)
        <tr>

            <td class="px-6 py-4 text-sm font-medium text-gray-800 dark:text-neutral-200">
                {{ $row->name }}

            </td>
            <td class="px-6 py-4 text-sm text-gray-800 dark:text-neutral-200">
                {{ $row->code ?? '-' }}
            </td>
            <td class="px-6 py-4 text-sm text-gray-800 dark:text-neutral-200">
                {{ $row->province ?? '-' }}
            </td>

            <td class="px-6 py-4 text-end text-sm font-medium">
                @can('gestionar recursos')
                    <span class="text-xs text-gray-400 dark:text-neutral-500 inline-flex items-center whitespace-nowrap">


                        <a wire:navigate href="{{ route('dashboard.cities.edit', $row->uuid) }}"
                            class="inline-flex items-center gap-x-2 text-sm  rounded-lg border border-transparent text-blue-600 hover:text-blue-800 dark:text-blue-500 dark:hover:text-blue-400">
                            {{ __('Editar') }}
                        </a>
                        <flux:modal.trigger name="confirm-delete-city">
                            <button wire:click="confirmDelete('{{ $row->uuid }}')"
                                class="cursor-pointer ml-2 inline-flex items-center gap-x-2 text-sm  rounded-lg text-red-600 hover:text-red-800 dark:text-red-500 dark:hover:text-red-400">
                                {{ __('Eliminar') }}
                            </button>
                        </flux:modal.trigger>
                    </span>
                @else
                    <span
                        class="text-xs text-gray-400 dark:text-neutral-500 inline-flex items-center whitespace-nowrap">{{ __('Sin permisos') }}</span>
                @endcan
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="4" class="px-6 py-4 text-sm text-center text-gray-500 dark:text-neutral-400">
                {{ __('No hay barrios cargados.') }}
            </td>
        </tr>
    @endforelse

    <x-slot name="modal">
        <flux:modal name="confirm-delete-city" x-data
            @city-deleted.window="$dispatch('modal-close', { name: 'confirm-delete-city' })"
            class="min-w-[22rem]">
            <div class="space-y-6">
                <div>
                    <flux:heading size="lg">{{ __('¿Eliminar ciudad?') }}</flux:heading>
                    <flux:text class="mt-2">
                        {{ __('Esta acción eliminará la ciudad. ¿Estás seguro?') }}
                    </flux:text>
                </div>
                <div class="flex gap-2">
                    <flux:spacer />
                    <flux:modal.close>
                        <flux:button variant="ghost">{{ __('Cancelar') }}</flux:button>
                    </flux:modal.close>
                    <flux:button wire:click="delete" variant="danger">
                        {{ __('Sí, eliminar') }}
                    </flux:button>
                </div>
            </div>
        </flux:modal>
    </x-slot>

</x-data-table>
