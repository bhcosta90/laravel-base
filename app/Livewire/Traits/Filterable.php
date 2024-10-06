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

    #[On('tag-search')]
    public function syncSearch($tags = []): void
    {
        $this->search = $tags;
    }
}
