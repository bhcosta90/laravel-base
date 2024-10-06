<?php

declare(strict_types = 1);

use App\Livewire\Auth\Logout;
use App\Models\User;

use function Pest\Laravel\actingAs;
use function Pest\Livewire\livewire;

describe('Livewire/Auth/Logout -> Feature', function () {
    test('user can logout', function () {
        actingAs(User::factory()->create());

        livewire(Logout::class, ['asButton' => false])
            ->call('logout')
            ->assertRedirect('/');
    });
});
