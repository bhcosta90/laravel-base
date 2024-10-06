@props(['id' => null])

@if(app()->isLocal())
    @if($id)
        <x-table.td :label="$id" />
    @else
        <x-table.th label="" action />
    @endif
@else
    <!-- Empty Component -->
@endif
