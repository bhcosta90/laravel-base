@props(['value' => null])
<div>
    {{ __($value) ?: $slot }}
</div>
