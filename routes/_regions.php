<?php

use App\Http\Controllers\BuildingController;
use App\Http\Controllers\RegionController;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'regions',
    'as' => 'api.regions.',
    'middleware' => 'auth:sanctum',
], function () {
    Route::get('/', [RegionController::class, 'index'])->name('index');
    Route::post('/', [RegionController::class, 'store'])->name('store');
    Route::get('/{region}', [RegionController::class, 'show'])->name('show');
    Route::put('/{region}', [RegionController::class, 'update'])->name('update');
    Route::delete('/{region}', [RegionController::class, 'destroy'])->name('destroy');
});

