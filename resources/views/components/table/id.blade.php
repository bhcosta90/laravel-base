@props(['id' => null])

@if(app()->isLocal())
    @if($id)
        <x-table.td :label="$id" center />
    @else
        <x-table.th label="ID" name="id" action />
    @endif
@else
    <!-- Empty Component -->
@endif
