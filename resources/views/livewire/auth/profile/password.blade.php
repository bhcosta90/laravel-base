<x-ui.card title="Password information">
    <form wire:submit="submit" class="space-y-6">
        <div class="space-y-3">
            <div class="lg:flex lg:justify-between lg:w-full lg:space-x-4 md:space-y-4 lg:space-y-0">
                <div class="w-full">
                    <x-ui.input
                        required
                        min="8"
                        max="25"
                        :error="false" type="password" label="New password"
                        wire:model="password"
                    />
                </div>
                <div class="w-full">
                    <x-ui.input
                        required
                        min="8"
                        max="25"
                        min="8"
                        type="password"
                        wire:model="password_confirmation"
                        label="Confirm password"
                    />
                </div>
            </div>
            <x-ui.error name="password" />
        </div>
        <x-ui.button primary label="Save" />
    </form>
</x-ui.card>
