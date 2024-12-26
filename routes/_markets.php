<?php

use App\Http\Controllers\MarketController;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'markets',
    'as' => 'api.markets.',
    'middleware' => 'auth:sanctum',
], function () {
    Route::get('/', [MarketController::class, 'listMarkets'])->name('listMarkets');
});
