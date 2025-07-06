<?php

use Illuminate\Auth\Events\Lockout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Volt\Component;

new #[Layout('components.layouts.auth')] class extends Component {
    #[Validate('required|string|email')]
    public string $email = '';

    #[Validate('required|string')]
    public string $password = '';

    public bool $remember = false;

    /**
     * Handle an incoming authentication request.
     */
    public function login(): void
    {
        $this->validate();
        $this->ensureIsNotRateLimited();

        if (!Auth::attempt(['email' => $this->email, 'password' => $this->password], $this->remember)) {
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'email' => __('auth.failed'),
            ]);
        }

        RateLimiter::clear($this->throttleKey());
        Session::regenerate();

        // LÓGICA AGREGADA DE ROLES:
        $user = Auth::user();
        if ($user->hasRole('admin') || $user->hasRole('agente') || $user->hasRole('editor')) {
            // Redirige directo al dashboard
            $this->redirect(route('dashboard', absolute: false), navigate: true);
            return;
        }

        // Si no es admin/agente, redirige a donde estaba o a la home
        $this->redirectIntended(default: route('home', absolute: false), navigate: true);
    }

    /**
     * Ensure the authentication request is not rate limited.
     */
    protected function ensureIsNotRateLimited(): void
    {
        if (!RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout(request()));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'email' => __('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    /**
     * Get the authentication rate limiting throttle key.
     */
    protected function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->email) . '|' . request()->ip());
    }
}; ?>
<div class="flex flex-col gap-7">
    {{-- Título y descripción --}}
    <div class="mb-1">
        <h1 class="text-2xl font-bold text-blue-800 text-center">Ingresar a PropFlex</h1>
        <p class="text-gray-600 text-center mt-1 text-sm">Ingresá tu email y contraseña para continuar</p>
    </div>

    <!-- Estado de sesión -->
    <x-auth-session-status class="text-center" :status="session('status')" />

    <form wire:submit="login" class="flex flex-col gap-6">
        <!-- Email -->

        <x-ui.input label="Email" type="email" name="email" wire:model="email" placeholder="ejemplo@email.com"
            required autofocus autocomplete="email" />


        <x-ui.input label="Contraseña" type="password" name="password" wire:model="password" placeholder="••••••••"
            required autocomplete="current-password" />


        <!-- Remember Me -->
        <div class="flex items-center">
            <input id="remember" name="remember" type="checkbox" wire:model="remember"
                class="rounded border-gray-300 text-blue-700 focus:ring-blue-600" />
            <label for="remember" class="ml-2 block text-sm text-gray-700 select-none">Recordarme</label>
        </div>

        <button type="submit"
            class="w-full py-2 rounded-lg bg-blue-700 text-white font-semibold hover:bg-blue-800 transition">
            Ingresar
        </button>
    </form>

    @if (Route::has('register'))
        <div class="text-center text-sm text-gray-600 mt-3">
            ¿No tenés cuenta?
            <a href="{{ route('register') }}" class="text-blue-700 font-medium hover:underline ml-1">
                Registrate
            </a>
        </div>
    @endif
</div>
