@props([
    'name'
])

<x-dynamic-component
    component="{{ $name }}"
    {{ $attributes->merge([
        'class' => 'h-6 w-6 shrink-0'
    ]) }}
/>
