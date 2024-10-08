<?php

declare(strict_types = 1);

use App\Exceptions\InvalidImpersonationException;
use App\Livewire\Admin\User\UserImpersonate;

use App\Models\User;

use function Pest\Laravel\actingAs;
use function Pest\Livewire\livewire;

describe('Livewire/Admin/User/UserImpersonate -> Feature', function () {
    test('it sets the user correctly based on session data', function () {
        livewire(UserImpersonate::class)
            ->assertSet('user', null);

        $user = User::factory()->create();
        session()->put('impersonate', $user->id);

        livewire(UserImpersonate::class)
            ->assertSet('user.id', $user->id)
            ->assertSee($user->name);
    });

    test('it throws an exception when trying to impersonate oneself', function () {
        livewire(UserImpersonate::class)
            ->call('submit', User::factory()->make())
            ->assertForbidden();
    });

    test('it throws an exception when trying to impersonate an authorized user', function () {
        actingAs($user = User::factory()->make());

        Gate::shouldReceive('authorize')
            ->with('impersonate', $user)
            ->andReturn(true);

        expect(fn () => livewire(UserImpersonate::class)
            ->call('submit', $user))->toThrow(InvalidImpersonationException::class);
    });

    test('it allows impersonation of another user and sets session data correctly', function () {
        actingAs($user = User::factory()->create());
        $userImpersonate = User::factory()->create();

        Gate::shouldReceive('authorize')
            ->with('impersonate', $userImpersonate)
            ->andReturn(true);

        livewire(UserImpersonate::class)
            ->call('submit', $userImpersonate)
            ->assertSessionHas('impersonator', $user->id)
            ->assertSessionHas('impersonate', $userImpersonate->id)
            ->assertRedirectToRoute('dashboard');
    });

    test('it forgets the impersonator and impersonate session keys', function () {
        session()->put('impersonator', 1);
        session()->put('impersonate', 1);

        livewire(UserImpersonate::class)
            ->assertSessionHas('impersonator', 1)
            ->assertSessionHas('impersonate', 1)
            ->call('finish')
            ->assertRedirectToRoute('dashboard')
            ->assertSessionMissing('impersonator')
            ->assertSessionMissing('impersonate');
    });
});
