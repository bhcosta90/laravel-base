<?php

declare(strict_types = 1);

use App\Livewire\Auth\Login;
use App\Models\User;
use App\Notifications\User\TokenNotification;
use Illuminate\Support\Facades\Notification;

use function Pest\Livewire\livewire;

test('renders successfully', function () {
    livewire(Login::class)
        ->assertStatus(200);
});

test('it must show the password field to be informed', function () {
    Notification::fake();

    livewire(Login::class)
        ->set('login', 'admin.user')
        ->call('submit')
        ->assertSet('isLogin', true)
        ->assertSet('isEmail', false);

    Notification::assertNothingSent();
});

test('it must show the token field to be informed', function () {
    Notification::fake();

    $user = User::factory()->create([
        'login' => 'admin@user.com',
    ]);

    livewire(Login::class)
        ->set('login', 'admin@user.com')
        ->call('submit')
        ->assertSet('isLogin', false)
        ->assertSet('isEmail', true);

    Notification::assertSentTo($user, TokenNotification::class);
});

test('when access is by email', function () {
    Notification::fake();

    User::factory()->create([
        'login' => 'admin.user@test.com',
    ]);

    $lw = livewire(Login::class)
        ->set('login', 'admin.user@test.com')
        ->call('submit');

    Notification::assertSentTo(User::first(), TokenNotification::class, function ($notification) use ($lw) {
        $lw->set('password', $notification->token)
            ->call('login')
            ->assertRedirect('dashboard');

        return true;
    });
});

test('when access is by login', function () {
    Notification::fake();

    User::factory()->create([
        'login' => 'admin.user',
    ]);

    livewire(Login::class)
        ->set('login', 'admin.user')
        ->call('submit')
        ->set('password', 'password')
        ->call('login')
        ->assertRedirect('dashboard');
});
