<?php

use App\Http\Controllers\MarketController;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'markets',
    'as' => 'api.markets.',
    'middleware' => 'auth:sanctum',
], function () {
    Route::get('/', [MarketController::class, 'index'])->name('index');
    Route::get('/{market}', [MarketController::class, 'show'])->name('show');
    Route::post('/', [MarketController::class, 'store'])->name('store');
    Route::put('/{market}', [MarketController::class, 'update'])->name('update');
    Route::delete('/{market}', [MarketController::class, 'destroy'])->name('destroy');
});
