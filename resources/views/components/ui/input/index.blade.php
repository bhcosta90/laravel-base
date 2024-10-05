@props([
    'label',
    'placeholder' => null,
    'xs'          => false,
    'sm'          => false,
    'md'          => false,
    'lg'          => false,
    'error'   => true,
    'icon'        => false,
])

@php($name ??= $attributes->wire('model')->value())
@php($id = $name ?? str()->uuid())

<div>
    @if($label)
        <label for="{{ $id }}">
            <span @class([
                'text-text-800 text-sm font-medium leading-5',
                'text-error' => $errors->has( $name ),
            ])>
                {{ $label }}
            </span>
        </label>
    @endif

    <div class="flex items-center">
        <input
            {{ $attributes->merge([
                'id'          => $id,
                'name'        => $name,
                'type'        => match(true) {
                    $attributes->has('password') => 'password',
                    $attributes->has('email') => 'email',
                    default => 'text',
                },
                'placeholder' => $placeholder,
                'autocomplete' => 'off'
            ])->class([
                'rounded-sm w-full text-sm font-normal leading-5 h-10 focus:ring-1 focus:ring-secondary-content-200 focus:outline-none',
                'input-error' => $errors->has($name),
                'input-xs' => $xs,
                'input-sm' => $sm,
                'input-md' => $md,
                'input-lg' => $lg,
                'focus:pr-10 hover:pr-10' => $icon && $attributes['type'] === 'number',
            ]) }}
        />

        @if ($icon)
            <x-ui.icon name="{{ $icon }}" class="-ml-8 text-neutral-400" />
        @endif
    </div>

    @if ($error)
        @error( $name )
        <label class="label">
            <span class="label-alt text-error text-sm">{{ $message }}</span>
        </label>
        @enderror
    @endif
</div>
