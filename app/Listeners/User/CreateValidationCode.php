<?php

declare(strict_types = 1);

namespace App\Listeners\User;

use App\Events\User\SendNewCode;
use App\Models\User;
use App\Notifications\ValidationCodeNotification;
use Illuminate\Auth\Events\Registered;

class CreateValidationCode
{
    public function __construct()
    {
    }

    public function handle(Registered | SendNewCode $event): void
    {
        /** @var User $user */
        $user = $event->user;

        $user->validation_code = $code = random_int(100000, 999999);
        $user->save();

        $user->notify(new ValidationCodeNotification($code));
    }
}
