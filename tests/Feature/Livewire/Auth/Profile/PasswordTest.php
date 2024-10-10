<?php

declare(strict_types = 1);

use App\Models\User;

use function Pest\Livewire\livewire;

describe('Livewire/Auth/Profile/Password -> Feature', function () {
    beforeEach(function () {
        $this->user = User::factory()->create();
    });

    test('validates password and password confirmation correctly', function () {
        livewire(App\Livewire\Auth\Profile\Password::class, ['user' => $this->user])
            ->toBeValidate([
                'password' => str_repeat('a', 26),
            ], [
                'password',
            ])->toBeValidate([
                'password' => str_repeat('a', 7),
            ], [
                'password',
            ])->toBeValidate([
                'password'              => 'password',
                'password_confirmation' => 'password123',
            ], [
                'password',
            ])->set([
                'password'              => 'password123',
                'password_confirmation' => 'password123',
            ])->call('submit', 'fake-token');

        expect(Hash::check('password123', $this->user->refresh()->password))->toBeTrue();
    });
});
