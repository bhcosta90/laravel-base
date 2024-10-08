<?php

declare(strict_types = 1);

/*
|--------------------------------------------------------------------------
| Test Case
|--------------------------------------------------------------------------
|
| The closure you provide to your test functions is always bound to a specific PHPUnit test
| case class. By default, that class is "PHPUnit\Framework\TestCase". Of course, you may
| need to change it using the "pest()" function to bind a different classes or traits.
|
*/

use Illuminate\Database\Eloquent\Model;
use Livewire\Features\SupportTesting\Testable;

pest()->extend(Tests\TestCase::class)
    ->use(Illuminate\Foundation\Testing\RefreshDatabase::class)
    ->in('Feature');

/*
|--------------------------------------------------------------------------
| Expectations
|--------------------------------------------------------------------------
|
| When you're writing tests, you often need to check that values meet certain conditions. The
| "expect()" function gives you access to a set of "expectations" methods that you can use
| to assert different things. Of course, you may extend the Expectation API at any time.
|
*/

expect()->extend('toBeOne', function () {
    return $this->toBe(1);
});

/*
|--------------------------------------------------------------------------
| Functions
|--------------------------------------------------------------------------
|
| While Pest is very powerful out-of-the-box, you may have some testing code specific to your
| project that you don't want to repeat in every file. Here you can also expose helpers as
| global functions to help you to reduce the number of lines of code in your test files.
|
*/

Testable::macro('toBeValidate', function (array $data, $errors, $action = 'submit', $debug = false) {
    $lw = $this->set($data)
        ->call($action);

    if (filled($errors)) {
        $lw->assertHasErrors($errors, $debug);
    } else {
        $lw->assertHasNoErrors();
    }

    return $this;
});

Testable::macro('toBeValidateManager', function (Model $model, $action = 'submit') {
    Illuminate\Support\Facades\Gate::shouldReceive('authorize')
        ->with('create', get_class($model))
        ->andReturn(true)
        ->once();

    Illuminate\Support\Facades\Gate::shouldReceive('authorize')
        ->with('update', $model)
        ->andReturn(true)
        ->once();

    $this->call($action)
        ->assertHasErrors(['open'])
        ->set('open', false)
        ->call($action)
        ->assertHasErrors(['open'])
        ->call('load', $model)
        ->assertSet('open', true)
        ->call($action)
        ->assertHasNoErrors(['open']);

    return $this;
});
