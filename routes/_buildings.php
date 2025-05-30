<?php

use App\Http\Controllers\BuildingController;
use App\Http\Controllers\BuildingFileController;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'buildings',
    'as' => 'api.buildings.',
    'middleware' => 'auth:sanctum',
], function () {
    Route::post('/availability', [\App\Http\Controllers\BuildingsAvailableController::class, 'store'])->name('store');

    Route::put('/{building}/availability/{buildingAvailable}', [\App\Http\Controllers\BuildingsAvailableController::class, 'update'])->name('update');

    Route::delete('/{building}/availability/{buildingAvailable}', [\App\Http\Controllers\BuildingsAvailableController::class, 'destroy'])->name('destroy');


    Route::get('/classes', [BuildingController::class, 'listClasses'])->name('listClasses');
    Route::get('/loading-doors', [BuildingController::class, 'listLoadingDoors'])->name('listLoadingDoors');
    Route::get('/types', [BuildingController::class, 'listPhases'])->name('listPhases');
    Route::get('/building-types', [BuildingController::class, 'listBuildingTypes'])->name('listBuildingTypes');
    Route::get('/certifications', [BuildingController::class, 'listBuildingCertifications'])->name('listBuildingCertifications');
    Route::get('/owner-types', [BuildingController::class, 'listBuildingOwnerTypes'])->name('listBuildingOwnerTypes');
    Route::get('/stages', [BuildingController::class, 'listBuildingStages'])->name('listBuildingStages');
    Route::get('/tenancies', [BuildingController::class, 'listTenancies'])->name('listTenancies');
    Route::get('/lightnings', [BuildingController::class, 'listLightnings'])->name('listLightnings');
    Route::get('/generation', [BuildingController::class, 'listTypeGenerations'])->name('listTypeGenerations');
    Route::get('/types-construction', [BuildingController::class, 'listTypeConstructions'])->name('listTypeConstructions');
    Route::get('/fire-protection-systems', [BuildingController::class, 'listFireProtectionSystems'])->name('listFireProtectionSystems');
    Route::get('/deals', [BuildingController::class, 'listDeals'])->name('listDeals');
    Route::get('/technical-improvements', [BuildingController::class, 'listTechnicalImprovements'])->name('listTechnicalImprovements');
    Route::get('/status', [BuildingController::class, 'listBuildingsStatus'])->name('listBuildingsStatus');
    Route::get('/company-types', [BuildingController::class, 'listBuildingsCompanyTypes'])->name('listBuildingsCompanyTypes');
    Route::get('/final-uses', [BuildingController::class, 'listFinalUses'])->name('listFinalUses');
    Route::get('/', [BuildingController::class, 'index'])->name('index');
    /*Route::post('/', [BuildingController::class, 'store'])->name('store');*/
    Route::get('/{building}', [BuildingController::class, 'show'])->name('show');
    /*Route::put('/{building}', [BuildingController::class, 'update'])->name('update');*/
   /* Route::post('/{building}', [BuildingController::class, 'update'])->name('update');
    Route::delete('/{building}', [BuildingController::class, 'destroy'])->name('destroy');*/
    Route::post('/{building}/files', [BuildingFileController::class, 'uploadFiles'])->name('uploadFiles');

    Route::get('/{building}/layout-design', [BuildingController::class, 'layoutDesign'])->name('layoutDesign');
    Route::post('/{building}/draft', [BuildingController::class, 'draft'])->name('draft');
    Route::get('/{building}/draft', [BuildingController::class, 'getDraft'])->name('getDraft');
    Route::put('/{building}/draft', [BuildingController::class, 'updateDraft'])->name('updateDraft');
    Route::delete('/{building}/draft', [BuildingController::class, 'deleteDraft'])->name('deleteDraft');
});

