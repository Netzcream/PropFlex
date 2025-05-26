<div class="max-w-3xl mx-auto my-8 px-4">
    <form wire:submit.prevent="save" class="space-y-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            <div>


                <flux:input wire:model.defer="property_title" label="Título" required />
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
            <div>
                <flux:input wire:model.defer="property_price" label="Precio" type="number" min="0" step="any" required />
            </div>
            <div>
                <flux:input wire:model.defer="property_currency" label="Moneda" placeholder="Ej: USD, ARS" maxlength="3" required />
            </div>
            <div>
                <flux:input wire:model.defer="property_address" label="Dirección" required />
            </div>
            <div>
                <flux:select wire:model.live="property_province_id"  label="Provincia">
                    <flux:select.option value="">{{ __('Elegir provincia...') }}</flux:select.option>
                    @foreach ($provinces as $province)
                        <flux:select.option value="{{ $province->id }}">{{ $province->name }}</flux:select.option>
                    @endforeach
                </flux:select>
            </div>
            <div>
                <flux:select wire:model.live="property_city_id"  label="Ciudad">
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
                <flux:input wire:model.defer="property_rooms" label="Ambientes" type="number" min="0" />
            </div>
            <div>
                <flux:input wire:model.defer="property_bathrooms" label="Baños" type="number" min="0" />
            </div>
            <div>
                <flux:input wire:model.defer="property_surface" label="Superficie (m²)" type="number" min="0" />
            </div>
            <div>
                <flux:input wire:model.defer="property_latitude" label="Latitud" type="text" />
            </div>
            <div>
                <flux:input wire:model.defer="property_longitude" label="Longitud" type="text" />
            </div>
            <div>
                <flux:input wire:model.defer="property_published_at" label="Fecha publicación" type="date" />
            </div>
            <div>
                <flux:input wire:model.defer="property_expires_at" label="Vence el" type="date" />
            </div>
            <div class="col-span-1">
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

        <div>
            <flux:textarea wire:model.defer="property_description" label="Descripción" rows="4" />
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Fotos</label>
            <input type="file" wire:model="photo_files" multiple accept="image/*" class="block w-full text-sm" />
            @error('photo_files.*')
                <span class="text-red-600 text-xs">{{ $message }}</span>
            @enderror
        </div>
        <div>
            <label class="block text-sm font-medium mb-1">Planos</label>
            <input type="file" wire:model="plan_files" multiple accept="image/*,application/pdf"
                class="block w-full text-sm" />
            @error('plan_files.*')
                <span class="text-red-600 text-xs">{{ $message }}</span>
            @enderror
        </div>

        <div class="flex justify-end gap-2">
            <flux:button type="submit" variant="primary">
                {{ $editMode ? __('Actualizar propiedad') : __('Crear propiedad') }}
            </flux:button>
            <a href="{{ route('dashboard.properties.index') }}" class="flux:button">
                {{ __('Cancelar') }}
            </a>
        </div>
    </form>
</div>
