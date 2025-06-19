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
    Route::get('/{buildingAbsorption}', [BuildingsAbsorptionController::class, 'show'])->name('show');
    Route::post('/{buildingAbsorption}', [BuildingsAbsorptionController::class, 'update'])->name('update');
    Route::delete('/{buildingAbsorption}', [BuildingsAbsorptionController::class, 'destroy'])->name('destroy');

    Route::put('/{buildingAbsorption}/to-available', [BuildingsAbsorptionController::class, 'toAvailable'])->name('to-available');
    Route::post('/{buildingAbsorption}/draft', [BuildingsAbsorptionController::class, 'draft'])->name('draft');
    Route::get('/{buildingAbsorption}/draft', [BuildingsAbsorptionController::class, 'getDraft'])->name('getDraft');
    Route::put('/{buildingAbsorption}/draft', [BuildingsAbsorptionController::class, 'updateDraft'])->name('updateDraft');
    Route::delete('/{buildingAbsorption}/draft', [BuildingsAbsorptionController::class, 'deleteDraft'])->name('deleteDraft');
});
