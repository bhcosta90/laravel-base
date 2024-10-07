<?php

declare(strict_types = 1);

namespace App\Livewire\Admin\User;

use App\Livewire\Traits\HandleManager;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Validation\Rule;
use Livewire\Component;

class UserManager extends Component
{
    use HandleManager;

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
            $this->model->fill([
                'password' => $this->password,
            ]);
        }

        $this->model->save();
    }

    protected function rules(): array
    {
        return [
            'open'        => 'required|in:1',
            'model.name'  => 'required|string|max:120',
            'model.email' => [
                'required',
                'email:rfc,filter,dns',
                'max:120',
                Rule::unique('users', 'email')->ignore($this->model?->id),
            ],
            'password' => [
                'nullable',
                'sometimes',
                'confirmed',
                'min:8',
                Rule::requiredIf(!$this->model?->id),
            ],
        ];
    }

    protected function getModel(): string
    {
        return User::class;
    }
}
