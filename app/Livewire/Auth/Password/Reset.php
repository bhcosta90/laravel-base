<?php

declare(strict_types = 1);

namespace App\Livewire\Auth\Password;

use Illuminate\Auth\Events\{PasswordReset};
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Password as PasswordFactory;
use Illuminate\Validation\Rules\Password;
use Livewire\Attributes\{Computed, Layout, Url};
use Livewire\Component;

#[Layout('components.layouts.guest')]
class Reset extends Component
{
    public ?string $email = null;

    public ?string $email_confirmation = null;

    public ?string $password = null;

    public ?string $password_confirmation = null;

    #[Url]
    public ?string $token = null;

    public function mount(): void
    {
        $this->email_confirmation = request('email');
    }

    public function render(): View
    {
        return view('livewire.auth.password.reset');
    }

    public function submit(): void
    {
        $this->validate();

        $status = PasswordFactory::reset([
            'email'                 => $this->email_confirmation,
            'password'              => $this->password,
            'password_confirmation' => $this->password_confirmation,
            'token'                 => $this->token,
        ], function ($user) {
            $user->password       = $this->password_confirmation;
            $user->remember_token = str()->random(60);
            $user->save();

            event(new PasswordReset($user));
        });

        $this->handleResponse($status);
    }

    protected function rules(): array
    {
        return [
            'email'    => 'required|email|confirmed',
            'password' => ['required', 'min:8', Password::default(), 'confirmed'],
            'token'    => 'required',
        ];
    }

    protected function handleResponse(string $status): void
    {
        if ($status === PasswordFactory::PASSWORD_RESET) {
            session()->flash('notification::success', __($status));
            $this->redirectRoute('login');

            return;
        }

        $this->addError('email', __($status));
    }

    #[Computed]
    public function obfuscatedEmail(): string
    {
        $email = $this->email_confirmation;

        if (!$email) {
            return '';
        }

        $split = explode('@', $email);

        if (count($split) !== 2) {
            return '';
        }

        $firstPart       = $split[0];
        $qty             = (int)floor(strlen($firstPart) * 0.75);
        $remaining       = strlen($firstPart) - $qty;
        $maskedFirstPart = substr($firstPart, 0, $remaining) . str_repeat('*', $qty);

        $secondPart       = $split[1];
        $qty              = (int)floor(strlen($secondPart) * 0.75);
        $remaining        = strlen($secondPart) - $qty;
        $maskedSecondPart = str_repeat('*', $qty) . substr($secondPart, $remaining * -1, $remaining);

        return $maskedFirstPart . '@' . $maskedSecondPart;
    }
}
