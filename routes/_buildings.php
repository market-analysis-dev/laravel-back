<?php

use App\Http\Controllers\BuildingController;
use App\Http\Controllers\BuildingFileController;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'buildings',
    'as' => 'api.buildings.',
    'middleware' => 'auth:sanctum',
], function () {
    Route::get('/classes', [BuildingController::class, 'listClasses'])->name('listClasses');
    Route::get('/loading-doors', [BuildingController::class, 'listLoadingDoors'])->name('listLoadingDoors');
    Route::get('/phases', [BuildingController::class, 'listPhases'])->name('listPhases');
    Route::get('/tenancies', [BuildingController::class, 'listTenancies'])->name('listTenancies');
    Route::get('/lightnings', [BuildingController::class, 'listLightnings'])->name('listLightnings');
    Route::get('/types-generation', [BuildingController::class, 'listTypeGenerations'])->name('listTypeGenerations');
    Route::get('/types-construction', [BuildingController::class, 'listTypeConstructions'])->name('listTypeConstructions');
    Route::get('/fire-protection-systems', [BuildingController::class, 'listFireProtectionSystems'])->name('listFireProtectionSystems');
    Route::get('/deals', [BuildingController::class, 'listDeals'])->name('listDeals');
    Route::get('/technical-improvements', [BuildingController::class, 'listTechnicalImprovements'])->name('listTechnicalImprovements');
    Route::get('/status', [BuildingController::class, 'listBuildingsStatus'])->name('listBuildingsStatus');
    Route::get('/company-types', [BuildingController::class, 'listBuildingsCompanyTypes'])->name('listBuildingsCompanyTypes');

    Route::get('/', [BuildingController::class, 'index'])->name('index');
    Route::post('/', [BuildingController::class, 'store'])->name('store');
    Route::get('/{building}', [BuildingController::class, 'show'])->name('show');
    Route::put('/{building}', [BuildingController::class, 'update'])->name('update');
    Route::delete('/{building}', [BuildingController::class, 'destroy'])->name('destroy');
    Route::post('/{building}/files', [BuildingFileController::class, 'uploadFiles'])->name('uploadFiles');
});

