<?php

declare(strict_types = 1);

use App\Models\User;

describe('Http/Controllers/Auth/VerifyEmailController', function () {
    test('returns 403 status for invalid verification URL', function () {
        $user = User::factory()->unverified()->create();

        $invalidVerificationUrl = URL::temporarySignedRoute(
            'verification.verify',
            now()->addMinutes(60),
            ['id' => $user->id, 'hash' => 'invalid-hash']
        );

        $response = $this->actingAs($user)->get($invalidVerificationUrl);

        $response->assertStatus(403);

        expect($user->fresh()->hasVerifiedEmail())->toBeFalse();
    });

    test('verifies email and sets session flag for unverified user', function () {
        $user = User::factory()->unverified()->create();

        $verificationUrl = URL::temporarySignedRoute(
            'verification.verify',
            now()->addMinutes(60),
            ['id' => $user->id, 'hash' => sha1($user->email)]
        );

        $response = $this->actingAs($user)->get($verificationUrl);

        $response->assertRedirect('?verified=1')
            ->assertSessionHas('has-verified-email', true);

        expect($user->fresh()->hasVerifiedEmail())->toBeTrue();
    });

    test('verifies email and does not set session flag for already verified user', function () {
        $user = User::factory()->create();

        $verificationUrl = URL::temporarySignedRoute(
            'verification.verify',
            now()->addMinutes(60),
            ['id' => $user->id, 'hash' => sha1($user->email)]
        );

        $response = $this->actingAs($user)->get($verificationUrl);

        $response->assertRedirect('?verified=1')
            ->assertSessionMissing('has-verified-email', true);

        expect($user->fresh()->hasVerifiedEmail())->toBeTrue();
    });
});
