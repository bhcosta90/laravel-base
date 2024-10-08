<?php

declare(strict_types = 1);

use function Pest\Livewire\livewire;

use Tests\Feature\Livewire\Traits\ComponentHasPasswordFake;

describe('Livewire/Traits/HasPassword -> Feature', function () {
    test('dispatches password open event on submit', function () {
        livewire(ComponentHasPasswordFake::class)
            ->call('submit')
            ->assertDispatched('user::password::open');
    });

    test('returns a bad request when token is provided', function () {
        livewire(ComponentHasPasswordFake::class)
            ->call('submit', 'token')
            ->assertBadRequest();
    });

    test('logs info and asserts ok when valid token is provided', function () {
        Log::shouldReceive('info')
            ->withArgs(['testing'])
            ->once();

        Livewire\Livewire::withCookies([
            'password' => 'fake-id',
        ])
            ->test(ComponentHasPasswordFake::class)
            ->call('submit', 'fake-id')
            ->assertOk();
    });
});
