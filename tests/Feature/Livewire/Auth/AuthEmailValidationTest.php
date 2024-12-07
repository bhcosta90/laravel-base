<?php

declare(strict_types = 1);

use App\Listeners\User\CreateValidationCode;
use App\Livewire\Auth\{EmailValidation, Register};
use App\Models\User;
use App\Notifications\ValidationCodeNotification;
use Illuminate\Auth\Events\Registered;

use function Pest\Laravel\actingAs;

it("should create a new validation code and save in the users table", function () {
    $user = User::factory()->create(['email_verified_at' => null, 'validation_code' => null]);

    $event    = new Registered($user);
    $listener = new CreateValidationCode();
    $listener->handle($event);

    $user->refresh();

    expect($user)->validation_code->not->toBeNull();
});

it('should send that new code to the user via email', function () {
    Notification::fake();

    $user = User::factory()->create(['email_verified_at' => null, 'validation_code' => null]);

    $event    = new Registered($user);
    $listener = new CreateValidationCode();
    $listener->handle($event);

    Notification::assertSentTo($user, ValidationCodeNotification::class);
});

test('making sure that the listener to send the code is linked to the Registered event', function () {
    Event::fake();
    Event::assertListening(
        Registered::class,
        CreateValidationCode::class
    );
});

it('should redirect to the validation page after registration', function () {
    Livewire::test(Register::class)
        ->set('name', 'Joe doe')
        ->set('email', 'joe@doe.com')
        ->set('email_confirmation', 'joe@doe.com')
        ->set('password', 'password')
        ->call('submit')
        ->assertHasNoErrors()
        ->assertRedirect(route('auth.email-validation'));
});

it('should check if the code is valid', function () {
    $user = User::factory()->withValidationCode()->create();

    actingAs($user);

    Livewire::test(EmailValidation::class)
        ->set('code', '000000')
        ->call('handle')
        ->assertHasErrors(['code']);
});

it('should be able to send a new code to the user', function () {
    Notification::fake();

    $user    = User::factory()->withValidationCode()->create();
    $oldCode = $user->validation_code;

    actingAs($user);

    Livewire::test(EmailValidation::class)
        ->call('sendNewCode');

    expect($user)->validation_code->not->toBe($oldCode);
    Notification::assertSentTo($user, ValidationCodeNotification::class);
});

it('should update email_verified_at and delete the code if the code if valid', function () {
    $user = User::factory()
        ->withValidationCode()
        ->create();

    actingAs($user);

    Livewire::test(EmailValidation::class)
        ->set('code', '999999')
        ->call('handle')
        ->assertHasNoErrors()
        ->assertRedirectToRoute('dashboard');

    expect($user)
        ->email_verified_at->not->toBeNull()
        ->validation_code->toBeNull();
});
