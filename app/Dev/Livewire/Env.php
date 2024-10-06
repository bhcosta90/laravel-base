<?php

declare(strict_types = 1);

namespace App\Dev\Livewire;

use function abort;
use function app;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Response;

use Livewire\Attributes\Computed;

use Livewire\Component;
use Process;

class Env extends Component
{
    public function mount(): void
    {
        if (app()->isProduction()) {
            abort(Response::HTTP_FORBIDDEN);
        }
    }

    public function render(): View
    {
        return view('dev.livewire.env');
    }

    #[Computed]
    public function branch(): string
    {
        return trim(Process::run('git branch --show-current')->output());
    }

    #[Computed]
    public function env(): string
    {
        return config('app.env');
    }
}
