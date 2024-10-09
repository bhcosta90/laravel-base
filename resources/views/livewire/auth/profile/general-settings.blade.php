<x-ui.card title="General information">
    <form wire:submit="submit" class="space-y-6">
        <div class="space-y-3">
            <div class="lg:flex lg:justify-between lg:w-full lg:space-x-4 md:space-y-4 lg:space-y-0">
                <div class="w-full">
                    <x-ui.input
                        required
                        max="120"
                        wire:model="user.name"
                        label="Name"
                    />
                </div>
                <div class="w-full">
                    <x-ui.input
                        required
                        type="email"
                        max="120"
                        wire:model="user.email"
                        label="Email"
                    />
                </div>
            </div>
        </div>
        <x-ui.button primary label="Save" />
    </form>
</x-ui.card>
