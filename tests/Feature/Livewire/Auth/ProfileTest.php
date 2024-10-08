<?php

declare(strict_types = 1);

use App\Livewire\Auth\Profile as ComponentProfile;
use App\Livewire\Livewire\Auth\Profile as AuthProfile;
use App\Models\User;

use function Pest\Laravel\{actingAs, get};
use function Pest\Livewire\livewire;

test('profile page displays correct Livewire components and user ID', function () {
    actingAs(User::factory()->make(['id' => 100]));

    get('/profile')
        ->assertSeeLivewire(AuthProfile\GeneralSettings::class)
        ->assertSeeLivewire(AuthProfile\Password::class);

    livewire(ComponentProfile::class)
        ->assertSet('user.id', 100);
});
