<?php

declare(strict_types = 1);

namespace App\Livewire\Dev;

use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\View\View;
use Livewire\Attributes\Computed;
use Livewire\Component;

class Login extends Component
{
    public ?int $selectedUser = null;

    public function render(): View
    {
        return view('livewire.dev.login');
    }

    #[Computed]
    public function users(): Collection
    {
        return User::query()->orderBy('id')->get();
    }

    public function login(): void
    {
        auth()->loginUsingId($this->selectedUser);

        $this->redirect(route('dashboard'));
    }
}