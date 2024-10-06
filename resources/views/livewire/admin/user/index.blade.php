@php use App\Models\User; @endphp
<div>
    <x-table :records="$this->records">
        <x-table.head>
            <x-table.row>
                <x-table.id />
                <x-table.th label="Name" />
                <x-table.th label="Email" />
                @can('impersonate', User::class)
                    <x-table.th action></x-table.th>
                @endcan
            </x-table.row>
        </x-table.head>
        <x-table.body>
            @foreach($this->records as $record)
                <x-table.row>
                    <x-table.id :id="$record->id" />
                    <x-table.td :label="$record->name" />
                    <x-table.td>
                        <x-ui.link href="mailto:{{ $record->email }}" navigate>
                            {{ $record->email }}
                        </x-ui.link>
                    </x-table.td>
                    @can('impersonate', $record)
                        <x-table.td>
                            <x-ui.button
                                label="Impersonate"
                                @click="$dispatch('user::impersonate', { user: {{ $record->id }} })"
                                xs
                            />
                        </x-table.td>
                    @endcan
                </x-table.row>
            @endforeach
        </x-table.body>
    </x-table>
</div>
