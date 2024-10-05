<?php

declare(strict_types = 1);

use App\Livewire\Auth\{Register};
use App\Models\User;

use Illuminate\Auth\Events\Registered;

use function Pest\Laravel\{actingAs, assertDatabaseCount, assertDatabaseHas};
use function Pest\Livewire\livewire;

describe('Livewire/Auth/Register -> Feature', function () {
    test('register validation', function () {
        $user           = User::factory()->make();
        $userRegistered = User::factory()->create();

        livewire(Register::class)
            ->toBeValidate([], [
                'name',
                'email',
                'password',
            ])
            ->toBeValidate([
                'name'                  => 't',
                'email'                 => 'testing',
                'password'              => 'testing',
                'password_confirmation' => 'testing123',
            ], [
                'name',
                'email',
                'password',
            ])
            ->toBeValidate([
                'name'                  => str_repeat('t', 122),
                'email'                 => 'testing',
                'password'              => 'testing',
                'password_confirmation' => 'testing123',
            ], [
                'name',
                'email',
                'password',
            ])
            ->toBeValidate([
                'name'                  => $user->name,
                'email'                 => str_repeat('a', 111) . 't@gmail.com',
                'password'              => 'testing123',
                'password_confirmation' => 'testing123',
            ], [
                'email',
            ])
            ->toBeValidate([
                'name'                  => $user->name,
                'email'                 => $userRegistered->email,
                'password'              => 'testing123',
                'password_confirmation' => 'testing123',
            ], [
                'email',
            ])
            ->toBeValidate([
                'name'                  => $user->name,
                'email'                 => $user->email,
                'password'              => 'testing123',
                'password_confirmation' => 'testing1234',
            ], [
                'password',
            ])
            ->toBeValidate([
                'name'                  => $user->name,
                'email'                 => $user->email,
                'password'              => $password = str_repeat('t', 31),
                'password_confirmation' => $password,
            ], [
                'password',
            ]);
    });

    test('a', function () {
        Event::fake();

        $user = User::factory()->make();
        livewire(Register::class)
            ->set([
                'email'                 => $user->email,
                'name'                  => $user->name,
                'password'              => 'testing123',
                'password_confirmation' => 'testing123',
            ])
            ->call('submit')
            ->assertHasNoErrors()
            ->assertRedirectToRoute('login')
            ->assertSessionHas('notification::message::success', __('Your account has been created.'));

        assertDatabaseCount('users', 1);
        assertDatabaseHas('users', [
            'email' => $user->email,
            'name'  => $user->name,
        ]);
        Event::assertDispatched(Registered::class);
    });

    test('authenticated user is redirected to dashboard', function () {
        actingAs(User::factory()->make());

        livewire(Register::class)->assertRedirectToRoute('dashboard');
    });
});
