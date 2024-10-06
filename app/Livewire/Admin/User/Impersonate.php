<?php

declare(strict_types = 1);

namespace App\Livewire\Admin\User;

use App\Exceptions\InvalidImpersonationException;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\On;
use Livewire\Component;

class Impersonate extends Component
{
    public ?User $user = null;

    public function mount(): void
    {
        $this->user = session()->get('impersonate')
            ? User::find(session()->get('impersonate'))
            : null;
    }

    public function render(): View
    {
        return view('livewire.admin.user.impersonate');
    }

    #[On('user::impersonate')]
    public function submit(User $user): void
    {
        if ($user->is(auth()->user())) {
            throw new InvalidImpersonationException('You cannot impersonate yourself.');
        }

        $this->authorize('impersonate', $user);

        session()->put('impersonator', auth()->user()->id);
        session()->put('impersonate', $user->id);

        $this->redirectRoute('dashboard');
    }

    public function finish(): void
    {
        session()->forget('impersonator');
        session()->forget('impersonate');
        $this->redirectRoute('dashboard');
    }
}
