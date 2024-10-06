@props([
    'menu',
    'open' => false,
    'ml' => false,
])

<ul @class([
        'mt-3 ',
        'border-l-2 border-l-secondary-content-550 ml-2' => $ml,
    ])
>
    @foreach($menu as $item)
        <li
            class="mb-2"
        >
            @if($item['submenu'] ?? null)
                <details {{ ($item['open'] ?? null) ? 'open' : '' }}>
                    <summary
                        @class([
                            'gap-3 text-sm font-medium text-primary-content-450 rounded-lg',
                            'hover:bg-neutral-content-100 active:!bg-neutral-100 active:!text-text-650',
                            'cursor-pointer' => $item['submenu'] ?? null
                        ])
                    >
                        {{ __($item['title']) }}
                    </summary>

                    <x-layouts.partials.submenu
                        :menu="$item['submenu']"
                        :ml="true"
                    >
                    </x-layouts.partials.submenu>
                </details>
            @else
                <a
                    href="{{ isset($item['route']) ? route($item['route']) : '#' }}"
                    @class([
                        'bg-neutral-100 text-text-800 font-medium' => $item['open'] ?? false,
                    ])
                >
                    {{ __($item['title']) }}
                </a>
            @endif
        </li>
    @endforeach
</ul>
