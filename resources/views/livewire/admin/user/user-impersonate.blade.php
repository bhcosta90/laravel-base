<div>
    @if($this->user)
        <div class="cursor-pointer py-4 text-center bg-warning-content text-warning" wire:click="finish">
            @lang('You are currently impersonating <b><u>:name</u></b>, click here to finish impersonate.',
                [
                    'name' => $this->user->name
                ]
            )
        </div>
    @endif
</div>
