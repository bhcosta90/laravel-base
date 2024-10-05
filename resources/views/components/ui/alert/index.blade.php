@props([
    'success' => null,
    'info' => null,
    'warning' => null,
    'error' => null,
    'dismissible' => null,
    'icon' => null,
    'sm' => null,
    'text' => null,
    'center' => false,
])

<div {{ $attributes->class([
    'alert rounded-md',
    'alert-success' => $success,
    'alert-info' => $info,
    'alert-warning' => $warning,
    'alert-error text-white' => $error,
    '!p-2' => $sm,
    'flex justify-center' => $center,
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
    <span class="text-center">{{ $slot->isEmpty() ? $text : $slot }}</span>
</div>
