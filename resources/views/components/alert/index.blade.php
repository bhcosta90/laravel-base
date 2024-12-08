@props([
    'icon' => null,
])
<div {{ $attributes->class([
    'alert shadow-lg',
]) }}>
    @if($icon)
        <x-icons :name="$icon" />
    @endif
    {{ $slot }}
</div>
