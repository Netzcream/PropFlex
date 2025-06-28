<div class="mb-4 flex flex-wrap gap-2 items-end w-full">

    <div class="max-w-[210px] flex-1">
        <flux:input wire:keyup.debounce.500ms="filter()" wire:model.debounce.500ms="search" label="{{ __('Buscar') }}" />
    </div>

    <div class="w-[160px]">
        <flux:select wire:model="type" wire:change="filter" label="{{ __('Tipo') }}">
            <flux:select.option value="">{{ __('Todos') }}</flux:select.option>
            @foreach ($propertyTypes as $type)
                <flux:select.option value="{{ $type->id }}">{{ $type->name }}</flux:select.option>
            @endforeach
        </flux:select>
    </div>

    <div class="w-[160px]">
        <flux:select wire:model="operation" wire:change="filter" label="{{ __('Operación') }}">
            <flux:select.option value="">{{ __('Todas') }}</flux:select.option>
            @foreach ($propertyOperationTypes as $op)
                <flux:select.option value="{{ $op->id }}">{{ $op->name }}</flux:select.option>
            @endforeach
        </flux:select>
    </div>

    <div class="w-[150px]">
        <flux:select wire:model="status" wire:change="filter" label="{{ __('Estado') }}">
            <flux:select.option value="">{{ __('Todos') }}</flux:select.option>
            @foreach ($propertyStatuses as $status)
                <flux:select.option value="{{ $status->id }}">{{ $status->name }}</flux:select.option>
            @endforeach
        </flux:select>
    </div>

    <div class="w-[130px]">
        <flux:select wire:model="is_featured" wire:change="filter" label="{{ __('Destacada') }}">
            <flux:select.option value="">{{ __('Todas') }}</flux:select.option>
            <flux:select.option value="1">{{ __('Sí') }}</flux:select.option>
            <flux:select.option value="0">{{ __('No') }}</flux:select.option>
        </flux:select>
    </div>

    <div class="w-[130px]">
        <flux:select wire:model="is_published" wire:change="filter" label="{{ __('Publicado') }}">
            <flux:select.option value="">{{ __('Todos') }}</flux:select.option>
            <flux:select.option value="1">{{ __('Sí') }}</flux:select.option>
            <flux:select.option value="0">{{ __('No') }}</flux:select.option>
        </flux:select>
    </div>

</div>


<div class="flex flex-col">
    <div class="-m-1.5 overflow-x-auto">
        <div class="p-1.5 min-w-full inline-block align-middle">
            <div class="overflow-hidden border border-zinc-700 rounded-lg">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-neutral-700">
                    <thead>
                        <tr>
                            <th
                                class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                                {{ __('Foto') }}
                            </th>
                            <th class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500 cursor-pointer"
                                wire:click="sort('title')">
                                <span class="inline-flex items-center gap-1 whitespace-nowrap cursor-pointer">
                                    {{ __('Título') }}
                                    @if ($sortBy === 'title')
                                        {!! $sortDirection === 'asc' ? '↑' : '↓' !!}
                                    @endif
                                </span>
                            </th>
                            <th class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500 cursor-pointer"
                                wire:click="sort('property_type_id')">
                                <span class="inline-flex items-center gap-1 whitespace-nowrap cursor-pointer">
                                    {{ __('Tipo') }}
                                    @if ($sortBy === 'property_type_id')
                                        {!! $sortDirection === 'asc' ? '↑' : '↓' !!}
                                    @endif
                                </span>
                            </th>
                            <th class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500 cursor-pointer"
                                wire:click="sort('property_operation_type_id')">
                                <span class="inline-flex items-center gap-1 whitespace-nowrap cursor-pointer">
                                    {{ __('Operación') }}
                                    @if ($sortBy === 'property_operation_type_id')
                                        {!! $sortDirection === 'asc' ? '↑' : '↓' !!}
                                    @endif
                                </span>
                            </th>
                            <th class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500 cursor-pointer"
                                wire:click="sort('property_status_id')">
                                <span class="inline-flex items-center gap-1 whitespace-nowrap cursor-pointer">
                                    {{ __('Estado') }}
                                    @if ($sortBy === 'property_status_id')
                                        {!! $sortDirection === 'asc' ? '↑' : '↓' !!}
                                    @endif
                                </span>
                            </th>
                            <th class="px-6 py-3 text-end text-xs font-medium text-gray-500 uppercase dark:text-neutral-500 cursor-pointer"
                                wire:click="sort('price')">
                                <span class="inline-flex items-center gap-1 whitespace-nowrap cursor-pointer">
                                    {{ __('Precio') }}
                                    @if ($sortBy === 'price')
                                        {!! $sortDirection === 'asc' ? '↑' : '↓' !!}
                                    @endif
                                </span>
                            </th>
                            <th
                                class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                                {{ __('Ubicación') }}
                            </th>
                            <th
                                class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                                {{ __('Destacada') }}
                            </th>
                            <th
                                class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                                {{ __('Agente') }}
                            </th>
                            <th
                                class="px-6 py-3 text-end text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                                {{ __('Acciones') }}
                            </th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-200 dark:divide-neutral-700">
                        @forelse ($properties as $row)
                            <tr>
                                <td class="px-6 py-4">
                                    <img src="{{ $row->getFirstMediaUrl('photos', 'thumb') ?: '/img/placeholder.png' }}"
                                        alt="Foto" class="rounded w-16 h-12 object-cover" />
                                </td>
                                <td class="px-6 py-4 text-sm font-medium text-gray-800 dark:text-neutral-200">
                                    {{ $row->title }}
                                    <div class="text-xs text-gray-500">{{ $row->code }}</div>
                                    <div class="text-xs text-gray-500">{{ $row->address }}</div>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-800 dark:text-neutral-200">
                                    {{ $row->propertyType->name ?? '-' }}
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-800 dark:text-neutral-200">
                                    {{ $row->propertyOperationType->name ?? '-' }}
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-800 dark:text-neutral-200">
                                    <span
                                        class="
                                        inline-block rounded px-2 py-0.5 text-xs font-semibold
                                        {{ $row->propertyStatus->name === 'Disponible'
                                            ? 'bg-green-100 text-green-700'
                                            : ($row->propertyStatus->name === 'Reservada'
                                                ? 'bg-yellow-100 text-yellow-700'
                                                : 'bg-red-100 text-red-700') }}">
                                        {{ $row->propertyStatus->name ?? '-' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-end text-sm text-gray-800 dark:text-neutral-200">
                                    {{ $row->currency ?? '$' }} {{ number_format($row->price, 0, ',', '.') }}
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-800 dark:text-neutral-200">
                                    {{ $row->province->name ?? '' }}
                                    {{ $row->city ? ' / ' . $row->city->name : '' }}
                                    {{ $row->neighborhood ? ' / ' . $row->neighborhood->name : '' }}
                                </td>
                                <td class="px-6 py-4 text-center text-sm text-gray-800 dark:text-neutral-200">
                                    <span class="inline-flex items-center justify-center w-8 h-8">
                                        @if (auth()->user()->isAdmin() || $row->user_id === auth()->id())
                                            <button wire:click="toggleFeatured('{{ $row->uuid }}')"
                                                class="focus:outline-none group w-8 h-8 flex items-center justify-center">
                                                @if ($row->is_featured)
                                                    <span title="Destacada"
                                                        class="text-yellow-400 group-hover:scale-110 transition-transform duration-150">
                                                        {{-- Icono estrella llena --}}
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="20"
                                                            height="20" viewBox="0 0 24 24" fill="none"
                                                            stroke="currentColor" stroke-width="2"
                                                            stroke-linecap="round" stroke-linejoin="round"
                                                            class="lucide lucide-star-icon lucide-star">
                                                            <path
                                                                d="M11.525 2.295a.53.53 0 0 1 .95 0l2.31 4.679a2.123 2.123 0 0 0 1.595 1.16l5.166.756a.53.53 0 0 1 .294.904l-3.736 3.638a2.123 2.123 0 0 0-.611 1.878l.882 5.14a.53.53 0 0 1-.771.56l-4.618-2.428a2.122 2.122 0 0 0-1.973 0L6.396 21.01a.53.53 0 0 1-.77-.56l.881-5.139a2.122 2.122 0 0 0-.611-1.879L2.16 9.795a.53.53 0 0 1 .294-.906l5.165-.755a2.122 2.122 0 0 0 1.597-1.16z" />
                                                        </svg>
                                                    </span>
                                                @else
                                                    <span title="No destacada"
                                                        class="text-gray-400 group-hover:text-yellow-400 group-hover:scale-110 transition-all duration-150">
                                                        {{-- Icono estrella vacía --}}
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="20"
                                                            height="20" viewBox="0 0 24 24" fill="none"
                                                            stroke="currentColor" stroke-width="2"
                                                            stroke-linecap="round" stroke-linejoin="round"
                                                            class="lucide lucide-star-off-icon lucide-star-off">
                                                            <path
                                                                d="M8.34 8.34 2 9.27l5 4.87L5.82 21 12 17.77 18.18 21l-.59-3.43" />
                                                            <path d="M18.42 12.76 22 9.27l-6.91-1L12 2l-1.44 2.91" />
                                                            <line x1="2" x2="22" y1="2"
                                                                y2="22" />
                                                        </svg>
                                                    </span>
                                                @endif
                                            </button>
                                        @else
                                            @if ($row->is_featured)
                                                <span title="Destacada" class="text-yellow-400">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="20"
                                                        height="20" viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        class="lucide lucide-star-icon lucide-star">
                                                        <path
                                                            d="M11.525 2.295a.53.53 0 0 1 .95 0l2.31 4.679a2.123 2.123 0 0 0 1.595 1.16l5.166.756a.53.53 0 0 1 .294.904l-3.736 3.638a2.123 2.123 0 0 0-.611 1.878l.882 5.14a.53.53 0 0 1-.771.56l-4.618-2.428a2.122 2.122 0 0 0-1.973 0L6.396 21.01a.53.53 0 0 1-.77-.56l.881-5.139a2.122 2.122 0 0 0-.611-1.879L2.16 9.795a.53.53 0 0 1 .294-.906l5.165-.755a2.122 2.122 0 0 0 1.597-1.16z" />
                                                    </svg>
                                                </span>
                                            @else
                                                <span title="No destacada" class="text-gray-400">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="20"
                                                        height="20" viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        class="lucide lucide-star-off-icon lucide-star-off">
                                                        <path
                                                            d="M8.34 8.34 2 9.27l5 4.87L5.82 21 12 17.77 18.18 21l-.59-3.43" />
                                                        <path d="M18.42 12.76 22 9.27l-6.91-1L12 2l-1.44 2.91" />
                                                        <line x1="2" x2="22" y1="2"
                                                            y2="22" />
                                                    </svg>
                                                </span>
                                            @endif
                                        @endif
                                    </span>
                                </td>


                                <td class="px-6 py-4 text-sm text-gray-800 dark:text-neutral-200">
                                    {{ $row->user->name ?? '-' }}
                                </td>
                                <td class="px-6 py-4 text-end text-sm font-medium">





                                <td class="px-6 py-4 text-end text-sm font-medium">
                                    @if (auth()->user()->isAdmin() || $row->user_id === auth()->user()->id)
                                        <span
                                            class="text-xs text-gray-400 dark:text-neutral-500 inline-flex items-center whitespace-nowrap">


                                            <a wire:navigate
                                                href="{{ route('dashboard.properties.edit', $row->uuid) }}"
                                                class="inline-flex items-center gap-x-2 text-sm  rounded-lg border border-transparent text-blue-600 hover:text-blue-800 dark:text-blue-500 dark:hover:text-blue-400">
                                                {{ __('Editar') }}
                                            </a>
                                            <flux:modal.trigger name="confirm-delete-property">
                                                <button wire:click="confirmDelete('{{ $row->uuid }}')"
                                                    class="cursor-pointer ml-2 inline-flex items-center gap-x-2 text-sm  rounded-lg text-red-600 hover:text-red-800 dark:text-red-500 dark:hover:text-red-400">
                                                    {{ __('Eliminar') }}
                                                </button>
                                            </flux:modal.trigger>
                                        </span>
                                    @else
                                        <span
                                            class="text-xs text-gray-400 dark:text-neutral-500 inline-flex items-center whitespace-nowrap">{{ __('Sin permisos') }}</span>
                                    @endif
                                </td>






                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="10"
                                    class="px-6 py-4 text-sm text-center text-gray-500 dark:text-neutral-400">
                                    {{ __('No hay propiedades cargadas.') }}
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="mt-4">
        {{ $properties->links() }}
    </div>

    <flux:modal name="confirm-delete-property" class="min-w-[22rem]">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">{{ __('¿Eliminar propiedad?') }}</flux:heading>
                <flux:text class="mt-2">
                    {{ __('Esta acción eliminará la propiedad. ¿Estás seguro?') }}
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


    <script>
        let livewireListenersRegistered = false;

        function registerLivewireListeners() {
            if (livewireListenersRegistered) return;

            window.Livewire.on('property-deleted', () => {
                const modal = document.querySelector(`dialog[data-modal="confirm-delete-property"]`);
                if (modal) {
                    modal.dispatchEvent(new CustomEvent('modal-close', {
                        bubbles: true,
                        detail: {
                            name: 'confirm-delete-property'
                        }
                    }));
                }
            });


            livewireListenersRegistered = true;
        }

        // Ejecutar al cargar la página completamente
        document.addEventListener('DOMContentLoaded', () => {
            registerLivewireListeners();
        });

        // Ejecutar también después de que Livewire haya navegado a una nueva página
        document.addEventListener('livewire:navigated', () => {
            registerLivewireListeners();
        });
    </script>


</div>
