@props([
    'icon' => null,
])
<div {{ $attributes->class([
    'alert shadow-lg',
]) }}>
    @if($icon)
        <x-ui.icons :name="$icon" />
    @endif
    {{ $slot }}
</div>
