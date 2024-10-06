@props([
    'label' => null,
    'action' => null,
])
<th @class([
    'px-3 py-3.5 text-left text-sm font-semibold text-gray-900',
    'w-0' => $action,
])>
    {{  $slot->isEmpty() ? $label : $slot }}
</th>
