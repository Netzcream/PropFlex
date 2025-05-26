<?php

use App\Livewire\Actions\Logout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('components.layouts.auth')] class extends Component {
    /**
     * Send an email verification notification to the user.
     */
    public function sendVerification(): void
    {
        if (Auth::user()->hasVerifiedEmail()) {
            $this->redirectIntended(default: route('dashboard', absolute: false), navigate: true);

            return;
        }

        Auth::user()->sendEmailVerificationNotification();

        Session::flash('status', 'verification-link-sent');
    }

    /**
     * Log the current user out of the application.
     */
    public function logout(Logout $logout): void
    {
        $logout();

        $this->redirect('/', navigate: true);
    }
}; ?>
<div class="mt-6 flex flex-col gap-7">
    <div class="text-center text-gray-700 text-base">
        Por favor, verificá tu dirección de email haciendo clic en el enlace que te enviamos.
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="text-center font-medium text-green-600">
            Se envió un nuevo enlace de verificación a tu email.
        </div>
    @endif

    <div class="flex flex-col items-center gap-3 mt-2">
        <button wire:click="sendVerification"
            class="w-full py-2 rounded-lg bg-blue-700 text-white font-semibold hover:bg-blue-800 transition">
            Reenviar email de verificación
        </button>

        <button type="button" wire:click="logout"
            class="text-sm text-gray-500 hover:text-blue-700 underline transition mt-2">
            Cerrar sesión
        </button>
    </div>
</div>
