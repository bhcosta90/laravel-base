<?php

declare(strict_types = 1);

namespace App\Livewire\Traits;

trait HandleRedirect
{
    abstract public function redirectRoute($name, $parameters = [], $absolute = true, $navigate = false);

    public function redirectRouteMessage(
        $name,
        $message,
        $parameters = [],
        $absolute = true,
        $navigate = false,
        string $type = 'success'
    ): void {
        session()->flash('notification::message::' . $type, __($message));
        $this->redirectRoute($name, $parameters, $absolute, $navigate);
    }
}
