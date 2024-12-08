@props(['actions' => null])

<form {{ $attributes->class([
    'space-y-2',
]) }}>
    {{ $slot }}

    @if(filled($actions))
        {!! $actions !!}
    @endif
</form>
