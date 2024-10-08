@props(['title'])
<div class="card bg-base-100 w-full shadow-xl">
    <div class="card-body">
        @if($title)
            <x-ui.card.header :text="$title" />
        @endif

        {{ $slot }}
    </div>
</div>
