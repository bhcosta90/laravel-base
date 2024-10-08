<div>
    <x-ui.slide :$open title="Add user" create="Add user">
        <form wire:submit="submit" class="space-y-2">
            <x-ui.input wire:model="user.name" label="Name" />
            <x-ui.input wire:model="user.email" label="Email" />
            <div>
                <div class="flex justify-between space-x-4">
                    <x-ui.input type="password" :error="false" wire:model="password" label="Password" />
                    <x-ui.input type="password" wire:model="password_confirmation" label="Confirm password" />
                </div>
                <x-ui.error name="password" />
            </div>
        </form>
    </x-ui.slide>
</div>
