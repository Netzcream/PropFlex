<x-data-table :pagination="$propertyFeatures">


    <x-slot name="head">
        <th class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
            {{ __('Icono') }}
        </th>
        <th class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500 cursor-pointer"
            wire:click="sort('title')">
            <span class="inline-flex items-center gap-1 whitespace-nowrap cursor-pointer">
                {{ __('Nombre') }}
                @if ($sortBy === 'name')
                    {!! $sortDirection === 'asc' ? '↑' : '↓' !!}
                @endif
            </span>
        </th>
        <th class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500 cursor-pointer"
            wire:click="sort('property_feature_id')">
            <span class="inline-flex items-center gap-1 whitespace-nowrap cursor-pointer">
                {{ __('Código') }}
                @if ($sortBy === 'code')
                    {!! $sortDirection === 'asc' ? '↑' : '↓' !!}
                @endif
            </span>
        </th>



        <th class="px-6 py-3 text-end text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
            {{ __('Acciones') }}
        </th>

    </x-slot>

    @forelse ($propertyFeatures as $row)
        <tr>
            <td class="px-6 py-4">
                @if ($row->icon)
                    <i class="fa-solid {{ $row->icon }}"></i>
                @else
                    -
                @endif

            </td>
            <td class="px-6 py-4 text-sm font-medium text-gray-800 dark:text-neutral-200">
                {{ $row->name }}

            </td>
            <td class="px-6 py-4 text-sm text-gray-800 dark:text-neutral-200">
                {{ $row->code ?? '-' }}
            </td>

            <td class="px-6 py-4 text-end text-sm font-medium">
                @can('gestionar recursos')
                    <span class="text-xs text-gray-400 dark:text-neutral-500 inline-flex items-center whitespace-nowrap">


                        <a wire:navigate href="{{ route('dashboard.property-features.edit', $row->uuid) }}"
                            class="inline-flex items-center gap-x-2 text-sm  rounded-lg border border-transparent text-blue-600 hover:text-blue-800 dark:text-blue-500 dark:hover:text-blue-400">
                            {{ __('Editar') }}
                        </a>
                        <flux:modal.trigger name="confirm-delete-property-feature">
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
                {{ __('No hay propiedades cargadas.') }}
            </td>
        </tr>
    @endforelse

    <x-slot name="modal">
        <flux:modal name="confirm-delete-property-feature" x-data
            @property-feature-deleted.window="$dispatch('modal-close', { name: 'confirm-delete-property-feature' })"
            class="min-w-[22rem]">
            <div class="space-y-6">
                <div>
                    <flux:heading size="lg">{{ __('¿Eliminar característica?') }}</flux:heading>
                    <flux:text class="mt-2">
                        {{ __('Esta acción eliminará característica. ¿Estás seguro?') }}
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


