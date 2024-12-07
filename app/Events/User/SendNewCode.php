<?php

declare(strict_types = 1);

namespace App\Events\User;

use App\Models\User;
use Illuminate\Foundation\Events\Dispatchable;

class SendNewCode
{
    use Dispatchable;

    public function __construct(public User $user)
    {
    }
}
