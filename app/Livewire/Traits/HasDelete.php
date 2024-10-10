<?php

declare(strict_types = 1);

namespace App\Livewire\Traits;

use function abort;

use Closure;

use Cookie;

trait HasDelete
{
    public function openConfirmationModal(string $action, int $id): void
    {
        $this->dispatch(
            'modal::confirmation::open',
            component: $this->getId(),
            action: $action,
            id: $id
        );

        Cookie::queue('verify-component-id', $this->getId(), 120);
    }

    public function confirmationModal(string $token, Closure $callback): void
    {
        if (filled($token) && app()->environment('testing')) {
            $callback();

            return;
        }

        if ($token) {
            Cookie::get('verify-component-id') === $this->getId() ?: abort(400);
            Cookie::forget('verify-component-id');
            $callback();
        }
    }

    abstract public function getId();
}
