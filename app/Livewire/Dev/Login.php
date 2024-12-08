<?php

declare(strict_types = 1);

namespace App\Livewire\Dev;

use App\Actions\Auth\LogoutAction;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\View\View;
use Livewire\Attributes\Computed;
use Livewire\Component;

class Login extends Component
{
    public ?int $selectedUser = null;

    public function mount(): void
    {
        $this->selectedUser = auth()->user()?->id;
    }

    public function render(): View
    {
        return view('livewire.dev.login');
    }

    #[Computed]
    public function users(): Collection
    {
        return User::query()->orderBy('id')->get();
    }

    public function login(LogoutAction $logoutAction): void
    {
        if (blank($this->selectedUser)) {
            $logoutAction->handle();

            return;
        }

        auth()->loginUsingId($this->selectedUser);

        $this->redirect(route('dashboard'));
    }
}
