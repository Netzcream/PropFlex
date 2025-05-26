<?php

use Illuminate\Support\Facades\Password;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('components.layouts.auth')] class extends Component {
    public string $email = '';

    /**
     * Send a password reset link to the provided email address.
     */
    public function sendPasswordResetLink(): void
    {
        $this->validate([
            'email' => ['required', 'string', 'email'],
        ]);

        Password::sendResetLink($this->only('email'));

        session()->flash('status', __('A reset link will be sent if the account exists.'));
    }
}; ?>
<div class="flex flex-col gap-7">
    {{-- Título y descripción --}}
    <div class="mb-1">
        <h1 class="text-2xl font-bold text-blue-800 text-center">¿Olvidaste tu contraseña?</h1>
        <p class="text-gray-600 text-center mt-1 text-sm">
            Ingresá tu email para recibir el enlace de restablecimiento de contraseña.
        </p>
    </div>

    <x-auth-session-status class="text-center" :status="session('status')" />

    <form wire:submit="sendPasswordResetLink" class="flex flex-col gap-4">
        <!-- Email Address -->
        <x-ui.input
            label="Email"
            name="email"
            type="email"
            wire:model="email"
            placeholder="ejemplo@email.com"
            required
            autofocus
        />

        <button type="submit"
            class="w-full py-2 rounded-lg bg-blue-700 text-white font-semibold hover:bg-blue-800 transition">
            Enviar enlace de restablecimiento
        </button>
    </form>

    <div class="text-center text-sm text-gray-500 mt-3">
        o&nbsp;
        <a href="{{ route('login') }}" class="text-blue-700 font-medium hover:underline ml-1">
            volver a ingresar
        </a>
    </div>
</div>
