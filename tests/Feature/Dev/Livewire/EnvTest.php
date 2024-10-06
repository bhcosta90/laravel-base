<?php

declare(strict_types = 1);

use App\Dev\Livewire\Env;

use function Pest\Livewire\livewire;

describe('App/Dev/Livewire/Env -> Feature', function () {
    test('redirects to login when user is not authenticated', function () {
        app()->detectEnvironment(fn () => 'production');
        livewire(Env::class)->assertForbidden();
    });

    test('displays the Livewire component and returns a successful response', function () {
        livewire(Env::class)->assertOk();
    });

    it("should show a current brand in the page", function () {
        Process::fake([
            'git branch --show-current' => Process::result('feature/testing'),
        ]);

        livewire(Env::class)
            ->assertSet('branch', 'feature/testing')
            ->assertSet('env', 'testing');

        Process::assertRan('git branch --show-current');
    });
});
