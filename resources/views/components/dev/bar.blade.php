<span>
    @if(!app()->isProduction())
        <div class="flex items-center p-2 bg-secondary-content space-x-2 justify-end">
            <livewire:dev.login />
        </div>
    @endif
</span>
