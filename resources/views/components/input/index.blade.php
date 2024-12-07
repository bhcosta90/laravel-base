@props(['label' => null])

<span>
    @if($label)
        <label class="block text-sm font-medium text-gray-700">
        {{ $label }}
    @endif
    <input {{ $attributes }} />
    @if($label)
        </label>
    @endif
</span>
