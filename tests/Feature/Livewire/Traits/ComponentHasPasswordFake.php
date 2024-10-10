<?php

declare(strict_types = 1);

namespace Tests\Feature\Livewire\Traits;

use App\Livewire\Traits\HasPassword;
use Livewire\Component;

class ComponentHasPasswordFake extends Component
{
    use HasPassword;

    public function submit(?string $token = null): void
    {
        $this->requiredPassword('submit', $token, function () {
            //
        });
    }

    public function getId(): string
    {
        return 'fake-id';
    }

    public function render(): string
    {
        return <<<HTML
            <div>Hello world</div>
HTML;
    }
}
