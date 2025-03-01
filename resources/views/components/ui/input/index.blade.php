@props([
    'label' => null,
    'placeholder' => false,
    'showError' => true
])

@php
    $name ??= $attributes->wire('model')->value();
    $id = $name ?? uniqid('', true);
@endphp

<div>
    @if($label)
        <label class="block text-sm">
            <div class="mb-0.5">{{ __($label) }}</div>
            @endif
            <input placeholder="{{ __($placeholder) }}" {{ $attributes->class([
        'input input-bordered w-full'
    ]) }} />
            @if($label)
        </label>
    @endif

    @if ($showError)
        @error( $name )
        <label class="label">
            <span class="label-alt text-error text-sm">{{ $message }}</span>
        </label>
        @enderror
    @endif
</div>
