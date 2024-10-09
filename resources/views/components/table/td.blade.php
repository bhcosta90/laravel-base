@props([
    'label' => false,
    'center' => false,
    'hidden' => false,
])
<td @class([
    'whitespace-nowrap px-3 py-4 text-sm text-gray-500',
    'text-center' => $center,
    'hidden md:table-cell' => $hidden
])>
    {{  $slot->isEmpty() ? $label : $slot }}
</td>
