<div class="mx-auto w-[360px]">
    <div class="text-center text-3xl mb-3">{{ config('app.name') }}</div>
    <x-card title="Password recovery" shadow>
        @if($message)
            <x-alert icon="o-exclamation-triangle" class="alert-success mb-4">
                <span>{{ $message }}</span>
            </x-alert>
        @endif

        <div class="text-center">
            @lang('You forgot your password? Here you can easily retrieve a new password.')
        </div>

        <x-form wire:submit="startPasswordRecovery">
            <x-input label="Email" wire:model="email"/>
            <x-slot:actions>
                <div>
                    <x-button full label="Submit" class="btn-primary" type="submit" spinner="submit"/>
                </div>
                <div>
                    <div>
                        <a wire:navigate href="{{ route('login') }}" class="link link-primary">
                            @lang('Login')
                        </a>
                    </div>
                    <div>
                        <a wire:navigate href="{{ route('register') }}" class="link link-primary">
                            @lang('Register a new membership')
                        </a>
                    </div>
                </div>
            </x-slot:actions>
        </x-form>
    </x-card>

</div>
