<?php

declare(strict_types = 1);

namespace App\Livewire\Dev;

use Illuminate\Support\Facades\Process;
use Livewire\Attributes\Computed;
use Livewire\Component;

class BranchEnv extends Component
{
    public function render(): string
    {
        return <<<'blade'
        <div class="flex items-center space-x-2">
            <x-badge neutral :value="$this->branch"/>
            <x-badge neutral :value="$this->env" />
        </div>
        blade;
    }

    #[Computed]
    public function env(): string
    {
        return config('app.env');
    }

    #[Computed]
    public function branch(): string
    {
        $process = Process::run('git branch --show-current');

        return trim($process->output());
    }
}
