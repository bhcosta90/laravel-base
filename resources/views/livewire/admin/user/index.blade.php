@php use App\Models\User; @endphp
<div>
    <x-table :records="$this->records">
        <x-table.head>
            <x-table.row>
                <x-table.id />
                <x-table.th label="Name" />
                <x-table.th label="Email" />
                <x-table.th action></x-table.th>
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
                    <x-table.td>
                        <x-ui.button
                            :disabled="!auth()->user()->can('impersonate', $record)"
                            label="Impersonate"
                            @click="$dispatch('user::impersonate', { user: {{ $record->id }} })"
                            xs
                        />
                    </x-table.td>
                </x-table.row>
            @endforeach
        </x-table.body>
    </x-table>
</div>
