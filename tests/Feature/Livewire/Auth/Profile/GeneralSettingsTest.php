<?php

declare(strict_types = 1);

use App\Livewire\Auth\Profile\GeneralSettings;
use App\Models\User;

use function Pest\Livewire\livewire;

describe('Livewire/Auth/Profile/GeneralSettings -> Feature', function () {
    beforeEach(function () {
        $this->user = User::factory()->create();
    });

    test('validates user name and email correctly', function () {
        $user = User::factory()->make();

        livewire(GeneralSettings::class, ['user' => $this->user])
            ->toBeValidate([
                'user.name'  => null,
                'user.email' => null,
            ], [
                'user.name',
                'user.email',
            ])->toBeValidate([
                'user.name'  => str_repeat('a', 121),
                'user.email' => str_repeat('a', 121),
            ], [
                'user.name',
                'user.email',
            ])->toBeValidate([
                'user.name'  => 'testing',
                'user.email' => 'testing',
            ], [
                'user.email',
            ])->set([
                'user.name'  => $user->name,
                'user.email' => $user->email,
            ])->call('submit');

        expect($this->user->refresh())
            ->name->toBe($user->name)
            ->email->toBe($user->email);
    });
});
