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

    public function load(int $id): void
    {
        $m = $this->getModel();

        $this->model = (new $m())->find($id);
        $this->open  = true;
        $this->updatedOpen();
    }

    public function updatedOpen(): void
    {
        $m = $this->getModel();

        $this->model?->id
            ? $this->authorize('edit', $this->model)
            : $this->authorize('create', $this->model = new $m());
    }

    abstract protected function getModel(): string;
}
