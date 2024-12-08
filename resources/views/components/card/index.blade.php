@props([
    'header' => null,
    'primary' => false,
])
<div {{ $attributes->class([
    'card bg-base-100 shadow-xl',
    'border-t-3 border-primary' => $primary
]) }}>
    @if($header)
        <x-card.header
            :center="$header->attributes?->get('center')"
            :lg="$header->attributes?->get('lg')"
        >
            {{ $header }}
        </x-card.header>
    @endif
    <div class="card-body">
        {{ $slot }}
    </div>
</div>
