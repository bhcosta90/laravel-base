<div>
    <x-ui.badge secondary>
        @lang('env: :env', ['env' => $this->env])
    </x-ui.badge>

    <x-ui.badge secondary>
        @lang('branch: :branch', ['branch' => $this->branch])
    </x-ui.badge>
</div>
