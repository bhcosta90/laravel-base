@props(['name'])

<span>
    @error($name)
        <label class="label">
            <span class="label-alt text-error text-sm">{{ $message }}</span>
        </label>
    @enderror
</span>
