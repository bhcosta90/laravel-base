<?php

declare(strict_types = 1);

use App\Livewire\Auth\Password\Recovery;

use App\Models\User;

use Illuminate\Auth\Events\PasswordResetLinkSent;
use Illuminate\Auth\Notifications\ResetPassword;

use function Pest\Livewire\livewire;

describe('Livewire/Auth/Password/Recovery -> Feature', function () {
    test('Recovery component validation', function () {
        livewire(Recovery::class)
            ->toBeValidate([], ['email'])
            ->toBeValidate(['email' => 'testing'], ['email']);
    });

    test('successful password reset link request', function () {
        Illuminate\Support\Facades\Password::shouldReceive('sendResetLink')
            ->once()
            ->andReturn('passwords.sent');

        $user = User::factory()->create();

        livewire(Recovery::class)
            ->set(['email' => $user->email])
            ->call('submit')
            ->assertHasNoErrors();
    });

    test('password reset link request fails for invalid user', function () {
        Illuminate\Support\Facades\Password::shouldReceive('sendResetLink')
            ->once()
            ->andReturn('passwords.user');

        $user = User::factory()->make();

        livewire(Recovery::class)
            ->toBeValidate(['email' => $user->email], ['email']);
    });

    test('password reset notification is sent', function () {
        Notification::fake();
        Event::fake();

        $user = User::factory()->create();

        livewire(Recovery::class)
            ->set(['email' => $user->email])
            ->call('submit');

        Notification::assertSentTo($user, ResetPassword::class);
        Event::assertDispatched(PasswordResetLinkSent::class);
    });

    test('no password reset notification is sent for invalid user', function () {
        Notification::fake();

        $user = User::factory()->make();

        livewire(Recovery::class)
            ->set(['email' => $user->email])
            ->call('submit');

        Notification::assertNothingSent();
    });
});
