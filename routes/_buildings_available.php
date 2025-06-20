<?php

use App\Http\Controllers\BuildingsAvailableController;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'buildings/availability',
    'as' => 'api.buildings.availability.',
    'middleware' => 'auth:sanctum',
], function () {
    Route::get('/export', [BuildingsAvailableController::class, 'exportAvailability'])->name('exportAvailability');
    Route::get('/', [BuildingsAvailableController::class, 'index'])->name('index');
    Route::get('/{buildingAvailable}', [BuildingsAvailableController::class, 'show'])->name('show');
    Route::post('/', [BuildingsAvailableController::class, 'store'])->name('store');
    Route::post('/{buildingAvailable}', [BuildingsAvailableController::class, 'update'])->name('update');
    Route::delete('/{buildingAvailable}', [BuildingsAvailableController::class, 'destroy'])->name('destroy');

    Route::put('/{buildingAvailable}/to-absorption', [BuildingsAvailableController::class, 'toAbsorption'])->name('to-absorption');
    Route::post('/{buildingAvailable}/draft', [BuildingsAvailableController::class, 'draft'])->name('draft');
    Route::get('/{buildingAvailable}/draft', [BuildingsAvailableController::class, 'getDraft'])->name('getDraft');
    Route::put('/{buildingAvailable}/draft', [BuildingsAvailableController::class, 'updateDraft'])->name('updateDraft');
    Route::delete('/{buildingAvailable}/draft', [BuildingsAvailableController::class, 'deleteDraft'])->name('deleteDraft');
    Route::post('/import', [BuildingsAvailableController::class, 'importAvailability'])->name('importAvailability');

});

