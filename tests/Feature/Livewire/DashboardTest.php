<?php

declare(strict_types = 1);

use App\Livewire\Dashboard;
use App\Models\User;

use function Pest\Laravel\{actingAs, get};
use function Pest\Livewire\livewire;

describe('Livewire/Admin/User/Index -> Feature', function () {
    beforeEach(function () {
        actingAs(User::factory()->make());
    });

    test('redirects to login when user is not authenticated', function () {
        Auth::logout();
        livewire(Dashboard::class)->assertForbidden();
    });

    test('displays the Livewire component and returns a successful response', function () {
        get('/dashboard')
            ->assertSeeLivewire(Dashboard::class)
            ->assertOk();
    });
});
