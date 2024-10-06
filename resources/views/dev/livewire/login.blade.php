<form class="join" wire:submit="submit">
    <x-ui.form.select :queryBuilder="$this->users" join />
    <x-ui.button label="Subscribe" join />
</form>
