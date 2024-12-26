<?php

use App\Http\Controllers\CurrencyController;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'currencies',
    'as' => 'api.currencies.',
    'middleware' => 'auth:sanctum',
], function () {
    Route::get('/', [CurrencyController::class, 'listCurrencies'])->name('listCurrencies');
});
