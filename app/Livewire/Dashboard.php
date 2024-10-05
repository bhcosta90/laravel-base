<?php

declare(strict_types = 1);

namespace App\Livewire;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Response;
use Livewire\Component;

class Dashboard extends Component
{
    public function mount(): void
    {
        if (!auth()->check()) {
            abort(Response::HTTP_FORBIDDEN);
        }
    }

    public function render(): View
    {
        return view('livewire.dashboard');
    }
}
