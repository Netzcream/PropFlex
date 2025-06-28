<div class="flex items-start max-md:flex-col">
    <div class="flex-1 self-stretch max-md:pt-6">

        <div class="relative mb-6 w-full">
            <div class="flex items-center justify-between gap-4 flex-wrap">
                <div>
                    <flux:heading size="xl" level="1">{{ __('Contactos recibidos') }}</flux:heading>
                    <flux:subheading size="lg" class="mb-6">
                        {{ __('Consultas y mensajes enviados desde la web.') }}
                    </flux:subheading>
                </div>
                {{-- Si necesitás un botón para exportar, agregar acá --}}
            </div>
            <flux:separator variant="subtle" />
        </div>

        <div class="mt-5 w-full ">
            <section class="w-full">
                <div class="flex flex-col">
                    <div class="-m-1.5 overflow-x-auto">
                        <div class="p-1.5 min-w-full inline-block align-middle">
                            <div class="overflow-hidden border border-zinc-700 rounded-lg">

                                <div
                                    class="flex items-center justify-between p-3 bg-zinc-50 dark:bg-neutral-900 border-b border-zinc-200 dark:border-neutral-700 gap-4 flex-wrap">
                                    <div class="w-72 max-w-full">
                                        <flux:input wire:model.live.debounce.400ms="search"
                                            placeholder="Buscar contacto, email, teléfono o mensaje..." size="sm"
                                            class="w-full" />
                                    </div>
                                    <div class="w-60 max-w-xs">
                                        <flux:select wire:model.live="property" size="sm" class="w-full">
                                            <flux:select.option value="">{{ __('Todas las propiedades') }}
                                            </flux:select.option>
                                            @foreach ($properties as $p)
                                                <flux:select.option value="{{ $p->id }}">{{ $p->title }}
                                                </flux:select.option>
                                            @endforeach
                                        </flux:select>
                                    </div>
                                </div>


                                <table class="min-w-full divide-y divide-gray-200 dark:divide-neutral-700">
                                    <thead>
                                        <tr>
                                            <th class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500 cursor-pointer"
                                                wire:click="sort('name')">
                                                <span
                                                    class="inline-flex items-center gap-1 whitespace-nowrap cursor-pointer">
                                                    {{ __('Nombre') }}
                                                    @if ($sortBy === 'name')
                                                        {!! $sortDirection === 'asc' ? '↑' : '↓' !!}
                                                    @endif
                                                </span>
                                            </th>
                                            <th class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500 cursor-pointer"
                                                wire:click="sort('email')">
                                                {{ __('Email') }}
                                            </th>
                                            <th class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500 cursor-pointer"
                                                wire:click="sort('phone')">
                                                {{ __('Teléfono') }}
                                            </th>
                                            <th class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500 cursor-pointer"
                                                wire:click="sort('property_id')">
                                                {{ __('Propiedad') }}
                                            </th>
                                            <th class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500 cursor-pointer"
                                                wire:click="sort('created_at')">
                                                {{ __('Fecha') }}
                                            </th>
                                            <th
                                                class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                                                {{ __('Mensaje') }}
                                            </th>
                                            <th
                                                class="px-6 py-3 text-end text-xs font-medium text-gray-500 uppercase dark:text-neutral-500">
                                                {{ __('Acciones') }}
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200 dark:divide-neutral-700">
                                        @forelse ($contacts as $contact)
                                            <tr>
                                                <td
                                                    class="px-6 py-4 text-sm font-medium text-gray-800 dark:text-neutral-200">
                                                    {{ $contact->name }}
                                                </td>
                                                <td class="px-6 py-4 text-sm text-gray-800 dark:text-neutral-200">
                                                    {{ $contact->email }}
                                                </td>
                                                <td class="px-6 py-4 text-sm text-gray-800 dark:text-neutral-200">
                                                    {{ $contact->phone }}
                                                </td>
                                                <td class="px-6 py-4 text-sm text-blue-700 dark:text-blue-400">
                                                    @if ($contact->property)
                                                        <a href="{{ route('properties.show', $contact->property->slug) }}"
                                                            class="hover:underline" target="_blank">
                                                            {{ $contact->property->title }}
                                                        </a>
                                                    @else
                                                        <span class="text-gray-400">-</span>
                                                    @endif
                                                </td>
                                                <td class="px-6 py-4 text-sm text-gray-600 dark:text-neutral-400">
                                                    {{ $contact->created_at->format('d/m/Y H:i') }}
                                                </td>
                                                <td class="px-6 py-4 text-sm text-gray-800 dark:text-neutral-200 max-w-[250px] truncate"
                                                    title="{{ $contact->message }}">
                                                    {{ Str::limit($contact->message, 70) }}
                                                </td>
                                                <td class="px-6 py-4 text-end text-sm font-medium">
                                                    <span
                                                        class="text-xs text-gray-400 dark:text-neutral-500 inline-flex items-center whitespace-nowrap">


                                                        <a wire:navigate
                                                            href="{{ route('dashboard.contacts.show', $contact->uuid) }}"
                                                            class="inline-flex items-center gap-x-2 text-sm  rounded-lg border border-transparent text-blue-600 hover:text-blue-800 dark:text-blue-500 dark:hover:text-blue-400">
                                                            {{ __('Ver') }}
                                                        </a>

                                                        <flux:modal.trigger name="confirm-delete-contact">
                                                            <button wire:click="confirmDelete('{{ $contact->uuid }}')"
                                                                class="cursor-pointer ml-2 inline-flex items-center gap-x-2 text-sm  rounded-lg text-red-600 hover:text-red-800 dark:text-red-500 dark:hover:text-red-400">
                                                                {{ __('Eliminar') }}
                                                            </button>
                                                        </flux:modal.trigger>
                                                    </span>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="7"
                                                    class="px-6 py-4 text-sm text-center text-gray-500 dark:text-neutral-400">
                                                    {{ __('No hay contactos recibidos.') }}
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4">
                        {{ $contacts->links() }}
                    </div>

                    <flux:modal name="confirm-delete-contact" class="min-w-[22rem]" x-data
                        @contact-deleted.window="$dispatch('modal-close', { name: 'confirm-delete-contact' })">
                        <div class="space-y-6">
                            <div>
                                <flux:heading size="lg">{{ __('¿Eliminar contacto?') }}</flux:heading>
                                <flux:text class="mt-2">
                                    {{ __('Esta acción eliminará el contacto. ¿Estás seguro?') }}
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



                </div>
            </section>
        </div>
    </div>
</div>
