<form wire:submit.prevent="save">
    {{-- ENCABEZADO Y ACCIONES --}}
    <div class="flex items-center justify-between gap-4 flex-wrap mb-8">
        <div>
            <flux:heading size="xl" level="1">{{ __('Barrios') }}</flux:heading>
            <flux:subheading size="lg" class="mb-6">
                {{ __('Agregá o editá barrios') }}
            </flux:subheading>
        </div>
        <flux:button type="submit" variant="primary">
            {{ $editMode ? __('Actualizar barrio') : __('Crear barrio') }}
        </flux:button>
    </div>

    <div class="space-y-10 max-w-3xl mx-auto">

        {{-- SECCIÓN 1: INFORMACIÓN GENERAL --}}
        <section>
            <h2 class="text-lg font-semibold text-gray-700 dark:text-white mb-4">Información general</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <flux:input wire:model.defer="neighborhood_name" label="Nombre" required />
                </div>

                <div>
                    <flux:input wire:model.defer="neighborhood_code" label="Código" placeholder="Ingresar código"
                        maxlength="10" required />
                </div>
                 <div>
                    <flux:select wire:model.live="neighborhood_city_id" label="Ciudad">
                        <flux:select.option value="">{{ __('Elegir ciudad...') }}</flux:select.option>
                        @foreach ($cities as $city)
                            <flux:select.option value="{{ $city->id }}">{{ $city->name }}</flux:select.option>
                        @endforeach
                    </flux:select>
                </div>

            </div>
        </section>



        {{-- BOTONES FINALES --}}
        <div class="flex justify-end gap-2 pt-6">
            <flux:button type="submit" variant="primary">
                {{ $editMode ? __('Actualizar') : __('Crear') }}
            </flux:button>
            <a href="{{ route('dashboard.neighborhoods.index') }}" class="flux:button">
                {{ __('Cancelar') }}
            </a>
        </div>
    </div>
</form>
