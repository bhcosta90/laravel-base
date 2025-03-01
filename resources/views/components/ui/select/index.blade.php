@props([
    'options' => null,
    'sm' => false,
])
<select {{ $attributes->class([
    'select select-bordered w-full',
    'select-sm' => $sm
]) }}>
    <option value="">@lang('Select an option')</option>
    @foreach($options as $option)
        <option value="{{ $option->id }}">{{ $option->name }}</option>
    @endforeach
</select>
