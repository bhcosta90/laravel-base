<?php

declare(strict_types = 1);

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return $user->id < 5;
    }

    public function impersonate(User $user, ?User $userActual = null): bool
    {
        return $user->id === 1 && !$user->is($userActual);
    }
}
