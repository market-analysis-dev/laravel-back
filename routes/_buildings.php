<?php

use App\Http\Controllers\BuildingController;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'buildings',
    'as' => 'api.buildings.',
//    'middleware' => 'auth:sanctum',
], function () {
    Route::get('/classes', [BuildingController::class, 'listClasses'])->name('listClasses');
    Route::get('/loading-doors', [BuildingController::class, 'listLoadingDoor'])->name('listLoadingDoor');
    Route::get('/phases', [BuildingController::class, 'listPhases'])->name('listPhases');
    Route::get('/types-generation', [BuildingController::class, 'listTypeGenerations'])->name('listTypeGenerations');
    Route::get('/tenancies', [BuildingController::class, 'listTenancies'])->name('listTenancies');
});

