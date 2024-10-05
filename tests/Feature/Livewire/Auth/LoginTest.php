<?php

declare(strict_types = 1);

use App\Livewire\Auth\Login;

use App\Models\User;

use function Pest\Laravel\actingAs;
use function Pest\Livewire\livewire;

describe('App/Livewire/Auth/Login -> Feature', function () {
    test('invalid credentials trigger error', function () {
        $user = User::factory()->create([
            'password' => $password = 'Pa$$w0rd!',
        ]);

        livewire(Login::class)
            ->toBeValidate(['email' => $user->email, 'password' => 'a' . $password], ['invalidCredential'])
            ->assertSet('password', null);
    });

    test('successful login redirects to dashboard and dispatches login event', function () {
        Event::fake();

        $user = User::factory()->create([
            'password' => $password = 'Pa$$w0rd!',
        ]);

        livewire(Login::class)
            ->set(['email' => $user->email, 'password' => $password])
            ->call('submit')
            ->assertHasNoErrors()
            ->assertRedirectToRoute('dashboard')
            ->assertSessionHas('notification::message', __('You have successfully logged in.'));

        expect(auth()->id())->toBe($user->id);
        Event::assertDispatched(Illuminate\Auth\Events\Login::class);
    });

    test('authenticated user is redirected to dashboard', function () {
        actingAs(User::factory()->make());

        livewire(Login::class)->assertRedirectToRoute('dashboard');
    });

    test('should make sure tha the rate limit is blocking after 5 attempts', function () {
        $user = User::factory()->create([
            'password' => 'password',
        ]);

        $l = livewire(Login::class)
            ->set('email', $user->email)
            ->set('password', 'password123');

        for ($i = 0; $i < 5; $i++) {
            $l->call('submit')
                ->assertHasErrors('invalidCredential');
        }

        $l->call('submit')
            ->assertHasErrors([
                'rateLimiter',
            ]);
    });
});
