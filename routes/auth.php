<?php

use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function(){
    Route::get('validation', fn() => 'oi')->name('auth.email-validation');
});
