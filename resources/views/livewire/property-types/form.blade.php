<form wire:submit.prevent="save">
    {{-- ENCABEZADO Y ACCIONES --}}
    <div class="flex items-center justify-between gap-4 flex-wrap mb-8">
        <div>
            <flux:heading size="xl" level="1">{{ __('Tipos de Propiedades') }}</flux:heading>
            <flux:subheading size="lg" class="mb-6">
                {{ __('Agregá o editá tus tipos de propiedades') }}
            </flux:subheading>
        </div>
        <flux:button type="submit" variant="primary">
            {{ $editMode ? __('Actualizar tipo') : __('Crear tipo') }}
        </flux:button>
    </div>

    <div class="space-y-10 max-w-3xl mx-auto">

        {{-- SECCIÓN 1: INFORMACIÓN GENERAL --}}
        <section>
            <h2 class="text-lg font-semibold text-gray-700 dark:text-white mb-4">Información general</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <flux:input wire:model.defer="property_type_name" label="Nombre" required />
                </div>

                <div>
                    <flux:input wire:model.defer="property_type_code" label="Código" placeholder="Ingresar código"
                        maxlength="10" required />
                </div>

<div
    x-data="{
        icons: [
            'fa-home', 'fa-building', 'fa-house-chimney', 'fa-warehouse', 'fa-hotel', 'fa-tree', 'fa-city', 'fa-store', 'fa-house', 'fa-chalkboard', 'fa-bath', 'fa-car', 'fa-couch'
        ],
        search: @js($property_type_icon ?? ''),
        showList: false,
        selected: @js($property_type_icon ?? ''),
        filtered() {
            if (!this.search) return this.icons;
            return this.icons.filter(i => i.includes(this.search.toLowerCase()));
        }
    }"
    class="mb-2 relative"
>
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
                                @mousedown.prevent="selected=icon;search=icon;showList=false;$wire.property_type_icon = icon;">
                                <i
                                    :class="['fa-solid fa-fw', icon, 'text-lg', 'text-flux-primary',
                                        'dark:text-flux-primary-dark'
                                    ]"></i>
                                <span x-text="icon" class="text-flux-text dark:text-flux-light"></span>
                            </div>
                        </template>
                    </div>
                    <input type="hidden" x-model="selected" wire:model.defer="property_type_icon">
                    @error('property_type_icon')
                        <span class="text-flux-danger text-xs dark:text-flux-danger-dark">{{ $message }}</span>
                    @enderror
                </div>




            </div>
        </section>



        {{-- BOTONES FINALES --}}
        <div class="flex justify-end gap-2 pt-6">
            <flux:button type="submit" variant="primary">
                {{ $editMode ? __('Actualizar tipo de propiedad') : __('Crear tipo de propiedad') }}
            </flux:button>
            <a href="{{ route('dashboard.property-types.index') }}" class="flux:button">
                {{ __('Cancelar') }}
            </a>
        </div>
    </div>
</form>
