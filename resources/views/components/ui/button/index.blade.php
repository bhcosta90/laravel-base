@props([
    'label' => null,
    'primary' => false,
    'secondary' => false,
    'outline' => false,
    'full' => false,
    'sm' => false,
])
<button {{ $attributes->class([
    'btn',
    'btn-primary' => $primary,
    'btn-secondary' => $secondary,
    'btn-sm' => $sm,
    'btn-outline' => $outline,
    'w-full' => $full,
]) }}>
    {{ __($label) ?: $slot }}
</button>
