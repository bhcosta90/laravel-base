<?php

declare(strict_types = 1);

namespace App\Livewire\Traits;

use function abort;

use Closure;

use Cookie;

trait WithAlert
{
    public function confirmAlert(string $action, int $id): void
    {
        $this->dispatch(
            'alert',
            component: $this->getId(),
            action: $action,
            confirm: true,
            params: $id,
            type: 'confirmation',
            title: __('Are you sure you want to delete this record?'),
            description: __('This action cannot be undone.'),
            textCancel: __('Cancel'),
            textConfirm: __('Yes, delete')
        );

        Cookie::queue('verify-component-id', $this->getId(), 120);
    }

    public function executeConfirmAlert(string $token, Closure $callback): void
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
