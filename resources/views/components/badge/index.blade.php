@props([
    'value' => null,
    'ghost' => false,
    'neutral' => false,
  ])
<div {{$attributes->class([
    'badge',
    'badge-ghost' => $ghost,
    'badge-neutral' => $neutral,
])}}>
    {{ __($value) ?: $slot }}
</div>
