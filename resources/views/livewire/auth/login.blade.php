<x-card title="Login" primary shadow class="mx-auto w-[360px]">

    <x-slot:header lg center>{{ config('app.name') }}</x-slot:header>

    @if($message = session()->get('status'))
        <x-alert icon="o-exclamation-triangle" class="alert-warning mb-4">
            {{ $message }}
        </x-alert>
    @endif

    @if($errors->hasAny(['invalidCredentials', 'rateLimiter']))
        <x-alert icon="o-exclamation-triangle" class="alert-warning mb-4">
            @error('invalidCredentials')
            <span>{{ $message }}</span>
            @enderror

            @error('rateLimiter')
            <span>{{ $message }}</span>
            @enderror
        </x-alert>
    @endif

    <x-form wire:submit="tryToLogin">
        <div class="text-xl text-center">@lang('Sign in to start your session')</div>
        <x-input label="Email" wire:model="email"/>
        <x-input label="Password" wire:model="password" type="password"/>
        <x-slot:actions>
            <div class="flex justify-between items-center">
                <div><x-checkbox label="Remember Me" primary type="checkbox" wire:model="remember" /></div>
                <div><x-button label="Login" primary type="submit" spinner="submit"/></div>
            </div>

            <div>
                <div>
                    <a href="{{ route('password.recovery') }}" class="link link-primary">
                        @lang('Forgot your password?')
                    </a>
                </div>

                <div>
                    <a href="{{ route('register') }}" class="link link-primary">
                        @lang('I want to create an account')
                    </a>
                </div>
            </div>
        </x-slot:actions>
    </x-form>
</x-card>

