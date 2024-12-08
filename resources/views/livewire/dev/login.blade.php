<div class="flex items-center join">
    <x-select sm class="join-item" icon="o-user" :options="$this->users" wire:model="selectedUser"
              placeholder="Select an user"/>

    <x-button sm class="join-item" secondary wire:click="login">Login</x-button>
</div>
