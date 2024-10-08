<?php

declare(strict_types = 1);

use App\Livewire\Admin\User\UserManager;

use App\Models\User;

use function Pest\Laravel\{assertDatabaseCount};
use function Pest\Livewire\livewire;

describe('Livewire/Admin/User/UserManager -> Feature', function () {
    it('validates open user manager', function () {
        $userCreated = User::factory()->create();

        livewire(UserManager::class)->toBeValidateManager($userCreated);
    });
    it('validates user manager fields correctly when create a new user', function () {
        $user        = User::factory()->make(['id' => 1]);
        $userCreated = User::factory()->create();

        Illuminate\Support\Facades\Gate::shouldReceive('authorize')
            ->with('create', User::class)
            ->andReturn(true)
            ->once();

        livewire(UserManager::class)
            ->set('open', true)
            ->toBeValidate([], [
                'user.name',
                'user.email',
                'password',
            ])
            ->toBeValidate([
                'user.name'  => str_repeat('a', 121),
                'user.email' => str_repeat('a', 121),
            ], [
                'user.name',
                'user.email',
            ])
            ->toBeValidate([
                'user.email' => 'a',
            ], [
                'user.email',
            ])
            ->toBeValidate([
                'user.email' => $userCreated->email,
            ], [
                'user.email',
            ])
            ->toBeValidate([
                'user.email' => $user->email,
            ], [
                'password',
            ])
            ->toBeValidate([
                'password' => 'testing123',
            ], [
                'password',
            ])
            ->toBeValidate([
                'password' => 'testing1234',
            ], [
                'password',
            ])
            ->toBeValidate([
                'password' => 'testing123',
            ], [])
            ->set('user', $user->toArray())
            ->set('password', 'testing123')
            ->set('password_confirmation', 'testing123')
            ->call('submit')
            ->assertDispatched('user::index')
            ->assertSet('open', false)
            ->assertHasNoErrors();

        assertDatabaseCount('users', 2);
    });

    it('validates user manager fields correctly when edit a new user', function () {
        $user        = User::factory()->make(['id' => 1]);
        $userCreated = User::factory()->create();

        Illuminate\Support\Facades\Gate::shouldReceive('authorize')
            ->with('update', $userCreated)
            ->andReturn(true)
            ->once();

        livewire(UserManager::class)
            ->call('load', $userCreated)
            ->assertSet('open', true)
            ->set('user.email', $user->email)
            ->call('submit')
            ->assertDispatched('user::index')
            ->assertHasNoErrors()
            ->assertSet('open', false)
            ->assertOk();

        expect($userCreated->refresh())->email->toBe($user->email);
    });
});
