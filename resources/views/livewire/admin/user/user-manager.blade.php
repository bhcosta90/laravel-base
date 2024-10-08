<div>
    <x-ui.button primary outline label="Add user" wire:click="$set('open', true)" />

    <x-ui.slide :$open title="Add user">
        <ul class="menu bg-base-200 text-base-content min-h-full w-80 p-4">
            <li><a>Sidebar Item 1</a></li>
            <li><a>Sidebar Item 2</a></li>
        </ul>
    </x-ui.slide>
</div>
