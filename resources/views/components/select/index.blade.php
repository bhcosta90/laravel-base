@props(['options'])
<select {{ $attributes }}>
    <option value="">@lang('Select an option')</option>
    @foreach($options as $option)
        <option value="{{ $option->id }}">{{ $option->name }}</option>
    @endforeach
</select>
