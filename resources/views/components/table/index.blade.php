@php use Illuminate\Contracts\Pagination\Paginator; @endphp

@props([
    'records',
])

<div class="overflow-y-auto">

    <!--<div wire:loading.remove class="w-full">-->
    <div class="w-full">
        <table @class([
        'min-w-full divide-y divide-gray-300'
    ])>
            {{ $slot }}
        </table>

        @if($records instanceof Paginator)
            <div class="mt-2">
                {{ $records->links('livewire::tailwind') }}
            </div>
        @endif
    </div>
</div>
