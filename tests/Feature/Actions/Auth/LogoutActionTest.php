<?php

declare(strict_types = 1);

use App\Actions\Auth\LogoutAction;

use App\Models\{User};

use function Pest\Laravel\{actingAs, assertAuthenticated, assertGuest};

test('user can logout', function () {
    actingAs(User::factory()->make());

    assertAuthenticated();

    app(LogoutAction::class)->handle();

    assertGuest();
});
