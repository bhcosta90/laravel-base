<x-ui.dropdown end hover>
    <x-slot name="trigger">
        <x-ui.avatar sm src="https://placehold.co/200x200" alt="Profile Avatar"/>
    </x-slot>

    <a href="{{ route('profile') }}" class="text-secondary-600 px-4 py-2 text-sm flex items-center cursor-pointer rounded-md transition-colors duration-150
                hover:text-secondary-900 hover:bg-secondary-100 dark:text-secondary-400 dark:hover:bg-secondary-700
                w-full" wire:navigate>
        @lang('Profile')
    </a>

    <x-layouts.partials.logout />
</x-ui.dropdown>
