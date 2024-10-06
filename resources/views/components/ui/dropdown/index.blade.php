@props([
    'trigger' => null,
    'end' => false,
    'hover' => false,
    'circle' => false,
])

<div {{ $attributes->class(['dropdown', 'dropdown-end' => $end, 'dropdown-hover' => $hover]) }}>
    <label tabindex="0" {{ $trigger->attributes->class(['m-1 btn btn-ghost no-animation btn-circle' => $circle]) }}>{{ $trigger }}</label>

    <ul class="p-2 shadow menu dropdown-content z-[1] bg-base-100 rounded-box w-52">
        {{ $slot }}
    </ul>
</div>
