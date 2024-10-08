<?php

declare(strict_types = 1);

use App\Http\Controllers\Auth\{LogoutController, VerifyEmailController};
use App\Livewire\Auth;
use Illuminate\Support\Facades\Route;

Route::get('login', Auth\Login::class)->name('login');
Route::get('register', Auth\Register::class)->name('register');
Route::group(['middleware' => 'auth'], function () {
    Route::post('logout', LogoutController::class)->name('logout');
    Route::get('email/verify', Auth\Email\Notice::class)->name('verification.notice')->middleware('unverified');
    Route::get('/verification/{id}/{hash}', VerifyEmailController::class)->name('verification.verify');
});
Route::prefix('password')->as('password.')->group(function () {
    Route::get('recovery', Auth\Password\Recovery::class)->name('recovery');
    Route::get('reset', Auth\Password\Reset::class)->name('reset');
});
