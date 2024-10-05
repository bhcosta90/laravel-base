@props([
    'success' => null,
    'info' => null,
    'warning' => null,
    'danger' => null,
    'dismissible' => null,
    'icon' => null,
    'sm' => null,
])

<div {{ $attributes->class([
    'flex gap-2 items-center rounded-md border text-sm p-4',
    'bg-green-50 border-green-500 dark:bg-secondary-800 dark:border-green-600 text-green-800 dark:text-green-600' => $success,
    'bg-info-content-100 border-info-content-600 dark:bg-secondary-800 dark:border-blue-600 text-info-content-600 dark:text-blue-600' => $info,
    'bg-yellow-50 border-yellow-500 dark:bg-secondary-800 dark:border-yellow-600 text-yellow-600 dark:text-yellow-600' => $warning,
    'bg-red-50 border-red-500 dark:bg-secondary-800 dark:border-red-600 text-red-800 dark:text-red-600' => $danger,
    '!p-2' => $sm,
]) }}
     @if($dismissible)
         x-transition:enter="transition ease-out duration-1000"
     x-transition:enter-start="opacity-0 transform scale-90"
     x-transition:enter-end="opacity-100 transform scale-100"
     x-transition:leave="transition ease-in duration-1000"
     x-transition:leave-start="opacity-100 transform scale-100"
     x-transition:leave-end="opacity-0 transform scale-90"
     x-data="{ show: false }"
     x-show="show"
     {{ '@'. $dismissible }}.window="
            show = true;
            setTimeout(() => show = false, 2000);
         "
    @endif
>
    @if ($icon)
        <x-ui.icon :name="$icon" />
    @endif
    <div>{{ $slot }}</div>
</div>
