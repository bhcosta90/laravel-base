@props(['actions' => null])

<form>
    {{ $slot }}

    @if(filled($actions))
        {!! $actions !!}
    @endif
</form>
