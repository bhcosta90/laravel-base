<x-card primary title="Password Reset" shadow class="mx-auto w-[360px]">
    <x-slot:header lg center>{{ config('app.name') }}</x-slot:header>

    @if($message = session()->get('status'))
        <x-alert icon="o-exclamation-triangle" class="alert-error mb-4">
            {{ $message }}
        </x-alert>
    @endif

    <x-form wire:submit="updatePassword">
        <x-input label="Email" value="{{ $this->obfuscatedEmail }}" readonly/>
        <x-input label="Email Confirmation" wire:model="email_confirmation"/>
        <x-input label="Password" wire:model="password" type="password"/>
        <x-input label="Password Confirmation" wire:model="password_confirmation" type="password"/>
        <x-slot:actions>
            <div>
                <x-button label="Reset" primary full type="submit" spinner="submit"/>
            </div>
            <div>
                <a wire:navigate href="{{ route('login') }}" class="link link-primary">
                    @lang('I already have an account')
                </a>
            </div>
        </x-slot:actions>
    </x-form>
</x-card>
