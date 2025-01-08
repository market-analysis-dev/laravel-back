<?php

use App\Http\Controllers\BuildingsAbsorptionController;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'buildings/{building}/absorption',
    'as' => 'api.buildings.absorption.',
    'middleware' => 'auth:sanctum',
], function () {
    Route::get('/', [BuildingsAbsorptionController::class, 'index'])->name('index');
    Route::post('/', [BuildingsAbsorptionController::class, 'store'])->name('store');
    Route::get('/{buildingAbsorption}', [BuildingsAbsorptionController::class, 'show'])->name('show');
    Route::put('/{buildingAbsorption}', [BuildingsAbsorptionController::class, 'update'])->name('update');
    Route::delete('/{buildingAbsorption}', [BuildingsAbsorptionController::class, 'destroy'])->name('destroy');
});
