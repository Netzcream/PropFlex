<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('components.layouts.auth')] class extends Component {
    public string $password = '';

    /**
     * Confirm the current user's password.
     */
    public function confirmPassword(): void
    {
        $this->validate([
            'password' => ['required', 'string'],
        ]);

        if (! Auth::guard('web')->validate([
            'email' => Auth::user()->email,
            'password' => $this->password,
        ])) {
            throw ValidationException::withMessages([
                'password' => __('auth.password'),
            ]);
        }

        session(['auth.password_confirmed_at' => time()]);

        $this->redirectIntended(default: route('dashboard', absolute: false), navigate: true);
    }
}; ?>

<div class="flex flex-col gap-7">
    {{-- Título y descripción --}}
    <div class="mb-1">
        <h1 class="text-2xl font-bold text-blue-800 text-center">Confirmar contraseña</h1>
        <p class="text-gray-600 text-center mt-1 text-sm">
            Esta es un área segura de la aplicación. Por favor, confirmá tu contraseña para continuar.
        </p>
    </div>

    <x-auth-session-status class="text-center" :status="session('status')" />

    <form wire:submit="confirmPassword" class="flex flex-col gap-4">
        <!-- Password -->
        <x-ui.input
            label="Contraseña"
            name="password"
            type="password"
            wire:model="password"
            placeholder="••••••••"
            required
            autocomplete="current-password"
        />

        <button type="submit"
            class="w-full py-2 rounded-lg bg-blue-700 text-white font-semibold hover:bg-blue-800 transition">
            Confirmar
        </button>
    </form>
</div>

