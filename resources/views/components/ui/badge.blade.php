@props([
    'label' => null,
    'primary' => false,
    'secondary' => false,
])
<div @class([
    'badge',
    'badge-primary' => $primary,
    'badge-secondary' => $secondary,
])>
    {{ $slot->isNotEmpty() ? $slot : $label }}
</div>
