<section>
    <div class="w-full primary-gradient text-sm font-medium p-8 rounded space-y-2 md:space-y-4">
        <form id="form-login" class="space-y-2 md:space-y-4" wire:submit="submit">
            <h1 class="text-center font-semibold text-lg">
                @lang('Reset your password.')
            </h1>

            <x-ui.input value="{{ $this->obfuscatedEmail }}" label="Email" disabled required />
            <x-ui.input email label="Email" id="login-email" wire:model="email" />
            <x-ui.input password label="Password" id="login-password" wire:model="password" />
            <x-ui.input password label="Confirm your password" id="login-password-confirmation" wire:model="password_confirmation" />
            <x-ui.button primary label="Register" full submit />
        </form>

        <x-auth.login.back />
    </div>
</section>
