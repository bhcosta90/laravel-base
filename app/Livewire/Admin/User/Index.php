<?php

declare(strict_types = 1);

namespace App\Livewire\Admin\User;

use App\Livewire\Traits\Filterable;
use App\Models\User;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Contracts\View\View;
use Laravel\Telescope\AuthorizesRequests;
use Livewire\Attributes\{Computed, Layout};
use Livewire\Component;

#[Layout('components.layouts.app', ['globalSearch' => true])]
class Index extends Component
{
    use Filterable;
    use AuthorizesRequests;

    public function mount(): void
    {
        $this->authorize('viewAny', User::class);
    }

    public function render(): View
    {
        return view('livewire.admin.user.index');
    }

    #[Computed]
    public function records(): Paginator
    {
        return User::query()
            ->select(['id', 'name', 'email'])
            ->filter(['name', 'email'], $this->search)
            ->orderBy('name')
            ->orderBy('email')
            ->paginate(10);
    }
}
