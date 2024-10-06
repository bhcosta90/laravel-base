<?php

declare(strict_types = 1);

use App\Livewire\Auth\Email\Notice;
use App\Models\User;

use Illuminate\Auth\Notifications\VerifyEmail;

use function Pest\Laravel\{actingAs, get};
use function Pest\Livewire\livewire;

describe('Livewire/Auth/Email/Notice -> Feature', function () {
    it('should redirect user to this page if verification is missing', function () {
        $user = User::factory()->unverified()->create();

        actingAs($user);

        get(route('dashboard'))
            ->assertRedirectToRoute('verification.notice');
    });

    test('displays verification notice page for unverified user', function () {
        $user = User::factory()->unverified()->create();

        actingAs($user);

        get(route('verification.notice'))
            ->assertOk();
    });

    it('should redirect the user out of this page if he is already verified', closure: function () {
        $user = User::factory()->create();

        actingAs($user);

        get(route('verification.notice'))
            ->assertRedirect('/');
    });

    it('should be able to send verification link again', function () {
        Notification::fake();

        $user = User::factory()->unverified()->create();

        actingAs($user);

        livewire(Notice::class)
            ->call('resend')
            ->assertSee(__('A new verification link has been sent to the email address you provided during registration.'))
            ->assertSet('sent', true);

        Notification::assertSentTo($user, VerifyEmail::class);
    });
});
