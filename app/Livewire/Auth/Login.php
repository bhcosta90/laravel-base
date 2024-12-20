<?php

declare(strict_types = 1);

namespace App\Livewire\Auth;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\{Auth, RateLimiter};
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.guest')]
class Login extends Component
{
    public ?string $email = null;

    public ?string $password = null;

    public bool $remember = false;

    public function render(): View
    {
        return view('livewire.auth.login')->layoutData(['title' => 'Login']);
    }

    public function tryToLogin(): void
    {
        if ($this->ensureIsNotRateLimiting()) {
            return;
        }

        $loginEmail = Auth::attempt(['email' => $this->email, 'password' => $this->password], $this->remember);
        $loginLogin = !$loginEmail && Auth::attempt(['login' => $this->email, 'password' => $this->password], $this->remember);

        if (!$loginEmail && !$loginLogin) {
            RateLimiter::hit($this->throttleKey());

            $this->addError('invalidCredentials', trans('auth.failed'));

            return;
        }

        $this->redirect(route('dashboard'));
    }

    protected function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->email) . '|' . request()->ip());
    }

    protected function ensureIsNotRateLimiting(): bool
    {
        if (RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            $this->addError('rateLimiter', trans('auth.throttle', [
                'seconds' => RateLimiter::availableIn($this->throttleKey()),
            ]));

            return true;
        }

        return false;
    }
}
