<?php

declare(strict_types = 1);

namespace App\Livewire\Livewire\Auth\Profile;

use App\Livewire\Traits\HasPassword;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Validation\Rule;
use Livewire\Component;

class GeneralSettings extends Component
{
    use HasPassword;

    public User $user;

    public function render(): View
    {
        return view('livewire.livewire.auth.profile.general-settings');
    }

    public function submit(?string $token = null): void
    {
        $this->validate();

        $this->requiredPassword('submit', $token, function () {
            $this->user->save();
            $this->dispatch('user::success', __('Profile updated successfully.'));
        });
    }

    protected function rules(): array
    {
        return [
            'user.name'  => 'required|string|max:120',
            'user.email' => [
                'required',
                'email:rfc,filter,dns',
                'max:120',
                Rule::unique('users', 'email')->ignore($this->user?->id),
            ],
        ];
    }
}
