@props(['label' => null])

<div>
    @if($label)
        <label class="block text-sm">
        <div class="mb-0.5">{{ __($label) }}</div>
    @endif
    <input {{ $attributes->class([
        'input input-bordered w-full'
    ]) }} />
    @if($label)
        </label>
    @endif
</div>
