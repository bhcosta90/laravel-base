<?php

declare(strict_types = 1);

use App\Livewire\Admin\User\UserManager;

use App\Models\User;

use function Pest\Laravel\{assertDatabaseCount};
use function Pest\Livewire\livewire;

describe('Livewire/Admin/User/UserManager -> Feature', function () {
    it('validates user manager fields correctly when create a new user', function () {
        $user        = User::factory()->make(['id' => 1]);
        $userCreated = User::factory()->create();

        Illuminate\Support\Facades\Gate::shouldReceive('authorize')
            ->with('create', User::class)
            ->andReturn(true);

        livewire(UserManager::class)
            ->toBeValidate([], [
                'open',
                'model.name',
                'model.email',
                'password',
            ])
            ->toBeValidate([
                'open' => false,
            ], [
                'open',
            ])
            ->toBeValidate([
                'open'       => true,
                'model.name' => str_repeat('a', 121),
            ], [
                'model.name',
            ])
            ->toBeValidate([
                'model.name'  => $user->name,
                'model.email' => str_repeat('a', 121),
            ], [
                'model.email',
            ])
            ->toBeValidate([
                'model.email' => 'a',
            ], [
                'model.email',
            ])
            ->toBeValidate([
                'model.email' => $userCreated->email,
            ], [
                'model.email',
            ])
            ->toBeValidate([
                'model.email' => $user->email,
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
            ->set('model', $user->toArray())
            ->set('password', 'testing123')
            ->set('password_confirmation', 'testing123')
            ->call('submit')
            ->assertHasNoErrors();

        assertDatabaseCount('users', 2);
    });

    it('validates user manager fields correctly when edit a new user', function () {
        $user        = User::factory()->make(['id' => 1]);
        $userCreated = User::factory()->create();

        Illuminate\Support\Facades\Gate::shouldReceive('authorize')
            ->with('update', $userCreated)
            ->andReturn(true);

        livewire(UserManager::class)
            ->call('load', $userCreated)
            ->assertSet('open', true)
            ->set('model.email', $user->email)
            ->call('submit')
            ->assertHasNoErrors()
            ->assertOk();

        expect($userCreated->refresh())->email->toBe($user->email);
    });
});
