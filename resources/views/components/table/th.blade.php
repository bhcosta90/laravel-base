@props([
    'label' => null,
    'action' => null,
    'name' => null,
    'sortName' => null,
    'sortDirection' => null,
    'hidden' => false,
])
<th {{ $attributes->merge(['class' => \Illuminate\Support\Arr::toCssClasses([
    'px-3 py-3.5 text-left text-sm font-semibold text-gray-900',
    'w-0' => $action,
    'cursor-pointer' => $name,
    'hidden md:table-cell' => $hidden
])]) }}
    wire:click="{{ $name ? 'sortBy(\'' . $name . '\')' : null }}"
    wire:target="{{ $name ? 'sortBy(\'' . $name . '\')' : null }}"
>
    <div class="whitespace-nowrap flex align-items-center gap-x-2">
        @if($name)
            <span class="inline-flex items-center space-x-1">
            @if($sortDirection === 'asc' && $sortName === $name)
                <x-ui.icon name="chevron-up" class="w-[1rem] h-[1rem] text-gray-500" />
            @else
                <x-ui.icon name="chevron-down" class="w-[1rem] h-[1rem] text-gray-500" />
            @endif
        </span>
        @endif
        {{  $slot->isEmpty() ? $label : $slot }}
    </div>
</th>
