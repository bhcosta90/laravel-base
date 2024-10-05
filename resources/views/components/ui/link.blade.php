@props([
    'info' => false,
    'neutral' => false,
    'xs' => false,
])

<a {{ $attributes }} wire:navigate @class([
    'link',
    'link-info' => $info,
    'text-accent' => $neutral,
    'text-xs' => $xs,
])>
    {{ $slot }}
</a>
