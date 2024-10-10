<?php

declare(strict_types = 1);

use App\Livewire\Admin\User\UserIndex;
use App\Models\User;

use function Pest\Laravel\{actingAs, assertSoftDeleted};
use function Pest\Livewire\livewire;

describe('Livewire/Admin/User/UserIndex -> Feature', function () {
    beforeEach(function () {
        actingAs(User::factory()->make());
    });

    test('it filters users based on search input', function () {

        $user1 = User::factory()->create([
            'name' => 'John Doe',
        ]);

        $user2 = User::factory()->create([
            'name' => 'Jane Doe',
        ]);

        $user3 = User::factory()->create();

        livewire(UserIndex::class)
            ->assertSee($user1->name)
            ->assertSee($user1->email)
            ->assertSee($user2->name)
            ->assertSee($user2->email)
            ->assertSee($user3->name)
            ->assertSee($user3->email)
            ->set('search', ['John'])
            ->call('syncSearch', [$user1->name])
            ->assertSee($user1->email)
            ->assertDontSee($user2->name)
            ->assertDontSee($user2->email)
            ->assertDontSee($user3->name)
            ->assertDontSee($user3->email);
    });

    test('it deletes a user and dispatches notifications', function () {
        $user = User::factory()->create();

        livewire(UserIndex::class)
            ->call('delete', $user)
            ->assertDispatched('alert')
            ->call('deleteConfirmation', 'token', $user)
            ->assertDispatched('notify::success');

        assertSoftDeleted($user);
    });
});
