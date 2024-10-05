@props([
    'message' => 'Already have an account?'
])

<div class="text-sm font-medium text-gray-500 dark:text-gray-300">
    @lang($message)
    <x-ui.link href="{{ route('login') }}" info>
        Login here
    </x-ui.link>
</div>
