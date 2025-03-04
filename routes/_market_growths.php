<?php

use App\Http\Controllers\MarketGrowthController;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'market-growths',
    'as' => 'api.market-growths.',
    'middleware' => 'auth:sanctum'
], function () {
    Route::get('/', [MarketGrowthController::class, 'index'])->name('index');
    Route::post('/', [MarketGrowthController::class, 'store'])->name('store');
    Route::get('/{marketGrowth}', [MarketGrowthController::class, 'show'])->name('show');
    Route::put('/{marketGrowth}', [MarketGrowthController::class, 'update'])->name('update');
    Route::delete('/{marketGrowth}', [MarketGrowthController::class, 'destroy'])->name('destroy');
});
