<section class="w-full bg-white rounded-2xl shadow p-8">
    <h2 class="text-xl font-bold text-blue-800 mb-4 text-center">Contacto por propiedad</h2>
    <p class="text-gray-600 text-center mb-6">
        Completá tus datos y nos pondremos en contacto por la propiedad: <strong>{{ $property->title }}</strong>
    </p>

    @if ($success)
        <div class="mb-4 bg-green-100 text-green-700 p-3 rounded text-sm text-center">
            ¡Mensaje enviado correctamente! Pronto te contactaremos.
        </div>
    @endif

    <form wire:submit.prevent="send" class="space-y-4">
        <div>
            <label for="name" class="block text-gray-700 mb-1 font-medium">Nombre</label>
            <input id="name" type="text" wire:model.defer="name" placeholder="Tu nombre"
                class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-blue-500" required>
            @error('name')
                <div class="text-sm text-red-600 mt-1">{{ $message }}</div>
            @enderror
        </div>
        <div>
            <label for="email" class="block text-gray-700 mb-1 font-medium">Email</label>
            <input id="email" type="email" wire:model.defer="email" placeholder="ejemplo@email.com"
                class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-blue-500" required>
            @error('email')
                <div class="text-sm text-red-600 mt-1">{{ $message }}</div>
            @enderror
        </div>
        <div>
            <label for="phone" class="block text-gray-700 mb-1 font-medium">Teléfono (opcional)</label>
            <input id="phone" type="text" wire:model.defer="phone" placeholder="Ej: 11 2345 6789"
                class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-blue-500">
            @error('phone')
                <div class="text-sm text-red-600 mt-1">{{ $message }}</div>
            @enderror
        </div>
        <div>
            <label for="message" class="block text-gray-700 mb-1 font-medium">Mensaje</label>
            <textarea id="message" rows="4" wire:model.defer="message"
                class="w-full px-4 py-2 rounded-lg border border-gray-300 focus:outline-blue-500 resize-none" required></textarea>
            @error('message')
                <div class="text-sm text-red-600 mt-1">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit"
            class="w-full py-2 rounded-lg bg-blue-700 text-white font-semibold hover:bg-blue-800 transition flex items-center justify-center"
            wire:loading.attr="disabled" wire:target="send">
            <span wire:loading.remove wire:target="send">Enviar consulta</span>
            <svg wire:loading wire:target="send" class="animate-spin h-5 w-5 mr-2 text-white"
                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4">
                </circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
            </svg>
            <span wire:loading wire:target="send">Enviando...</span>
        </button>
    </form>
</section>
