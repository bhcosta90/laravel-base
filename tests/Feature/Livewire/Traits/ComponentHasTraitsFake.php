<?php

declare(strict_types = 1);

namespace Tests\Feature\Livewire\Traits;

use App\Livewire\Traits\{HasPassword, WithAlert};
use Livewire\Component;

class ComponentHasTraitsFake extends Component
{
    use HasPassword;
    use WithAlert;

    public function submit(?string $token = null): void
    {
        $this->requiredPassword('submit', $token, function () {
            //
        });
    }

    public function delete(): void
    {
        $this->confirmAlert('submit', 1);
    }

    public function deleteConfirmation(string $token): void
    {
        $this->executeConfirmAlert($token, function () {
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
