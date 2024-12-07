<?php

declare(strict_types = 1);

use App\Livewire\Auth\Register;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Livewire\Livewire;

use function Pest\Laravel\{assertDatabaseCount, assertDatabaseHas};

it('should render the component', function () {
    Livewire::test(Register::class)
        ->assertOk();
});

it('should be able to register a new user in the system', function () {
    Livewire::test(Register::class)
        ->set('name', 'Joe doe')
        ->set('email', 'joe@doe.com')
        ->set('email_confirmation', 'joe@doe.com')
        ->set('password', 'password')
        ->call('submit')
        ->assertHasNoErrors();

    assertDatabaseHas('users', [
        'name'  => 'Joe Doe',
        'email' => 'joe@doe.com',
    ]);

    assertDatabaseCount('users', 1);

    expect(auth()->check())
        ->and(auth()->user())
        ->id->toBe(User::first()->id);
});

test('validation rules', function () {

    $data = [
        'name::required'     => (object)['field' => 'name', 'value' => '', 'rule' => 'required'],
        'name::max:255'      => (object)['field' => 'name', 'value' => str_repeat('*', 256), 'rule' => 'max'],
        'email::required'    => (object)['field' => 'email', 'value' => '', 'rule' => 'required'],
        'email::email'       => (object)['field' => 'email', 'value' => 'not-an-email', 'rule' => 'email'],
        'email::max:255'     => (object)['field' => 'email', 'value' => str_repeat('*' . '@doe.com', 256), 'rule' => 'max'],
        'email::confirmed'   => (object)['field' => 'email', 'value' => 'joe@doe.com', 'rule' => 'confirmed'],
        'email::unique'      => (object)['field' => 'email', 'value' => 'joe@doe.com', 'rule' => 'unique', 'aField' => 'email_confirmation', 'aValue' => 'joe@doe.com'],
        'password::required' => (object)['field' => 'password', 'value' => '', 'rule' => 'required'],
    ];

    $livewire = Livewire::test(Register::class);

    foreach ($data as $f) {
        if ($f->rule == 'unique') {
            User::factory()->create([$f->field => $f->value]);
        }

        $livewire->set($f->field, $f->value);

        if (property_exists($f, 'aValue')) {
            $livewire->set($f->aField, $f->aValue);
        }

        $livewire->call('submit')
            ->assertHasErrors([$f->field => $f->rule]);
    }
});

it('should dispatch Registered event', function () {
    Event::fake();

    Livewire::test(Register::class)
        ->set('name', 'Joe doe')
        ->set('email', 'joe@doe.com')
        ->set('email_confirmation', 'joe@doe.com')
        ->set('password', 'password')
        ->call('submit');

    Event::assertDispatched(Registered::class);
});
