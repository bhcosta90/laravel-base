<?php

declare(strict_types = 1);

namespace App\Livewire\Auth;

use App\Livewire\Traits\HandleRedirect;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\{Auth, RateLimiter};
use Illuminate\Support\Str;
use Livewire\Attributes\{Layout};
use Livewire\Component;

#[Layout('components.layouts.guest')]
class Login extends Component
{
    use HandleRedirect;

    public ?string $email = '';

    public ?string $password = '';

    public bool $remember = false;

    public function mount(): void
    {
        if (auth()->check()) {
            $this->redirectRoute('dashboard');
        }
    }

    public function render(): View
    {
        return view('livewire.auth.login');
    }

    public function submit(): void
    {
        if ($this->ensureIsNotRateLimited()) {
            return;
        }

        if (!Auth::attempt(['email' => $this->email, 'password' => $this->password], $this->remember)) {
            RateLimiter::hit($this->throttleKey());
            $this->reset('password');
            $this->addError('invalidCredential', trans('auth.failed'));

            return;
        }

        RateLimiter::clear($this->throttleKey());
        $this->redirectRouteMessage('dashboard', 'You have successfully logged in.');
        $this->redirect(route('dashboard'));
    }

    protected function ensureIsNotRateLimited(): bool
    {
        if (!RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return false;
        }

        $seconds = RateLimiter::availableIn($this->throttleKey());

        $this->addError('rateLimiter', trans('auth.throttle', [
            'seconds' => $seconds,
            'minutes' => ceil($seconds / 60),
        ]));

        return true;
    }

    private function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->email) . '|' . request()->ip());
    }
}
