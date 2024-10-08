<?php

declare(strict_types = 1);

namespace App\Livewire\Auth;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class Profile extends Component
{
    public User $user;

    public function mount(): void
    {
        $this->user = auth()->user();
    }

    public function render(): View
    {
        return view('livewire.auth.profile');
    }
}
