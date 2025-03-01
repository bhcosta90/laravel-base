<div {{ $attributes->class([
    'card-header border-b-1 p-3',
    'text-3xl' => $attributes->get('lg'),
    'text-center' => $attributes->get('center'),
]) }}
>
    {{ $slot }}
</div>
