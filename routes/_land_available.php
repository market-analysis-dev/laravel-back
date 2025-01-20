<?php

use App\Http\Controllers\LandAvailableController;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'lands/{land}/available',
    'as' => 'api.lands.available.',
    'middleware' => 'auth:sanctum',
], function () {
    Route::get('/', [LandAvailableController::class, 'index'])->name('index');
    Route::post('/', [LandAvailableController::class, 'store'])->name('store');
    Route::get('/{landAvailable}', [LandAvailableController::class, 'show'])->name('show');
    Route::put('/{landAvailable}', [LandAvailableController::class, 'update'])->name('update');
    Route::delete('/{landAvailable}', [LandAvailableController::class, 'destroy'])->name('destroy');
});
