<?php

use App\Http\Controllers\LandController;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'lands',
    'as' => 'api.lands.',
    'middleware' => 'auth:sanctum',
], function () {
    Route::get('/parcel-shape', [LandController::class, 'listParcelShape'])->name('listParcelShape');
    Route::get('/zoning', [LandController::class, 'listZoning'])->name('listZoning');
    Route::get('/', [LandController::class, 'index'])->name('index');
    Route::post('/', [LandController::class, 'store'])->name('store');
    Route::get('/{land}', [LandController::class, 'show'])->name('show');
    Route::put('/{land}', [LandController::class, 'update'])->name('update');
    Route::delete('/{land}', [LandController::class, 'destroy'])->name('destroy');
    Route::get('/service-state', [LandController::class, 'getServiceState'])->name('getServiceState');
});

