@props([
    'info' => false,
    'neutral' => false,
    'xs' => false,
])

<a {{ $attributes->merge([
    'wire:navigate' => !$attributes->has('navigate'),
]) }} @class([
    'link',
    'link-info' => $info,
    'text-accent' => $neutral,
    'text-xs' => $xs,
])>
    {{ $slot }}
</a>
