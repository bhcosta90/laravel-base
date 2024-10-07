<?php

declare(strict_types = 1);

namespace App\Livewire\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

trait HandleManager
{
    use AuthorizesRequests;

    public ?Model $model = null;

    public bool $open = false;

    public function load(Model $model): void
    {
        $this->model = $model;
        $this->open  = true;
        $this->updatedOpen();
    }

    public function updatedOpen(): void
    {
        $m = $this->getModel();

        $this->model?->id
            ? $this->authorize($this->permissionUpdate(), $this->model)
            : $this->authorize($this->permissionCreate(), $this->model = new $m());
    }

    protected function permissionCreate(): string
    {
        return 'create';
    }

    protected function permissionUpdate(): string
    {
        return 'update';
    }

    abstract protected function getModel(): string;
}
