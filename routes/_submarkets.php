<?php

use App\Http\Controllers\SubMarketController;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'submarkets',
    'as' => 'api.submarkets.',
    'middleware' => 'auth:sanctum',
], function () {
    Route::get('/', [SubMarketController::class, 'index'])->name('listSubMarkets');
});
