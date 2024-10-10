<?php

declare(strict_types = 1);

namespace App\Livewire\Traits;

use Closure;
use Cookie;
use Livewire\Features\SupportEvents\HandlesEvents;

trait HasPassword
{
    use HandlesEvents;

    public function requiredPassword(string $action, ?string $token = null, ?Closure $callback = null): void
    {
        if (filled($token) && app()->environment('testing')) {
            $callback();

            return;
        }

        if ($token === null) {
            $this->dispatch(
                'user::password::open',
                component: $this->getId(),
                action: $action,
            );

            Cookie::queue('verify-component-id', $this->getId(), 120);

            return;
        }

        Cookie::get('verify-component-id') === $this->getId() ?: abort(400);
        Cookie::forget('verify-component-id');
        $callback();
    }

    abstract public function getId();
}
