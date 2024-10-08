<?php

declare(strict_types = 1);

namespace App\Livewire\Traits;

use Livewire\Attributes\{On, Url};
use Livewire\WithPagination;

trait Filterable
{
    use WithPagination;

    #[Url]
    public array $search = [];

    #[Url(as: 'order-name')]
    public string $orderName = 'name';

    #[Url(as: 'order-direction')]
    public string $orderDirection = 'asc';

    #[On('tag-search')]
    public function syncSearch($tags = []): void
    {
        $this->search = $tags;
    }

    public function sortBy(string $name): void
    {
        $this->orderDirection = $this->orderName === $name
            ? $this->revertSort()
            : 'asc';
        $this->orderName = $name;
        $this->resetPage();
    }

    protected function revertSort(): string
    {
        return $this->orderDirection === 'asc'
            ? 'desc'
            : 'asc';
    }
}
