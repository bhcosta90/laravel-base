<?php

declare(strict_types = 1);

namespace App\Livewire\Admin\User;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Validation\Rule;
use Livewire\Component;

class UserManager extends Component
{
    use AuthorizesRequests;

    public bool $open = false;

    public ?User $user = null;

    public string $password = '';

    public string $password_confirmation = '';

    public function render(): View
    {
        return view('livewire.admin.user.user-manager');
    }

    public function submit(): void
    {
        $this->validate();

        if ($this->password && $this->password_confirmation && $this->password === $this->password_confirmation) {
            $this->user->password = $this->password;
        }

        $this->user->save();
    }

    public function load(User $user): void
    {
        $this->user = $user;
        $this->open = true;
        $this->updatedOpen();
    }

    public function updatedOpen(): void
    {
        $this->user?->id
            ? $this->authorize('update', $this->user)
            : $this->authorize('create', $this->user = new User());
    }

    protected function rules(): array
    {
        return [
            'open'       => 'required|in:1',
            'user.name'  => 'required|string|max:120',
            'user.email' => [
                'required',
                'email:rfc,filter,dns',
                'max:120',
                Rule::unique('users', 'email')->ignore($this->user?->id),
            ],
            'password' => [
                'nullable',
                'sometimes',
                'confirmed',
                'min:8',
                Rule::requiredIf(!$this->user?->id),
            ],
        ];
    }
}
