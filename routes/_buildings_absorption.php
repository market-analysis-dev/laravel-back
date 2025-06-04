<?php

use App\Http\Controllers\BuildingsAbsorptionController;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'buildings/absorption',
    'as' => 'api.buildings.absorption.',
    'middleware' => 'auth:sanctum',
], function () {
    Route::get('/', [BuildingsAbsorptionController::class, 'index'])->name('index');
    Route::post('/', [BuildingsAbsorptionController::class, 'store'])->name('store');
    Route::get('/{buildingAvailable}', [BuildingsAbsorptionController::class, 'show'])->name('show');
    Route::put('/{buildingAvailable}', [BuildingsAbsorptionController::class, 'update'])->name('update');
    Route::delete('/{buildingAvailable}', [BuildingsAbsorptionController::class, 'destroy'])->name('destroy');

    Route::put('/{buildingAvailable}/to-available', [BuildingsAbsorptionController::class, 'toAvailable'])->name('to-available');
    Route::post('/{buildingAvailable}/draft', [BuildingsAbsorptionController::class, 'draft'])->name('draft');
    Route::get('/{buildingAvailable}/draft', [BuildingsAbsorptionController::class, 'getDraft'])->name('getDraft');
    Route::put('/{buildingAvailable}/draft', [BuildingsAbsorptionController::class, 'updateDraft'])->name('updateDraft');
    Route::delete('/{buildingAvailable}/draft', [BuildingsAbsorptionController::class, 'deleteDraft'])->name('deleteDraft');
});
