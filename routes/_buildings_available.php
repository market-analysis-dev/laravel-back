<?php

use App\Http\Controllers\BuildingsAvailableController;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'buildings/availability',
    'as' => 'api.buildings.availability.',
    'middleware' => 'auth:sanctum',
], function () {
    Route::get('/', [BuildingsAvailableController::class, 'index'])->name('index');
    Route::post('/', [BuildingsAvailableController::class, 'store'])->name('store');
    Route::get('/{availability}', [BuildingsAvailableController::class, 'show'])->name('show');
    Route::put('/{availability}', [BuildingsAvailableController::class, 'update'])->name('update');
    Route::delete('/{availability}', [BuildingsAvailableController::class, 'destroy'])->name('destroy');
});

