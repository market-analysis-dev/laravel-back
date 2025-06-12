<?php

use App\Http\Controllers\MarketSizeController;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'market-size',
    'as' => 'api.market-size.',
    'middleware' => 'auth:sanctum',
], function () {
    Route::get('/', [MarketSizeController::class, 'index'])->name('index');
});
