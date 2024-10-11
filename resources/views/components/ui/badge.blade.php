@props([
    'label' => null,
    'primary' => false,
    'secondary' => false,
    'info' => false,
    'success' => false,
])
<div @class([
    'badge',
    'badge-primary' => $primary,
    'badge-secondary' => $secondary,
    'badge-info' => $info,
    'badge-success' => $success,
])>
    {{ $slot->isNotEmpty() ? $slot : $label }}
</div>
