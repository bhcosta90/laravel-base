<select
    @class([
        'select select-bordered w-full max-w-xs',
        'join-item' => $join
    ])
    wire:model="user"
>
    <option value="">@lang('Select')</option>
    @foreach($data as $key => $item)
        <option value="{{ $key }}">{{ $item }}</option>
    @endforeach
</select>
