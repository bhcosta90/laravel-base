<?php

declare(strict_types = 1);

namespace App\Livewire\Auth;

use App\Models\User;
use App\Notifications\User\TokenNotification;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\{Auth, RateLimiter};
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.guest')]
class Login extends Component
{
    public ?string $login = '';

    public bool $isLogin = false;

    public bool $isEmail = false;

    public ?string $password = null;

    public function render(): View
    {
        return view('livewire.auth.login');
    }

    public function submit(): void
    {
        if ($this->ensureIsNotRateLimiting(__FUNCTION__)) {
            return;
        }

        $this->validate([
            'login' => 'required|string',
        ]);

        if (filter_var($this->login, FILTER_VALIDATE_EMAIL)) {
            $this->isEmail = true;

            $user = User::whereLogin($this->login)->first();

            if ($user) {
                $user->password = $password = mb_strtoupper((string) str()->random(6));
                $user->save();

                $user->notify(new TokenNotification($password));
            }
        } else {
            $this->isLogin = true;
        }

        RateLimiter::hit($this->throttleKey(__FUNCTION__));
    }

    public function execute(): void
    {
        if ($this->ensureIsNotRateLimiting(__FUNCTION__)) {
            return;
        }

        if (Auth::attempt(['login' => $this->login, 'password' => $this->password])) {
            $this->redirect('dashboard');
        }

        RateLimiter::hit($this->throttleKey(__FUNCTION__));
        $this->addError('login', __('auth.failed'));
    }

    protected function throttleKey(string $action): string
    {
        return Str::transliterate(Str::lower($action . $this->login) . '|' . request()->ip());
    }

    protected function ensureIsNotRateLimiting(string $action): bool
    {
        if (RateLimiter::tooManyAttempts($this->throttleKey($action), 5)) {
            $this->addError('rateLimiter', trans('auth.throttle', [
                'seconds' => RateLimiter::availableIn($this->throttleKey($action)),
            ]));

            return true;
        }

        return false;
    }
}
