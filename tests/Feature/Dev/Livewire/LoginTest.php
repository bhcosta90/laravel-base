<?php

declare(strict_types = 1);

use App\Dev\Livewire\Login;

use App\Models\User;

use function Pest\Livewire\livewire;

describe('App/Dev/Livewire/Login -> Feature', function () {
    test('redirects to login when user is not authenticated', function () {
        app()->detectEnvironment(fn () => 'production');
        livewire(Login::class)->assertForbidden();
    });

    test('displays the Livewire component and returns a successful response', function () {
        livewire(Login::class)->assertOk();
    });

    test('sets users property with 5 created users', function () {
        User::factory(5)->create();
        livewire(Login::class)
            ->assertSet('users', function ($user) {
                expect($user->count())->toBe(5);

                return true;
            });
    });

    test('logs in user and redirects to dashboard with success message', function () {
        $user = User::factory()->create();

        livewire(Login::class)
            ->set('user', $user->id)
            ->call('submit')
            ->assertRedirectToRoute('dashboard')
            ->assertSessionHas('notification::message::success', __('You have successfully logged in.'));

        expect(auth()->id())->toBe($user->id);
    });
});
