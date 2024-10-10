<?php

declare(strict_types = 1);

use App\Models\User;

use function Pest\Laravel\{actingAs, post};

test('Http/Controllers/Auth/LogoutController -> Feature', function () {
    post('/logout')
        ->assertRedirect();

    expect(Auth::check())->toBeFalse();
    actingAs(User::factory()->make());
    expect(Auth::check())->toBeTrue();

    post('/logout')
        ->assertRedirect();

    expect(Auth::check())->toBeFalse();
});
