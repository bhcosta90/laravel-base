<?php

declare(strict_types = 1);

namespace App\Livewire\Auth;

use Auth;
use Livewire\Component;
use Session;

class Logout extends Component
{
    public bool $asButton = true;

    public string $class = '';

    public bool $withIcon = false;

    public function render(): string
    {
        if ($this->asButton) {
            return <<<'blade'
                <x-ui.button wire:click="logout" spinner>
                    {{ __('Logout') }}
                </x-ui.button>
            blade;
        }

        return <<<'blade'
            <button class="{{ $class }}" wire:click="logout">
                @if($withIcon)
                    <x-ui.icon name="logout"
                        class="h-6 w-6 shrink-0 text-gray-400 group-hover:text-gray-300"/
                    >
                @endif
                {{ __('Logout') }}
            </button>
        blade;
    }

    public function logout(): void
    {
        Auth::guard('web')->logout();

        Session::invalidate();
        Session::regenerateToken();

        $this->redirect('/');
    }
}
