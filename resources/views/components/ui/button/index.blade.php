@props([
    'label' => null,
    'primary' => false,
    'secondary' => false,
    'accent' => false,
    'success' => false,
    'warning' => false,
    'info' => false,
    'error' => false,
    'hover' => false,
    'neutral' => false,
    'ghost' => false,
    'link' => false,
    'active' => false,
    'glass' => false,
    'outline' => false,
    'noAnimation' => false,
    'xs' => false,
    'sm' => false,
    'md' => false,
    'lg' => false,
    'wide' => false,
    'block' => false,
    'circle' => false,
    'square' => false,
    'loading' => null,
    'icon' => null,
    'withLoading' => false,
    'href' => false,
    'white' => false,
    'full' => false,
    'join' => false,
])

@php
    $loadingTarget = null;

    if ($wireClick = $attributes->get('wire:click')) {
        $loadingTarget = $wireClick;
    }

    if ($loading) {
        $loadingTarget = $loading;
    }
@endphp

<button
    {{ $attributes->merge(['type' => 'submit'])->class([
        'btn normal-case rounded',
        'flex items-center' => !$href,
        'btn-primary' => $primary,
        'btn-secondary' => $secondary,
        'btn-accent' => $accent,
        'btn-success' => $success,
        'btn-warning' => $warning,
        'btn-info' => $info,
        'btn-error' => $error,
        'btn-hover' => $hover,
        'btn-neutral hover:bg-text-0 hover:text-text-800' => $neutral,
        'btn-ghost' => $ghost,
        'btn-link' => $link,
        'btn-active' => $active,
        'glass' => $glass,
        'btn-outline' => $outline,
        'no-animation' => $noAnimation,
        'btn-xs' => $xs,
        'btn-sm' => $sm,
        'btn-md' => $md,
        'btn-lg' => $lg,
        'btn-wide' => $wide,
        'btn-block' => $block,
        'btn-circle' => $circle,
        'btn-square' => $square,
        'bg-text-0 hover:bg-text-800 hover:text-text-0' => $white,
        'w-full' => $full,
        'join-item' => $join,
    ]) }}
    wire:loading.attr="disabled">
    @if ($icon)
        <x-ui.icon :name="$icon" class="!size-4" />
    @endif

    {{ $label ?: $slot }}

    @if ($withLoading && $loadingTarget)
        <span wire:loading.class.remove="hidden" wire:target="{{ $loadingTarget }}"
              class="loading loading-ring loading-sm hidden"></span>
    @endif

</button>
