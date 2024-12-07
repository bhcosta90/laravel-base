<?php

declare(strict_types = 1);

namespace App\Livewire\Auth;

use App\Events\User\SendNewCode;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.guest')]
class EmailValidation extends Component
{
    public ?string $code = null;

    public ?string $sendNewCodeMessage = null;

    public function render(): View
    {
        return view('livewire.email-validation');
    }

    public function handle(): void
    {
        $this->reset('sendNewCodeMessage');

        $this->validate([
            'code' => function (string $attribute, mixed $value, \Closure $fail) {

                if (!\Hash::check($value, auth()->user()->validation_code)) {
                    $fail('Invalid code');
                }
            },
        ]);

        $user                    = auth()->user();
        $user->validation_code   = null;
        $user->email_verified_at = now();
        $user->save();

        $this->redirectRoute('dashboard');
    }

    public function sendNewCode(): void
    {
        SendNewCode::dispatch(auth()->user());

        $this->sendNewCodeMessage = __('Code was sent to you. Check your mailbox.');
    }
}
