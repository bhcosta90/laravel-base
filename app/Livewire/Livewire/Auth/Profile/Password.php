<?php

declare(strict_types = 1);

namespace App\Livewire\Livewire\Auth\Profile;

use App\Livewire\Traits\HasPassword;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Validation\Rule;
use Livewire\Component;

class Password extends Component
{
    use HasPassword;

    public User $user;

    public string $password = '';

    public string $password_confirmation = '';

    public function render(): View
    {
        return view('livewire.livewire.auth.profile.password');
    }

    public function submit(?string $token = null): void
    {
        $this->validate();

        $this->requiredPassword('submit', $token, function () {
            dd(123);
        });
    }

    protected function rules(): array
    {
        return [
            'password' => [
                'required',
                'confirmed',
                'min:8',
                \Illuminate\Validation\Rules\Password::default(),
                Rule::requiredIf(!$this->user->id),
            ],
        ];
    }
}
