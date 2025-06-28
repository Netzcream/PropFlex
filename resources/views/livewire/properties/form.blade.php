<form wire:submit.prevent="save">
    {{-- ENCABEZADO Y ACCIONES --}}
    <div class="flex items-center justify-between gap-4 flex-wrap mb-8">
        <div>
            <flux:heading size="xl" level="1">{{ __('Propiedades') }}</flux:heading>
            <flux:subheading size="lg" class="mb-6">
                {{ __('Agregá o editá tus propiedades') }}
            </flux:subheading>
        </div>
        <flux:button type="submit" variant="primary">
            {{ $editMode ? __('Actualizar propiedad') : __('Crear propiedad') }}
        </flux:button>
    </div>

    <div class="space-y-10 max-w-3xl mx-auto">

        {{-- SECCIÓN 1: INFORMACIÓN GENERAL --}}
        <section>
            <h2 class="text-lg font-semibold text-gray-700 dark:text-white mb-4">Información general</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <flux:input wire:model.defer="property_title" label="Título" required />
                </div>
                <div>
                    <flux:input wire:model.defer="property_code" label="Código" required />
                </div>
                <div>
                    <flux:input wire:model.defer="property_slug" label="Ruta" />
                </div>
                <div>
                    <flux:select wire:model.defer="property_type_id" label="Tipo de propiedad" required>
                        <flux:select.option value="">{{ __('Elegir tipo...') }}</flux:select.option>
                        @foreach ($propertyTypes as $type)
                            <flux:select.option value="{{ $type->id }}">{{ $type->name }}</flux:select.option>
                        @endforeach
                    </flux:select>
                </div>
                <div>
                    <flux:select wire:model.defer="property_operation_type_id" label="Operación" required>
                        <flux:select.option value="">{{ __('Elegir operación...') }}</flux:select.option>
                        @foreach ($propertyOperationTypes as $op)
                            <flux:select.option value="{{ $op->id }}">{{ $op->name }}</flux:select.option>
                        @endforeach
                    </flux:select>
                </div>
                <div>
                    <flux:select wire:model.defer="property_status_id" label="Estado" required>
                        <flux:select.option value="">{{ __('Elegir estado...') }}</flux:select.option>
                        @foreach ($propertyStatuses as $status)
                            <flux:select.option value="{{ $status->id }}">{{ $status->name }}</flux:select.option>
                        @endforeach
                    </flux:select>
                </div>
                <div class="flex gap-4">
                    <div class="basis-1/4">
                        <flux:input wire:model.defer="property_currency" label="Moneda" placeholder="Ej: USD"
                            maxlength="3" required />
                    </div>
                    <div class="basis-3/4">
                        <flux:input wire:model.defer="property_price" label="Precio" type="number" min="0"
                            step="any" required />
                    </div>
                </div>
                <div class="md:col-span-2">
                    <flux:textarea wire:model.defer="property_description" label="Descripción" rows="3" />
                </div>
            </div>
        </section>

        {{-- SECCIÓN 2: UBICACIÓN --}}
        <section>
            <h2 class="text-lg font-semibold text-gray-700 dark:text-white mb-4">Ubicación</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <flux:input wire:model.defer="property_address" label="Dirección" required />
                </div>
                <div>
                    <flux:select wire:model.live="property_province_id" label="Provincia">
                        <flux:select.option value="">{{ __('Elegir provincia...') }}</flux:select.option>
                        @foreach ($provinces as $province)
                            <flux:select.option value="{{ $province->id }}">{{ $province->name }}</flux:select.option>
                        @endforeach
                    </flux:select>
                </div>
                <div>
                    <flux:select wire:model.live="property_city_id" label="Ciudad">
                        <flux:select.option value="">{{ __('Elegir ciudad...') }}</flux:select.option>
                        @foreach ($cities as $city)
                            <flux:select.option value="{{ $city->id }}">{{ $city->name }}</flux:select.option>
                        @endforeach
                    </flux:select>
                </div>
                <div>
                    <flux:select wire:model.defer="property_neighborhood_id" label="Barrio">
                        <flux:select.option value="">{{ __('Elegir barrio...') }}</flux:select.option>
                        @foreach ($neighborhoods as $hood)
                            <flux:select.option value="{{ $hood->id }}">{{ $hood->name }}</flux:select.option>
                        @endforeach
                    </flux:select>
                </div>
                <div>
                    <flux:input wire:model.defer="property_latitude" label="Latitud" type="text" />
                </div>
                <div>
                    <flux:input wire:model.defer="property_longitude" label="Longitud" type="text" />
                </div>
            </div>
        </section>

        {{-- SECCIÓN 3: CARACTERÍSTICAS --}}
        <section>
            <h2 class="text-lg font-semibold text-gray-700 dark:text-white mb-4">Características</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <flux:input wire:model.defer="property_rooms" label="Ambientes" type="number" min="0" />
                </div>
                <div>
                    <flux:input wire:model.defer="property_bathrooms" label="Baños" type="number" min="0" />
                </div>
                <div>
                    <flux:input wire:model.defer="property_surface" label="Superficie (m²)" type="number"
                        min="0" />
                </div>
                <div>
                    <flux:input wire:model.defer="property_published_at" label="Fecha publicación" type="date" />
                </div>
                <div>
                    <flux:input wire:model.defer="property_expires_at" label="Vence el" type="date" />
                </div>
                <div class="md:col-span-2 flex flex-col md:flex-row gap-4">
                    <flux:field variant="inline" class="mb-2">
                        <flux:label>{{ __('Destacar propiedad') }}</flux:label>
                        <flux:switch wire:model.defer="property_is_featured" />
                        <flux:error name="property_is_featured" />
                    </flux:field>
                    <flux:field variant="inline">
                        <flux:label>{{ __('Publicar propiedad') }}</flux:label>
                        <flux:switch wire:model.defer="property_is_published" />
                        <flux:error name="property_is_published" />
                    </flux:field>
                </div>
            </div>
        </section>


        <section>
            <h2 class="text-lg font-semibold text-gray-700 dark:text-white mb-4">Características adicionales</h2>
            <div class="flex flex-wrap gap-3">
                @foreach ($allFeatures as $feature)
                    <label
                        class="flex items-center gap-2 px-3 py-2 rounded  bg-white dark:bg-white/10 cursor-pointer transition hover:bg-flux-hover dark:hover:bg-flux-hover-dark">
                        <input type="checkbox" wire:model="property_features" value="{{ $feature->id }}"
                            class="form-checkbox accent-flux-primary dark:accent-flux-primary-dark">
                        @if ($feature->icon)
                            <i
                                class="fa-solid {{ $feature->icon }} text-lg text-flux-primary dark:text-flux-primary-dark"></i>
                        @endif
                        <span class="text-flux-text dark:text-flux-light">{{ $feature->name }}</span>
                    </label>
                @endforeach
            </div>
            @error('property_features')
                <span class="text-flux-danger text-xs dark:text-flux-danger-dark">{{ $message }}</span>
            @enderror
        </section>



        {{-- SECCIÓN 4: MULTIMEDIA --}}
        <section>
            <h2 class="text-lg font-semibold text-gray-700 dark:text-white mb-4">Multimedia</h2>
            {{-- FOTOS --}}
            <div class="flex flex-col gap-2 mb-4">
                <label for="photo-files-pre" class="block text-sm font-medium">Fotos</label>
                <label for="photo-files-pre"
                    class="flex items-center justify-center px-4 py-2 border-2 border-dashed rounded-lg cursor-pointer bg-white hover:bg-gray-50 transition text-gray-600 font-medium text-sm shadow-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="fill-blue-500 mr-2 size-5" viewBox="0 0 640 512">
                        <path
                            d="M144 480C64.5 480 0 415.5 0 336c0-62.8 40.2-116.2 96.2-135.9c-.1-2.7-.2-5.4-.2-8.1c0-88.4 71.6-160 160-160c59.3 0 111 32.2 138.7 80.2C409.9 102 428.3 96 448 96c53 0 96 43 96 96c0 12.2-2.3 23.8-6.4 34.6C596 238.4 640 290.1 640 352c0 70.7-57.3 128-128 128l-368 0zm79-217c-9.4 9.4-9.4 24.6 0 33.9s24.6 9.4 33.9 0l39-39L296 392c0 13.3 10.7 24 24 24s24-10.7 24-24l0-134.1 39 39c9.4 9.4 24.6 9.4 33.9 0s9.4-24.6 0-33.9l-80-80c-9.4-9.4-24.6-9.4-33.9 0l-80 80z" />
                    </svg>
                    <span>Elegir fotos (máx. 4 MB c/u)</span>
                    <input id="photo-files-pre" type="file" wire:model="photo_files_pre" multiple
                        accept="image/*" class="hidden" />
                </label>
                @error('photo_files.*')
                    <span class="text-red-600 text-xs">{{ $message }}</span>
                @enderror
            </div>
            @if ($photo_files)
                <div class="mb-4">
                    <label class="block text-sm font-medium mb-1">Fotos pendientes de subida</label>
                    <div class="flex flex-wrap gap-4">
                        @foreach ($photo_files as $idx => $photo)
                            <div
                                class="relative w-32 h-32 border rounded overflow-hidden flex items-center justify-center bg-gray-100">
                                @if (substr($photo->getMimeType(), 0, 5) === 'image')
                                    <img src="{{ $photo->temporaryUrl() }}" class="object-cover w-full h-full"
                                        alt="Foto {{ $idx + 1 }}">
                                @else
                                    <span class="text-xs p-2">{{ $photo->getClientOriginalName() }}</span>
                                @endif
                                <button type="button" wire:click="removePhotoFile({{ $idx }})"
                                    class="absolute top-1 right-1 bg-white rounded-full p-1 text-red-500 hover:bg-red-100">
                                    &times;
                                </button>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
            @if ($existing_photos)
                <div class="mb-4">
                    <label class="block text-sm font-medium mb-1">Fotos actuales</label>
                    <div class="flex flex-wrap gap-4">
                        @foreach ($existing_photos as $media)
                            <div
                                class="relative w-32 h-32 border rounded overflow-hidden flex items-center justify-center bg-gray-100">
                                <img src="{{ $media->getUrl('thumb') ?? $media->getUrl() }}"
                                    class="object-cover w-full h-full" alt="Foto actual">
                                <button type="button" wire:click="removeExistingPhoto({{ $media->id }})"
                                    class="absolute top-1 right-1 bg-white rounded-full p-1 text-red-500 hover:bg-red-100">
                                    &times;
                                </button>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            {{-- PLANOS --}}
            <div class="flex flex-col gap-2 mb-4">
                <label for="plan-files-pre" class="block text-sm font-medium">Planos</label>
                <label for="plan-files-pre"
                    class="flex items-center justify-center px-4 py-2 border-2 border-dashed rounded-lg cursor-pointer bg-white hover:bg-gray-50 transition text-gray-600 font-medium text-sm shadow-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="fill-blue-500 mr-2 size-5" viewBox="0 0 640 512">
                        <path
                            d="M144 480C64.5 480 0 415.5 0 336c0-62.8 40.2-116.2 96.2-135.9c-.1-2.7-.2-5.4-.2-8.1c0-88.4 71.6-160 160-160c59.3 0 111 32.2 138.7 80.2C409.9 102 428.3 96 448 96c53 0 96 43 96 96c0 12.2-2.3 23.8-6.4 34.6C596 238.4 640 290.1 640 352c0 70.7-57.3 128-128 128l-368 0zm79-217c-9.4 9.4-9.4 24.6 0 33.9s24.6 9.4 33.9 0l39-39L296 392c0 13.3 10.7 24 24 24s24-10.7 24-24l0-134.1 39 39c9.4 9.4 24.6 9.4 33.9 0s9.4-24.6 0-33.9l-80-80c-9.4-9.4-24.6-9.4-33.9 0l-80 80z" />
                    </svg>
                    <span>Elegir planos (máx. 4 MB c/u)</span>
                    <input id="plan-files-pre" type="file" wire:model="plan_files_pre" multiple accept="image/*"
                        class="hidden" />
                </label>
                @error('plan_files.*')
                    <span class="text-red-600 text-xs">{{ $message }}</span>
                @enderror
            </div>
            @if ($plan_files)
                <div class="mb-4">
                    <label class="block text-sm font-medium mb-1">Planos pendientes de subida</label>
                    <div class="flex flex-wrap gap-4">
                        @foreach ($plan_files as $idx => $plan)
                            <div
                                class="relative w-32 h-32 border rounded overflow-hidden flex items-center justify-center bg-gray-100">
                                @if (substr($plan->getMimeType(), 0, 5) === 'image')
                                    <img src="{{ $plan->temporaryUrl() }}" class="object-cover w-full h-full"
                                        alt="Foto {{ $idx + 1 }}">
                                @else
                                    <span class="text-xs p-2">{{ $plan->getClientOriginalName() }}</span>
                                @endif
                                <button type="button" wire:click="removePlanFile({{ $idx }})"
                                    class="absolute top-1 right-1 bg-white rounded-full p-1 text-red-500 hover:bg-red-100">
                                    &times;
                                </button>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
            @if ($existing_plans)
                <div class="mb-4">
                    <label class="block text-sm font-medium mb-1">Planos actuales</label>
                    <div class="flex flex-wrap gap-4">
                        @foreach ($existing_plans as $media)
                            <div
                                class="relative w-32 h-32 border rounded overflow-hidden flex items-center justify-center bg-gray-100">
                                <img src="{{ $media->getUrl('thumb') ?? $media->getUrl() }}"
                                    class="object-cover w-full h-full" alt="Plano actual">
                                <button type="button" wire:click="removeExistingPlan({{ $media->id }})"
                                    class="absolute top-1 right-1 bg-white rounded-full p-1 text-red-500 hover:bg-red-100">
                                    &times;
                                </button>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </section>

        {{-- BOTONES FINALES --}}
        <div class="flex justify-end gap-2 pt-6">
            <flux:button type="submit" variant="primary">
                {{ $editMode ? __('Actualizar propiedad') : __('Crear propiedad') }}
            </flux:button>
            <a href="{{ route('dashboard.properties.index') }}" class="flux:button">
                {{ __('Cancelar') }}
            </a>
        </div>
    </div>
</form>
