<div class="mx-auto w-[360px]">
    <div class="text-center text-3xl mb-3">{{ config('app.name') }}</div>
    <x-card title="Register" shadow>
        <div class="text-center">
            @lang('Register a new membership')
        </div>
        <x-form wire:submit="submit">
            <x-input placeholder="Full name" wire:model="name"/>
            <x-input type="email" placeholder="Email" wire:model="email"/>
            <x-input type="password" placeholder="Confirm your email" wire:model="email_confirmation"/>
            <x-input type="password" placeholder="Password" wire:model="password" type="password"/>
            <x-slot:actions>
                <div class="w-full flex items-center justify-between">
                    <x-button label="Reset" secondary type="reset"/>
                    <x-button label="Register" primary type="submit" spinner="submit"/>
                </div>

                <div class="text-lg text-center text-muted">- @lang('OR') -</div>

                <div>
                    <a wire:navigate href="{{ route('login') }}" class="link link-primary">
                        @lang('I already have an account')
                    </a>
                </div>
            </x-slot:actions>
        </x-form>
    </x-card>
</div>
