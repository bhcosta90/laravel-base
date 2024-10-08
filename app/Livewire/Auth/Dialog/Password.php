<?php

declare(strict_types = 1);

namespace App\Livewire\Auth\Dialog;

use Hash;
use Illuminate\View\View;
use Livewire\Attributes\{On, Rule};
use Livewire\Component;

class Password extends Component
{
    public bool $open = false;

    #[Rule('required')]
    public ?string $password = null;

    public function render(): View
    {
        return view('livewire.auth.dialog.password');
    }

    #[On('user::password::open')]
    public function openModal(): void
    {
        $this->reset('password');
        $this->resetValidation();
        $this->open = true;
    }

    public function submit(): void
    {
        $this->validate();

        if (Hash::check($this->password, auth()->user()->password)) {
            $this->open = false;
            $this->dispatch('user::password::success');

            return;
        }

        $this->addError('password', __('The provided password does not match our records.'));
        $this->reset('password');
    }
}
