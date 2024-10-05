<?php

declare(strict_types = 1);

namespace App\Livewire\Auth\Password;

use App\Livewire\Traits\HandleRedirect;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Password;
use Livewire\Attributes\{Layout, Validate};
use Livewire\Component;

#[Layout('components.layouts.guest')]
class Recovery extends Component
{
    use HandleRedirect;

    #[Validate(['email' => 'required|email'])]
    public ?string $email = null;

    public function render(): View
    {
        return view('livewire.auth.password.recovery');
    }

    public function submit(): void
    {
        $this->validate();

        $status = Password::sendResetLink(['email' => $this->email]);

        $this->handleResponse($status);
    }

    protected function handleResponse(string $status): void
    {
        if ($status === Password::RESET_LINK_SENT) {
            $this->redirectRouteMessage('login', __($status));

            return;
        }

        $this->addError('email', __($status));
    }
}
