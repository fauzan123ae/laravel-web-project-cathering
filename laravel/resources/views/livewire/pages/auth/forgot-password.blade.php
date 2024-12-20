<?php

use Illuminate\Support\Facades\Password;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public string $email = '';

    /**
     * Send a password reset link to the provided email address.
     */
    public function sendPasswordResetLink(): void
    {
        // Validasi input email
        $this->validate([
            'email' => ['required', 'string', 'email'],
        ]);

        // Mengirimkan link reset password
        $status = Password::sendResetLink([
            'email' => $this->email
        ]);

        // Jika pengiriman link gagal, tampilkan error
        if ($status != Password::RESET_LINK_SENT) {
            $this->addError('email', __($status));
            return;
        }

        // Reset form setelah berhasil
        $this->reset('email');

        // Menampilkan pesan sukses
        session()->flash('status', __($status));
    }
};
?>

<div>
    <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />
        @csrf



    <form wire:submit="sendPasswordResetLink">
        <!-- Email or username-->
        <div>
            <x-input-label for="input_type" :value="('Email/Username')" />
            <x-text-input wire:model="email" id="input_type" class="block mt-1 w-full" type="text" name="email" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Email Password Reset Link') }}
            </x-primary-button>
        </div>
    </form>
</div>