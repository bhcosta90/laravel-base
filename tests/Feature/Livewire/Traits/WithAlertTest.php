<?php

declare(strict_types = 1);

use function Pest\Livewire\livewire;

use Tests\Feature\Livewire\Traits\ComponentHasTraitsFake;

describe('Livewire/Traits/HasPassword -> Feature', function () {
    test('dispatches password open event on submit', function () {
        app()->detectEnvironment(fn () => 'local');
        livewire(ComponentHasTraitsFake::class)
            ->call('delete')
            ->assertDispatched('alert');
    });

    test('logs info and asserts ok when valid token is provided', function () {
        app()->detectEnvironment(fn () => 'local');

        Livewire\Livewire::withCookies([
            'verify-component-id' => 'fake-id',
        ])
            ->test(ComponentHasTraitsFake::class)
            ->call('deleteConfirmation', 'fake-id')
            ->assertOk();
    });
});
