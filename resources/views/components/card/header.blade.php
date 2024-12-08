<div {{ $attributes->class([
    'card-header text-4xl border-b-1 p-3',
    'text-center' => $attributes->has('center'),
]) }}
>
    {{ $slot }}
</div>
