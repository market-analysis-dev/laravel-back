<?php

use App\Http\Controllers\SubMarketController;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'submarkets',
    'as' => 'api.submarkets.',
    'middleware' => 'auth:sanctum',
], function () {
    Route::get('/', [SubMarketController::class, 'index'])->name('index');
    Route::post('/', [SubMarketController::class, 'store'])->name('create');
    Route::get('/{submarket}', [SubMarketController::class, 'show'])->name('show');
    Route::put('/{submarket}', [SubMarketController::class, 'update'])->name('update');
    Route::delete('/{submarket}', [SubMarketController::class, 'destroy'])->name('destroy');
});
