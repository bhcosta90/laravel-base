<?php

declare(strict_types = 1);

namespace App\Livewire\Auth;

use App\Models\User;
use App\Notifications\User\TokenNotification;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

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
        if (filter_var($this->login, FILTER_VALIDATE_EMAIL)) {
            $this->isEmail = true;

            $user = User::whereLogin($this->login)->first();

            $user->password = $password = mb_strtoupper(str()->random(6));
            $user->save();

            $user->notify(new TokenNotification($password));
        } else {
            $this->isLogin = true;
        }
    }

    public function login(): void
    {
        if (Auth::attempt(['login' => $this->login, 'password' => $this->password])) {
            $this->redirect('dashboard');
        }

        $this->addError('login', __('auth.failed'));
    }
}
