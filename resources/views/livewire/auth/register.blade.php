<?php

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('components.layouts.auth')] class extends Component {
    public string $name = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';

    /**
     * Handle an incoming registration request.
     */
    public function register(): void
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);

        $validated['password'] = Hash::make($validated['password']);

        event(new Registered(($user = User::create($validated))));

        Auth::login($user);

        $this->redirectIntended(route('dashboard', absolute: false), navigate: true);
    }
}; ?>

<div class="flex flex-col gap-7">
    {{-- Título y descripción --}}
    <div class="mb-1">
        <h1 class="text-2xl font-bold text-blue-800 text-center">Crear cuenta en PropFlex</h1>
        <p class="text-gray-600 text-center mt-1 text-sm">Completá tus datos para registrarte</p>
    </div>

    <x-auth-session-status class="text-center" :status="session('status')" />

    <form wire:submit="register" class="flex flex-col gap-4">
        <!-- Name -->
        <x-ui.input label="Nombre y apellido" name="name" type="text" wire:model="name" placeholder="Nombre completo"
            required autofocus autocomplete="name" />

        <!-- Email -->
        <x-ui.input label="Email" name="email" type="email" wire:model="email" placeholder="ejemplo@email.com"
            required autocomplete="email" />

        <!-- Password -->
        <x-ui.input label="Contraseña" name="password" type="password" wire:model="password" placeholder="••••••••"
            required autocomplete="new-password" />

        <!-- Confirm Password -->
        <x-ui.input label="Confirmar contraseña" name="password_confirmation" type="password"
            wire:model="password_confirmation" placeholder="••••••••" required autocomplete="new-password" />

        <!-- Botón -->
        <button type="submit"
            class="w-full py-2 rounded-lg bg-blue-700 text-white font-semibold hover:bg-blue-800 transition">
            Crear cuenta
        </button>
    </form>

    <div class="text-center text-sm text-gray-600 mt-3">
        ¿Ya tenés cuenta?
        <a href="{{ route('login') }}" class="text-blue-700 font-medium hover:underline ml-1">
            Ingresar
        </a>
    </div>
</div>
