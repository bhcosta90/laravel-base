<?php

declare(strict_types = 1);

namespace App\Livewire\Livewire\Auth\Profile;

use function __;

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
            if ($this->password === $this->password_confirmation) {
                $this->user->password = $this->password;
                $this->user->save();
                $this->dispatch('notify::success', __('Password updated successfully.'));
                $this->reset('password', 'password_confirmation');
            }
        });
    }

    protected function rules(): array
    {
        return [
            'password' => [
                'required',
                'confirmed',
                'min:8',
                'max:25',
                \Illuminate\Validation\Rules\Password::default(),
                Rule::requiredIf(!$this->user->id),
            ],
        ];
    }
}
