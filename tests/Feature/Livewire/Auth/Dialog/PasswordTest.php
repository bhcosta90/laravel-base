<?php

declare(strict_types = 1);

use App\Livewire\Auth\Dialog\Password;
use App\Models\User;

use function Pest\Laravel\actingAs;
use function Pest\Livewire\livewire;

describe('Livewire/Auth/Dialog/Password -> Feature', function () {
    beforeEach(function () {
        actingAs(User::factory()->make());
    });

    test('modal opens when openModal is called', function () {
        livewire(Password::class)
            ->assertSet('open', false)
            ->call('openModal')
            ->assertSet('open', true);
    });

    test('submit method validates password and open state', function () {
        livewire(Password::class)
            ->call('submit')
            ->assertHasErrors(['password', 'open'])
            ->set('open', false)
            ->call('submit')
            ->assertHasErrors(['password', 'open'])
            ->set('open', true)
            ->call('submit')
            ->assertHasErrors(['password'])
            ->set('password', 'testing')
            ->call('submit')
            ->assertHasErrors(['password']);
    });

    test('password is correct and success event is dispatched', function () {
        livewire(Password::class)
            ->set('open', true)
            ->set('password', 'password')
            ->call('submit')
            ->assertHasNoErrors()
            ->assertDispatched('user::password::success');
    });
});
