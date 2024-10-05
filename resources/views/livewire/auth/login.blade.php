<section>
    <div class="w-full primary-gradient text-sm font-medium p-8 rounded">
        <form id="form-login" class="space-y-4 md:space-y-6" wire:submit="submit">
            <h1 class="text-center font-semibold text-lg">
                Please enter your user information.
            </h1>

            @error('invalidCredential')
            <x-ui.alert error :text="$message" />
            @enderror

            @error('rateLimiter')
            <x-ui.alert info :text="$message" />
            @enderror

            <x-ui.input label="Email" id="login-email" wire:model="email" />
            <x-ui.input password label="Password" id="login-password" wire:model="password" />
            <x-ui.button primary label="Sign in" />
        </form>
    </div>
</section>
