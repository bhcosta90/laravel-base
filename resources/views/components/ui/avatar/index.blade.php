@props([
    'src',
    'xs' => false,
    'sm' => false,
    'md' => false,
    'lg' => false,
    'xl' => false,
    'squared' => false
])

<img @class([
        'shrink-0 object-cover object-center',
        'rounded-sm'   =>  $squared,
        'rounded-full' => !$squared,
        'border border-gray-200 dark:border-secondary-500',
        'w-6 h-6 text-2xs' => $xs,
        'w-8 h-8 text-sm' => $sm,
        'w-10 h-10 text-base' => $md || (!$xs && !$sm && !$lg && !$xl),
        'w-12 h-12 text-lg' => $lg,
        'w-14 h-14 text-xl' => $xl,
    ])
     src="{{ $src }}"
     alt="{{ $attributes->get('alt') }}"
/>

