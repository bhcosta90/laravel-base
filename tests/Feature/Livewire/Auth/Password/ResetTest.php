<?php

declare(strict_types = 1);

use App\Livewire\Auth\Password\{Recovery, Reset};
use App\Models\User;

use Illuminate\Auth\Events\PasswordReset;

use function Pest\Laravel\assertDatabaseMissing;
use function Pest\Livewire\livewire;

describe('Livewire - Auth - Password - Reset -> Feature', function () {
    test('reset password validation', function () {
        livewire(Reset::class)
            ->toBeValidate([], ['email', 'token'])
            ->toBeValidate(['email' => 'testing'], ['email', 'token', 'password'])
            ->toBeValidate(['email' => 'testing@gmail.com', 'token' => '123'], ['email']);
    });

    test('successful password reset process', function () {
        Notification::fake();
        Event::fake();

        $user = User::factory()->create([
            'email' => 'test@gmail.com',
        ]);

        livewire(Recovery::class)
            ->set(['email' => $user->email])
            ->call('submit')
            ->assertHasNoErrors();

        Notification::assertSentTo(
            $user,
            Illuminate\Auth\Notifications\ResetPassword::class,
            function ($notification) use ($user) {
                livewire(Reset::class, ['email' => $user->email, 'token' => $notification->token])
                    ->set([
                        'email_confirmation'    => $user->email,
                        'password'              => 'password',
                        'password_confirmation' => 'password',
                    ])
                    ->assertSet('obfuscatedEmail', 't***@******com')
                    ->call('submit')
                    ->assertHasNoErrors();

                assertDatabaseMissing('users', [
                    'id'       => $user->id,
                    'password' => $user->getAttribute('password'),
                ]);

                Event::assertDispatched(PasswordReset::class);

                return true;
            }
        );
    });

    test('reset password with invalid token', function () {
        $user = User::factory()->create();

        livewire(Reset::class, ['email' => $user->email, 'token' => '123'])
            ->set([
                'email_confirmation'    => $user->email,
                'password'              => 'password',
                'password_confirmation' => 'password',
            ])
            ->call('submit')
            ->assertHasErrors(['email'])
            ->set([
                'email_confirmation' => 'test',
            ])
            ->assertSet('obfuscatedEmail', '');
    });
});
