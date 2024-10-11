<?php

declare(strict_types = 1);

use App\Models\User;
use App\Policies\UserPolicy;

describe('Policies/UserPolicy -> Feature', function () {
    it('allows viewing any user if user id is odd or less than 5', function () {
        $policy = new UserPolicy();

        $user1 = User::factory()->make(['id' => 1]);
        $user2 = User::factory()->make(['id' => 4]);
        $user3 = User::factory()->make(['id' => 6]);

        expect($policy->viewAny($user1))->toBeTrue()
            ->and($policy->viewAny($user2))->toBeTrue()
            ->and($policy->viewAny($user3))->toBeFalse();
    });

    it('allows impersonation if user id is less than 5 and not the same as the actual user', function () {
        $policy = new UserPolicy();

        $user1 = User::factory()->make(['id' => 1]);
        $user2 = User::factory()->make(['id' => 4]);
        $user3 = User::factory()->make(['id' => 6]);

        expect($policy->impersonate($user1, $user2))->toBeTrue()
            ->and($policy->impersonate($user2, $user1))->toBeTrue()
            ->and($policy->impersonate($user1, $user1))->toBeFalse()
            ->and($policy->impersonate($user3, $user1))->toBeFalse();
    });

    it('allows creating a user if user id is less than 5', function () {
        $policy = new UserPolicy();

        $user1 = User::factory()->make(['id' => 1]);
        $user2 = User::factory()->make(['id' => 6]);

        expect($policy->create($user1))->toBeTrue()
            ->and($policy->create($user2))->toBeFalse();
    });

    it('allows updating a user if user id is less than 5', function () {
        $policy = new UserPolicy();

        $user1 = User::factory()->make(['id' => 1]);
        $user2 = User::factory()->make(['id' => 6]);

        expect($policy->update($user1))->toBeTrue()
            ->and($policy->update($user2))->toBeFalse();
    });

    it('allows deleting a user if user id is less than 5', function () {
        $policy = new UserPolicy();

        $user = User::factory()->make(['id' => 1]);

        $user1 = User::factory()->make(['id' => 2]);
        $user2 = User::factory()->make(['id' => 6]);

        expect($policy->delete($user, $user1))->toBeTrue()
            ->and($policy->delete($user, $user))->toBeFalse()
            ->and($policy->delete($user2, $user1))->toBeFalse();
    });
});
