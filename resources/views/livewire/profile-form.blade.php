<main class="flex-1 flex items-center justify-center bg-gray-50 py-10 dark:bg-neutral-900">
    <div class="w-full max-w-xl bg-white dark:bg-neutral-800 rounded-xl shadow-lg p-8 space-y-10">

        <div>
            <flux:heading size="xl" level="1">Mi Perfil</flux:heading>
            <flux:subheading size="lg" class="mb-6">
                Editá tus datos personales y credenciales.
            </flux:subheading>
            <flux:separator variant="subtle" />
        </div>

        <form wire:submit.prevent="save" class="space-y-8">
            {{-- AVATAR --}}
            <div class="flex flex-col items-center gap-3">
                <div>
                    @if($avatarPreview)
                        <img src="{{ $avatarPreview }}" class="w-24 h-24 rounded-full object-cover shadow" alt="Avatar">
                    @else
                        <div class="w-24 h-24 rounded-full bg-gray-200 flex items-center justify-center text-3xl text-gray-400">
                            <i class="fa-solid fa-user"></i>
                        </div>
                    @endif
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-2">Cambiar avatar</label>
                    <input type="file" wire:model="avatar" accept="image/*" class="text-sm">
                    @error('avatar')
                        <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <flux:input wire:model.defer="name" label="Nombre" required autocomplete="off" />
                <flux:input wire:model.defer="email" label="Email" required type="email" autocomplete="off" />
                <flux:input wire:model.defer="phone" label="Teléfono" type="text" autocomplete="off" />
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <flux:input wire:model.defer="password" label="Nueva contraseña (opcional)" type="password" autocomplete="new-password" />
                <flux:input wire:model.defer="password_confirmation" label="Repetir contraseña" type="password" autocomplete="new-password" />
            </div>

            <div class="flex justify-end gap-2 pt-6">
                <flux:button type="submit" variant="primary">Guardar cambios</flux:button>
            </div>
        </form>

        @if(session()->has('success'))
            <div class="text-green-600 dark:text-green-400 text-sm mt-2">{{ session('success') }}</div>
        @endif

    </div>
</main>
