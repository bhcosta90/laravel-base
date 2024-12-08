<div>
    @if(!app()->isProduction())
        <div class="flex gap-x-3 justify-end bg-base-200 p-3 border-b-2 border-b-base-300">
            <livewire:dev.branch-env />
            <livewire:dev.login />
        </div>
    @endif
</div>
