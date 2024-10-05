<section>
    <div class="w-full primary-gradient text-sm font-medium p-8 rounded space-y-2 md:space-y-4">
        <form id="form-login" class="space-y-2 md:space-y-4" wire:submit="submit">
            <h1 class="text-center font-semibold text-lg">
                @lang('Please enter your user information.')
            </h1>

            @error('invalidCredential')
                <x-ui.alert error :text="$message" center sm />
            @enderror

            @error('rateLimiter')
                <x-ui.alert info :text="$message" center sm />
            @enderror

            <x-ui.input label="Email" id="login-email" wire:model="email" />
            <x-ui.input password label="Password" id="login-password" wire:model="password" />
            <x-ui.button primary label="Sign in" full submit />
        </form>

        @if(\Illuminate\Support\Facades\Route::has('register'))
            <div class="text-sm font-medium text-gray-500 dark:text-gray-300">
                @lang('Not registered?')
                <x-ui.link href="{{ route('register') }}" class="link link-info">
                    @lang('Create account')
                </x-ui.link>
            </div>
        @endif
    </div>
</section>
