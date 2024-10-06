<tr @class([
    'even:bg-gray-50'
])>
    {{  $slot }}
    @if(app()->isLocal())

    @endif
</tr>
