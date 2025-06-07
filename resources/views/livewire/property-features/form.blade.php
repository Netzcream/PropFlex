<form wire:submit.prevent="save">
    {{-- ENCABEZADO Y ACCIONES --}}
    <div class="flex items-center justify-between gap-4 flex-wrap mb-8">
        <div>
            <flux:heading size="xl" level="1">{{ __('Características de Propiedades') }}</flux:heading>
            <flux:subheading size="lg" class="mb-6">
                {{ __('Agregá o editá características de propiedades') }}
            </flux:subheading>
        </div>
        <flux:button type="submit" variant="primary">
            {{ $editMode ? __('Actualizar característica') : __('Crear característica') }}
        </flux:button>
    </div>

    <div class="space-y-10 max-w-3xl mx-auto">

        {{-- SECCIÓN 1: INFORMACIÓN GENERAL --}}
        <section>
            <h2 class="text-lg font-semibold text-gray-700 dark:text-white mb-4">Información general</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <flux:input wire:model.defer="property_feature_name" label="Nombre" required />
                </div>

                <div>
                    <flux:input wire:model.defer="property_feature_code" label="Código" placeholder="Ingresar código"
                        maxlength="10" required />
                </div>

                <div x-data="{
                    icons: [
                        // Vivienda, Edificio, General
                        'fa-home', // Casa
                        'fa-building', // Edificio
                        'fa-house-chimney', // Casa con chimenea
                        'fa-warehouse', // Depósito, galpón
                        'fa-hotel', // Hotel o depto temporario

                        // Ambientes y mobiliario
                        'fa-couch', // Living/comedor amueblado
                        'fa-bed', // Dormitorio
                        'fa-bath', // Baño
                        'fa-shower', // Ducha
                        'fa-utensils', // Cocina/comedor
                        'fa-chair', // Sillas, espacio comedor

                        // Comodidades/Amenities
                        'fa-car', // Cochera/Garage
                        'fa-tree', // Jardín/Verde
                        'fa-seedling', // Patio/verde
                        'fa-swimming-pool', // Pileta
                        'fa-fire', // Parrilla
                        'fa-snowflake', // Aire acondicionado/Climatización
                        'fa-elevator', // Ascensor
                        'fa-key', // Seguridad, portón
                        'fa-lock', // Seguridad adicional
                        'fa-camera', // Cámaras de seguridad
                        'fa-wifi', // Internet/Wi-Fi

                        // Mascotas y niños
                        'fa-dog', // Acepta mascotas
                        'fa-cat', // Acepta gatos/mascotas
                        'fa-child', // Espacio para niños

                        // Accesibilidad
                        'fa-wheelchair', // Accesible para movilidad reducida

                        // Balcón, terraza, etc
                        'fa-border-all', // Balcón
                        'fa-sun', // Terraza/Solarium
                        'fa-water', // Agua corriente/pileta

                        // Servicios incluidos
                        'fa-bolt', // Electricidad
                        'fa-tint', // Agua
                        'fa-gas-pump', // Gas natural
                        'fa-phone', // Teléfono

                        // Vistas y ubicación
                        'fa-map-marker-alt', // Buena ubicación
                        'fa-map', // Mapa
                        'fa-mountain', // Vista abierta/paisaje

                        // Equipamiento especial
                        'fa-tv', // TV
                        'fa-laptop', // Espacio de trabajo
                        'fa-plug', // Tomas eléctricas adicionales
                        'fa-door-open', // Entrada independiente
                        'fa-toolbox', // Baulera/Depósito
                        'fa-box', // Guardamuebles

                        // Extras/otros
                        'fa-check', // General OK
                        'fa-times', // No disponible
                        'fa-star', // Premium/Extra
                        'fa-leaf', // Espacio verde
                        'fa-recycle', // Reciclado/Ecológico
                    ],

                    search: @js($property_feature_icon ?? ''),
                    showList: false,
                    selected: @js($property_feature_icon ?? ''),
                    filtered() {
                        if (!this.search) return this.icons;
                        return this.icons.filter(i => i.includes(this.search.toLowerCase()));
                    }
                }" class="mb-2 relative">
                    <label class="block text-sm font-medium mb-1 text-flux-text dark:text-flux-light">Ícono</label>
                    <div class="flex items-center gap-3">
                        <input x-model="search" @focus="showList=true" @blur="setTimeout(()=>showList=false,200)"
                            type="text"
                            class="w-full border rounded-lg block disabled:shadow-none dark:shadow-none appearance-none text-base sm:text-sm py-2 h-10 leading-[1.375rem] ps-3 pe-3 bg-white dark:bg-white/10 dark:disabled:bg-white/[7%] text-zinc-700 disabled:text-zinc-500 placeholder-zinc-400 disabled:placeholder-zinc-400/70 dark:text-zinc-300 dark:disabled:text-zinc-400 dark:placeholder-zinc-400 dark:disabled:placeholder-zinc-500 shadow-xs border-zinc-200 border-b-zinc-300/80 disabled:border-b-zinc-200 dark:border-white/10 dark:disabled:border-white/5"
                            placeholder="Buscar ícono (ej: home)">
                        <template x-if="selected">
                            <i
                                :class="['fa-solid fa-fw ', selected, 'text-2xl', 'text-flux-primary',
                                    'dark:text-flux-primary-dark'
                                ]"></i>
                        </template>
                        <template x-if="!selected && search">
                            <i class="fa-solid fa-question text-2xl text-flux-muted dark:text-flux-muted-dark"></i>
                        </template>
                    </div>
                    <div x-show="showList && filtered().length"
                        class="absolute z-20 bg-flux-background dark:bg-flux-dark border border-flux-border dark:border-flux-border-dark rounded shadow mt-1 w-full max-h-56 overflow-y-auto min-w-[10rem]">
                        <template x-for="icon in filtered()" :key="icon">
                            <div class="flex items-center gap-2 px-3 py-2 hover:bg-flux-hover dark:hover:bg-flux-hover-dark cursor-pointer"
                                @mousedown.prevent="selected=icon;search=icon;showList=false;$wire.property_feature_icon = icon;">
                                <i
                                    :class="['fa-solid fa-fw', icon, 'text-lg', 'text-flux-primary',
                                        'dark:text-flux-primary-dark'
                                    ]"></i>
                                <span x-text="icon" class="text-flux-text dark:text-flux-light"></span>
                            </div>
                        </template>
                    </div>
                    <input type="hidden" x-model="selected" wire:model.defer="property_feature_icon">
                    @error('property_feature_icon')
                        <span class="text-flux-danger text-xs dark:text-flux-danger-dark">{{ $message }}</span>
                    @enderror
                </div>




            </div>
        </section>



        {{-- BOTONES FINALES --}}
        <div class="flex justify-end gap-2 pt-6">
            <flux:button type="submit" variant="primary">
                {{ $editMode ? __('Actualizar') : __('Crear') }}
            </flux:button>
            <a href="{{ route('dashboard.property-types.index') }}" class="flux:button">
                {{ __('Cancelar') }}
            </a>
        </div>
    </div>
</form>
