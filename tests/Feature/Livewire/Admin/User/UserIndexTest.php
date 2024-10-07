<?php

declare(strict_types = 1);

use App\Livewire\Admin\User\Index;
use App\Models\User;

use function Pest\Laravel\actingAs;
use function Pest\Livewire\livewire;

describe('Livewire/Admin/User/Index -> Feature', function () {

    test('it filters users based on search input', function () {
        actingAs(User::factory()->make());

        $user1 = User::factory()->create([
            'name' => 'John Doe',
        ]);

        $user2 = User::factory()->create([
            'name' => 'Jane Doe',
        ]);

        $user3 = User::factory()->create();

        livewire(Index::class)
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
});
