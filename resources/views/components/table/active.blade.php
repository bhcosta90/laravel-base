@if($attributes->has('active'))
    <x-table.td center>
        @if($attributes->get('active') === true || $attributes->get('active') === null)
            <x-ui.badge success>@lang('Active')</x-ui.badge>
        @else
            <x-ui.badge info>@lang('Inactive')</x-ui.badge>
        @endif
    </x-table.td>
@else
    <x-table.th action><x-ui.toggle wire:model.live="active" /></x-table.th>
@endif
