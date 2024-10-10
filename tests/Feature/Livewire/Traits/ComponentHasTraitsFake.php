<?php

declare(strict_types = 1);

namespace Tests\Feature\Livewire\Traits;

use App\Livewire\Traits\{HasDelete, HasPassword};
use Livewire\Component;

class ComponentHasTraitsFake extends Component
{
    use HasPassword;
    use HasDelete;

    public function submit(?string $token = null): void
    {
        $this->requiredPassword('submit', $token, function () {
            //
        });
    }

    public function delete(): void
    {
        $this->openConfirmationModal('submit', 1);
    }

    public function deleteConfirmation(string $token): void
    {
        $this->confirmationModal($token, function () {
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
