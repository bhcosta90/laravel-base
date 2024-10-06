<?php

declare(strict_types = 1);

namespace App\Livewire\Auth\Email;

use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.guest')]
class Notice extends Component
{
    public bool $sent = false;

    public function render(): View
    {
        return view('livewire.auth.email.notice');
    }

    public function resend(): void
    {
        auth()->user()->sendEmailVerificationNotification();

        $this->sent = true;
    }
}
