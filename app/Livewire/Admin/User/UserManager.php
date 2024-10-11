<?php

declare(strict_types = 1);

namespace App\Livewire\Admin\User;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Livewire\Attributes\On;
use Livewire\Component;

class UserManager extends Component
{
    use AuthorizesRequests;

    public bool $open = false;

    public bool $open2 = false;

    public ?User $user = null;

    public string $password = '';

    public string $password_confirmation = '';

    public function render(): View
    {
        return view('livewire.admin.user.user-manager');
    }

    #[On('load::manager')]
    public function load(?User $user): void
    {
        $this->user = $user;
        $this->open = true;
        $this->updatedOpen();
        $this->resetValidation();
    }

    public function updatedOpen(): void
    {
        $this->user?->id
            ? $this->authorize('update', $this->user)
            : $this->authorize('create', $this->user = new User());

        $this->reset(['password', 'password_confirmation']);
    }

    public function submit(): void
    {
        $this->validate();

        if ($this->password && $this->password_confirmation && $this->password === $this->password_confirmation) {
            $this->user->password = $this->password;
        }

        $this->user->save();
        $this->open = false;
        $this->dispatch('user::index');
    }

    protected function rules(): array
    {
        return [
            'open'           => 'required|in:1',
            'user.name'      => 'required|string|max:120',
            'user.is_active' => 'boolean',
            'user.email'     => [
                'required',
                'email:rfc,filter,dns',
                'max:120',
                Rule::unique('users', 'email')->ignore($id = $this->user?->id),
            ],
            'password' => [
                'nullable',
                'sometimes',
                'confirmed',
                'min:8',
                'max:25',
                Password::default(),
                Rule::requiredIf(!$id),
            ],
        ];
    }
}
