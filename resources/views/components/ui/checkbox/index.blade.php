@props([
    'label',
    'primary' => false,
])

<label class="flex justify-center gap-2">
    <div>
        <input type="checkbox" {{ $attributes->class([
            'checkbox',
            'checkbox-primary' => $primary
        ]) }} />
    </div>

    <div>
        {{ __($label) }}
    </div>
</label>
