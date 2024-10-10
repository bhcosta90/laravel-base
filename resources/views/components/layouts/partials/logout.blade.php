<form method="post" action="{{ route('logout') }}">
    @csrf
    <a href="{{ route('logout') }}" class="text-secondary-600 px-4 py-2 text-sm flex items-center cursor-pointer rounded-md transition-colors duration-150
            hover:text-secondary-900 hover:bg-secondary-100 dark:text-secondary-400 dark:hover:bg-secondary-700
            w-full" onclick="event.preventDefault(); this.closest('form').submit();">
        @lang('Logout')
    </a>
</form>
