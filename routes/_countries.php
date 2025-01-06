<?php

use App\Http\Controllers\CountryController;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'countries',
    'as' => 'api.countries.',
    'middleware' => 'auth:sanctum',
], function () {
    Route::get('/', [CountryController::class, 'index'])->name('index');
});
