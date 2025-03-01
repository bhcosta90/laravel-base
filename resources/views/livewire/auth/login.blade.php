<x-ui.card title="Login" primary shadow class="mx-auto w-[360px]">

    <x-slot:header lg center>{{ config('app.name') }}</x-slot:header>

    @if($message = session()->get('status'))
        <x-ui.alert icon="o-exclamation-triangle" class="alert-warning mb-4">
            {{ $message }}
        </x-ui.alert>
    @endif

    @if($errors->hasAny(['invalidCredentials', 'rateLimiter']))
        <x-ui.alert icon="o-exclamation-triangle" class="alert-warning mb-4">
            @error('invalidCredentials')
            <span>{{ $message }}</span>
            @enderror

            @error('rateLimiter')
            <span>{{ $message }}</span>
            @enderror
        </x-ui.alert>
    @endif

    @if(!($this->isEmail || $this->isLogin))
        <x-ui.form wire:submit="submit">
            <div class="text-xl text-center">@lang('Sign in to start your session')</div>
            <x-ui.input placeholder="Login or Email" wire:model="login"/>
            <x-slot:actions>
                <div class="flex justify-end">
                    <div><x-ui.button label="Send" primary type="submit" spinner="submit"/></div>
                </div>
            </x-slot:actions>
        </x-ui.form>
    @endif

    @if(($this->isEmail || $this->isLogin))
        <x-ui.form wire:submit="execute">
            <div class="text-xl text-center">@lang('Sign in to start your session')</div>
            <x-ui.input placeholder="Email" disabled wire:model="login"/>
            <x-ui.input placeholder="Password" wire:model="password" type="password"/>
            <x-slot:actions>
                <div class="flex justify-between items-center">
                    <div>
                        <div><x-ui.button label="Reset" secondary outline type="reset" spinner="submit" x-on:click="$wire.set('isEmail', false); $wire.set('isLogin', false)"/></div>
                    </div>

                    <div class="flex gap-x-2 justify-between items-center">
                        <div><x-ui.checkbox label="Remember Me" primary type="checkbox" wire:model="remember" /></div>
                        <div><x-ui.button label="Login" primary type="submit" spinner="submit"/></div>
                    </div>
                </div>
            </x-slot:actions>
        </x-ui.form>
    @endif
</x-ui.card>

