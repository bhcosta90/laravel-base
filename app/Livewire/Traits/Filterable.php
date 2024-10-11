<?php

declare(strict_types = 1);

namespace App\Livewire\Traits;

use Livewire\Attributes\{On, Url};
use Livewire\WithPagination;

trait Filterable
{
    use WithPagination;

    #[Url]
    public bool $active = true;

    #[Url]
    public array $search = [];

    #[Url(as: 'sort-name')]
    public string $sortName = 'name';

    #[Url(as: 'sort-direction')]
    public string $sortDirection = 'asc';

    #[On('tag-search')]
    public function syncSearch($tags = []): void
    {
        $this->search = $tags;
    }

    public function sortBy(string $name): void
    {
        $this->sortDirection = $this->sortName === $name
            ? $this->revertSort()
            : 'asc';
        $this->sortName = $name;
        $this->resetPage();
    }

    protected function revertSort(): string
    {
        return $this->sortDirection === 'asc'
            ? 'desc'
            : 'asc';
    }

    public function updatedActive(): void
    {
        $this->resetPage();
        ;
    }
}
