<?php

declare(strict_types = 1);

namespace App\Livewire\Admin\User;

use App\Livewire\Traits\{Filterable, WithAlert};
use App\Models\User;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Contracts\View\View;
use Laravel\Telescope\AuthorizesRequests;
use Livewire\Attributes\{Computed, Layout, On};
use Livewire\Component;

#[Layout('components.layouts.app', ['globalSearch' => true])]
class UserIndex extends Component
{
    use Filterable;
    use AuthorizesRequests;
    use WithAlert;

    public function mount(): void
    {
        $this->authorize('viewAny', User::class);
    }

    public function render(): View
    {
        return view('livewire.admin.user.user-index');
    }

    #[On('user::index')]
    #[Computed]
    public function records(): Paginator
    {
        return User::query()
            ->select(['id', 'name', 'email', 'is_active'])
            ->filter(['name', 'email'], $this->search)
            ->active($this->active)
            ->orderBy($this->sortName, $this->sortDirection)
            ->orderBy('email')
            ->paginate(10);
    }

    #[On('user::delete')]
    public function delete(User $user): void
    {
        $this->authorize('delete', $user);
        $this->confirmAlert('deleteConfirmation', $user->id);
    }

    public function deleteConfirmation(string $token, User $user): void
    {
        $this->executeConfirmAlert($token, function () use ($user) {
            $this->authorize('delete', $user);
            $user->delete();
            $this->dispatch('user::index');
            $this->dispatch('notify::success', __('User deleted successfully.'));
        });
    }
}
